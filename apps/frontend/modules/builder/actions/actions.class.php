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
        $this->form = new RiskBuilderForm();
        $this->flight_information = FlightInformationFieldTable::getAllFields();
    }

}