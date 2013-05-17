<?php
class TreeInstance {
    private $branches = array();
    private $direct_referals_count = null;
    private $indirect_referals_count = null;
    public function __construct(){
    }

    public function loadData($direct_referals_count){
        $data = BranchPartTable::getBranchDataByTreeId($direct_referals_count);
        foreach($data as $branch_part){
            $this->branches[$branch_part->getBranchId()] = array(
                'start' => array('x' => $branch_part->getStartX(), 'y' => $branch_part->getStartY()),
                'end' => array('x' => $branch_part->getEndX(), 'y' => $branch_part->getEndY()));
        }

    }
    private function getLineFunction($branch_index){
        $A = $this->branches[$branch_index]['start']['y'] - $this->branches[$branch_index]['end']['y'];
        $B = $this->branches[$branch_index]['end']['x'] - $this->branches[$branch_index]['start']['x'];
        $C = $this->branches[$branch_index]['start']['x']*$this->branches[$branch_index]['end']['y'] - $this->branches[$branch_index]['end']['x']*$this->branches[$branch_index]['start']['y'];
        $k = -($A/$B);
        $b = -($C/$B);
        return array('A' => $A, 'B' => $B, 'C' => $C, 'k' => $k, 'b' => $b);
    }
    public function getY($branch_index, $x){
        $line_func = $this->getLineFunction($branch_index);
        return $y = $line_func['k']*$x + $line_func['b'];
    }

    public function getBranchAngle($branch_index){
        $line_func = $this->getLineFunction($branch_index);
        return rad2deg(acos($line_func['k']));
    }

    public function getMaxX($branch_index){
        return $this->branches[$branch_index]['start']['x'] >= $this->branches[$branch_index]['end']['x'] ? $this->branches[$branch_index]['start']['x'] : $this->branches[$branch_index]['end']['x'];
    }
    public function getMinX($branch_index){
        return $this->branches[$branch_index]['start']['x'] < $this->branches[$branch_index]['end']['x'] ? $this->branches[$branch_index]['start']['x'] : $this->branches[$branch_index]['end']['x'];
    }

    public function getMaxY($branch_index){
        return $this->branches[$branch_index]['start']['y'] >= $this->branches[$branch_index]['end']['y'] ? $this->branches[$branch_index]['start']['y'] : $this->branches[$branch_index]['end']['y'];
    }
    public function getMinY($branch_index){
        return $this->branches[$branch_index]['start']['y'] < $this->branches[$branch_index]['end']['y'] ? $this->branches[$branch_index]['start']['y'] : $this->branches[$branch_index]['end']['y'];
    }

    public function setDirectReferalsCount($count){
        $this->direct_referals_count = $count;
    }
    public function setIndirectReferalsCount($count){
        $this->indirect_referals_count = $count;
    }

}