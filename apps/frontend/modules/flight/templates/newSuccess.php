<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<div class="flight">
    <form id="flight_form" method="POST">
        <?php echo $form->renderGlobalErrors();?>
        <?php echo $form->renderHiddenFields();?>
        <ul class="flight-field-list">
            <li><?php include_partial("registration/field", array('field' => $form['airport_to'])); ?></li>
            <li><?php include_partial("registration/field", array('field' => $form['airport_from'])); ?></li>
            <li><?php include_partial("registration/field", array('field' => $form['departure_date'])); ?></li>
            <li><?php include_partial("registration/field", array('field' => $form['departure_time'])); ?></li>
        </ul>





        <button type="submit">Sign Up</button>
    </form>
</div>
