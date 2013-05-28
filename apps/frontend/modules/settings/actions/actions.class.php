<?php

class settingsActions extends sfActions {
    public function executeIndex(sfWebRequest $request){
        $account_id = $request->getParameter('account_id');
        $user = Doctrine_Core::getTable('sfGuardUser')->find($this->getUser()->getGuardUser()->getId());
        if(!sfGuardUserTable::checkUserAccountAccess($account_id, $user->getId())){
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }
        $this->account = Doctrine_Core::getTable('Account')->find($account_id);
        $this->account_form = new AccountForm($this->account);
        $this->user_form = new MyInformationSettingsForm($user);
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
}