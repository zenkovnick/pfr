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
          'title', 'photo'
      ));

      $this->widgetSchema['photo'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['photo'] = new sfValidatorPass();

      $this->widgetSchema['photo_widget'] = new sfWidgetFormInputFile();
      $this->validatorSchema['photo_widget'] = new sfValidatorString(array('required' => false));

      $this->widgetSchema['uploaded_photo'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['uploaded_photo'] = new sfValidatorPass();

      $this->validatorSchema['title'] = new sfValidatorString(array('required' => true));

      if($this->getObject()->isNew()){
          $this->setWidget("chief_pilot_id", new sfWidgetFormInputHidden());
          $this->setValidator("chief_pilot_id", new sfValidatorPass());
          $this->setWidget("chief_pilot_name", new sfWidgetFormInput());
          $this->setValidator("chief_pilot_name", new sfValidatorString(array("required" => false)));
      } else {
          $this->setWidget("chief_pilot_id", new sfWidgetFormDoctrineChoiceCustom(array(
              'model' => 'sfGuardUser',
              'table_method' => 'getUsers',
              'table_method_parameters' => array('account' => $this->getOption('account')),
              'method' => 'getUserTitle',
              'method_parameters' => array('curr_user' => $this->getOption('user'))
          )));
      }
  }

    public function processValues($values = null){
        if(isset($values['chief_pilot_name']) && $values['chief_pilot_id'] == "" && $values['chief_pilot_name'] != ""){
            $pilot = new sfGuardUser();
            $pilot->setUsername($values['chief_pilot_name']);
            $pilot->save();
            $values['chief_pilot_id'] = $pilot->getId();
        } elseif($values['chief_pilot_id'] == "" && $values['chief_pilot_name'] == "") {
            $values['chief_pilot_id'] = null;
        }
        return $values;

    }

    protected function doSave($con = null)
    {


        parent::doSave($con);

        //EmailNotification::sendInvites($this->getUser()->getGuardUser(), $pilot, $url, $account);

        if($this->getValue('uploaded_photo') != ''){
            if($this->getObject()->getPhoto()){
                unlink(sfConfig::get('sf_upload_dir')."/avatar/{$this->getObject()->getPhoto()}");
            }
            $this->getObject()->setPhoto($this->getValue('uploaded_photo'));
            $this->getObject()->save();

        }
        $user = $this->getObject()->getChiefPilot();
        if($user){
            $user_account = new UserAccount();
            $user_account->setAccount($this->getObject());
            $user_account->setUser($user);
            $user_account->setInviteToken($user->generateToken());
            $user_account->setPosition(UserAccountTable::getMaxPosition($this->getObject()) + 1);
            $user_account->setIsManager(true);
            $user_account->save();
        }
    }
}
