<?php include_partial('menu/header_menu', array('account_id' => $account->getId())); ?>


<!--[if IE 9]>
<script type="text/javascript" src="/js/jquery.fileupload-ie9.js"></script>
<![endif]-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        init_crop('<?php echo url_for('@create_account_upload_avatar'); ?>', '<?php echo url_for('@create_account_crop_image'); ?>', '/images/no_avatar.png', [32, 32], 'photo', 'account_photo');
    });
</script>

<a href="<?php echo url_for("@signout") ?>">Sign Out</a>

<h1>Settings</h1>

<ul class="settings-list">
    <li class="my-information">
        <form id="my_information_settings_form" action="<?php echo url_for("@process_my_information_data?account_id={$account->getId()}") ?>" enctype="multipart/form-data" method="post">
            <?php echo($user_form->renderHiddenFields()) ?>
            <?php echo($user_form->renderGlobalErrors()) ?>
            <ul>
                <li class="photo-block"><?php include_partial('registration/avatar_field', array('field' => $user_form['photo'])) ?></li>
                <li class="input-block"><?php include_partial('registration/field', array('field' => $user_form['first_name'], 'placeholder' => 'Name')) ?></li>
                <li class="input-block"><?php include_partial('registration/field', array('field' => $user_form['username'], 'placeholder' => 'Email')) ?></li>
                <li class="input-block"><?php include_partial('registration/field', array('field' => $user_form['new_password'], 'placeholder' => 'New Password')) ?></li>
                <li class="input-block"><?php include_partial('registration/field', array('field' => $user_form['new_password_confirm'], 'placeholder' => 'New Password Confirm')) ?></li>
                <li><button type="submit">Save</button></li>
            </ul>

        </form>

    </li>
</ul>
