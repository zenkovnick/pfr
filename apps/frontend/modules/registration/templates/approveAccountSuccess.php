<h1>You have been invited to <?php echo $account->getTitle() ?> account</h1>
<div>
    <a href="<?php echo url_for("@approve_account_process?token={$user_account->getInviteToken()}&status=approve") ?>">Approve</a>
    <a href="<?php echo url_for("@approve_account_process?token={$user_account->getInviteToken()}&status=decline") ?>">Decline</a>
</div>