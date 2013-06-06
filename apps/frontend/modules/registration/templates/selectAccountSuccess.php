<?php use_helper('Thumbnail'); ?>
<?php slot('header') ?>
    <?php include_partial('menu/header_logo')?>
    <?php if($sf_user->isAuthenticated()): ?>
        <a class="sign-out" href="<?php echo url_for("@signout"); ?>">Sign Out</a>
    <?php endif ?>
<?php end_slot() ?>


<h1>Which Account</h1>
<ul>
    <?php foreach($accounts as $account): ?>
        <li>
            <?php if($account->getPhoto()): ?>
                <?php if($account->getPhoto()): ?>
                    <?php echo image_tag(getThumbnail('avatar/'.$account->getPhoto(), 40), array('alt' => '')) ?>
                <?php else: ?>
                    <?php echo image_tag(getThumbnail('../images/no_logo.jpg', 40), array('alt' => '')) ?>
                <?php endif ?>
            <?php endif ?>
            <a href="<?php echo url_for("@dashboard?account_id={$account->getId()}") ?>"><?php echo $account->getTitle() ?></a>
            <span><?php echo $account->getManager()->getUsername() ?></span>
        </li>
    <?php endforeach; ?>
    <li>
        <a href="<?php echo url_for('@create_account') ?>">Create Account</a>
    </li>
</ul>