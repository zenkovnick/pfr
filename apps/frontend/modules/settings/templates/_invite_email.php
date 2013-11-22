<p>
    You have been invited to <?php echo $account->getTitle() ?> account by
    <?php if($initiator->getFirstName()): ?>
        <?php echo "{$initiator->getFirstName()}({$initiator->getUsername()})" ?>
    <?php else: ?>
        <?php echo $initiator->getUsername() ?>
    <?php endif ?>
</p>
<p>
    Please, visit this <a href="<?php echo $url ?>">link</a> to sign up in PreFlightRisk.
</p>
<p>
    Once at the login page, Please enter a password you want to use and it will be set after you click "Sign Up"
</p>