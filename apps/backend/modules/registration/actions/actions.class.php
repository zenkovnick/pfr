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
            $this->redirect("@homepage");
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
            $this->redirect("@homepage");
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
                    $this->redirect("@homepage");
                } else {
                    $this->getUser()->signIn($user);
                    $this->redirect('@homepage');
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

                    $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');

                }

                //return $this->redirect('@blog');
            } else {
                $this->getUser()->setFlash('error', 'Username or Password is incorrect');
                $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));

                $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
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

    public function executeForgotPassword(sfWebRequest $request){
        $this->form = new ForgotPasswordForm();

        if ($request->isMethod('post'))
        {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid())
            {
                $this->user = $this->form->user;
                $pass = $this->user->generatePassword();
                $this->user->setPassword($pass);
                $this->user->save();
                EmailNotification::sendPasswordRecovery(
                    $this->form->user->username,
                    $this->getPartial('registration/password_recovery', array('email' => $this->form->user->username, 'password' => $pass)),
                    'Forgot Password Request for '.$this->form->user->username
                );

                $this->redirect('@signin');
            }
        }
    }

}