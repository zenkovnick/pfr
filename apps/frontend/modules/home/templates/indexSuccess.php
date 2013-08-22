<?php if($sf_user->isAuthenticated()): ?>
    <a href="<?php echo url_for("@select_account") ?>">Select Account</a>
<?php else: ?>
    <a href="<?php echo url_for("@signup") ?>">Sign Up</a>
    <a href="<?php echo url_for("@signin") ?>">Sign In</a>
<?php endif ?>

<h1>HomePage</h1>