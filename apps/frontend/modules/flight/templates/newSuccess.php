<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<div class="flight">
    <form id="flight_form" method="POST">
        <?php echo $form->renderGlobalErrors();?>
        <?php echo $form->renderHiddenFields();?>
        <ul class="flight-field-list">
            <?php foreach($form as $field): ?>
                <li><?php include_partial("registration/field", array('field' => $field)); ?></li>
            <?php endforeach; ?>
        </ul>





        <button type="submit">Sign Up</button>
    </form>
</div>
