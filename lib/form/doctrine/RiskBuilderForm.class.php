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
          'mitigation_high_message', 'mitigation_high_instructions', 'mitigation_high_notify', 'mitigation_high_prevent_flight'
      ));

      $this->validatorSchema['form_name'] = new sfValidatorString(array('required' => true));
      $this->validatorSchema['mitigation_low_message'] = new sfValidatorString(array('required' => true));
      $this->validatorSchema['mitigation_medium_message'] = new sfValidatorString(array('required' => true));
      $this->validatorSchema['mitigation_high_message'] = new sfValidatorString(array('required' => true));

      $this->widgetSchema->setLabels(array(
          'mitigation_low_notify' => 'Notify chief pilot about all risks (low to high)',
          'mitigation_medium_notify' => 'Notify chief pilot about medium to high risk flights',
          'mitigation_high_notify' => 'Notify chief pilot about high risk flights',
      ));
  }

    protected function doSave($con = null)
    {
        $this->getObject()->setMitigationLowNotify($this->getValue('mitigation_low_notify') == 'on');
        $this->getObject()->setMitigationMediumNotify($this->getValue('mitigation_medium_notify') == 'on');
        $this->getObject()->setMitigationHighNotify($this->getValue('mitigation_high_notify') == 'on');
        parent::doSave($con);


    }
}
