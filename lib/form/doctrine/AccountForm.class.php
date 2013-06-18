<?php

/**
 * Account form.
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AccountForm extends BaseAccountForm
{
  public function configure()
  {
      $this->useFields(array(
          'title', 'photo', 'chief_pilot_id'
      ));

      $this->widgetSchema['photo'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['photo'] = new sfValidatorPass();

      $this->widgetSchema['photo_widget'] = new sfWidgetFormInputFile();
      $this->validatorSchema['photo_widget'] = new sfValidatorString(array('required' => false));

      $this->widgetSchema['uploaded_photo'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['uploaded_photo'] = new sfValidatorPass();

      $this->validatorSchema['title'] = new sfValidatorString(array('required' => true));

      if($this->getObject()->isNew()){
          $this->widgetSchema["chief_pilot_id"] = new sfWidgetFormInputHidden();
          $this->validatorSchema["chief_pilot_id"] = new sfValidatorPass();
          $this->widgetSchema["chief_pilot_name"] = new sfWidgetFormInput();
          $this->validatorSchema["chief_pilot_name"] = new sfValidatorString(array("required" => false));
      } else {
          $this->widgetSchema["chief_pilot_id"] = new sfWidgetFormDoctrineChoiceCustom(array(
              'model' => 'sfGuardUser',
              'table_method' => 'getUsers',
              'table_method_parameters' => array('account' => $this->getOption('account')),
              'method' => 'getUserTitle',
              'method_parameters' => array('curr_user' => $this->getOption('user')),
              'add_empty' => "Choose Chief Pilot..."
          ));
      }
  }
    public function bind(array $taintedValues = null, array $taintedFiles = null){

        if(!$taintedValues["chief_pilot_id"]){
            $taintedValues["chief_pilot_id"] = null;
        }
        parent::bind($taintedValues, $taintedFiles);
    }

    public function processValues($values = null){
        if(isset($values['chief_pilot_name']) && is_null($values['chief_pilot_id']) && $values['chief_pilot_name'] != ""){
            $pilot = new sfGuardUser();
            $pilot->setUsername($values['chief_pilot_name']);
            $pilot->save();
            $values['chief_pilot_id'] = $pilot->getId();
        }
        return $values;

    }

    protected function doSave($con = null)
    {

        $is_new = $this->getObject()->isNew();
        parent::doSave($con);

        //EmailNotification::sendInvites($this->getUser()->getGuardUser(), $pilot, $url, $account);

        if($this->getValue('uploaded_photo') != ''){
            if($this->getObject()->getPhoto()){
                unlink(sfConfig::get('sf_upload_dir')."/avatar/{$this->getObject()->getPhoto()}");
            }
            $this->getObject()->setPhoto($this->getValue('uploaded_photo'));
            $this->getObject()->save();

        }
        if($is_new){
            if(Doctrine_Core::getTable('sfGuardUser')->find($this->getObject()->getChiefPilot()->getId())){
                $user_account = new UserAccount();
                $user_account->setAccount($this->getObject());
                $user_account->setUser($this->getObject()->getChiefPilot());
                $user_account->setInviteToken($this->getObject()->getChiefPilot()->generateToken());
                $user_account->setPosition(UserAccountTable::getMaxPosition($this->getObject()) + 1);
                $user_account->setIsManager(true);
                $user_account->save();
            } else {
                $this->getObject()->setChiefPilot(null);
                $this->getObject()->save();
            }
        }
    }
}
