<?php include_partial("home/error"); ?>
<?php include_partial('home/notice'); ?>
<?php include_partial('home/success'); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<div class="form-builder-wrapper">
    <div>
        <form id="<?php echo $risk_builder->getId(); ?>" method="post" id="main_form">
            <?php echo $form->renderGlobalErrors();?>
            <?php echo $form->renderHiddenFields();?>
            <ul class="form-fields">
                <li><?php include_partial("builder/field", array('field' => $form['form_name'])); ?></li>
                <li><?php include_partial("builder/field", array('field' => $form['form_instructions'])); ?></li>
            </ul>
            <ul class="mitigation-fields">
                <div id="slider-range"></div>
                <li id="low" class="low-risk">
                    <div class="mitigation-header">
                        <span class="risk-value"><?php echo $risk_builder->getMitigationLowMin() ?> - <?php echo $risk_builder->getMitigationLowMax() ?></span>
                        <span class="risk-title">Low Risk</span>
                        <a href="" class="edit hidden">Edit</a>
                        <a href="" class="cancel hidden">Cancel</a>
                    </div>
                    <div class="field-wrapper">
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_low_message'])); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_low_instructions'])); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_low_notify'])); ?></div>
                        <button class="mitigation-save">Save</button>
                    </div>
                </li>

                <li id="medium" class="medium-risk">
                    <div class="mitigation-header">
                        <span class="risk-value"><?php echo $risk_builder->getMitigationMediumMin() ?> - <?php echo $risk_builder->getMitigationMediumMax() ?></span>
                        <span class="risk-title">Medium Risk</span>
                        <a href="" class="edit hidden">Edit</a>
                        <a href="" class="cancel hidden">Cancel</a>
                    </div>
                    <div class="field-wrapper">
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_medium_message'])); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_medium_instructions'])); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_medium_require_details'])); ?></div>
                        <div><?php include_partial("builder/field",
                                array('field' => $form['mitigation_medium_notify'], 'disabled'=>$risk_builder->getMitigationLowNotify())); ?></div>
                        <button class="mitigation-save">Save</button>
                    </div>
                </li>

                <li id="high" class="high-risk">
                    <div class="mitigation-header">
                        <span class="risk-value"><?php echo $risk_builder->getMitigationHighMin() ?>+</span>
                        <span class="risk-title">High Risk</span>
                        <a href="" class="edit hidden">Edit</a>
                        <a href="" class="cancel hidden">Cancel</a>
                    </div>
                    <div class="field-wrapper">
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_high_message'])); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_high_instructions'])); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_high_prevent_flight'])); ?></div>
                        <div><?php include_partial("builder/field",
                                array('field' => $form['mitigation_high_notify'], 'disabled'=> ($risk_builder->getMitigationLowNotify() || $risk_builder->getMitigationMediumNotify()))); ?></div>
                        <button class="mitigation-save">Save</button>
                    </div>
                </li>
            </ul>
            <button type="submit">Save and Exit</button>
        </form>
    </div>

    <div class="flight-information-wrapper" style="width: 320px;margin: 0 auto; height: 400px">
        <ul class="flight-information-list" id="flight-information-container" style="height: 600px">
            <?php foreach($flight_information as $flight_information_field):?>
                <li class="<?php echo $flight_information_field->getIsHide() ? 'hidden-field' : "" ?>" style="height: 50px;">
                    <input type="hidden" value="<?php echo $flight_information_field->getId(); ?>" ?>
                    <span class="handler" style="display:inline-block; height: 100%; cursor: pointer">Handler</span>
                    <span><?php echo $flight_information_field->getInformationName() ?></span>
                    <?php if($flight_information_field->getHiddable()): ?>
                        <span class="hiddable">
                        <?php echo $flight_information_field->getIsHide() ? 'Enable Field' : "Disable field" ?>
                    </span>
                    <?php endif ?>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
    <div class="risk-factor-wrapper">
        <ul class="risk-factor-list">
            <?php foreach($risk_factors as $risk_factor): ?>
                <li></li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

<script type="text/javascript">
    jQuery("div.field-wrapper").hide();
    jQuery(document).ready(function() {
        var form_id = jQuery('form').attr('id');
        jQuery( "#flight-information-container").sortable({
            containment: "parent",
            axis: "y",
            handle: "span.handler",
            stop: function() {
                var positions = new Array();
                jQuery("#flight-information-container li").each(function(){
                    positions.push(jQuery(this).find("input[type='hidden']").val());
                });
                var json_obj =  JSON.stringify(positions);
                jQuery.ajax({
                    url: '<?php echo url_for("@save_flight_info_position") ?>',
                    type: 'POST',
                    data: {ids: json_obj, form_id: jQuery('form').attr('id')},
                    success: function() {

                    }
                })
            }
        });

        jQuery("#flight-information-container ul, #flight-information-container li" ).disableSelection();

        jQuery("#risk_builder_mitigation_low_notify").click(function(){
           if(jQuery(this).is(':checked')){
               jQuery("#risk_builder_mitigation_medium_notify, #risk_builder_mitigation_high_notify").attr('disabled', 'disabled');
           } else {
               if(jQuery('#risk_builder_mitigation_medium_notify').is(':checked')){
                   jQuery("#risk_builder_mitigation_medium_notify").removeAttr('disabled');
               } else {
                   jQuery("#risk_builder_mitigation_medium_notify, #risk_builder_mitigation_high_notify").removeAttr('disabled');
               }
           }
        });
        jQuery("div.mitigation-header").mouseover(function(){
            if(jQuery(this).find('a.cancel').hasClass('hidden')){
               jQuery(this).find('a.edit').removeClass('hidden');
            }
        });
        jQuery("div.mitigation-header").mouseout(function(){
            if(jQuery(this).find('a.cancel').hasClass('hidden')){
                jQuery(this).find('a.edit').addClass('hidden');
            }
        });

        jQuery('a.edit').click(function(event){
            event.preventDefault();
            jQuery(this).addClass('hidden');
            var root_li = jQuery(this).closest('li');
            root_li.find('a.cancel').removeClass('hidden');
            root_li.find('div.field-wrapper').show(500);
        });

        jQuery("a.cancel").click(function(event){
            event.preventDefault();
            jQuery(this).addClass('hidden');
            var root_li = jQuery(this).closest('li');
            var type = root_li.attr('id');
            root_li.find('div.field-wrapper').hide(500);
            jQuery.ajax({
                url: '<?php echo url_for("@cancel_mitigation_section") ?>',
                type: 'POST',
                data: {type: type},
                success: function() {
                }
            });

        });

        jQuery("#risk_builder_mitigation_medium_notify").click(function(){
            if(jQuery(this).is(':checked')){
                jQuery("#risk_builder_mitigation_high_notify").attr('disabled', 'disabled');
            } else {
                jQuery("#risk_builder_mitigation_high_notify").removeAttr('disabled');
            }
        });

        jQuery("button.mitigation-save").click(function(event){
            event.preventDefault();
            var type = jQuery(this).parent().attr('id');
            var data = null;
            switch(type){
                case 'low':
                    data = {
                        form_id: form_id,
                        type: type,
                        message: jQuery("#risk_builder_mitigation_low_message").val(),
                        instructions: jQuery("#risk_builder_mitigation_low_instructions").val(),
                        notify: jQuery("#risk_builder_mitigation_low_notify").is(':checked') ? 1 : 0
                    };
                    break;
                case 'medium':
                    data = {
                        form_id: form_id,
                        type: type,
                        message: jQuery("#risk_builder_mitigation_medium_message").val(),
                        instructions: jQuery("#risk_builder_mitigation_medium_instructions").val(),
                        notify: jQuery("#risk_builder_mitigation_medium_notify").is(':checked') ? 1 : 0,
                        require: jQuery("#risk_builder_mitigation_medium_require_details").is(':checked') ? 1 : 0
                    };
                    break;
                case 'high':
                    data = {
                        form_id: form_id,
                        type: type,
                        message: jQuery("#risk_builder_mitigation_high_message").val(),
                        instructions: jQuery("#risk_builder_mitigation_high_instructions").val(),
                        notify: jQuery("#risk_builder_mitigation_high_notify").is(':checked') ? 1 : 0,
                        prevent: jQuery("#risk_builder_mitigation_high_prevent_flight").is(':checked') ? 1 : 0
                    };
                    break;

            }
            if(data){
                jQuery.ajax({
                    url: '<?php echo url_for("@save_mitigation_section") ?>',
                    type: 'POST',
                    data: data,
                    success: function() {
                    }
                });
            }

        });
        jQuery("span.hiddable").click(function(){
            var el = jQuery(this);
            var field_id = el.parent('li').find("input[type='hidden']").val();
            var field_hidding = !(el.parent().hasClass('hidden-field'));
            jQuery.ajax({
                url: '<?php echo url_for("@save_form_field_hidding") ?>',
                type: 'POST',
                data: {id: field_id, hidding: field_hidding, form_id: form_id},
                success: function() {
                    if(el.parent().hasClass('hidden-field')) {
                        el.parent().removeClass('hidden-field');
                        el.text("Disable Field");
                    } else {
                        el.parent().addClass('hidden-field');
                        el.text("Enable Field");
                    }

                }
            });
        });

        jQuery( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 49,
            values: [<?php echo $risk_builder->getMitigationLowMax() ?>, <?php echo $risk_builder->getMitigationMediumMax() ?> ],
            slide: function( event, ui ) {
                if(ui.values[ 0 ] == ui.values[ 1 ]){
                    return false;
                } else {
                    if(ui.values[ 0 ] == 0) {
                        jQuery( "li.low-risk span.risk-value" ).text("0");
                    } else {
                        jQuery( "li.low-risk span.risk-value" ).text("0 - " + (ui.values[ 0 ]));
                    }
                    if((ui.values[ 0 ] + 1) == ui.values[ 1 ]) {
                        jQuery( "li.medium-risk span.risk-value" ).text((ui.values[ 1 ]));
                    } else {
                        jQuery( "li.medium-risk span.risk-value" ).text((ui.values[ 0 ] + 1) + " - " + (ui.values[ 1 ]));
                    }
                    jQuery( "li.high-risk span.risk-value" ).text((ui.values[ 1 ] + 1) + "+");
                }
            },
            stop: function(event, ui) {
                jQuery.ajax({
                    url: '<?php echo url_for("@save_mitigation_range") ?>',
                    type: 'POST',
                    data: {low_max: ui.values[0], medium_max: ui.values[1], form_id: form_id },
                    success: function() {
                    }
                });
            }
        });
    });
</script>