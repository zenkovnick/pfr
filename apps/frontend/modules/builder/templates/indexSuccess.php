<?php include_partial("home/error"); ?>
<?php include_partial('home/notice'); ?>
<?php include_partial('home/success'); ?>

<div>
    <?php include_partial("builder/field", array('field' => $form['name'])); ?>
    <?php include_partial("builder/field", array('field' => $form['instructions'])); ?>
</div>
