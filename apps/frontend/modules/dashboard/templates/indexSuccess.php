<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<h1>Dashboard</h1>

<a href="<?php echo url_for("@create_flight?account_id={$account->getId()}")?>">New Flight</a>