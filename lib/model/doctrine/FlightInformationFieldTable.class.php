<?php

/**
 * FlightInformationFieldTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class FlightInformationFieldTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object FlightInformationFieldTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('FlightInformationField');
    }

    public static function getAllFields($form_id){
        return Doctrine_Query::create()
            ->from('FlightInformationField fif')
            ->where('fif.risk_builder_id = ?', $form_id)
            ->orderBy('fif.position ASC')
            ->execute();
    }
}