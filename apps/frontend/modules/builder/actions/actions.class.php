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
        $this->form_id = $request->getParameter('id');
        $this->forward404Unless($this->risk_builder = Doctrine_Core::getTable('RiskBuilder')->find($this->form_id));
        $this->account = $this->risk_builder->getAccount();
        if(!sfGuardUserTable::checkUserAccountAccess($this->account->getId(), $this->getUser()->getGuardUser()->getId())){
            $this->redirect("@select_account");
        }
        $this->form = new RiskBuilderForm($this->risk_builder, array('account' => $this->account));
        $this->flight_information = FlightInformationFieldTable::getAllFields($this->risk_builder->getId());
        $this->risk_factors = RiskFactorFieldTable::getAllRiskFactors($this->risk_builder->getId());

        $this->flight = new Flight();
        $this->data_fields = $this->flight->generateFromDB($this->account);
        $this->preview_form = new FlightForm(null, array('user' => $this->getUser()->getGuardUser(), 'account' => $this->account));

        if($request->isMethod('post')){
            $this->form->bind($request->getPostParameter($this->form->getName()));
            if($this->form->isValid()){
                $risk_builder = $this->form->save();
                $this->account = $risk_builder->getAccount();
                if(!$this->account->getHasModifiedForm()){
                    $this->account->setHasModifiedForm(true);
                    if(!$this->account->getChiefPilot()->getId()){
                        $this->account->setChiefPilot(null);
                    }
                    $this->account->save();
                }
                $redirect_url = $this->getUser()->getAttribute('redirect_url');
                $this->getUser()->getAttributeHolder()->remove('redirect_url');
                $this->redirect($redirect_url);
            }
        } else {
            $this->getUser()->setAttribute('redirect_url', $request->getReferer());
        }
    }

    public function executePreviewSubmit(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        if($this->getUser()->isAuthenticated()){
            $this->form_id = $request->getParameter('id');
            $this->forward404Unless($this->risk_builder = Doctrine_Core::getTable('RiskBuilder')->find($this->form_id));
            $this->account = $this->risk_builder->getAccount();
            $this->form = new RiskBuilderForm($this->risk_builder, array('account' => $this->account));
            $this->users = sfGuardUserTable::getPilotsByAccountArray($this->account->getId());



            if($request->isMethod('post')){
                $this->form->bind($request->getPostParameter($this->form->getName()));
                if($this->form->isValid()){
                    $this->flight = new Flight();
                    $this->data_fields = json_decode($this->flight->generateFromDBAndForm($this->account, $this->form), true);
                    $this->preview_form = new FlightForm(null, array('user' => $this->getUser()->getGuardUser(), 'account' => $this->account));
                    $form_data = $this->getPartial('flight/form', array('form' => $this->preview_form, 'data' => $this->data_fields, 'users' => $this->users));
                    echo json_encode(array('result' => 'OK', 'form_data' => $form_data));
                }
            }

        } else {
            echo json_encode(array('result' => 'login'));
        }
        return sfView::NONE;
    }

    public function executeSaveRiskFactor(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $form = new RiskFactorOptionsForm();
        if($this->getUser()->isAuthenticated()){
            if($request->isMethod('post')){
                $form->bind($request->getParameter($form->getName()));
                if($form->isValid()){
                    $form->save();
                    $risk_builder = Doctrine_Core::getTable('RiskBuilder')->find($request->getParameter('form_builder_id'));
                    $account = $risk_builder->getAccount();
                    if(!$account->getHasModifiedForm()){
                        $account->setHasModifiedForm(true);
                        if(!$account->getChiefPilot()->getId()){
                            $account->setChiefPilot(null);
                        }
                        $account->save();
                    }
                    $form->getObject()->setRiskBuilder($risk_builder);
                    $form->getObject()->setPosition(RiskFactorFieldTable::getMaxPosition() + 1);
                    $form->getObject()->save();

                    echo json_encode(
                        array(
                            'result' => 'OK',
                            'risk_id' => $form->getObject()->getId(),
                            'new_form_num' => $request->getParameter('new_form_num'),
                            'question' => $form->getObject()->getQuestion()
                        )
                    );
                } else {
                    echo json_encode(
                        array(
                            'result' => 'Failed',
                        )
                    );

                }
            }
        } else {
            echo json_encode(array('result' => 'login'));
        }
        return sfView::NONE;
    }

    public function executeUpdateRiskFactor(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $form = new RiskFactorOptionsForm(Doctrine_Core::getTable('RiskFactorField')->find($request->getParameter('risk_factor_id')));
        if($this->getUser()->isAuthenticated()){
            if($request->isMethod('post')){
                $form->bind($request->getParameter($form->getName()));
                if($form->isValid()){
                    $form->getObject()->save();
                    $form->save();
                    echo json_encode(
                        array(
                            'result' => 'OK',
                            'risk_id' => $form->getObject()->getId(),
                            'question' => $form->getObject()->getQuestion()
                        )
                    );
                } else {
                    echo json_encode(
                        array(
                            'result' => 'Failed'
                        )
                    );

                }
                //$this->redirect('@form');
            }
        } else {
            echo json_encode(array('result' => 'login'));
        }
        return sfView::NONE;
    }

    public function executeDeleteRiskFactor(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $risk_factor = Doctrine_Core::getTable('RiskFactorField')->find($request->getParameter('id'));
        if($this->getUser()->isAuthenticated()){
            if($risk_factor){
                $risk_factor->delete();
                echo json_encode(array('result' => 'OK'));
            } else {
                echo json_encode(array('result' => 'Failed'));
            }

        } else {
            echo json_encode(array('result' => 'login'));
        }
        return sfView::NONE;
    }

    public function executeEditRiskFactorField(sfWebRequest $request){
        $this->forward404unless($request->isXmlHttpRequest());
        $risk_id = intval($request->getParameter("risk_factor_id"));
        $main_form_id = intval($request->getParameter("form_id"));
        $risk_factor = Doctrine_Core::getTable('RiskFactorField')->find($risk_id);
        $this->form = new RiskFactorOptionsForm($risk_factor);
        return $this->renderPartial('editRiskFactor',array('form' => $this->form, 'risk_factor' => $risk_factor, 'form_id' => $main_form_id));
    }

    public function executeAddNewRiskFactorField(sfWebRequest $request){
        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getPostParameter("risk_factor_num"));
        $main_form_id = intval($request->getPostParameter("form_id"));
        $this->form = new RiskFactorFieldForm();
        return $this->renderPartial('addNewRiskFactor',array('form' => $this->form, 'number' => $number, 'form_id' => $main_form_id));
    }

    public function executeAddNewResponseOptionField(sfWebRequest $request){
        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getPostParameter("num"));
        $type = $request->getPostParameter("type");
        $this->form = new RiskFactorOptionsForm();

        $this->form->addNewFields($number, $type);

        return $this->renderPartial('addNewResponseOption',array('form' => $this->form, 'number' => $number));
    }

    public function executeDeleteResponseOption(sfWebRequest $request) {
        $this->setLayout(false);
        $this->forward404unless($request->isXmlHttpRequest());
        $response_option = Doctrine_Core::getTable('ResponseOptionField')->find($request->getParameter('id'));
        $responses_in_risk_factor = ResponseOptionFieldTable::getResponsesCountByRiskFactor($response_option->getRiskFactorId());
        if($this->getUser()->isAuthenticated()){
            if($response_option && $responses_in_risk_factor > 2){
                $response_option->delete();
                echo json_encode(array('result' => 'OK'));
            } else {
                echo json_encode(array('result' => 'Failed'));
            }
        } else {
            echo json_encode(array('result' => 'login'));
        }
        return sfView::NONE;
    }


    public function executeSaveMitigationRange(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $risk_builder = Doctrine_Core::getTable("RiskBuilder")->find($request->getParameter('form_id'));
        $risk_builder->setMitigationLowMax($request->getParameter('low_max'));
        $risk_builder->setMitigationMediumMin($request->getParameter('low_max') + 1);
        $risk_builder->setMitigationMediumMax($request->getParameter('medium_max'));
        $risk_builder->setMitigationHighMin($request->getParameter('medium_max') + 1);
        $account = $risk_builder->getAccount();
        if(!$account->getHasModifiedForm()){
            $account->setHasModifiedForm(true);
            if(!$account->getChiefPilot()->getId()){
                $account->setChiefPilot(null);
            }
            $account->save();
        }

        $risk_builder->save();
        return sfView::NONE;
    }

    public function executeCancelMitigationSection(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $risk_builder = Doctrine_Core::getTable("RiskBuilder")->find($request->getPostParameter('form_id'));
        echo json_encode($risk_builder->toArray());
        return sfView::NONE;
    }

    public function executeSaveMitigationSection(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $type = $request->getPostParameter('type');
        $risk_builder = Doctrine_Core::getTable("RiskBuilder")->find($request->getPostParameter('form_id'));
        switch($type) {
            case 'low':
                $risk_builder->setMitigationLowMessage($request->getPostParameter('message'));
                $risk_builder->setMitigationLowInstructions($request->getPostParameter('instructions'));
                $risk_builder->setMitigationLowNotify($request->getPostParameter('notify'));
                break;
            case 'medium':
                $risk_builder->setMitigationMediumMessage($request->getPostParameter('message'));
                $risk_builder->setMitigationMediumInstructions($request->getPostParameter('instructions'));
                $risk_builder->setMitigationMediumNotify($request->getPostParameter('notify'));
                $risk_builder->setMitigationMediumRequireDetails($request->getPostParameter('require'));
                break;
            case 'high':
                $risk_builder->setMitigationHighMessage($request->getPostParameter('message'));
                $risk_builder->setMitigationHighInstructions($request->getPostParameter('instructions'));
                $risk_builder->setMitigationHighNotify($request->getPostParameter('notify'));
                $risk_builder->setMitigationHighPreventFlight($request->getPostParameter('prevent'));
                break;
        }
        $risk_builder->save();
        $account = $risk_builder->getAccount();
        if(!$account->getHasModifiedForm()){
            $account->setHasModifiedForm(true);
            if(!$account->getChiefPilot()->getId()){
                $account->setChiefPilot(null);
            }
            $account->save();
        }

        return sfView::NONE;
    }

    public function executeSaveFormFieldHidding(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $field_id = $request->getParameter('id');
        $field_hidding = $request->getParameter('hidding');
        $flight_information_field = Doctrine_Core::getTable("FlightInformationField")->find($field_id);
        $flight_information_field->setIsHide($field_hidding);
        $flight_information_field->save();
        $account = $flight_information_field->getRiskBuilder()->getAccount();
        if(!$account->getHasModifiedForm()){
            $account->setHasModifiedForm(true);
            if(!$account->getChiefPilot()->getId()){
                $account->setChiefPilot(null);
            }
            $account->save();
        }

    }

    public function executeSaveRiskFactorPosition(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $ids_json = $request->getParameter('ids');
        $ids = array_flip(json_decode($ids_json));
        $form_id = $request->getParameter('form_id');
        $risk_factors = RiskFactorFieldTable::getAllRiskFactors($form_id);
        foreach($risk_factors as $risk_factor){
            $curr_position = $ids[$risk_factor->getId()] + 1;
            if($risk_factor->getPosition() != $curr_position){
                $risk_factor->setPosition($curr_position);
                $risk_factor->save();
            }
        }
        $risk_builder = Doctrine_Core::getTable("RiskBuilder")->find($request->getParameter('form_id'));
        $account = $risk_builder->getAccount();
        if(!$account->getHasModifiedForm()){
            $account->setHasModifiedForm(true);
            if(!$account->getChiefPilot()->getId()){
                $account->setChiefPilot(null);
            }
            $account->save();
        }


        return sfView::NONE;
    }

    public function executeShowHideField(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $flight_information_field = Doctrine_Core::getTable('FlightInformationField')->find($request->getParameter('id'));
        if($this->getUser()->isAuthenticated()){
            if($flight_information_field->getHiddable()){
                $flight_information_field->setIsHide(!$flight_information_field->getIsHide());
                $flight_information_field->save();
                $account = $flight_information_field->getRiskBuilder()->getAccount();
                if(!$account->getHasModifiedForm()){
                    $account->setHasModifiedForm(true);
                    if(!$account->getChiefPilot()->getId()){
                        $account->setChiefPilot(null);
                    }
                    $account->save();
                }

                echo json_encode(array('result' => 'OK', 'is_hide' => $flight_information_field->getIsHide()));
            } else {
                echo json_encode(array('result' => 'Failed'));
            }
        } else {
            echo json_encode(array('result' => 'login'));
        }
        return sfView::NONE;
    }

    public function executeRequiredField(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $flight_information_field = Doctrine_Core::getTable('FlightInformationField')->find($request->getParameter('id'));
        if($this->getUser()->isAuthenticated()){
            if($flight_information_field->getIsRequired()){
                $flight_information_field->setRequired(!$flight_information_field->getRequired());
                $flight_information_field->save();
                $account = $flight_information_field->getRiskBuilder()->getAccount();
                if(!$account->getHasModifiedForm()){
                    $account->setHasModifiedForm(true);
                    if(!$account->getChiefPilot()->getId()){
                        $account->setChiefPilot(null);
                    }
                    $account->save();
                }

                echo json_encode(array('result' => 'OK', 'is_required' => !$flight_information_field->getRequired()));
            } else {
                echo json_encode(array('result' => 'Failed'));
            }
        } else {
            echo json_encode(array('result' => 'login'));
        }
        return sfView::NONE;
    }



    public function executeSaveFlightInfoPosition(sfWebRequest $request)
    {
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
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
        $risk_builder = Doctrine_Core::getTable("RiskBuilder")->find($request->getParameter('form_id'));
        $account = $risk_builder->getAccount();
        if(!$account->getHasModifiedForm()){
            $account->setHasModifiedForm(true);
            if(!$account->getChiefPilot()->getId()){
                $account->setChiefPilot(null);
            }
            $account->save();
        }

        return sfView::NONE;
    }

}