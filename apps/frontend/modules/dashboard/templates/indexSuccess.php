<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<h1>Dashboard</h1>

<a href="<?php echo url_for("@create_flight?account_id={$account->getId()}")?>">New Flight</a>
<ul>
    <?php foreach($flights as $flight): ?>
        <li>
            <?php if($flight->getDrafted() && $flight->getStatus() != "complete"): ?>
                <span>Drafted</span>
                <span><?php echo $flight->getId() ?></span>
                <a href="<?php echo url_for("@edit_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>">Edit</a>
            <?php else: ?>
                <span><?php echo $flight->getId()." ".$flight->getTripNumber() ?></span>
            <?php endif ?>
        </li>
    <?php endforeach ?>
</ul>