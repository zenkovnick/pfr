<?php
class reportsComponents extends sfComponents
{
    public function executeAccount()
    {
        $this->flights = $this->account->getFlightsByCriteria();
        $this->avg_sum = $this->account->getAvgRiskSumByCriteria();
        $this->max_sum = $this->account->getMaxRiskSumByCriteria();
        $this->mitigation_count = $this->account->getMitigationCountByCriteria();
        $this->risk_selected_data = $this->account->getRiskSelectedDataByCriteria();
    }
}