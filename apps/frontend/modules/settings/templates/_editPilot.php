<div class="pilot-wrapper" style="display:none">
<!--    <h1>--><?php //echo $risk_factor->getQuestion() ?><!--</h1>-->
    <?php echo $form->renderGlobalErrors();?>
    <?php echo $form->renderHiddenFields();?>
    <form id="edit_pilot_form_<?php echo $pilot->getId() ?>"
          action="<?php echo url_for("@update_pilot?pilot_id={$pilot->getId()}&account_id={$account->getId()}") ?>" method="post">
        <fieldset>
            <?php include_partial("settings/field", array('field' => $form['first_name'], 'class' => 'name', 'placeholder' => 'Name')); ?>
            <?php include_partial("settings/field", array('field' => $form['username'], 'class' => 'username', 'placeholder' => 'Email')); ?>
            <?php if($pilot->getId() != $account->getManagedById() && $pilot->getId() != $sf_user->getGuardUser()->getId()): ?>
                <?php include_partial("settings/field", array('field' => $form['can_manage'], 'class' => 'can-manage')); ?>
            <?php endif ?>
        </fieldset>
        <button class="btn btn-green" type="submit">Save</button>
        <?php if($pilot->getId() != $account->getManagedById() && $pilot->getId() != $sf_user->getGuardUser()->getId()): ?>
            <a href="" class="delete-pilot">Delete</a>
        <?php endif ?>
    </form>
</div>
<script type="text/javascript">
    jQuery(function(){

        jQuery("#edit_pilot_form_<?php echo $pilot->getId() ?>").bind('submit', validateAndSubmitEditPilot)
    });

</script>