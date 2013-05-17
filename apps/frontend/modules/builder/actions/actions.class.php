<?php

/**
 * article actions.
 *
 * @package    blueprint
 * @subpackage article
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class builderActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
        $this->risk_builder = Doctrine_Core::getTable('RiskBuilder')->find(1);
        $this->form = new RiskBuilderForm($this->risk_builder);
        $this->flight_information = FlightInformationFieldTable::getAllFields($this->risk_builder->getId());
        $this->risk_factors = RiskFactorFieldTable::getAllRiskFactors($this->risk_builder->getId());
        if($request->isMethod('post')){
            $this->form->bind($request->getPostParameter($this->form->getName()));
            if($this->form->isValid()){
                $this->form->save();
                $this->redirect("@form");
            }
        }
    }


    public function executeSaveFormFieldHidding(sfWebRequest $request){
        $this->setLayout(false);
        $field_id = $request->getParameter('id');
        $field_hidding = $request->getParameter('hidding');
        $flight_information_field = Doctrine_Core::getTable("FlightInformationField")->find($field_id);
        $flight_information_field->setIsHide($field_hidding);
        $flight_information_field->save();
        return sfView::NONE;
    }

    public function executeSaveFlightInfoPosition(sfWebRequest $request)
    {
        $this->setLayout(false);
        $ids_json = $request->getParameter('ids');
        $ids = array_flip(json_decode($ids_json));
        $form_id = $request->getParameter('form_id');
        $flight_information = FlightInformationFieldTable::getAllFields($form_id);
        foreach($flight_information as $flight_information_field){
            $curr_position = $ids[$flight_information_field->getId()] + 1;
            if($flight_information_field->getPosition() != $curr_position){
                $flight_information_field->setPosition($curr_position);
                $flight_information_field->save();
            }
        }

        return sfView::NONE;
    }

}