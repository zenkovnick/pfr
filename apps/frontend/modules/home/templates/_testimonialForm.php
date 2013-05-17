<!--[if IE 9]>
    <script type="text/javascript" src="/js/jquery.fileupload-ie9.js"></script>
<![endif]-->


<fieldset>

    <?php echo($form->renderHiddenFields()) ?>
    <?php echo($form->renderGlobalErrors()) ?>

    <ul>
        <li class="input-block"><?php include_partial('home/field', array('field' => $form['testimonial_text'], 'placeholder' => 'Your Testimonial', 'label' => false)) ?></li>
        <li class="input-block"><?php include_partial('home/field', array('field' => $form['name'], 'placeholder' => 'Your Name', 'label' => false)) ?></li>
        <li class="input-block">
            <div class="fake-select">
                <div class="textfield"></div>
                <?php include_partial('home/field', array('field' => $form['political_view'], 'placeholder' => 'Select Your Political View', 'label' => false)) ?>
            </div>
        </li>
        <li class="input-block"><?php include_partial('home/field', array('field' => $form['city_state'], 'placeholder' => 'City/State', 'label' => false)) ?></li>
    <ul>

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