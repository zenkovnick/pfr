<?php

class settingsActions extends sfActions {
    public function executeIndex(sfWebRequest $request){
        $account_id = $request->getParameter('account_id');
        $this->user = Doctrine_Core::getTable('sfGuardUser')->find($this->getUser()->getGuardUser()->getId());
        if(!sfGuardUserTable::checkUserAccountAccess($account_id, $this->user->getId())){
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }
        $this->account = Doctrine_Core::getTable('Account')->find($account_id);
        $this->account_form = new AccountForm($this->account);
        $this->user_form = new MyInformationSettingsForm($this->user);
        $this->planes = PlaneTable::getPlanesByAccount($account_id);
        $this->pilots = sfGuardUserTable::getPilotsByAccount($account_id);
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
                $values = $form->getTaintedValues();
                if(!($plane = PlaneTable::existPlane($values['tail_number']))){
                    $plane = $form->save();
                }
                if(!AccountPlaneTable::existPlaneInAccount($plane->getId(), $request->getParameter('account_id'))){
                    $account_plane = new AccountPlane();
                    $account_plane->setAccount(Doctrine_Core::getTable('Account')->find($request->getParameter('account_id')));
                    $account_plane->setPlane($plane);
                    $account_plane->setPosition(AccountPlaneTable::getMaxPosition($request->getParameter('account_id')) + 1);
                    $account_plane->save();
                    echo json_encode(
                        array(
                            'result' => 'OK',
                            'plane_id' => $plane->getId(),
                            'new_form_num' => $request->getParameter('new_form_num'),
                            'tail_number' => $plane->getTailNumber()
                        )
                    );
                } else {
                    $error_fields[] = 'tail_number';
                    echo json_encode(
                        array(
                            'result' => 'Failed',
                            'error_fields' => $error_fields,
                            'new_form_num' => $request->getParameter('new_form_num'),
                        )
                    );
                }
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
        $old_plane = Doctrine_Core::getTable('Plane')->find($request->getParameter('plane_id'));
        $form = new PlaneForm($old_plane);
        if($request->isMethod('post')){
            $form->bind($request->getParameter($form->getName()));
            if($form->isValid()){
                $values = $form->getTaintedValues();
                if($old_plane->getTailNumber() != $values['tail_number']){
                    if(!($plane = PlaneTable::existPlane($values['tail_number']))){
                        $form->getObject()->save();
                        $plane = $form->save();
                        echo json_encode(
                            array(
                                'result' => 'OK',
                                'plane_id' => $plane->getId(),
                                'tail_number' => $plane->getTailNumber()
                            )
                        );
                    } else {
                        $old_account_plane = AccountPlaneTable::existPlaneInAccount($old_plane->getId(), $request->getParameter('account_id'));
                        $old_account_plane->setPlane($plane);
                        $old_account_plane->save();
                        echo json_encode(
                            array(
                                'result' => 'Changed',
                                'new_plane_id' => $plane->getId(),
                                'old_plane_id' => $old_plane->getId(),
                                'tail_number' => $plane->getTailNumber()
                            )
                        );
                    }
                } else {
                    echo json_encode(
                        array(
                            'result' => 'OK',
                            'plane_id' => $old_plane->getId(),
                            'tail_number' => $old_plane->getTailNumber()
                        )
                    );

                }
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
        $account_planes = AccountPlaneTable::getPlanesByAccount($account_id);
        foreach($account_planes as $account_plane){
            $curr_position = $ids[$account_plane->getPlaneId()] + 1;
            if($account_plane->getPosition() != $curr_position){
                $account_plane->setPosition($curr_position);
                $account_plane->save();
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
                $values = $form->getTaintedValues();
                if(sfGuardUserTable::checkUserByUsername($values['username'])){
                    $pilot = $form->save();
                    $user_account = new UserAccount();
                    $user_account->setAccount(Doctrine_Core::getTable('Account')->find($request->getParameter('account_id')));
                    $user_account->setUser($pilot);
                    $user_account->setPosition(UserAccountTable::getMaxPosition($request->getParameter('account_id')) + 1);
                    $user_account->save();
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
                            'type' => 'username_exists',
                            'new_form_num' => $request->getParameter('new_form_num'),
                        )
                    );
                }

            } else {
                $errors = $form->getErrorSchema()->getErrors();
                $error_fields = array();
                foreach($errors as $key => $error){
                    $error_fields[] = $key;
                }
                echo json_encode(
                    array(
                        'result' => 'Failed',
                        'error_fields' => $error_fields,
                        'new_form_num' => $request->getParameter('new_form_num'),
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
                $errors = $form->getErrorSchema()->getErrors();
                $error_fields = array();
                foreach($errors as $key => $error){
                    $error_fields[] = $key;
                }
                echo json_encode(
                    array(
                        'result' => 'Failed',
                        'error_fields' => $error_fields,
                        'pilot_id' => $request->getParameter('pilot_id'),
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
        $account_pilots = UserAccountTable::getPilotsByAccount($account_id);
        foreach($account_pilots as $account_pilot){
            $curr_position = $ids[$account_pilot->getUserId()] + 1;
            if($account_pilot->getPosition() != $curr_position){
                $account_pilot->setPosition($curr_position);
                $account_pilot->save();
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