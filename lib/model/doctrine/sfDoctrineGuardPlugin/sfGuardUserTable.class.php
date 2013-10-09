<?php

/**
 * sfGuardUserTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class sfGuardUserTable extends PluginsfGuardUserTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object sfGuardUserTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfGuardUser');
    }

    public static function getUserByCode($code)
    {
        $q = Doctrine_Query::create()
             ->select("user.*")
             ->from("sfGuardUser user, ActivationCode code")
             ->where("(user.id = code.user_id) AND (code.code = '$code')");

        return $q->fetchOne();
    }


    public static function checkUserAccountAccess($account_id, $user_id) {
        $user = Doctrine_Query::create()
            ->from("sfGuardUser u")
            ->leftJoin("u.UserAccount ua")
            ->where("ua.account_id = ?", $account_id)
            ->andWhere('ua.user_id = ?', $user_id)
            ->andWhere("ua.is_active = ?", true)
            ->execute();
        return $user->count() > 0;
    }

    public static function existEmail($email)
    {
        $user = self::getInstance()->findOneBy('email_address', $email);
        return $user ? $user : false;
    }

    public static function checkUserByUsername($username){
        $user = Doctrine_Query::create()
            ->from("sfGuardUser u")
            ->where("u.username LIKE ?", $username)
            ->fetchOne();
        return !$user ? true : false;
    }

    public static function checkUserByNick($nick){
        $user = Doctrine_Query::create()
            ->from("sfGuardUser u")
            ->where("u.nick LIKE ?", $nick)
            ->fetchOne();
        return !$user ? true : false;
    }

    public static function getPilotsByAccount($account_id){
        return Doctrine_Query::create()
            ->select("u.*, ua.is_active as is_active_account")
            ->from("sfGuardUser u")
            ->leftJoin('u.UserAccount ua')
            ->where('ua.account_id = ?', $account_id)
            ->orderBy('ua.position')
            ->execute();
    }

    public static function getPilotsByAccountArray($account_id){
        $pilot_collection = self::getPilotsByAccount($account_id);
        $pilot_array = array();
        foreach($pilot_collection as $pilot){
            $pilot_array[$pilot->getId()] = $pilot;
        }
        return $pilot_array;
    }

    public static function getMaxPosition($account_id){
        $query = Doctrine_Query::create()
            ->select('MAX(ua.position) as max_position')
            ->from('sfGuardUser u')
            ->leftJoin('u.UserAccount ua')
            ->where('ua.account_id = ?', $account_id)
            ->fetchOne();
        $max_position = $query->getMaxPosition();
        return $max_position ? $max_position : 0;
    }

    public static function getUsers($parameters){
        $account = $parameters['account'];
        $query = Doctrine_Query::create()
            ->from('sfGuardUser u')
            ->leftJoin('u.UserAccount ua')
            ->where('ua.account_id = ?', $account->getId())
            ->andWhere('ua.is_active = true')
            ->andWhere('ua.is_pic = true')
            ->orderBy('ua.position ASC')
            ->execute();
        return $query;
    }

    public static function getUsersWithMore($parameters){
        $account = $parameters['account'];
        $main_collection = Doctrine_Query::create()
            ->from('sfGuardUser u')
            ->leftJoin('u.UserAccount ua')
            ->where('ua.account_id = ?', $account->getId())
            ->andWhere('ua.is_active = true')
            ->andWhere('ua.is_sic = true')
            ->orderBy('ua.position ASC')
            ->execute();

        if($main_collection->count() == 0){
            $main_collection = new Doctrine_Collection('sfGuardUser');
        }
        $more_user = new sfGuardUser();
        $more_user->setId(0);
        $more_user->setFirstName('More');
        $main_collection->add($more_user);
        return $main_collection;
    }

    public static function getDefaultUserIdByAccount($account, $curr_user){
        $query = Doctrine_Query::create()
            ->from('sfGuardUser u')
            ->leftJoin('u.UserAccount ua')
            ->where('ua.account_id = ?', $account->getId())
            ->andWhere('u.id != ?', $curr_user->getId())
            ->andWhere('ua.is_active = true')
            ->orderBy('ua.position ASC')
            ->execute();

        return $query->count() > 0 ? $query->getFirst()->getId() : 0;
    }

    public static function getUsersByUsername($username){
        $users = Doctrine_Query::create()
            ->from("sfGuardUser u")
            ->where("u.username LIKE '{$username}%'")
            ->execute();
        return $users;
    }
}