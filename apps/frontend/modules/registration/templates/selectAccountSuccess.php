<?php if($sf_user->isAuthenticated()): ?>
    <a href="<?php echo url_for("@signout"); ?>">Sign Out</a>
<?php endif ?>

<h1>Which Account</h1>
<ul>
    <?php foreach($accounts as $account): ?>
        <li>
            <img src="/uploads/avatar/<?php echo $account->getPhoto() ?>" />
            <a href=""><?php echo $account->getTitle() ?></a>
            <span><?php echo $account->getManager()->getUsername() ?></span>
        </li>
    <?php endforeach; ?>
</ul>