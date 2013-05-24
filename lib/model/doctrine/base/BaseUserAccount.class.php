<?php

/**
 * BaseUserAccount
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $account_id
 * @property integer $user_id
 * @property boolean $is_manager
 * @property Account $Account
 * 
 * @method integer     getAccountId()  Returns the current record's "account_id" value
 * @method integer     getUserId()     Returns the current record's "user_id" value
 * @method boolean     getIsManager()  Returns the current record's "is_manager" value
 * @method Account     getAccount()    Returns the current record's "Account" value
 * @method UserAccount setAccountId()  Sets the current record's "account_id" value
 * @method UserAccount setUserId()     Sets the current record's "user_id" value
 * @method UserAccount setIsManager()  Sets the current record's "is_manager" value
 * @method UserAccount setAccount()    Sets the current record's "Account" value
 * 
 * @package    blueprint
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUserAccount extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user_account');
        $this->hasColumn('account_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('is_manager', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Account', array(
             'local' => 'account_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}