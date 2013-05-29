<?php use_helper('Thumbnail') ?>
<div class="header-account-information">
    <span class="header-account-avatar">
        <?php if(isset($account_id) && isset($account) && $account->getPhoto()): ?>
            <?php echo image_tag(getThumbnail('avatar/'.$account->getPhoto(), 40), array('alt' => '')) ?>
        <?php else: ?>
            <?php echo image_tag(getThumbnail('../images/no_logo.jpg', 40), array('alt' => '')) ?>
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
<div class="header-link-block">
    <span class="header-dashboard">
        <a href="<?php echo isset($account_id) ? url_for("@dashboard?account_id={$account_id}") : "#" ?>">Dashboard</a>
    </span>
    <span class="header-settings">
        <a href="<?php echo isset($account_id) ? url_for("@settings?account_id={$account_id}") : "#" ?>">Settings</a>
    </span>
</div>
<div class="header-user-information">
    <span class="header-user-name">
        Keep the blue side up, <?php echo $sf_user->getGuardUser()->getFirstName(); ?>
    </span>
    <span class="header-user-email">
        <?php echo $sf_user->getGuardUser()->getUsername(); ?>
    </span>
    <span class="header-user-email">
        <?php if($sf_user->getGuardUser()->getPhoto()): ?>
            <?php echo image_tag(getThumbnail('avatar/'.$sf_user->getGuardUser()->getPhoto(), 40), array('alt' => '')) ?>
        <?php else: ?>
            <?php echo image_tag(getThumbnail('../images/no_logo.jpg', 40), array('alt' => '')) ?>
        <?php endif ?>
    </span>

</div>

