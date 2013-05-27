<form action="<?php echo url_for('@signin_process') ?>" method="post">
    <fieldset class="blog-login">
        <?php echo($form->renderHiddenFields()) ?>
        <?php echo($form->renderGlobalErrors()) ?>

        <ul>
            <li class="text">
                <?php include_partial("builder/field", array('field' => $form['username'], 'placeholder' => 'Email')); ?>
            </li>

            <li class="text">
                <?php include_partial("builder/field", array('field' => $form['password'], 'placeholder' => 'Password')); ?>
            </li>
        </ul>
        <button class="btn-grey" type="submit">Sign In</button>

        <span>
            <span>If you are new here create account or</span>
            <a href="<?php echo url_for('@signup') ?>">Sign Up</a>
        </span>

    </fieldset>
</form>

<script type="text/javascript">
    jQuery('[placeholder]').focus(function() {
        var input = jQuery(this);
        if (input.val() == input.attr('placeholder')) {
            input.val('');
            input.removeClass('placeholder');
        }
    }).blur(function() {
            var input = jQuery(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur();
</script>
