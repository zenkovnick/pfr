<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<h1>Dashboard</h1>

<?php echo $account->getTitle() ?>
<a href="<?php echo url_for("@signout") ?>">Sign Out</a>