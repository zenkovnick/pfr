<?php
    echo $user_account->getUser()->getFirstName() ? "{$user_account->getUser()->getFirstName()}({$user_account->getUser()->getUsername()})" : $user_account->getUser()->getUsername();