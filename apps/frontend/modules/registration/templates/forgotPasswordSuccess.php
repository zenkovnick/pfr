<?php use_helper('I18N') ?>
<h1><?php echo __('Forgot your password?', null, 'sf_guard') ?></h1>

<p>
    <?php echo __('Do not worry, we can help you get back in to your account safely!', null, 'sf_guard') ?>
    <?php echo __('Fill out the form below to request an e-mail with information on how to reset your password.', null, 'sf_guard') ?>
</p>

<form action="<?php echo url_for('@forgot_password') ?>" method="post" class="forgot-password-form">



        <?php echo $form ?>
        <input type="submit" class="btn btn-grey" name="change" value="<?php echo __('Request', null, 'sf_guard') ?>" />
</form>
<script type="text/javascript">
    jQuery('body').addClass('forgot-password');
</script>