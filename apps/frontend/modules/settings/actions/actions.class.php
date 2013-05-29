<?php

class settingsActions extends sfActions {
    public function executeIndex(sfWebRequest $request){
        $account_id = $request->getParameter('account_id');
        $this->user = Doctrine_Core::getTable('sfGuardUser')->find($this->getUser()->getGuardUser()->getId());
        if(!sfGuardUserTable::checkUserAccountAccess($account_id, $this->user->getId())){
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }
        $this->account = Doctrine_Core::getTable('Account')->find($account_id);
        $this->planes = PlaneTable::getPlanesByAccount($account_id);
        $this->account_form = new AccountForm($this->account);
        $this->user_form = new MyInformationSettingsForm($this->user);
    }

    public function executeProcessMyInformationData(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->user = Doctrine_Core::getTable('sfGuardUser')->find($this->getUser()->getGuardUser()->getId());
        $this->form = new MyInformationSettingsForm($this->user);
        if($request->isMethod('POST')){
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if($this->form->isValid()){
                $this->form->save();
                echo json_encode(array('result' => 'OK'));
            } else {
                echo json_encode(array('result' => 'Not Valid'));
            }
        }
        return sfView::NONE;
    }

    public function executeProcessAccountData(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->user = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        $this->form = new AccountForm($this->user);
        if($request->isMethod('POST')){
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if($this->form->isValid()){
                $this->form->save();
                echo json_encode(array('result' => 'OK'));
            } else {
                echo json_encode(array('result' => 'Not Valid'));
            }
        }
        return sfView::NONE;
    }

    public function executeSavePlane(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $form = new PlaneForm();
        if($request->isMethod('post')){
            $form->bind($request->getParameter($form->getName()));
            if($form->isValid()){
                $form->save();
                $form->getObject()->setAccounts(Doctrine_Core::getTable('Account')->find($request->getParameter('account_id')));
                $form->getObject()->setPosition(RiskFactorFieldTable::getMaxPosition() + 1);
                $form->getObject()->save();
                echo json_encode(
                    array(
                        'result' => 'OK',
                        'risk_id' => $form->getObject()->getId(),
                        'new_form_num' => $request->getParameter('new_form_num'),
                        'question' => $form->getObject()->getQuestion()
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'result' => 'Failed',
                    )
                );

            }
        }
        return sfView::NONE;
    }

    public function executeUpdatePlane(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $form = new RiskFactorOptionsForm(Doctrine_Core::getTable('RiskFactorField')->find($request->getParameter('risk_factor_id')));
        if($request->isMethod('post')){
            $form->bind($request->getParameter($form->getName()));
            if($form->isValid()){
                $form->getObject()->save();
                $form->save();
                echo json_encode(
                    array(
                        'result' => 'OK',
                        'risk_id' => $form->getObject()->getId(),
                        'question' => $form->getObject()->getQuestion()
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'result' => 'Failed'
                    )
                );

            }
            //$this->redirect('@form');
        }
        return sfView::NONE;
    }

    public function executeDeletePlane(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $risk_factor = Doctrine_Core::getTable('RiskFactorField')->find($request->getParameter('id'));
        if($risk_factor){
            $risk_factor->delete();
            echo json_encode(array('result' => 'OK'));
        } else {
            echo json_encode(array('result' => 'Failed'));
        }
        return sfView::NONE;
    }

    public function executeAddNewPlaneField(sfWebRequest $request){
        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getPostParameter("plane_num"));
        $account_id = intval($request->getPostParameter("account_id"));
        $this->form = new PlaneForm();
        return $this->renderPartial('addNewPlane',array('form' => $this->form, 'number' => $number, 'account_id' => $account_id));
    }

    public function executeSavePlanePosition(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $ids_json = $request->getParameter('ids');
        $ids = array_flip(json_decode($ids_json));
        $form_id = $request->getParameter('form_id');
        $risk_factors = RiskFactorFieldTable::getAllRiskFactors($form_id);
        foreach($risk_factors as $risk_factor){
            $curr_position = $ids[$risk_factor->getId()] + 1;
            if($risk_factor->getPosition() != $curr_position){
                $risk_factor->setPosition($curr_position);
                $risk_factor->save();
            }
        }

        return sfView::NONE;
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