<li class="new" id="new_<?php echo $number ?>" style="display: none">
    <a href="" class="cancel-risk-factor-add">Cancel</a>
    <span class="handler hidden">Handler</span>
    <input type="hidden" value="" />
    <div class="entry-header hidden">
        <span class="question"></span>
        <a href="" class="edit-risk-factor-link hidden">Edit</a>
        <a href="" class="cancel-risk-factor-link hidden">Cancel</a>
    </div>
    <div class="risk-factor-wrapper">
        <h2>New Risk factor</h2>
        <form id="risk_factor_form_<?php echo $number ?>" action="<?php echo url_for("@save_risk_factor?form_builder_id={$form_id}&new_form_num={$number}") ?>" method="post">
            <fieldset>

                <?php include_partial("builder/field", array('field' => $form['question'], 'class' => 'question', 'placeholder' => 'Risk factor or question')); ?>
                <?php include_partial("builder/field", array('field' => $form['help_message'], 'class' => 'help-message', 'placeholder' => 'Help text or link (optional)')); ?>

            </fieldset>
            <ul class="response-option-list">

            </ul>
            <a href="" class="add-new-response-link">+ Add Response Option</a>
            <button class="btn btn-green save-risk" type="submit">Save</button>
        </form>
    </div>
</li>
<script type="text/javascript">

    jQuery("#risk_factor_form_<?php echo $number ?>").bind('submit', validateAndSubmitAddRiskFactor)


</script>