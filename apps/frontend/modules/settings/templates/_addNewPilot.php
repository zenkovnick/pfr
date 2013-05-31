<li class="new" id="new_pilot_<?php echo $number ?>" style="display: none">
    <a href="" class="cancel-pilot-add">Cancel</a>
    <span class="handler hidden">Handler</span>
    <input type="hidden" value="" />
    <div class="pilot-header hidden">
        <span class="name"></span>
        <a href="" class="edit-pilot-link hidden">Edit</a>
        <a href="" class="cancel-pilot-link hidden">Cancel</a>
    </div>
    <div class="pilot-wrapper">
        <h2>New Pilot</h2>
        <?php echo($form->renderHiddenFields()) ?>
        <?php echo($form->renderGlobalErrors()) ?>
        <form id="pilot_form_<?php echo $number ?>" action="<?php echo url_for("@save_pilot?account_id={$account_id}&new_form_num={$number}") ?>" method="post">
            <fieldset>
                <?php include_partial("settings/field", array('field' => $form['first_name'], 'class' => 'name', 'placeholder' => 'Name')); ?>
                <?php include_partial("settings/field", array('field' => $form['username'], 'class' => 'username', 'placeholder' => 'Email')); ?>
                <?php include_partial("settings/field", array('field' => $form['can_manage'], 'class' => 'can-manage', 'placeholder' => 'Email')); ?>
            </fieldset>
            <button class="btn btn-green" type="submit">Save</button>
        </form>
    </div>
</li>
<script type="text/javascript">

    jQuery("#pilot_form_<?php echo $number ?>").bind('submit', validateAndSubmitAddPilot)


</script>