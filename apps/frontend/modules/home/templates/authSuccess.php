<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(".forgot-password").click(function(event){
            event.preventDefault();
            jQuery("div.login-block").hide(0, function(){
                jQuery("div.recovery-block").show();
            })

        });
        jQuery(".return-to-login").click(function(event){
            event.preventDefault();
            jQuery("div.recovery-block").hide(0, function(){
                jQuery("div.login-block").show();
            })
        });
    });
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
<div class="popup signin">
    <?php use_helper('I18N') ?>
    <?php echo($form->renderHiddenFields()) ?>
    <?php echo($form->renderGlobalErrors()) ?>

    <div class="login-block">
        <a href="#" class="close-popup" onclick="jQuery.fancybox.close(); return false"></a>
        <h1>Members Sign In</h1>
        <p>Members, please log in below using your email address and password</p>
        <form action="<?php echo url_for('@sf_guard_signin?ref_action=book') ?>" method="post">
            <?php //include_partial('authorization/form', array('form' => $form)) ?>

            <div class="input-block">
                <?php echo $form['username']->renderLabel() ?>
                <?php echo $form['username']->render(); ?>
                <?php echo $form['username']->renderError() ?>
            </div>

            <div class="input-block">
                <?php echo $form['password']->renderLabel() ?>
                <?php echo $form['password']->render(); ?>
                <?php echo $form['password']->renderError() ?>
            </div>

            <input type="submit" class="btn btn-violet" value="Sign In" />

            <div class="check-block">
                <?php echo $form['remember']->render(); ?>
                <?php echo $form['remember']->renderLabel() ?>
                <?php echo $form['remember']->renderError() ?>
            </div>
        </form>
        <a href="#" class="bottom-link forgot-password">I Forgot My Password</a>
    </div>
    <div class="recovery-block" style="display: none">
        <a href="#" class="close-popup" onclick="jQuery.fancybox.close()"></a>
        <h1>Password Recovery</h1>

        <p class="password-pages-hint">Please enter your Email and we'll send you new password</p>

        <form  name="<?php echo($forgot_password_form->getName()) ?>" method="post" action="<?php echo url_for("@forgot_password") ?>">
            <fieldset class="blog-login">
                <div class="input-block">
                    <?php echo $forgot_password_form['username']->render(array('placeholder' => 'Email Address')); ?>
                    <?php echo $forgot_password_form['username']->renderError() ?>
                </div>
                <input type="submit" class="btn btn-violet" value="Recover" />
            </fieldset>
        </form>
        <a href="#" class="bottom-link return-to-login">Return to Login Form</a>
    </div>

</div> <!-- /Login -->

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