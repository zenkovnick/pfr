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
                <img src="/uploads/avatar/<?php echo $account->getPhoto() ?>" />
            <?php endif ?>
            <a href="<?php echo url_for("@dashboard?account_id={$account->getId()}") ?>"><?php echo $account->getTitle() ?></a>
            <span><?php echo $account->getManager()->getUsername() ?></span>
        </li>
    <?php endforeach; ?>
    <li>
        <img src="#" alt=""/>
        <a href="<?php echo url_for('@create_account') ?>">Create Account</a>
        <span>Set it up now</span>
    </li>
</ul>
<script type="text/javascript">
    jQuery('body').addClass('choose-account');
</script>