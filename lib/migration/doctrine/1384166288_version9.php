<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version9 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropForeignKey('account', 'account_chief_pilot_id_sf_guard_user_id');
        $this->dropForeignKey('flight', 'flight_pic_id_sf_guard_user_id');
        $this->dropForeignKey('flight', 'flight_sic_id_sf_guard_user_id');
        $this->createForeignKey('account', 'account_chief_pilot_id_sf_guard_user_id_1', array(
             'name' => 'account_chief_pilot_id_sf_guard_user_id_1',
             'local' => 'chief_pilot_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'SET NULL',
             ));
        $this->createForeignKey('flight', 'flight_pic_id_sf_guard_user_id_1', array(
             'name' => 'flight_pic_id_sf_guard_user_id_1',
             'local' => 'pic_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'SET NULL',
             ));
        $this->createForeignKey('flight', 'flight_sic_id_sf_guard_user_id_1', array(
             'name' => 'flight_sic_id_sf_guard_user_id_1',
             'local' => 'sic_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'SET NULL',
             ));
        $this->addIndex('account', 'account_chief_pilot_id', array(
             'fields' => 
             array(
              0 => 'chief_pilot_id',
             ),
             ));
        $this->addIndex('flight', 'flight_pic_id', array(
             'fields' => 
             array(
              0 => 'pic_id',
             ),
             ));
        $this->addIndex('flight', 'flight_sic_id', array(
             'fields' => 
             array(
              0 => 'sic_id',
             ),
             ));
    }

    public function down()
    {
        $this->createForeignKey('account', 'account_chief_pilot_id_sf_guard_user_id', array(
             'name' => 'account_chief_pilot_id_sf_guard_user_id',
             'local' => 'chief_pilot_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('flight', 'flight_pic_id_sf_guard_user_id', array(
             'name' => 'flight_pic_id_sf_guard_user_id',
             'local' => 'pic_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('flight', 'flight_sic_id_sf_guard_user_id', array(
             'name' => 'flight_sic_id_sf_guard_user_id',
             'local' => 'sic_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->dropForeignKey('account', 'account_chief_pilot_id_sf_guard_user_id_1');
        $this->dropForeignKey('flight', 'flight_pic_id_sf_guard_user_id_1');
        $this->dropForeignKey('flight', 'flight_sic_id_sf_guard_user_id_1');
        $this->removeIndex('account', 'account_chief_pilot_id', array(
             'fields' => 
             array(
              0 => 'chief_pilot_id',
             ),
             ));
        $this->removeIndex('flight', 'flight_pic_id', array(
             'fields' => 
             array(
              0 => 'pic_id',
             ),
             ));
        $this->removeIndex('flight', 'flight_sic_id', array(
             'fields' => 
             array(
              0 => 'sic_id',
             ),
             ));
    }
}