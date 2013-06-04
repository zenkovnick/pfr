<?php echo $form->renderGlobalErrors();?>
<?php echo $form->renderHiddenFields();?>
<ul class="flight-field-list">
    <?php foreach($form as $field): ?>
        <li><?php include_partial("flight/field", array('field' => $field, 'label' => true)); ?></li>
    <?php endforeach; ?>
</ul>