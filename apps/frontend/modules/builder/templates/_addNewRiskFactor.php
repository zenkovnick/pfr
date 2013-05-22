<li class="new">
    <div class="risk-factor-wrapper">
        <h2>New Risk factor</h2>
        <form id="risk_factor_form_<?php echo $number ?>" action="<?php echo url_for('@save_risk_factor?form_builder_id='.$form_id) ?>" method="post">
            <fieldset>
                <a href="#" class="delete_risk_factor">Remove</a>
                <?php include_partial("builder/field", array('field' => $form['question'], 'placeholder' => 'Risk factor or question')); ?>
                <?php include_partial("builder/field", array('field' => $form['help_message'], 'placeholder' => 'Help text or link (optional)')); ?>

            </fieldset>
            <ul class="response-option-list">

            </ul>
            <a href="" class="add-new-response-link">+ Add Response Option</a>
            <button class="btn btn-green" type="submit">Save</button>
        </form>
    </div>
</li>
<script type="text/javascript">
    jQuery(function(){
        var options_submit = {
            dataType:  'json',
            clearForm: false,
            success: riskFactorSubmitted
        };
        jQuery("#risk_factor_form_<?php echo $number ?>").ajaxForm(options_submit);
    });

</script>