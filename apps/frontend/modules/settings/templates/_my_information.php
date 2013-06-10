<div class="my-information-wrapper" style="display:none" >
    <form id="my_information_settings_form" action="<?php echo url_for("@process_my_information_data") ?>" enctype="multipart/form-data" method="post">
        <?php echo($form->renderHiddenFields()) ?>
        <?php echo($form->renderGlobalErrors()) ?>
        <ul>
            <li class="photo-block"><?php include_partial('settings/user_avatar_field', array('field' => $form['photo_widget'], 'user' => $user)) ?></li>
            <li class="input-block"><?php include_partial('settings/field',
                    array('field' => $form['first_name'], 'placeholder' => 'Name')) ?>
            </li>
            <li class="input-block"><?php include_partial('settings/field',
                    array('field' => $form['username'], 'class' => 'username', 'placeholder' => 'Email')) ?>
            </li>
            <li class="input-block"><?php include_partial('settings/field',
                    array('field' => $form['new_password'], 'class' => 'new-password', 'placeholder' => 'New Password')) ?>
            </li>
            <li class="input-block"><?php include_partial('settings/field',
                    array('field' => $form['new_password_confirm'], 'class' => 'new-password-confirm', 'placeholder' => 'New Password Confirm')) ?>
            </li>
            <li><button type="submit">Save</button></li>
        </ul>

    </form>
    <a href="<?php echo url_for("@delete_user?account_id={$account->getId()}"); ?>" class="delete-my-information">Delete Me</a>
</div>
<script type="text/javascript">
    jQuery("#my_information_settings_form").bind('submit', validateAndSubmitInformationForm);
    init_crop('<?php echo url_for('@my_information_upload_avatar'); ?>', '<?php echo url_for('@settings_get_widget'); ?>',
        '/images/no_avatar.png', [32, 32], 'photo', 'sf_guard_user_photo_widget', 'user_avatar_container', 'sf_guard_user_uploaded_photo');

</script>