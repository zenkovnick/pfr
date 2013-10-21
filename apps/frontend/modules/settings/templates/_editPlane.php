<div class="plane-wrapper info-block" style="display:none">
<!--    <h1>--><?php //echo $risk_factor->getQuestion() ?><!--</h1>-->
    <?php echo $form->renderGlobalErrors();?>
    <?php echo $form->renderHiddenFields();?>
    <form id="edit_plane_form_<?php echo $plane->getId() ?>"
          action="<?php echo url_for("@update_plane?plane_id={$plane->getId()}&account_id={$account_id}") ?>" method="post">
        <ul>
            <li class="input-block">
                <?php include_partial("settings/field", array('field' => $form['tail_number'], 'class' => 'tail-number', 'placeholder' => 'Tail Number')); ?>
            </li>
            <li class="buttons-block">
                <a href="" class="delete-plane remove-link">Delete</a>
                <button class="btn btn-green" type="submit">Save</button>
            </li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    jQuery(function(){

        jQuery("#edit_plane_form_<?php echo $plane->getId() ?>").bind('submit', validateAndSubmitEditPlane)
    });

</script>