<?php include_partial('menu/header_menu', array('account_id' => $account->getId())); ?>

<h1>Dashboard</h1>

<?php echo $account->getTitle() ?>
<a href="<?php echo url_for("@signout") ?>">Sign Out</a>