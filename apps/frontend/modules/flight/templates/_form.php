<?php echo $form->renderGlobalErrors();?>
<?php echo $form->renderHiddenFields();?>
<ul class="flight-field-list">
    <li><?php include_partial("flight/field", array('field' => $form['airport_from'], 'label' => true)); ?></li>
    <li><?php include_partial("flight/field", array('field' => $form['airport_to'], 'label' => true)); ?></li>
    <li><?php include_partial("flight/field", array('field' => $form['departure_date'], 'label' => true)); ?></li>
    <li><?php include_partial("flight/field", array('field' => $form['departure_time'], 'label' => true)); ?></li>
    <?php foreach($data['flight_information'] as $fi): ?>
        <li>
            <?php $key = Flight::generateKeyByTitle($fi['name']); ?>
            <?php if($key == 'pilot_in_command' || $key == 'second_in_command'): ?>
                <?php include_partial("flight/field", array('field' => $form[$key], 'class' => 'pilot', 'label' => true)); ?>
                <span class="dashboard-avatar">
                    <?php include_partial('flight/avatar', array('user' => $users[$form[$key]->getValue()])); ?>
                </span>
            <?php else: ?>
                <?php include_partial("flight/field", array('field' => $form[$key], 'label' => true)); ?>
            <?php endif ?>
        </li>
    <?php endforeach ?>
    <?php for($i = 0; $i<count($data['risk_analysis']); $i++): ?>
        <li><?php include_partial("flight/field", array(
                'field' => $form["flight_risk_factor_{$i}"],
                'label' => true,
                'class' => 'risk-factor'
            ));
            ?>
            <?php $risk = $data['risk_analysis'][$i]['response_options'][$form["flight_risk_factor_{$i}"]->getValue()]['value'] ?>
            <span class="risk">
                <?php echo $risk > 0 ? $risk : '' ?>
            </span>
            <span class="note">
                <?php echo $risk > 0 ? $data['risk_analysis'][$i]['response_options'][$form["flight_risk_factor_{$i}"]->getValue()]['note'] : ''?>
            </span>
        </li>
    <?php endfor ?>
</ul>

<script type="text/javascript">

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


    jQuery(document).ready(function(){
        jQuery("select.risk-factor").bind('change', getRisk);
        jQuery("select.pilot").bind('change', getPilot);
        //jQuery("select.risk-factor").trigger('change');
    });
</script>