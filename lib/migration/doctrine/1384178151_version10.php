<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version10 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('flight', 'mitigation_note', 'varchar', '255', array(
             ));
        $this->addColumn('flight', 'flight_note', 'varchar', '255', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('flight', 'mitigation_note');
        $this->removeColumn('flight', 'flight_note');
    }
}