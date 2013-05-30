<div class="plane-wrapper" style="display:none">
<!--    <h1>--><?php //echo $risk_factor->getQuestion() ?><!--</h1>-->
    <?php echo $form->renderGlobalErrors();?>
    <?php echo $form->renderHiddenFields();?>
    <form id="edit_plane_form_<?php echo $plane->getId() ?>"
          action="<?php echo url_for("@update_plane?plane_id={$plane->getId()}&account_id={$account_id}") ?>" method="post">
        <fieldset>
            <?php include_partial("settings/field", array('field' => $form['tail_number'], 'class' => 'tail-number', 'placeholder' => 'Tail Number')); ?>
        </fieldset>
        <button class="btn btn-green" type="submit">Save</button>
        <a href="" class="delete-plane">Delete</a>
    </form>
</div>
<script type="text/javascript">
    jQuery(function(){

        jQuery("#edit_plane_form_<?php echo $plane->getId() ?>").bind('submit', validateAndSubmitEditPlane)
    });

</script>