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
          'name', 'instructions'
      ));
  }
}
