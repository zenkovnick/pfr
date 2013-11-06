<?php

/**
 * RiskBuilder form.
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RiskBuilderForm extends BaseRiskBuilderForm
{
  public function configure()
  {
      $this->useFields(array(
          'form_name', 'form_instructions',
          'mitigation_low_message', 'mitigation_low_instructions', 'mitigation_low_notify',
          'mitigation_medium_message', 'mitigation_medium_instructions', 'mitigation_medium_notify', 'mitigation_medium_require_details',
          'mitigation_high_message', 'mitigation_high_instructions', 'mitigation_high_notify', 'mitigation_high_prevent_flight',
          'mitigation_high_email', 'mitigation_low_email', 'mitigation_medium_email',
          'high_risk_factor_notify', 'high_risk_factor_email'
      ));

      $this->validatorSchema['form_name'] = new sfValidatorString(array('required' => true));
      $this->validatorSchema['mitigation_low_message'] = new sfValidatorString(array('required' => true));
      $this->validatorSchema['mitigation_medium_message'] = new sfValidatorString(array('required' => true));
      $this->validatorSchema['mitigation_high_message'] = new sfValidatorString(array('required' => true));

      $account = $this->getOption('account');
      $chief_pilot = $account->getChiefPilot();
      if($chief_pilot && $chief_pilot->getId() && UserAccountTable::getUserAccount($chief_pilot->getId(), $account->getId())->getIsActive()){
          $chief_pilot_name = $account->getChiefPilot()->getFirstName();
      } else {
          $chief_pilot_name = "chief pilot";
      }
      $this->widgetSchema->setLabels(array(
          'mitigation_low_notify' => "Notify {$chief_pilot_name} about all risks (low to high)",
          'mitigation_medium_notify' => "Notify {$chief_pilot_name} about medium to high risk flights",
          'mitigation_high_notify' => "Notify {$chief_pilot_name} about high risk flights",
          'high_risk_factor_notify' => "Notify {$chief_pilot_name} if one of the risk item equals 4 or 5",
          'mitigation_medium_require_details' => 'Require details about how risk is mitigated before proceeding'
      ));
  }

    protected function doSave($con = null)
    {

        parent::doSave($con);
        /*if($this->getValue('mitigation_medium_notify')){
            $this->getObject()->setMitigationMediumNotify($this->getValue('mitigation_medium_notify'));
        } else {
            $this->getObject()->setMitigationMediumNotify(true);
        }
        if($this->getValue('mitigation_high_notify')){
            $this->getObject()->setMitigationHighNotify($this->getValue('mitigation_high_notify'));
        } else {
            $this->getObject()->setMitigationHighNotify(true);
        }
        $this->getObject()->save();*/

    }

    public function bind(array $taintedValues = null, array $taintedFiles = null){
        $taintedValues['mitigation_low_notify'] = $taintedValues['low_mitigation_val'];
        $taintedValues['mitigation_medium_notify'] = $taintedValues['medium_mitigation_val'];
        $taintedValues['mitigation_high_notify'] = $taintedValues['high_mitigation_val'];

        unset($taintedValues['low_mitigation_val']);
        unset($taintedValues['medium_mitigation_val']);
        unset($taintedValues['high_mitigation_val']);
        unset($taintedValues['high_risk_factor_val']);
        parent::bind($taintedValues, $taintedFiles);
    }
}
