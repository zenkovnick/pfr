<?php

/**
 * Account
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    blueprint
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Account extends BaseAccount
{
    public function getPilots(){
        return implode(', ', sfGuardUser::getNamesArray(sfGuardUserTable::getPilotsByAccount($this->getId())));
    }

    public function getReportTypes(){
        return array('account' => 'Account', 'plane' => 'Planes', 'airport' => 'Airport', 'pic' => 'PIC', 'sic' => 'SIC');
    }

    public function getFlightsByCriteria($criteria = 'account', $option_id = null){
        return FlightTable::getInstance()->getFlightsByCriteria($criteria, $this->getId(), $option_id);
    }

    public function getAvgRiskSumByCriteria($criteria = 'account', $option_id = null){
        return FlightTable::getInstance()->getAvgRiskSumByCriteria($criteria, $this->getId(), $option_id);
    }

    public function getMaxRiskSumByCriteria($criteria = 'account', $option_id = null){
        return FlightTable::getInstance()->getMaxRiskSumByCriteria($criteria, $this->getId(), $option_id);
    }

    public function getMitigationCountByCriteria($criteria = 'account', $option_id = null){
        return FlightTable::getInstance()->getMitigationCountByCriteria($criteria, $this->getId(), $option_id);
    }

    public function getPlaneDataByCriteria($criteria = 'account', $option_id = null){
        $planes = FlightTable::getInstance()->getPlaneDataByCriteria($criteria, $this->getId(), $option_id);
        $data = array('max' => -1, 'data' => array());
        foreach($planes as $row){
            $key = md5($row->getName());
            $data['data'][$key]['tail_number'] = $row->getName();
            $data['data'][$key]['count'] = $row->getCount();
        }
        $data['max'] = $this->getMax($data['data']);
        $data['data'] = $this->aasort($data['data'], 'count');
        return $data;
    }

    public function getPilotDataByCriteria($criteria = 'account', $option_id = null){
        $pic = FlightTable::getInstance()->getPICDataByCriteria($criteria, $this->getId(), $option_id);
        $sic = FlightTable::getInstance()->getSICDataByCriteria($criteria, $this->getId(), $option_id);
        $data = array('max' => -1, 'data' => array());
        foreach($pic as $row){
            $key = md5($row['name']);
            $data['data'][$key]['name'] = $row['name'];
            $data['data'][$key]['count'] = $row['count'];
        }
        foreach($sic as $row){
            $key = md5($row['name']);
            if(!array_key_exists($key, $data['data'])){
                $data['data'][$key]['name'] = $row['name'];
                $data['data'][$key]['count'] = $row['count'];
            } else {
                $data['data'][$key]['count'] += $row['count'];
            }
        }
        $data['max'] = $this->getMax($data['data']);
        $data['data'] = $this->aasort($data['data'], 'count');
        return $data;
    }

    public function getRiskSelectedDataByCriteria($criteria = 'account', $option_id = null){
        $flights = $this->getFlightsByCriteria($criteria, $option_id);
        $data = array('max' => -1, 'data' => array());
        foreach($flights as $flight){
            $high_factors = $flight->getRiskSelectedReportData();
            foreach($high_factors as $key => $question){
                if(!array_key_exists($key, $data['data'])){
                    $data['data'][$key]['question'] = $question;
                    $data['data'][$key]['count'] = 1;
                } else {
                    $data['data'][$key]['count']++;
                }
            }
        }
        $data['max'] = $this->getMax($data['data']);
        $data['data'] = $this->aasort($data['data'], 'count');
        return $data;
    }

    public function getAdditionalOptions($report_type){
        $options = array();
        switch($report_type){
            case 'pic':
                $options = sfGuardUserTable::getInstance()->getOptionsPilot($this->getId(), 'pic');
                break;
            case 'sic':
                $options = sfGuardUserTable::getInstance()->getOptionsPilot($this->getId(), 'sic');
                break;
            case 'airport':
                $options = AirportTable::getInstance()->getOptionsAirportTo($this);
                break;
            case 'plane':
                $options = PlaneTable::getInstance()->getOptionsPlane($this);
                break;
        }
        return $options;

    }

    private function aasort ($array, $key) {
        $sorter=array();
        $ret=array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        arsort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        $array=$ret;
        return $array;
    }

    private function getMax($data){
        $max = 0;
        foreach($data as $obj)
        {
            if($obj['count'] > $max)
            {
                $max = $obj['count'];
            }
        }
        return $max;
    }

}
