<?php
class reportsComponents extends sfComponents
{
    public function executeAccount()
    {
        $this->flights = $this->account->getFlightsByCriteria($this->report_type, $this->option_id);
        $this->avg_sum = $this->account->getAvgRiskSumByCriteria($this->report_type, $this->option_id);
        $this->max_sum = $this->account->getMaxRiskSumByCriteria($this->report_type, $this->option_id);
        $this->mitigation_count = $this->account->getMitigationCountByCriteria($this->report_type, $this->option_id);
        $this->plane_data = $this->account->getPlaneDataByCriteria($this->report_type, $this->option_id);
        $this->pilot_data = $this->account->getPilotDataByCriteria($this->report_type, $this->option_id);
        $this->risk_selected_data = $this->account->getRiskSelectedDataByCriteria($this->report_type, $this->option_id);
    }
}