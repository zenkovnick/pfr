<?php

/**
 * sfGuardUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    blueprint
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class sfGuardUser extends PluginsfGuardUser
{

    public function __toString()
    {
        return (string) $this->getFirstName();
    }

    public function getUserTitle($parameters){
        $curr_user = $parameters['curr_user'];
        return $this === $curr_user ? $this->getFirstName()." (Me)" : $this->getFirstName();
    }


    public function generatePassword()
    {
        if( !$this->isNew() )
        {
            if($this->getCreatedAt() !== null)
            {
                $last_time_number = strtotime($this->getCreatedAt()) % 10;
                $password_str = substr(sha1($this->getEmailAddress()), $last_time_number, 10);

                return $password_str;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function setGeneratedPassword()
    {
        if($pass = $this->generatePassword())
        {
            $this->setPassword($pass);
            $this->save();
        }
    }

    public function assignAvatar($avatar)
    {
        $this->setAvatar($avatar);
        $this->save();
    }

    public function generateToken() {
        return base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }



    public function changePassword($new_password)
    {
        $this->setPassword($new_password);
        $this->save();
    }

    public function genUUID() {
        $unique = false;
        $uuid = null;
        while(!$unique){
            $uuid = sprintf( '%04x%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

                // 16 bits for "time_mid"
                mt_rand( 0, 0xffff ),

                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand( 0, 0x0fff ) | 0x4000,

                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand( 0, 0x3fff ) | 0x8000,

                // 48 bits for "node"
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            );
            $uuid_in_db = Doctrine_Core::getTable('sfGuardUser')->findOneBy('referal_id', $uuid);
            if(!$uuid_in_db){
                $unique = true;
            }
        }
        return $uuid;
    }

    public static function checkReferalId($referal_id){
        $user = Doctrine_Core::getTable('sfGuardUser')->findOneBy('referral_id', $referal_id);
        if($user){
            return true;
        } else {
            return false;
        }

    }
    public function checkNickname($nick_name){
        if($nick_name){
            $user = Doctrine_Query::create()
                ->from('sfGuardUser')
                ->whereNotIn('id', $this->getId())
                ->andWhere('nick LIKE ?', $nick_name)
                ->fetchOne();
            if($user){
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }

    }
    public function getParent(){
        if(!is_null($this->getParentId())){
            return Doctrine_Core::getTable('sfGuardUser')->find($this->getParentId());
        } else {
            return null;
        }
    }

    public function getReferals(){
        return Doctrine_Core::getTable('sfGuardUser')->findBy('parent_id', $this->getId());
    }

    public function getReferalsCount(){
        return $this->getReferals()->count();
    }
    public static function resizeAvatar($file_input, $file_output, $w_o, $h_o, $percent = false) {
        list($w_i, $h_i, $type) = getimagesize($file_input);
        if (!$w_i || !$h_i) {
            //echo 'Невозможно получить длину и ширину изображения';
            return null;
        }
        $types = array('','gif','jpeg','png');
        $ext = $types[$type];
        if ($ext) {
            $func = 'imagecreatefrom'.$ext;
            $img = $func($file_input);
        } else {
            //echo 'Некорректный формат файла';
            return null;
        }
        if ($percent) {
            $w_o *= $w_i / 100;
            $h_o *= $h_i / 100;
        }
        if (!$h_o) $h_o = $w_o/($w_i/$h_i);
        if (!$w_o) $w_o = $h_o/($h_i/$w_i);

        $img_o = imagecreatetruecolor($w_o, $h_o);
        imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
        if ($type == 2) {
            return imagejpeg($img_o,$file_output,100);
        } else {
            $func = 'image'.$ext;
            return $func($img_o,$file_output);
        }
    }


    public static function cropAvatar($file_input, $file_output, $crop = 'square',$percent = false) {
        list($w_i, $h_i, $type) = getimagesize($file_input);
        if (!$w_i || !$h_i) {
            //echo 'Невозможно получить длину и ширину изображения';
            return null;
        }
        $types = array('','gif','jpeg','png');
        $ext = $types[$type];
        if ($ext) {
            $func = 'imagecreatefrom'.$ext;
            $img = $func($file_input);
        } else {
            //echo 'Некорректный формат файла';
            return null;
        }
        if ($crop == 'square') {
            $min = $w_i;
            if ($w_i > $h_i) {
                $min = $h_i;
                $rest = $w_i - $h_i;
                $x_o = ceil($rest / 2);
            }
            $w_o = $h_o = $min;
        } else {
            list($x_o, $y_o, $w_o, $h_o) = $crop;
            if ($percent) {
                $w_o *= $w_i / 100;
                $h_o *= $h_i / 100;
                $x_o *= $w_i / 100;
                $y_o *= $h_i / 100;
            }
            if ($w_o < 0) $w_o += $w_i;
            $w_o -= $x_o;
            if ($h_o < 0) $h_o += $h_i;
            $h_o -= $y_o;
        }
        $img_o = imagecreatetruecolor($w_o, $h_o);
        imagecopy($img_o, $img, 0, 0, $x_o, $y_o, $w_o, $h_o);
        if ($type == 2) {
            return imagejpeg($img_o,$file_output,100);
        } else {
            $func = 'image'.$ext;
            return $func($img_o,$file_output);
        }
    }

    public static function getNamesArray($collection){
        return array_map(function($value){
            return $value['first_name'];
        }, $collection->toArray());
    }

    public function canManage($account){
        $user_account = UserAccountTable::getUserAccount($this->getId(), $account->getId());
        return $user_account->getIsManager();
    }


}
