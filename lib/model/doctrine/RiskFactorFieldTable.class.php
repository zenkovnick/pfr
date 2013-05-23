<?php

/**
 * RiskFactorFieldTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class RiskFactorFieldTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object RiskFactorFieldTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('RiskFactorField');
    }

    public static function getAllRiskFactors($form_id){
        return Doctrine_Query::create()
            ->from('RiskFactorField rff')
            ->where('rff.risk_builder_id =?', $form_id)
            ->orderBy('rff.position ASC')
            ->execute();
    }

    public static function getMaxPosition(){
        $query = Doctrine_Query::create()
            ->select('MAX(rff.position) as max_position')
            ->from('RiskFactorField rff')
            ->fetchOne();
        $max_position = $query->getMaxPosition();
        return $max_position ? $max_position : 0;
    }
}