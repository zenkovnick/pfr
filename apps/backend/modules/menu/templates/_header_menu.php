<?php use_helper('Thumbnail') ?>
<div class="header-account-information">
    <span class="header-account-avatar">
        <?php if(isset($account) && $account->getPhoto()): ?>
            <?php echo image_tag(getThumbnail('avatar/'.$account->getPhoto(), 60), array('alt' => '')) ?>
        <?php else: ?>
            <?php echo image_tag(getThumbnail('../images/no_logo.jpg', 60), array('alt' => '')) ?>
        <?php endif ?>
    </span>
    <span class="header-account-title">
        <?php if(isset($account) && $account->getTitle()): ?>
            <?php echo $account->getTitle(); ?>
        <?php else: ?>
            PreFlight Risk
        <?php endif ?>
    </span>
</div>

<div class="header-user-information-wrapper">
    <div class="user-wrapper">

        <span class="header-user-name">
            Keep the blue side up, <?php echo $sf_user->getGuardUser()->getFirstName(); ?>
        </span>
        <span class="header-user-email">
            <?php echo $sf_user->getGuardUser()->getUsername(); ?> (<a href="<?php echo url_for('@signout') ?>">Sign Out</a>)
        </span>
    </div>
</div>
<ul class="header-link-block">
    <li class="header-dashboard header-link">
        <a href="<?php echo isset($account) ? url_for("@dashboard?account_id={$account->getId()}") : "#" ?>">Dashboard</a>
    </li>
    <li class="header-settings header-link">
        <a href="<?php echo isset($account) ? url_for("@settings?account_id={$account->getId()}") : "#" ?>">Settings</a>
    </li>
    <li class="header-settings header-link">
        <a href="<?php echo url_for("@select_account")?>">Change Account</a>
    </li>
    <li class="mobile-logout">
        <a href="<?php echo url_for('@signout') ?>">Sign Out</a>
    </li>
</ul>

