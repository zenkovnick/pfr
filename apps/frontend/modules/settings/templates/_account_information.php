<div class="account-information-wrapper info-block" style="display:none" >
    <form id="account_information_settings_form" action="<?php echo url_for("@process_account_information_data?account_id={$account->getId()}") ?>" enctype="multipart/form-data" method="post">
        <?php echo($form->renderHiddenFields()) ?>
        <?php echo($form->renderGlobalErrors()) ?>
        <ul>
            <li class="photo-block">
                <?php include_partial('settings/account_avatar_field', array('field' => $form['photo_widget'], 'account' => $account)) ?>
            </li>
            
            <li class="input-block">
                <?php include_partial('settings/field', array('field' => $form['title'], 'class' => 'account-title', 'placeholder' => 'Title')) ?>
            </li>

            <?php if($chief_is_active): ?>
                <li class="input-block">
                    <?php include_partial('settings/field', array('field' => $form['chief_pilot_id'], 'class' => 'chief-pilot', 'placeholder' => 'Title')) ?>
                </li>
            <?php else: ?>
                <li class="input-block">
                    <span class="invited-chief">Chief Pilot was invited(<?php echo $chief_pilot->getUsername() ?>)</span>
                    <a class="cancel-invitation" href="">Cancel invitation</a>
                    <?php include_partial('settings/field', array('field' => $form['chief_pilot_id'], 'class' => 'chief-pilot hidden', 'placeholder' => 'Title')) ?>
                </li>
            <?php endif ?>

            <li>
                <span class="hint">You are currently paying 5$ per month</span>
                <a class="change-billing-link" href="">Change your billing.</a>
            </li>
            <li class="buttons-block">
                <a href="<?php echo url_for("@delete_account?account_id={$account->getId()}"); ?>" class="delete-account-information remove-link">Delete Account</a>
                <button type="submit" class="btn btn-green">Save</button>
            </li>
        </ul>
    </form>

</div>

<script type="text/javascript">
    function cancelInvitation(event){
        event.preventDefault();
        jQuery.ajax({
            url: '<?php echo url_for("@cancel_chief_invitation?account_id={$account->getId()}") ?>',
            dataType: 'json',
            type: 'post',
            success: function(data){

            }
        })
    }
    jQuery("#account_information_settings_form").bind('submit', validateAndSubmitAccountForm);
    init_crop('<?php echo url_for('@create_account_upload_avatar'); ?>', '<?php echo url_for('@create_account_get_widget'); ?>',
        '/images/no_avatar.png', [32, 32], 'photo', 'account_photo_widget', 'account_avatar_container', 'account_uploaded_photo');
    jQuery("a.cancel-invitation").bind('click', cancelInvitation);

</script>
