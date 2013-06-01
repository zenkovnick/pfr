<?php if($sf_user->isAuthenticated()): ?>
    <a href="<?php echo url_for("@signout"); ?>">Sign Out</a>
<?php endif ?>

<h1>Which Account</h1>
<ul>
    <?php foreach($accounts as $account): ?>
        <li>
            <?php if($account->getPhoto()): ?>
                <img src="/uploads/avatar/<?php echo $account->getPhoto() ?>" />
            <?php endif ?>
            <a href="<?php echo url_for("@dashboard?account_id={$account->getId()}") ?>"><?php echo $account->getTitle() ?></a>
            <span><?php echo $account->getManager()->getUsername() ?></span>
        </li>
    <?php endforeach; ?>
    <li>
        <a href="<?php echo url_for('@create_account') ?>">Create Account</a>
    </li>
</ul>