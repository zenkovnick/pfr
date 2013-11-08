<?php slot('header') ?>
    <?php include_partial('menu/header_logo')?>
    <a class="back-to-preflight" href="http://preflightrisk.com">Back to PreflightRisk.com</a>
<?php end_slot() ?>
<h1>Password Recovery</h1>

<span>
    Please enter email and we'll send You instructions
</span>

<form action="<?php echo url_for('@forgot_password') ?>" method="post" class="forgot-password-form">
    <?php echo($form->renderHiddenFields()) ?>
    <?php echo($form->renderGlobalErrors()) ?>

    <ul class="sign-up-field-list">
        <li><?php include_partial("registration/field", array('field' => $form['username'], 'class' => 'email', 'label' => false, 'placeholder' => 'Email' )); ?></li>
    </ul>
    <button class="btn btn-grey" type="submit">Recover</button>

    <span>
        If you're new here, create an account or
        <a href="<?php echo url_for('@signup') ?>">sign up.</a>
    </span>

</form>
<script type="text/javascript">
    jQuery('body').addClass('forgot-password');
</script>