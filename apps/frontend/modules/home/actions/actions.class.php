<?php

/**
 * article actions.
 *
 * @package    blueprint
 * @subpackage article
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {

    }

    public function executeFinishControlling(sfWebRequest $request){
        if($this->getUser()->getAttribute('controller_id')){
            $user = sfGuardUserTable::getInstance()->find($this->getUser()->getAttribute('controller_id'));
            $this->getUser()->getAttributeHolder()->remove('controller_id');
            $this->getUser()->getAttributeHolder()->remove('controlled_id');
            $this->getUser()->signIn($user);

            $this->redirect('/admin/users');
        } else {
            $this->redirect('@select_account');
        }
    }

}
