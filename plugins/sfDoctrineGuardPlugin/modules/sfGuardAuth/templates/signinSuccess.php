<div class="wrap blog-page">
    <?php use_helper('I18N') ?>
    
    <span class="login-logo"></span>
    <h1>Войти на сайт</h1>
    
    <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>

    <h2>Войти используя соц. сети</h2>
    <div class="login-media">
        <ul>
            <?php if (isset($twitterLoginUrl)): ?>
            <li><a class="media-tw" href="<?php echo $twitterLoginUrl?>" id="twitter-connect"></a></li>
            <?php endif; ?>

            <li><a class="media-vk" href="#" onclick="vkauth();"></a></li>

            <?php /*<li><a href="<?php echo url_for("@auth_vk"); ?>">Auth via Vkontakte</a></li> */ ?>
            <?php if (isset($facebookLoginUrl)): ?>
            <li><a class="media-fb" href="<?php echo $facebookLoginUrl?>" id="facebook-connect"></a></li>
            <?php endif; ?>

        </ul>
    </div>

</div>

<script type="text/javascript">
    jQuery(".media-tw").click(function(event){
        event.preventDefault();
        jQuery.ajax({
            url: "<?php echo url_for('@auth') ?>",
            type: "POST",
            dataType: 'json',
            success: function(data){
                if(data.session == 'auth'){
                    window.location.href = jQuery(".media-tw").attr("href");
                }
            }
        });
    })
</script>

