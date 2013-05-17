<?php use_helper('I18N') ?>
<script type="text/javascript">
    function vkauth(){
        /** Перенаправляем на страницу авторизации ВКонтакте */
        location.href = "https://oauth.vk.com/authorize?"+
                "client_id=<?php echo sfConfig::get('app_vk_id');?>&"+
                "redirect_uri=<?php echo sfConfig::get('app_vk_redirect_uri');?>&"+
                "response_type=code";

    }
</script>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <fieldset class="blog-login">
        <?php echo($form->renderHiddenFields()) ?>
        <?php echo($form->renderGlobalErrors()) ?>
        
        <ul>
            <li class="text">
                <?php //echo $form['username']->renderLabel(); ?>
                <?php echo $form['username']->render(); ?>
                <?php echo $form['username']->renderError(); ?>
            </li>

            <li class="text">
                <?php //echo $form['password']->renderLabel(); ?>
                <?php echo $form['password']->render(); ?>
                <?php echo $form['password']->renderError(); ?>
            </li>
            
            <li class="check">
                <div class="forgot-block">
                    <?php $routes = $sf_context->getRouting()->getRoutes() ?>
                    <a href="<?php echo url_for("@forgot_password") ?>">Забыли пароль?</a>
                </div>

                <?php echo $form['remember']->render(); ?>
                <?php echo $form['remember']->renderLabel(); ?>
                <?php echo $form['remember']->renderError(); ?>
            </li>
        </ul>
        <button class="btn-grey" type="submit">Signin</button>

        <?php if (isset($routes['sf_guard_register'])): ?>
            <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard') ?></a>
        <?php endif; ?>

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

