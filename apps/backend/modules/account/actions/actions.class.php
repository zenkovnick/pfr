<?php

require_once dirname(__FILE__).'/../lib/accountGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/accountGeneratorHelper.class.php';

/**
 * account actions.
 *
 * @package    blueprint
 * @subpackage account
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class accountActions extends autoAccountActions
{
    public function executeListBlock(sfWebRequest $request)
    {
        $account = $this->getRoute()->getObject();

        $account->is_active = $account->is_active ? false : true;
        $account->save();

        $this->getUser()->setFlash('notice', !$account->is_active ? "Account \"{$account->title}\" was blocked" : "Account \"{$account->title}\" was unblocked");

        $this->redirect('account');
    }
}
