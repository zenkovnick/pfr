<?php

class FlightChart {
    private $flights = null;

    public function __construct(Doctrine_Collection $flights){
        $this->flights = $flights;
    }

    public function setFlights(Doctrine_Collection $flights){
        $this->flights = $flights;
    }

    public function getFlights(){
        return $this->flights;
    }

    public function getChartMarkup(){
        $chart_data = array();
        $this->getChartData($chart_data, $this->flights);
        $this->convertData($chart_data, $chart_data);
        //$result['not_null_metrics_count'] = $not_null_metrics_count;
        return $chart_data;


    }

    private function getChartData(&$tmp_chart_data, $flights){
        $date_pattern = "Y-m-d";
        $tmp_chart_data = array();
        $chart_info = sfConfig::get('app_dashboard_chart');
        $tmp_chart_data['c_metric']['risk'] = $chart_info['risk']['metric'];
        $tmp_chart_data['c_color']['risk'] = $chart_info['risk']['color'];
        $tmp_chart_data['c_metric']['mitigation'] = $chart_info['mitigation']['metric'];
        $tmp_chart_data['c_color']['mitigation'] = $chart_info['mitigation']['color'];
        $tmp_chart_data['c_value'] = array();
        foreach($flights as $flight){
            $values['risk'] = $flight->getRSum();
            $values['mitigation'] = $flight->getMSum();
            $tmp_chart_data['c_value'][date($date_pattern, strtotime($flight->getCreatedAt()))] = $values;
        }

        ksort($tmp_chart_data['c_value']);
    }

    private function convertData(&$data){
        $chart_data = array();
        foreach($data['c_color'] as $color){
            $chart_data['chart_color'][] = $color;
        }
        $chart_data['chart_data']['cols'][] = array("id" => null, "label" => "Check-In Date", "pattern" => null, "type" => "date");
        foreach($data['c_metric'] as $id => $metric){
            $chart_data['chart_data']['cols'][] = array("id" => $id, "label" => $metric, "pattern" => null, "type" => "number");
        }

        /*if(count($data['c_metric']) > 1){
            $this->scaleData($data['c_value'], $ids);
        }*/

        foreach($data['c_value'] as $date => $values){
            $col_values = array();
            $col_values[] = array(
                'v' => "Date(".(date('Y', strtotime($date)) < 1970 ? 1970 : date('Y', strtotime($date))).", ".(date('m', strtotime($date))-1).", ".date('d', strtotime($date)).")",
                'f' => null
            );
            foreach($values as $value){
                $col_values[] = array(
                    'v' => $value,
                    'f' => null
                );
            }
            $chart_data['chart_data']['rows'][] = array(
                'c' => $col_values
            );

        }
        $data = $chart_data;
    }

    private function scaleData(&$data, $ids){
        $max_values = array();
        $min_values = array();
        $scale_intervals = array();
        foreach($ids as $id){
            $max_values[$id] = 0;
            $min_values[$id] = 99999999999;
        }
        //die(pr($data));
        foreach($data as $date=>$values){
            foreach($values as $id=>$value){
                if(($value > $max_values[$id]) && !is_null($value)){
                    $max_values[$id] = $value;
                }
                if(($value < $min_values[$id]) && !is_null($value)){
                    $min_values[$id] = $value;
                }
            }
        }
        foreach($ids as $id){
            $scale_intervals[$id] = $max_values[$id] - $min_values[$id];
        }
        foreach($data as $date=>$values){
            foreach($values as $id=>$value){
                if(is_null($scale_intervals[$id]) || $scale_intervals[$id] == 0){
                    $data[$date][$id] = null;
                } else {
                    $data[$date][$id] = round((($value - $min_values[$id]) / $scale_intervals[$id]) * 100);
                    if($data[$date][$id] < 0){
                        $data[$date][$id] = null;
                    }
                }
            }
        }
    }

}