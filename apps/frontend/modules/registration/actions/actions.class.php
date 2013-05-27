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

    public function executeSignup(sfWebRequest $request) {
        $this->form = new RegistrationForm();
        if($request->isMethod('POST')){
            $this->form->bind($request->getPostParameter($this->form->getName()));
            if($this->form->isValid()){
                $user = $this->form->save();
                $this->getUser()->signIn($user);
                $this->redirect('@create_account');
            }
        }
    }

    public function executeCreateAccount(sfWebRequest $request) {
//        if($this->getUser()->isAuthenticated()){
            $this->form = new AccountForm();
            if($request->isMethod('POST')){
                $this->form->bind($request->getPostParameter($this->form->getName()),$request->getFiles($this->form->getName()));
                if($this->form->isValid()){
                    $account = $this->form->save();
                    $user_account = new UserAccount();
                    $user_account->setAccount($account);
                    $user_account->setUser($this->getUser()->getGuardUser());
                    $user_account->setIsManager(true);
                    $user_account->save();
                    $this->redirect('@dashboard');
                }
            }
  /*      } else {
            $this->redirect('@create_account');
        }*/
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
}