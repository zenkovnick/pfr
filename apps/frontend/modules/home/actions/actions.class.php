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

    public function executeIndex(sfWebRequest $request)
    {

    }

    public function executeFinishControlling(sfWebRequest $request){
//        if($this->getUser()->getAttribute('controller_id')){
//            $user = sfGuardUserTable::getInstance()->find($this->getUser()->getAttribute('controller_id'));
//            $this->getUser()->getAttributeHolder()->remove('controller_id');
//            $this->getUser()->getAttributeHolder()->remove('controlled_id');
//            $this->getUser()->signIn($user);
//
//            $this->redirect('/admin/users');
//        } else {
//            $this->redirect('@select_account');
//        }

        if($this->getUser()->getAttribute('controllers')){
            $controllers = $this->getUser()->getAttribute('controllers');
            if(count($controllers) > 0 && in_array($this->getUser()->getGuardUser()->getId(), $controllers)){
                $controller_id = array_search($this->getUser()->getGuardUser()->getId(), $controllers);
                $user = sfGuardUserTable::getInstance()->find($controller_id);
                unset($controllers[$controller_id]);
                if(count($controllers) > 0){
                    $this->getUser()->setAttribute('controllers', $controllers);
                } else {
                    $this->getUser()->getAttributeHolder()->remove('controllers');
                }
                $this->getUser()->signIn($user);
                $this->redirect('/admin/users');
            } else {
                $this->redirect('@select_account');
            }
        } else {
            $this->redirect('@select_account');
        }

    }

}
