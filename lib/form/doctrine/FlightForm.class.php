<?php

/**
 * Flight form.
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FlightForm extends BaseFlightForm
{
  public function configure()
  {
      $data_fields = json_decode($this->getObject()->getInfo(), true);
      foreach($data_fields as $key => $data_field){
          if(!is_array($data_field)){
              $this->setWidget($key, new sfWidgetFormInput());
              $this->setValidator($key, new sfValidatorString());
          }
      }
  }
}
