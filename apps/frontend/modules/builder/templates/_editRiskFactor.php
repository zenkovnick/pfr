<div class="risk-factor-wrapper">
    <h1><?php echo $risk_factor->getQuestion() ?></h1>
    <?php echo $form->renderGlobalErrors();?>
    <?php echo $form->renderHiddenFields();?>
    <form id="edit_risk_factor_form_<?php echo $risk_factor->getId() ?>"
          action="<?php echo url_for("@update_risk_factor?risk_factor_id={$risk_factor->getId()}&form_builder_id={$form_id}") ?>" method="post">
        <fieldset>
            <a href="#" class="delete_risk_factor">Remove</a>
            <?php include_partial("builder/field", array('field' => $form['question'], 'placeholder' => 'Risk factor or question')); ?>
            <?php include_partial("builder/field", array('field' => $form['help_message'], 'placeholder' => 'Help text or link (optional)')); ?>

        </fieldset>
        <ul class="response-option-list">
            <?php foreach($form['ResponseOptions'] as $option): ?>
                <li>
                    <?php include_partial("builder/field", array('field' => $option['response_text'], 'placeholder' => 'Risk factor or question')); ?>
                    <?php include_partial("builder/field", array('field' => $option['response_value'], 'placeholder' => 'Help text or link (optional)')); ?>
                    <?php include_partial("builder/field", array('field' => $option['note'], 'placeholder' => 'Help text or link (optional)')); ?>
                </li>
            <?php endforeach ?>
        </ul>
        <a href="" class="add-new-response-link">+ Add Response Option</a>
        <button type="submit">Save</button>
    </form>
</div>
<script type="text/javascript">
    jQuery(function(){
        var edit_options_submit = {
            dataType:  'json',
            clearForm: false,
            success: editRiskFactorSubmitted
        };
        jQuery("#edit_risk_factor_form_<?php echo $risk_factor->getId() ?>").ajaxForm(edit_options_submit);
    });

</script>