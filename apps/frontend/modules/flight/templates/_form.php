<?php echo $form->renderGlobalErrors();?>
<?php echo $form->renderHiddenFields();?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<script src="/js/jquery.ui.timepicker.js"></script>
<ul class="flight-field-list">
    <li class="small-field"><?php include_partial("flight/field", array('field' => $form['airport_from'], 'class' => 'airport-from', 'placeholder' => 'From Airport ID', 'label' => false)); ?></li>
    <li class="small-field right"><?php include_partial("flight/field", array('field' => $form['airport_to'], 'class' => 'airport-to', 'placeholder' => 'To Airport ID', 'label' => false)); ?></li>
    <li class="small-field"><?php include_partial("flight/date_field", array('field' => $form['departure_date'], 'class' => 'date', 'placeholder' => 'Date', 'label' => false)); ?></li>
    <li class="small-field right"><?php include_partial("flight/time_field", array('field' => $form['departure_time'], 'class' => 'time', 'placeholder' => 'HH:MM', 'label' => false)); ?></li>
    <li><span class="bottom-border"></span></li>
    <li><h2>Flight Information</h2></li>
    <?php foreach($data['flight_information'] as $fi): ?>
        <li class="flight-information">
            <?php $key = Flight::generateKeyByTitle($fi['name']); ?>
            <?php if($key == 'pilot_in_command' || $key == 'second_in_command'): ?>
                <span class="dashboard-avatar">
                    <?php include_partial('flight/avatar', array('user' => $users[$form[$key]->getValue()])); ?>
                </span>
                <?php include_partial("flight/field", array('field' => $form[$key], 'class' => 'pilot', 'label' => true)); ?>
            <?php elseif($key == 'trip_number'): ?>
                <?php include_partial("flight/field", array('field' => $form[$key], 'class' => 'trip-number', 'label' => true)); ?>
            <?php else: ?>
                <?php include_partial("flight/field", array('field' => $form[$key], 'label' => true)); ?>
            <?php endif ?>
        </li>
    <?php endforeach ?>
    <li><span class="bottom-border"></span></li>
    <li><h2>Risk Analysis</h2></li>
    <?php for($i = 0; $i<count($data['risk_analysis']); $i++): ?>
        <li>
            <?php include_partial("flight/risk_field", array(
                'field' => $form["flight_risk_factor_{$i}"],
                'label' => true,
                'class' => 'risk-factor',
                'help' => $data['risk_analysis'][$i]['help_message'],
                'risk' => $data['risk_analysis'][$i]['response_options'][$form["flight_risk_factor_{$i}"]->getValue()]['value'],
                'note' => $data['risk_analysis'][$i]['response_options'][$form["flight_risk_factor_{$i}"]->getValue()]['note']
            ));
            ?>
            <div class="list-select">
                <div class="result">Select value</div>
                <ul>
                    <li>Value 1</li>
                    <li>Value 2</li>
                    <li>Value 3</li>
                    <li>Value 4</li>
                </ul>
            </div>
        </li>
    <?php endfor ?>
</ul>

<script type="text/javascript">
    jQuery('.bottom-border').parent().prev().addClass('last');
    function getRisk(){
        var root_li = jQuery(this).closest('li');
        jQuery.ajax({
            url: '<?php echo url_for("@get_risk") ?>',
            data: {id: jQuery(this).val()},
            dataType: 'json',
            type: 'GET',
            success: function(data){
                if(data.result == "OK"){
                    var risk_el = jQuery("span.risk", root_li);
                    var note_el = jQuery("span.note", root_li);
                    if(data.risk){
                        risk_el.text(data.risk);
                        risk_el.removeClass('hidden');
                    } else {
                        risk_el.addClass('hidden');
                    }
                    if(data.note){
                        note_el.text(data.note);
                        note_el.removeClass('hidden');
                    } else {
                        note_el.addClass('hidden');
                    }
                    if(data.risk == 0) {
                        risk_el.addClass('hidden');
                    };
                }

            }
        });
    }

    function getPilot(){
        var root_li = jQuery(this).closest('li');
        jQuery.ajax({
            url: '<?php echo url_for("@get_pilot") ?>',
            data: {id: jQuery(this).val()},
            dataType: 'json',
            type: 'GET',
            success: function(data){
                if(data.result == "OK"){
                    var avatar_el = jQuery("span.dashboard-avatar", root_li);
                    avatar_el.html(data.user_data);
                }

            }
        });
    }

    function showHelp(event){
        event.preventDefault();
        var root_el = jQuery(this).closest('div.risk-factor-question-wrapper');
        var help = jQuery("p.help-message", root_el);
        if(help.hasClass('hidden')){
            help.removeClass('hidden');
        } else {
            help.addClass('hidden');
        }
    }


    jQuery(document).ready(function(){
        jQuery("select.risk-factor").bind('change', getRisk);
        jQuery("select.pilot").bind('change', getPilot);
        jQuery("a.show-help-link").bind('click', showHelp);
        jQuery("input.date").prop('readonly', true).datepicker({
            dateFormat: 'yy-mm-dd'
        });
        jQuery("input.time").prop('readonly', true).timepicker({
            hourGrid: 4,
            minuteGrid: 10,
            timeFormat: 'HH:mm'
        });
        //jQuery("select.risk-factor").trigger('change');
    });


    jQuery('.list-select .result').bind('click', function(){
        jQuery(this).parent().find('ul').show();
    });
    jQuery('.list-select ul li').click(function(){
        jQuery(this).parent().parent().find('.result').html(jQuery(this).text());
        jQuery(this).parent().hide().hide();
    });
    jQuery('.list-select ul').mouseleave(function() {
        jQuery(this).hide();
    });


</script>