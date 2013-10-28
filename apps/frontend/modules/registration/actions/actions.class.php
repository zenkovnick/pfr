<?php
/**
 * Created by JetBrains PhpStorm.
 * User: zenkovnick
 * Date: 24.05.13
 * Time: 12:19
 * To change this template use File | Settings | File Templates.
 */

class registrationActions extends sfActions
{
    public function executeIndex(sfWebRequest $request) {

    }

    public function executeSignin(sfWebRequest $request) {
        if($this->getUser()->isAuthenticated()){
            $accounts = AccountTable::getAllUserAccounts($this->getUser()->getGuardUser());
            if($accounts->count() >= 1) {
                $this->redirect("@dashboard?account_id={$accounts->getFirst()->getId()}");

            } else {
                $this->redirect("@select_account");
            }

        }
        else
        {
            if($request->getParameter('redirect_to')){
                $this->getUser()->setAttribute('redirect_to', $request->getParameter('redirect_to'));
            }
            $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
            $this->form = new $class();

        }
    }


    public function executeSignup(sfWebRequest $request) {
        if($this->getUser()->isAuthenticated()){
            $this->redirect("@select_account");
        }
        if($request->getParameter('token')){
            $this->forward404Unless($user_account = Doctrine_Core::getTable('UserAccount')->findOneBy('invite_token', $request->getParameter('token')));
            $invited_user = $user_account->getUser();
            if($invited_user){
                $this->form = new RegistrationForm($invited_user);
            }
        } else {
            $this->form = new RegistrationForm();
        }
        if($request->isMethod('POST')){
            $this->form->bind($request->getPostParameter($this->form->getName()));
            if($this->form->isValid()){
                $user = $this->form->save();
                if($request->getParameter('token')){
                    $this->forward404Unless($user_account = Doctrine_Core::getTable('UserAccount')->findOneBy('invite_token', $request->getParameter('token')));
                    $user_account->setIsActive(true);
                    $user_account->save();
                    $this->getUser()->signIn($user);
                    $this->redirect("@dashboard?account_id=".$user_account->getAccount()->getId());
                } else {
                    $this->getUser()->signIn($user);
                    $this->redirect('@create_account');
                }
            } else {
            $errors = $this->form->getErrorSchema()->getErrors();
            $error_fields = array();
            foreach($errors as $key => $error){
                $error_fields[] = $key;
            }
            echo json_encode(
                array(
                    'result' => 'Failed',
                    'error_fields' => $error_fields
                )
            );

            }
        }
    }

    public function executeApproveAccount(sfWebRequest $request) {
        $this->getUser()->setAttribute('approve', $request->getUri());
        if($this->getUser()->isAuthenticated()){
            $this->user = $this->getUser()->getGuardUser();
            if($request->getParameter('token')){
                $this->forward404Unless($this->user_account = Doctrine_Core::getTable('UserAccount')->findOneBy('invite_token', $request->getParameter('token')));
                if($this->user_account->getUserId() != $this->user->getId()){
                    $this->redirect("@select_account");
                } else {
                    $this->account = $this->user_account->getAccount();
                }
            } else {
                $this->redirect("@select_account");
            }

        } else {
            if($request->getParameter('token')){
                $url = $this->generateUrl('approve_account', array('token' => $request->getParameter('token')), true);
                $this->getUser()->setAttribute('refer_page', $url);
            }
            $this->redirect("@signin");
        }
    }

    public function executeApproveAccountProcess(sfWebRequest $request) {
        if($request->getParameter('token')){
            $this->forward404Unless($this->user_account = Doctrine_Core::getTable('UserAccount')->findOneBy('invite_token', $request->getParameter('token')));
            if($request->getParameter('status') == 'approve') {
                $this->user_account->setIsActive(true);
                $this->user_account->setInviteToken(null);
                $this->user_account->save();
                $this->getUser()->getAttributeHolder()->remove('approve');
                $this->redirect("@dashboard?account_id=".$this->user_account->getAccount()->getId());
            } else {
                $this->getUser()->getAttributeHolder()->remove('approve');
                $this->user_account->delete();
                $this->redirect("@select_account");
            }
        } else {
            $this->getUser()->getAttributeHolder()->remove('approve');
            $this->redirect("@select_account");
        }
    }



    public function executeSelectAccount(sfWebRequest $request) {
        $this->accounts = AccountTable::getAllUserAccounts($this->getUser()->getGuardUser());
        $this->getUser()->getAttributeHolder()->remove('flight_filter');
        if($this->accounts->count() == 0){
            $this->redirect('@create_account');
        }
    }

    public function executeCreateAccount(sfWebRequest $request) {
        if($this->getUser()->isAuthenticated()){
            $this->user = $this->getUser()->getGuardUser();
            $this->form = new AccountForm(null, array('curr_user' => $this->user));
            if($request->isMethod('POST')){
                $this->form->bind($request->getPostParameter($this->form->getName()),$request->getFiles($this->form->getName()));
                if($this->form->isValid()){
                    $values = $this->form->getTaintedValues();
                    $chief_exists = ($values['chief_pilot_name'] && !sfGuardUserTable::checkUserByUsername($values['chief_pilot_name'])) ? true : false;
                    $account = $this->form->save();
                    $account->setManager($this->user);
                    $user_account = UserAccountTable::getUserAccount($this->user->getId(), $account->getId());
                    if(!$user_account){
                        $user_account = new UserAccount();
                        $user_account->setAccount($account);
                        $user_account->setUser($this->user);
                        $user_account->setIsManager(true);
                        $user_account->setRole('both');
                        $user_account->setIsActive(true);
                        $user_account->save();
                    }

                    $risk_builder = new RiskBuilder();
                    $risk_builder->createDefaultForm($account);

                    $chief_pilot = $account->getChiefPilot();
                    if($chief_pilot && $chief_pilot->getId() && $chief_pilot->getId() != $this->user->getId()){
                        $chief_user_account = UserAccountTable::getUserAccount($chief_pilot->getId(), $account->getId());

                        if($chief_exists){
                            $url = $this->generateUrl('approve_account', array('token' => $chief_user_account->getInviteToken()), true);
                            EmailNotification::sendChiefAccountApprove($this->getUser()->getGuardUser(), $chief_pilot, $url, $account);

                        } else {
                            $url = $this->generateUrl('signup_invite', array('token' => $chief_user_account->getInviteToken()), true);
                            EmailNotification::sendChiefInvite($this->getUser()->getGuardUser(), $chief_pilot, $url, $account);

                        }
                    }

                    if($this->getUser()->getAttribute('approve')){
                        $redirect = $this->getUser()->getAttribute('approve');
                        $this->getUser()->getAttributeHolder()->remove('approve');
                        $this->redirect($redirect);
                    } else {
                        $this->redirect("@dashboard?account_id={$account->getId()}");
                    }
                }
            }
        } else {
            $this->redirect('@signup');
        }
    }

    public function executeUploadAvatar(sfWebRequest $request)
    {
        $upload_handler = new UploadHandler(array(
            'upload_dir' => getcwd()."/uploads/avatar/",
            'upload_url' => "/uploads/avatar/",
            'param_name' => 'account'
        ));
        if ($request->isMethod('post'))
        {
            $response = json_decode($upload_handler->post(), true);
            echo json_encode($response);

        }
        return sfView::NONE;
    }

    public function executeGetWidget(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->renderPartial('registration/uploaded_avatar', array('file_path' => str_replace('/uploads/', '', $request->getParameter('url'))));
        return sfView::NONE;
    }

    public function executeProcessSignin($request)
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers("Url");
        $user = $this->getUser();
        if ($user->isAuthenticated())
        {
            $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));

            return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
        }

        $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
        $this->form = new $class();

        if ($request->isMethod('post'))
        {
            $this->form->bind($request->getParameter('signin'));
            if ($this->form->isValid())
            {
                $values = $this->form->getValues();
                $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

                // always redirect to a URL set in app.yml
                // or to the referer
                // or to the homepage
                $route = $user->getAttribute('redirect_to');
                $user->getAttributeHolder()->remove('redirect_to');
                if($route){
                    $this->redirect("@{$route}");
                } else {
                    $refer_page =  $this->getUser()->getAttribute('refer_page', null);
                    $this->getUser()->getAttributeHolder()->remove('refer_page');
                    if(!is_null($refer_page)){
                        $signinUrl = $refer_page;
                    } else {
                        $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));
                    }

                    $this->redirect('' != $signinUrl ? $signinUrl : '@select_account');

                }

                //return $this->redirect('@blog');
            } else {
                $this->getUser()->setFlash('error', 'Username or Password is incorrect');
                $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));

                $this->redirect('' != $signinUrl ? $signinUrl : '@dashboard');
            }
        }

        else
        {
            if ($request->isXmlHttpRequest())
            {
                $this->getResponse()->setHeaderOnly(true);
                $this->getResponse()->setStatusCode(401);

                return sfView::NONE;
            }

            // if we have been forwarded, then the referer is the current URL
            // if not, this is the referer of the current request
            $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

            $module = sfConfig::get('sf_login_module');
            if ($this->getModuleName() != $module)
            {
                return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
            }

            $this->getResponse()->setStatusCode(401);
        }

    }


    public function executeSignout($request)
    {
        $this->getUser()->signOut();
        $this->getUser()->getAttributeHolder()->remove('refer_page');
        $this->getUser()->getAttributeHolder()->remove('flight_filter');
        $signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());

        $this->redirect("@signin");
    }

    public function executeSignupCheck($request)
    {
        $this->setLayout(false);
        if($request->getParameter('email')){
            if(sfGuardUserTable::checkUserByUsername($request->getParameter('email'))){
                echo json_encode(array('result' => 'OK'));
            } else {
                echo json_encode(array('result' => 'Exists'));

            }
        } else {
            echo json_encode(array('result' => 'Failed'));
        }
        return sfView::NONE;
    }

    public function executeAutocompletePilots(sfWebRequest $request) {
        $this->setLayout(false);
        $result = sfGuardUserTable::getInstance()
            ->getUsersByUsername($request['term']);
        $array = array();
        foreach($result as $pilot){
            $record['id'] = $pilot->getId();
            $record['username'] = $pilot->getUsername();
            $record['value'] = $pilot->getFirstName();
            //$record['value'] = $pilot->getFirstName();
            $array[] = $record;
        }
        return $this->renderText(json_encode($array));
    }
}