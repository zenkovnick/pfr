<li class="new-response-option">
    <fieldset>
        <?php include_partial("builder/field", array('field' => $form['new-response'][$number]['response_text'])); ?>
        <?php include_partial("builder/field", array('field' => $form['new-response'][$number]['response_value'])); ?>
        <?php include_partial("builder/field", array('field' => $form['new-response'][$number]['note'], 'placeholder' => 'Add instructions or notes if the above response is selected')); ?>
    </fieldset>
</li>