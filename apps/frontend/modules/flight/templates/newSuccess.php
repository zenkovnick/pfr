<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

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
            var trip_number = jQuery('input.trip-number', this);

            if(airport_from.val() == '') {
                valid = false;
                airport_from.addClass('invalid-field');
            } else {
                airport_from.removeClass('invalid-field');
            }

            if(airport_to.val() == ''){
                valid = false;
                airport_to.addClass('invalid-field');
            } else {
                airport_to.removeClass('invalid-field');
            }

            if(trip_number.val() == ''){
                valid = false;
                trip_number.addClass('invalid-field');
            } else {
                trip_number.removeClass('invalid-field');
            }
            if(valid){
                jQuery('.invalid-field', this).removeClass('invalid-field');
                return true;
            } else {
                event.preventDefault();
            }
        }
    }

    jQuery(document).ready(function(){
        jQuery("#flight_form").bind('submit', validateAndSubmitFlight);
        jQuery("button.finish-later").bind('click', submitFinishLater);
    });
</script>