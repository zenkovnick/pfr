<?php slot('header') ?>
    <?php include_partial('menu/header_logo')?>
    <a class="back-to-preflight" href="http://preflightrisk.com">Back to PreflightRisk.com</a>
<?php end_slot() ?>
<h1>Sign in</h1>
<form class="sign-in-form" action="<?php echo url_for('@signin_process') ?>" method="post">
    <fieldset class="blog-login">
        <?php echo($form->renderHiddenFields()) ?>
        <?php echo($form->renderGlobalErrors()) ?>

        <ul>
            <li class="text">
                <?php include_partial("builder/field", array('field' => $form['username'], 'placeholder' => 'Email', 'label' => false)); ?>
            </li>

            <li class="text">
                <?php include_partial("builder/field", array('field' => $form['password'], 'placeholder' => 'Password', 'label' => false)); ?>
            </li>
        </ul>
        <button class="btn btn-grey" type="submit">Sign In</button>

        <span>
            If you're new here, create an account or
            <a href="<?php echo url_for('@signup') ?>">sign up.</a>
        </span>

    </fieldset>
</form>

<script type="text/javascript">
    jQuery('body').addClass('sign-in');
//    jQuery('[placeholder]').focus(function() {
//        var input = jQuery(this);
//        if (input.val() == input.attr('placeholder')) {
//            input.val('');
//            input.removeClass('placeholder');
//        }
//    }).blur(function() {
//            var input = jQuery(this);
//            if (input.val() == '' || input.val() == input.attr('placeholder')) {
//                input.addClass('placeholder');
//                input.val(input.attr('placeholder'));
//            }
//        }).blur();
</script>
