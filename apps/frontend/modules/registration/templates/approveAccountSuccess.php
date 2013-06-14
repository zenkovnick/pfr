<?php slot('header') ?>
    <?php include_partial('menu/header_logo')?>
    <?php if($sf_user->isAuthenticated()): ?>
        <a class="sign-out" href="<?php echo url_for("@signout"); ?>">Sign Out</a>
    <?php endif ?>
<?php end_slot() ?>
<div class="approve-account">
    <h2>Welcome, <?php echo $sf_user->getGuardUser()->getFirstName() ?></h2>
    <p>You have been invited to <?php echo $account->getTitle() ?> account</p>
    <div class="buttons">
        <a class="btn btn-green" href="<?php echo url_for("@approve_account_process?token={$user_account->getInviteToken()}&status=approve") ?>">Accept</a>
        <a class="btn btn-red"href="<?php echo url_for("@approve_account_process?token={$user_account->getInviteToken()}&status=decline") ?>">Decline</a>
    </div>
</div>
