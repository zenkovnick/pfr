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
        $this->form = new AccountForm();
    }

    public function executeUploadAvatar(sfWebRequest $request)
    {
        $upload_handler = new UploadHandler(array(
            'upload_dir' => getcwd()."/uploads/avatar/",
            'upload_url' => "/uploads/avatar/",
            'param_name' => 'sf_guard_user'
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