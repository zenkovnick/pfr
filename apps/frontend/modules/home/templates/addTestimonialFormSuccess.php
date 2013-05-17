<div class="popup testimonial-form">
    <a href="#" class="close-popup" onclick="jQuery.fancybox.close(); return false"></a>
    <h1>Add Your Testimonial in Support of TheSolution</h1>
    <form id="testimonial_form" name="<?php echo($form->getName()) ?>" method="post" enctype="multipart/form-data" action="<?php echo url_for("@add_testimonial") ?>" >
        <?php include_partial('home/testimonialForm', array('form' => $form)) ?>
        <button type="submit" class="btn btn-violet">Submit</button>
    </form>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.fake-select .textfield').each(function() {
            jQuery(this).text( jQuery(this).parent().find('select option:selected').clone().children().remove().end().text()  );
        });
        jQuery('.fake-select select').change(function(){
            jQuery(this).parent().find('.textfield').text( jQuery(this).find('option:selected').clone().children().remove().end().text() );
        });

    });
</script>