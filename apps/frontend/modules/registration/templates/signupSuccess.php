<?php slot('header') ?>
    <?php include_partial('menu/header_logo')?>
    <a class="back-to-preflight" href="http://preflightrisk.com">Back to PreflightRisk.com</a>
<?php end_slot() ?>
<h1>Sign up</h1>
<div class="sign-up">
    <form id="sign_up_form" method="POST">
        <?php echo $form->renderGlobalErrors();?>
        <?php echo $form->renderHiddenFields();?>
        <ul class="sign-up-field-list">
            <li><?php include_partial("registration/field", array('field' => $form['first_name'], 'label' => false, 'placeholder' => 'Your Name')); ?></li>
            <li><?php include_partial("registration/field", array('field' => $form['username'], 'class' => 'email', 'label' => false, 'placeholder' => 'Email' )); ?></li>
            <li><?php include_partial("registration/field", array('field' => $form['password'], 'label' => false, 'placeholder' => 'Password' )); ?></li>
        </ul>
        <button type="submit" class="disabled btn btn-grey">Sign Up</button>
    </form>
    <span>
        Already a user?
        <a href="<?php echo url_for("@signin?redirect_to=select_account") ?>" class="sign-in-link">Sign in.</a>
    </span>
</div>

<script type="text/javascript">
    jQuery('body').addClass('sign-up');
    var email_pattern = /^[-a-z0-9!#\$%&'*+\/=?\^_`{|}~]+(\.[-a-z0-9!#\$%&'*+\/=?\^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/i;
    function changeFieldContent(){
        var filled = true;
        var field_list = jQuery('ul.sign-up-field-list');
        jQuery('li input', field_list).each(function(){
            if(jQuery(this).val() == ''){
                filled = false;
            }
        });
        if(filled) {
            jQuery('button[type="submit"]').removeClass('disabled');
        } else {
            jQuery('button[type="submit"]').addClass('disabled');
        }
    }

    function validateForm(email_valid){
        var valid = true;
        var field_list = jQuery('ul.sign-up-field-list');
        jQuery('li input', field_list).each(function(){
            if(jQuery(this).val() == '' ||
                (jQuery(this).hasClass('email') && !jQuery(this).val().match(email_pattern)) ||
                (jQuery(this).hasClass('email') && !email_valid)){
                jQuery(this).addClass('invalid-field');
                valid = false;
            } else {
                jQuery(this).removeClass('invalid-field');
            }
        });
        return valid;
    }

    function submitForm(event) {
        var email_valid = true;
        var form = jQuery(this).closest('form');
        event.preventDefault();
        jQuery.ajax({
            url: '<?php echo url_for('@signup_check') ?>',
            type: 'get',
            dataType: 'json',
            data: {email: jQuery('li input.email').val()},
            success: function(data){
                if(data.result != 'OK'){
                    email_valid = false;
                }
                if(validateForm(email_valid)){
                    form.submit();
                }
            }
        });
        return false;
    }

    jQuery(document).ready(function(){
        var field_list = jQuery('ul.sign-up-field-list');
        //jQuery("li input", field_list).bind('keyup', changeFieldContent);
        jQuery("button[type='submit']").bind('click', submitForm);
        jQuery('#sf_guard_user_first_name, #sf_guard_user_username, #sf_guard_user_password').keyup(function() {
            if ( (jQuery('#sf_guard_user_first_name').val() != '') && (jQuery('#sf_guard_user_username').val() != '') && (jQuery('#sf_guard_user_password').val() != '') ) {
                jQuery('.btn.btn-grey').addClass('active')
            } else {
                jQuery('.btn.btn-grey').removeClass('active')
            }
        });
    });
</script>
