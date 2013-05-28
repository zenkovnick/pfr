<!--[if IE 9]>
<script type="text/javascript" src="/js/jquery.fileupload-ie9.js"></script>
<![endif]-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        init_crop('<?php echo url_for('@create_account_upload_avatar'); ?>', '<?php echo url_for('@create_account_crop_image'); ?>',
            '/images/no_avatar.png', [32, 32], 'photo', 'account_photo', 'avatar_container', 'account_uploaded_photo');
    });
</script>


<?php if($sf_user->isAuthenticated()): ?>
    <a href="<?php echo url_for("@signout"); ?>">Sign Out</a>
<?php endif ?>

<form id="create_account_form" method="post">
    <?php echo($form->renderHiddenFields()) ?>
    <?php echo($form->renderGlobalErrors()) ?>


    <ul>
        <li class="input-block"><?php include_partial('registration/field', array('field' => $form['title'], 'placeholder' => 'Company, Organization or Name')) ?></li>
        <li class="input-block"><?php include_partial('registration/field', array('field' => $form['chief_pilot_email'], 'placeholder' => 'Chief Pilot\'s Email (if any)')) ?></li>
        <li class="photo-block"><?php include_partial('registration/avatar_field', array('field' => $form['photo'])) ?></li>
        <li><button type="submit">Create Account</button></li>
    </ul>

</form>

