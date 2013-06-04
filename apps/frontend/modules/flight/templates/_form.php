<?php echo $form->renderGlobalErrors();?>
<?php echo $form->renderHiddenFields();?>
<ul class="flight-field-list">
    <?php foreach($form as $field): ?>
        <li><?php include_partial("registration/field", array('field' => $field)); ?></li>
    <?php endforeach; ?>
</ul>