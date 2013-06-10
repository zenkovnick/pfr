<div class="account-information-wrapper" style="display:none" >
    <form id="account_information_settings_form" action="<?php echo url_for("@process_account_information_data?account_id={$account->getId()}") ?>" enctype="multipart/form-data" method="post">
        <?php echo($form->renderHiddenFields()) ?>
        <?php echo($form->renderGlobalErrors()) ?>
        <ul>
            <li class="photo-block"><?php include_partial('settings/account_avatar_field', array('field' => $form['photo_widget'], 'account' => $account)) ?></li>
            <li class="input-block"><?php include_partial('settings/field',
                    array('field' => $form['title'], 'class' => 'account_title', 'placeholder' => 'Title')) ?>
            </li>
            <li class="input-block"><?php include_partial('settings/field',
                    array('field' => $form['chief_pilot_name'], 'class' => 'cpn', 'placeholder' => 'Chief Pilot Name')) ?>
            </li>
            <li><button type="submit">Save</button></li>
        </ul>
    </form>
    <a href="<?php echo url_for("@delete_account?account_id={$account->getId()}"); ?>" class="delete-account-information">Delete Account</a>

</div>

<script type="text/javascript">
    jQuery("#account_information_settings_form").bind('submit', validateAndSubmitAccountForm);
    init_crop('<?php echo url_for('@create_account_upload_avatar'); ?>', '<?php echo url_for('@create_account_get_widget'); ?>',
        '/images/no_avatar.png', [32, 32], 'photo', 'account_photo_widget', 'account_avatar_container', 'account_uploaded_photo');

</script>
