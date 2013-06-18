<?php

/**
 * BasePlane
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property varchar $tail_number
 * @property Doctrine_Collection $Accounts
 * @property Doctrine_Collection $AccountPlane
 * @property Doctrine_Collection $Flight
 * 
 * @method varchar             getTailNumber()   Returns the current record's "tail_number" value
 * @method Doctrine_Collection getAccounts()     Returns the current record's "Accounts" collection
 * @method Doctrine_Collection getAccountPlane() Returns the current record's "AccountPlane" collection
 * @method Doctrine_Collection getFlight()       Returns the current record's "Flight" collection
 * @method Plane               setTailNumber()   Sets the current record's "tail_number" value
 * @method Plane               setAccounts()     Sets the current record's "Accounts" collection
 * @method Plane               setAccountPlane() Sets the current record's "AccountPlane" collection
 * @method Plane               setFlight()       Sets the current record's "Flight" collection
 * 
 * @package    blueprint
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePlane extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('plane');
        $this->hasColumn('tail_number', 'varchar', 40, array(
             'type' => 'varchar',
             'length' => 40,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Account as Accounts', array(
             'refClass' => 'AccountPlane',
             'local' => 'account_id',
             'foreign' => 'plane_id'));

        $this->hasMany('AccountPlane', array(
             'local' => 'id',
             'foreign' => 'plane_id'));

        $this->hasMany('Flight', array(
             'local' => 'id',
             'foreign' => 'plane_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}