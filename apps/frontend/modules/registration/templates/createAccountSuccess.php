<!--[if IE 9]>
<script type="text/javascript" src="/js/jquery.fileupload-ie9.js"></script>
<![endif]-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
    jQuery('body').addClass('create-account');
    jQuery(document).ready(function(){
        init_crop('<?php echo url_for('@create_account_upload_avatar'); ?>', '<?php echo url_for('@create_account_get_widget'); ?>',
            '/images/no_avatar.png', [32, 32], 'photo', 'account_photo_widget', 'avatar_container', 'account_uploaded_photo');
    });
</script>

<?php slot('header') ?>
    <?php include_partial('menu/header_logo')?>
    <?php if($sf_user->isAuthenticated()): ?>
        <a class="sign-out" href="<?php echo url_for("@signout"); ?>">Sign Out</a>
    <?php endif ?>
<?php end_slot() ?>

<h1>Create an Account</h1>
<p>
   Welcome! If you know your company is already using Preflight Risk, email your administrator to request they add you
   as a user. Otherwise, create an account now.
</p>

<form id="create_account_form" method="post">
    <?php echo($form->renderHiddenFields()) ?>
    <?php echo($form->renderGlobalErrors()) ?>


    <ul>
        <li class="input-block"><?php include_partial('registration/field', array('field' => $form['title'], 'class' => 'company-title', 'placeholder' => 'Company, Organization or Name', 'label' => false)) ?></li>
        <li class="input-block"><?php include_partial('registration/field', array('field' => $form['chief_pilot_email'], 'class' => 'chief-pilot-email', 'placeholder' => 'Chief Pilot\'s Email (if any)', 'label' => false)) ?></li>
        <li class="photo-block"><?php include_partial('registration/avatar_field', array('field' => $form['photo_widget'])) ?></li>
        <li><button class="btn btn-blue" type="submit">Create Account</button></li>
    </ul>

</form>

<script type="text/javascript">
    function validateAndSubmitCreation(event){
        var valid = true;
        if(jQuery(".company-title").val() == ''){
            valid = false;
            jQuery(".company-title").addClass('invalid-field');
        }
        if(valid){
            return true;
        } else {
            event.preventDefault();
        }
    }

    jQuery(document).ready(function(){
        jQuery("#create_account_form").bind('submit', validateAndSubmitCreation);
    });
</script>

