<div class="sign-up">
    <form id="sign_up_form" method="POST">
        <?php echo $form->renderGlobalErrors();?>
        <?php echo $form->renderHiddenFields();?>
        <ul class="sign-up-field-list">
            <li><?php include_partial("registration/field", array('field' => $form['name'])); ?></li>
            <li><?php include_partial("registration/field", array('field' => $form['username'], 'class' => 'email')); ?></li>
            <li><?php include_partial("registration/field", array('field' => $form['password'])); ?></li>
        </ul>
        <button type="submit" class="disabled">Sign Up</button>
    </form>
    <div>
        <span>Already a user?</span>
        <a href="<?php echo url_for("@signin?redirect_to=select_account") ?>" class="sign-in-link">Sign In</a>
    </div>
</div>

<script type="text/javascript">
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

    function validateForm(){
        var valid = true;
        var field_list = jQuery('ul.sign-up-field-list');
        jQuery('li input', field_list).each(function(){
            if(jQuery(this).val() == '' || (jQuery(this).hasClass('email') && !jQuery(this).val().match(email_pattern))){
                jQuery(this).addClass('invalid-field');
                valid = false;
            } else {
                jQuery(this).removeClass('invalid-field');
            }
        });
        return valid;
    }

    function submitForm(event) {
        if(jQuery(this).hasClass('disabled') || !validateForm()){
            event.preventDefault();
        }
    }

    jQuery(document).ready(function(){
        var field_list = jQuery('ul.sign-up-field-list');
        jQuery("li input", field_list).bind('keyup', changeFieldContent);
        jQuery("button[type='submit']").bind('click', submitForm);
    });
</script>
