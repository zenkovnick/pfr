<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<script src="/js/jquery.ui.timepicker.js"></script>
<script src="/js/iscroll.js"></script>

<div class="flight">
    <form action="<?php echo url_for("@create_flight?account_id={$account->getId()}") ?>" id="flight_form" method="POST">
        <?php include_partial('flight/form', array('form' => $form, 'data' => $data_fields, 'users' => $users)); ?>
        <button type="submit" class="btn btn-green">Calculate Risk</button>
        <button class="finish-later btn btn-grey">Finish Later</button>
    </form>
</div>
<script type="text/javascript">
    function submitFinishLater(event) {
        event.preventDefault();
        var form = jQuery("form");
        form.addClass('drafted');
        form.prop('action', form.prop('action') + "?drafted=true").submit();
    }
    function validateAndSubmitFlight(event){
        if(jQuery(this).hasClass('drafted')){
            return true;
        } else {
            var valid = true;
            var airport_from = jQuery('input.airport-from', this);
            var airport_to = jQuery('input.airport-to', this);
            var airport_from_id = jQuery('#flight_airport_from_id');
            var airport_to_id = jQuery('#flight_airport_to_id');
            var trip_number = jQuery('input.trip-number', this);
            var pic_input = jQuery('.pic-field input[type="hidden"]');
            var sic_input = jQuery('.sic-field input[type="hidden"]');
            var sic_input_custom = jQuery('#flight_second_in_command_custom');
            var pic_label = jQuery('.pic-field .pilot');
            var sic_label = jQuery('.sic-field .pilot');
            var plane = jQuery('#flight_plane', this);
            var plane_label = jQuery('.plane-select .plane', this);
            var pic_wrapper = jQuery("#pic_field");
            var sic_wrapper = jQuery("#sic_field");
            var plane_wrapper = jQuery("#plane_field");
            var anchor = null;

            if(airport_from.val() == '' || airport_from.val().length > 4 || airport_from.val().length < 4){
                valid = false;
                airport_from.addClass('invalid-field');
                if(!anchor){
                    anchor = airport_from.prop('id');
                }
            } else {
                airport_from.removeClass('invalid-field');
            }


            if(airport_to.val() == '' || airport_to.val().length > 4 || airport_to.val().length < 4){
                valid = false;
                airport_to.addClass('invalid-field');
                if(!anchor){
                    anchor = airport_to.prop('id');
                }
            } else {
                airport_to.removeClass('invalid-field');
            }

            if( airport_from.val() ==  airport_to.val()){
                valid = false;
                airport_from.addClass('invalid-field');
                airport_to.addClass('invalid-field');
                if(!anchor){
                    anchor = airport_from.prop('id');
                }

            } else {
                if(valid){
                    airport_from.removeClass('invalid-field');
                    airport_to.removeClass('invalid-field');
                }
            }

            if(pic_input.val() == sic_input.val()){
                valid = false;
                pic_label.addClass('invalid-select');
                sic_label.addClass('invalid-select');
                if(!anchor){
                    anchor = pic_wrapper.prop('id');
                }

            } else {
                pic_label.removeClass('invalid-select');
                sic_label.removeClass('invalid-select');
            }

            if(sic_input.val() == 0 && sic_input_custom.val() == ''){
                valid = false;
                sic_input_custom.addClass('invalid-field');
                if(!anchor){
                    anchor = sic_input_custom.prop('id');
                }
            } else {
                sic_input_custom.removeClass('invalid-field');
            }

            if(plane.val() == ""){
                valid = false;
                plane_label.addClass('invalid-select');
                if(!anchor){
                    anchor = plane_wrapper.prop('id');
                }
            } else {
                plane_label.removeClass('invalid-select');
            }

            if(trip_number.val() == ''){
                valid = false;
                trip_number.addClass('invalid-field');
                if(!anchor){
                    anchor = trip_number.prop('id');
                }
            } else {
                trip_number.removeClass('invalid-field');
            }
            if(valid){
                jQuery('.invalid-field', this).removeClass('invalid-field');
                jQuery('.invalid-select', this).removeClass('invalid-select');
                return true;
            } else {
                window.location.href = "#"+anchor;
                event.preventDefault();
            }
        }
    }

    jQuery(document).ready(function(){
        jQuery("#flight_form").bind('submit', validateAndSubmitFlight);
        jQuery("button.finish-later").bind('click', submitFinishLater);
    });
</script>