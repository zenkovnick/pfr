<div class="risk-factor-wrapper" style="display:none">
<!--    <h1>--><?php //echo $risk_factor->getQuestion() ?><!--</h1>-->
    <?php echo $form->renderGlobalErrors();?>
    <?php echo $form->renderHiddenFields();?>
    <form id="edit_risk_factor_form_<?php echo $risk_factor->getId() ?>"
          action="<?php echo url_for("@update_risk_factor?risk_factor_id={$risk_factor->getId()}&form_builder_id={$form_id}") ?>" method="post">
        <fieldset>
            <?php include_partial("builder/field", array('field' => $form['question'], 'class' => 'question', 'placeholder' => 'Risk factor or question')); ?>
            <?php include_partial("builder/field", array('field' => $form['help_message'], 'class' => 'help-message', 'placeholder' => 'Help text or link (optional)')); ?>

        </fieldset>
        <ul class="response-option-list">
            <?php foreach($form['ResponseOptions'] as $option): ?>
                <li class="response-option">
                    <input class="response-option-id" type="hidden" value="<?php echo $option['id']->getValue() ?>" />
                    <?php include_partial("builder/field", array('field' => $option['response_text'], 'class' => 'response-text', 'placeholder' => 'Risk factor or question')); ?>
                    <?php include_partial("builder/field", array('field' => $option['response_value'], 'class' => 'response-value', 'placeholder' => 'Help text or link (optional)')); ?>
                    <?php if($option['note']->getValue()): ?>
                        <div class="remove-note-wrapper">
                            <?php include_partial("builder/field", array('field' => $option['note'], 'class' => 'note', 'placeholder' => 'Help text or link (optional)')); ?>
                            <a href="" class="remove-note">Remove note</a>
                        </div>
                        <div class="add-note-wrapper hidden">
                            <a href="" class="add-note">Add note</a>
                        </div>
                    <?php else: ?>
                        <div class="remove-note-wrapper hidden">
                            <?php include_partial("builder/field", array('field' => $option['note'], 'class' => 'note', 'placeholder' => 'Help text or link (optional)')); ?>
                            <a href="" class="remove-note">Remove note</a>
                        </div>
                        <div class="add-note-wrapper">
                            <a href="" class="add-note">Add note</a>
                        </div>
                    <?php endif; ?>
                    <a href="" class="delete-response-option-link hidden">Delete</a>
                </li>
            <?php endforeach ?>
        </ul>
        <a href="" class="add-new-response-link">+ Add Response Option</a>
        <button class="btn btn-green save-risk" type="submit">Save</button>
        <a href="" class="delete_risk_factor">Delete</a>
    </form>
</div>
<script type="text/javascript">
    jQuery(function(){

        jQuery("#edit_risk_factor_form_<?php echo $risk_factor->getId() ?>").bind('submit', validateAndSubmitEditRiskFactor)
        jQuery(".response-value").spinner({max: 5, min: 0}).prop('readonly', 'readonly');
        //jQuery(".response-value").spinner("option", "icons", { down: "/images/spinner_down.png", up: "/images/spinner_up.png" });
    });

</script>