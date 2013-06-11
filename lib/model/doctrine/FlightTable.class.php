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

    public static function getFlightsForChart($filter_query){
        return $filter_query->select('f.created_at, SUM(f.risk_factor_sum ) AS r_sum, SUM(f.mitigation_sum) AS m_sum')
            ->groupBy('DATE_FORMAT(f.created_at,"%Y-%m-%d")')
            ->execute();
    }
}