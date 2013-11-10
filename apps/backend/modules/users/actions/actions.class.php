<?php

require_once dirname(__FILE__).'/../lib/usersGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/usersGeneratorHelper.class.php';

/**
 * users actions.
 *
 * @package    blueprint
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends autoUsersActions
{
    public function executeListBlock(sfWebRequest $request)
    {
        $user = $this->getRoute()->getObject();

        $user->is_active = $user->is_active ? false : true;
        $user->save();

        $this->getUser()->setFlash('notice', !$user->is_active ? "Account \"{$user->name}\" was blocked" : "Account \"{$user->name}\" was unblocked");

        $this->redirect('sf_guard_user');
    }

    public function executeListControl(sfWebRequest $request)
    {
        $user = $this->getRoute()->getObject();

        $this->getUser()->setAttribute('controller_id', $this->getUser()->getGuardUser()->getId());
        $this->getUser()->setAttribute('controlled_id', $user->getId());
        $this->getUser()->signIn($user);

        $this->redirect('/select');
    }


}
