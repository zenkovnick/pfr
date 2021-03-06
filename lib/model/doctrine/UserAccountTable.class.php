<?php

/**
 * UserAccountTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UserAccountTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object UserAccountTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('UserAccount');
    }

    public static function getPilotsByAccount($account_id){
        return Doctrine_Query::create()
            ->from('UserAccount ua')
            ->where('ua.account_id = ?', $account_id)
            ->orderBy('ua.position')
            ->execute();
    }

    public static function getMaxPosition($account_id){
        $query = Doctrine_Query::create()
            ->select('MAX(ua.position) as max_position')
            ->from('UserAccount ua')
            ->where('ua.account_id = ?', $account_id)
            ->fetchOne();
        $max_position = $query->getMaxPosition();
        return $max_position ? $max_position : 0;
    }

    public static function getUserAccount($user_id, $account_id){
        return Doctrine_Query::create()
            ->from('UserAccount ua')
            ->leftJoin('ua.Account a')
            ->where('ua.user_id = ?', $user_id)
            ->andWhere('ua.account_id = ?', $account_id)
            ->fetchOne();
    }

    public function retrieveNotActiveInvites(Doctrine_Query $q){
        $q->where('is_active = false')->andWhere('invite_token IS NOT NULL');
        return $q;
    }
}