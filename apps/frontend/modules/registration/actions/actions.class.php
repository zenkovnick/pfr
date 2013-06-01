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
            $this->redirect("@select_account");
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
        if($request->getParameter('token')){
            $invited_user = Doctrine_Core::getTable('sfGuardUser')->findOneBy('invite_token', $request->getParameter('token'));
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
                    $user->setIsActive(true);
                }
                $this->getUser()->signIn($user);
                $this->redirect('@create_account');
            }
        }
    }

    public function executeSelectAccount(sfWebRequest $request) {
        $this->accounts = AccountTable::getAllUserAccounts($this->getUser()->getGuardUser());
        if($this->accounts->count() == 0){
            $this->redirect('@create_account');
        }
    }

    public function executeCreateAccount(sfWebRequest $request) {
        if($this->getUser()->isAuthenticated()){
            $this->form = new AccountForm();
            if($request->isMethod('POST')){
                $this->form->bind($request->getPostParameter($this->form->getName()),$request->getFiles($this->form->getName()));
                $this->user = $this->getUser()->getGuardUser();
                if($this->form->isValid()){
                    $account = $this->form->save();
                    $account->setManager($this->user);
                    $user_account = new UserAccount();
                    $user_account->setAccount($account);
                    $user_account->setUser($this->user);
                    $user_account->setIsManager(true);
                    $user_account->save();
                    $this->redirect("@dashboard?account_id={$account->getId()}");
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
            $upload_handler->post();
        }
        return sfView::NONE;
    }

    public function executeCropImage(sfWebRequest $request)
    {
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
                    $this->getUser()->setAttribute('refer_page', null);
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
        $this->getUser()->setAttribute('refer_page', null);

        $signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());

        $this->redirect($signoutUrl);
    }
}