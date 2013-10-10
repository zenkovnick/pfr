<div class="pilot-wrapper info-block" style="display:none">
<!--    <h1>--><?php //echo $risk_factor->getQuestion() ?><!--</h1>-->
    <?php echo $form->renderGlobalErrors();?>
    <?php echo $form->renderHiddenFields();?>
    <form id="edit_pilot_form_<?php echo $pilot->getId() ?>"
          action="<?php echo url_for("@update_pilot?pilot_id={$pilot->getId()}&account_id={$account->getId()}") ?>" method="post">
        <ul>
            <li class="input-block">
                <?php include_partial("settings/field", array('field' => $form['first_name'], 'class' => 'name', 'placeholder' => 'Name')); ?>
            </li>
            
            <li class="input-block">
                <?php include_partial("settings/field", array('field' => $form['username'], 'class' => 'username', 'placeholder' => 'Email')); ?>
            </li>
            
            <?php if($pilot->getId() != $account->getManagedById() && $pilot->getId() != $sf_user->getGuardUser()->getId()): ?>
                <li class="check-block">
                    <?php include_partial("settings/field", array('field' => $form['can_manage'], 'class' => 'can-manage')); ?>
                </li>
                <li class="check-block">
                    <?php include_partial("settings/field", array('field' => $form['role'], 'class' => 'role')); ?>
                </li>

            <?php endif ?>

            <li class="hint-block">
                <p>Adding this pilot will give you the ability to measure their flights' risk over time, but be aware that by adding them, you will be adding <span>$3 every month</span> to your bill.</p>
            </li>
            <li class="buttons-block">
                <?php if($pilot->getId() != $account->getManagedById() && $pilot->getId() != $sf_user->getGuardUser()->getId()): ?>
                    <a href="" class="delete-pilot remove-link">Delete</a>
                <?php endif ?>
                <button class="btn btn-green" type="submit">Save</button>
            </li>
        </ul>
    </form>
</div>
<script type="text/javascript">
    jQuery(function(){

        jQuery("#edit_pilot_form_<?php echo $pilot->getId() ?>").bind('submit', validateAndSubmitEditPilot)
    });

</script>