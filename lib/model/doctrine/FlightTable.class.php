<?php

/**
 * FlightTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class FlightTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object FlightTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Flight');
    }
}