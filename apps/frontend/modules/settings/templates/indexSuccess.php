<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account_id' => $account->getId(), 'account' => $account)); ?>
<?php end_slot() ?>

<!--[if IE 9]>
<script type="text/javascript" src="/js/jquery.fileupload-ie9.js"></script>
<![endif]-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        init_crop('<?php echo url_for('@my_information_upload_avatar'); ?>', '<?php echo url_for('@my_information_crop_image'); ?>',
            '/images/no_avatar.png', [32, 32], 'photo', 'sf_guard_user_photo', 'user_avatar_container', 'sf_guard_user_uploaded_photo');
        init_crop('<?php echo url_for('@create_account_upload_avatar'); ?>', '<?php echo url_for('@create_account_crop_image'); ?>',
            '/images/no_avatar.png', [32, 32], 'photo', 'account_photo', 'account_avatar_container', 'account_uploaded_photo');
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
                <li class="photo-block"><?php include_partial('settings/user_avatar_field', array('field' => $user_form['photo'], 'user' => $user)) ?></li>
                <li class="input-block"><?php include_partial('settings/field',
                        array('field' => $user_form['first_name'], 'placeholder' => 'Name')) ?>
                </li>
                <li class="input-block"><?php include_partial('settings/field',
                        array('field' => $user_form['username'], 'class' => 'username', 'placeholder' => 'Email')) ?>
                </li>
                <li class="input-block"><?php include_partial('settings/field',
                        array('field' => $user_form['new_password'], 'class' => 'new-password', 'placeholder' => 'New Password')) ?>
                </li>
                <li class="input-block"><?php include_partial('settings/field',
                        array('field' => $user_form['new_password_confirm'], 'class' => 'new-password-confirm', 'placeholder' => 'New Password Confirm')) ?>
                </li>
                <li><button type="submit">Save</button></li>
            </ul>

        </form>

    </li>
</ul>

<script type="text/javascript">
    function informationSubmitted(data){
        alert('a');
    }
    var information_submit = {
        dataType:  'json',
        clearForm: false,
        success: informationSubmitted
    };

    var email_pattern = /^[-a-z0-9!#\$%&'*+\/=?\^_`{|}~]+(\.[-a-z0-9!#\$%&'*+\/=?\^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/i;

    function validateAndSubmitInformationForm(event) {
        event.preventDefault();
        var valid = true;
        var username = jQuery('input.username', this);
        var new_pass = jQuery('input.new-password', this);
        var new_pass_confirm = jQuery('input.new-password-confirm', this);

        if(username.val() == '' || !username.val().match(email_pattern)) {
            valid = false;
            username.addClass('invalid-field');
        }

        if(new_pass.val() != new_pass_confirm.val()){
            valid = false;
            new_pass.addClass('invalid-field');
            new_pass_confirm.addClass('invalid-field');
        }
        if(valid){
            jQuery('.invalid-field', this).removeClass('invalid-field');
            jQuery(this).ajaxSubmit(information_submit);
        }

    }

    jQuery(document).ready(function(){
        jQuery("#my_information_settings_form").bind('submit', validateAndSubmitInformationForm)
    });
</script>
