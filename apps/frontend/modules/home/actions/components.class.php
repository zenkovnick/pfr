<?php
class homeComponents extends sfComponents
{
    public function executeUnderControl()
    {
        $this->controller = sfGuardUserTable::getInstance()->find($this->getUser()->getAttribute('controller_id'));
        $this->controlled = sfGuardUserTable::getInstance()->find($this->getUser()->getAttribute('controlled_id'));
    }
}