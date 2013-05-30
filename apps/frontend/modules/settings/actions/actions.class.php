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


    /* PLANE */

    public function executeSavePlane(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $form = new PlaneForm();
        if($request->isMethod('post')){
            $form->bind($request->getParameter($form->getName()));
            if($form->isValid()){
                $plane = $form->save();
                $account_plane = new AccountPlane();
                $account_plane->setAccount(Doctrine_Core::getTable('Account')->find($request->getParameter('account_id')));
                $account_plane->setPlane($plane);
                $account_plane->save();
                $plane->setPosition(PlaneTable::getMaxPosition($request->getParameter('account_id')) + 1);
                $plane->save();
                echo json_encode(
                    array(
                        'result' => 'OK',
                        'account_id' => $plane->getId(),
                        'new_form_num' => $request->getParameter('new_form_num'),
                        'tail_number' => $plane->getTailNumber()
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
        $form = new PlaneForm(Doctrine_Core::getTable('Plane')->find($request->getParameter('plane_id')));
        if($request->isMethod('post')){
            $form->bind($request->getParameter($form->getName()));
            if($form->isValid()){
                $form->getObject()->save();
                $form->save();
                echo json_encode(
                    array(
                        'result' => 'OK',
                        'plane_id' => $form->getObject()->getId(),
                        'tail_number' => $form->getObject()->getTailNumber()
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
        $plane = Doctrine_Core::getTable('Plane')->find($request->getParameter('id'));
        if($plane){
            $plane->delete();
            echo json_encode(array('result' => 'OK'));
        } else {
            echo json_encode(array('result' => 'Failed'));
        }
        return sfView::NONE;
    }

    public function executeEditPlaneField(sfWebRequest $request){
        $this->forward404unless($request->isXmlHttpRequest());
        $plane_id = intval($request->getParameter("plane_id"));
        $account_id = intval($request->getParameter("account_id"));
        $plane = Doctrine_Core::getTable('Plane')->find($plane_id);
        $this->form = new PlaneForm($plane);
        return $this->renderPartial('editPlane',array('form' => $this->form, 'plane' => $plane, 'account_id' => $account_id));
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
        $account_id = $request->getParameter('account_id');
        $planes = PlaneTable::getPlanesByAccount($account_id);
        foreach($planes as $plane){
            $curr_position = $ids[$plane->getId()] + 1;
            if($plane->getPosition() != $curr_position){
                $plane->setPosition($curr_position);
                $plane->save();
            }
        }

        return sfView::NONE;
    }


    /* PILOT */

    public function executeSavePilot(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $form = new PilotForm();
        if($request->isMethod('post')){
            $form->bind($request->getParameter($form->getName()));
            if($form->isValid()){
                $pilot = $form->save();
                $user_account = new UserAccount();
                $user_account->setAccount(Doctrine_Core::getTable('Account')->find($request->getParameter('account_id')));
                $user_account->setUser($pilot);
                $user_account->save();
                $pilot->setPosition(PlaneTable::getMaxPosition($request->getParameter('account_id')) + 1);
                $pilot->save();
                echo json_encode(
                    array(
                        'result' => 'OK',
                        'pilot_id' => $pilot->getId(),
                        'new_form_num' => $request->getParameter('new_form_num'),
                        'name' => $pilot->getFirstName()
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

    public function executeUpdatePilot(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $form = new PilotForm(Doctrine_Core::getTable('sfGuardUser')->find($request->getParameter('pilot_id')));
        if($request->isMethod('post')){
            $form->bind($request->getParameter($form->getName()));
            if($form->isValid()){
                $form->getObject()->save();
                $form->save();
                echo json_encode(
                    array(
                        'result' => 'OK',
                        'pilot_id' => $form->getObject()->getId(),
                        'name' => $form->getObject()->getFirstName()
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

    public function executeDeletePilot(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $pilot = Doctrine_Core::getTable('sfGuardUser')->find($request->getParameter('id'));
        if($pilot && $pilot->getId() != $this->getUser()->getGuardUser()->getId()){
            $pilot->delete();
            echo json_encode(array('result' => 'OK'));
        } else {
            echo json_encode(array('result' => 'Failed'));
        }
        return sfView::NONE;
    }

    public function executeEditPilotField(sfWebRequest $request){
        $this->forward404unless($request->isXmlHttpRequest());
        $pilot_id = intval($request->getParameter("pilot_id"));
        $account_id = intval($request->getParameter("account_id"));
        $pilot = Doctrine_Core::getTable('sfGuardUser')->find($pilot_id);
        $this->form = new PilotForm($pilot);
        return $this->renderPartial('editPilot',array('form' => $this->form, 'pilot' => $pilot, 'account_id' => $account_id));
    }

    public function executeAddNewPilotField(sfWebRequest $request){
        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getPostParameter("pilot_num"));
        $account_id = intval($request->getPostParameter("account_id"));
        $this->form = new PilotForm();
        return $this->renderPartial('addNewPilot',array('form' => $this->form, 'number' => $number, 'account_id' => $account_id));
    }

    public function executeSavePilotPosition(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $ids_json = $request->getParameter('ids');
        $ids = array_flip(json_decode($ids_json));
        $account_id = $request->getParameter('account_id');
        $pilots = sfGuardUserTable::getPilotsByAccount($account_id);
        foreach($pilots as $pilot){
            $curr_position = $ids[$pilot->getId()] + 1;
            if($pilot->getPosition() != $curr_position){
                $pilot->setPosition($curr_position);
                $pilot->save();
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