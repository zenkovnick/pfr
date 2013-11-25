<?php
class reportsComponents extends sfComponents
{
    public function executeShowReport()
    {
        $this->flights = $this->account->getFlightsByCriteria(
            $this->report_type, $this->option_id, $this->date_type, $this->date_from, $this->date_to
        );

        $this->avg_sum = $this->account->getAvgRiskSumByCriteria(
            $this->report_type, $this->option_id, $this->date_type, $this->date_from, $this->date_to
        );

        $this->max_sum = $this->account->getMaxRiskSumByCriteria(
            $this->report_type, $this->option_id, $this->date_type, $this->date_from, $this->date_to
        );

        $this->mitigation_count = $this->account->getMitigationCountByCriteria(
            $this->report_type, $this->option_id, $this->date_type, $this->date_from, $this->date_to
        );

        $this->plane_data = $this->account->getPlaneDataByCriteria(
            $this->report_type, $this->option_id, $this->date_type, $this->date_from, $this->date_to
        );

        $this->pilot_data = $this->account->getPilotDataByCriteria(
            $this->report_type, $this->option_id, $this->date_type, $this->date_from, $this->date_to
        );

        $this->risk_selected_data = $this->account->getRiskSelectedDataByCriteria(
            $this->report_type, $this->option_id, $this->date_type, $this->date_from, $this->date_to, $this->to_pdf
        );
    }
}