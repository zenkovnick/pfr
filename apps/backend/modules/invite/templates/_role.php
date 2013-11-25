<?php
    switch($user_account->getRole()){
        case 'pic':
            echo "PIC";
            break;
        case 'sic':
            echo "SIC";
            break;
        case 'both':
            echo "PIC and SIC";
            break;
    }