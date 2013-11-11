<?php
class homeComponents extends sfComponents
{
    public function executeUnderControl()
    {
//        $this->controller = sfGuardUserTable::getInstance()->find($this->getUser()->getAttribute('controller_id'));
//        $this->controlled = sfGuardUserTable::getInstance()->find($this->getUser()->getAttribute('controlled_id'));

        $controllers = $this->getUser()->getAttribute('controllers');
        if(count($controllers) > 0 && $this->getUser()->isAuthenticated() && in_array($this->getUser()->getGuardUser()->getId(), $controllers)){
            $controller_id = array_search($this->getUser()->getGuardUser()->getId(), $controllers);
            $controlled_id = $controllers[$controller_id];
            $this->controller = sfGuardUserTable::getInstance()->find($controller_id);
            $this->controlled = sfGuardUserTable::getInstance()->find($controlled_id);

        } else {
            return sfView::NONE;
        }
    }
}