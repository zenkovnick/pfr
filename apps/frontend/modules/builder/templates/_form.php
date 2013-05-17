<!--[if IE 9]>
    <script type="text/javascript" src="/js/jquery.fileupload-ie9.js"></script>
<![endif]-->


<fieldset>

    <?php echo($form->renderHiddenFields()) ?>
    <?php echo($form->renderGlobalErrors()) ?>

    <ul>
        <li class="input-block"><?php include_partial('home/field', array('field' => $form['username'], 'placeholder' => 'Your Email Address', 'label' => false)) ?></li>
    </ul>

</fieldset>
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
<script type="text/javascript">
    $('[placeholder]').parents('form').submit(function() {
        $(this).find('[placeholder]').each(function() {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
            }
        })
    });

</script>