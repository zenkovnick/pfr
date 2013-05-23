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

      ));
  }
}
