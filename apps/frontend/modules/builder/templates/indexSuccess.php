<?php include_partial("home/error"); ?>
<?php include_partial('home/notice'); ?>
<?php include_partial('home/success'); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<h1>Form editor</h1>
<div class="form-builder-wrapper">
    <div>
        <form id="<?php echo $risk_builder->getId(); ?>" method="post" class="main-form">
            <?php echo $form->renderGlobalErrors();?>
            <?php echo $form->renderHiddenFields();?>
            <ul class="form-fields">
                <li><?php include_partial("builder/field", array('field' => $form['form_name'], 'class' => 'first-field')); ?></li>
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

    <div class="flight-information-wrapper">
        <h2>Flight information</h2>
        <ul class="flight-information-list" id="flight-information-container" style="height: 600px">
            <?php foreach($flight_information as $flight_information_field):?>
                <li class="<?php echo $flight_information_field->getIsHide() ? 'hidden-field' : "" ?>">
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
        <ul class="risk-factor-list" id="risk-factor-container">
            <?php foreach($risk_factors as $risk_factor): ?>
                <li class="risk-factor-entity" id="rf_<?php echo $risk_factor->getId() ?>">
                    <span class="handler">Handler</span>
                    <input type="hidden" value="<?php echo $risk_factor->getId() ?>" />
                    <div class="entry-header">
                        <span class="question"><?php echo $risk_factor->getQuestion() ?></span>
                        <a href="" class="edit-risk-factor-link hidden">Edit</a>
                        <a href="" class="cancel-risk-factor-link hidden">Cancel</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="" id="add-risk-factor-link">+ Add Risk Factor</a>
    </div>

</div>

<script type="text/javascript">
    jQuery("div.field-wrapper").hide();
    var new_risk_factor_count = 0;
    var new_response_option_count = 0;

    function addNewRiskFactorField(num){
        return jQuery.ajax({
            type: 'POST',
            data: {risk_factor_num: num, form_id: jQuery("form.main-form").attr("id")},
            url: '<?php echo url_for("@add_new_risk_factor_field"); ?>',
            async: false
        }).responseText;
    }

    function addNewResponseOptionField(num, type){
        return jQuery.ajax({
            type: 'POST',
            data: {num: num, type: type},
            url: '<?php echo url_for("@add_new_response_option_field"); ?>',
            async: false
        }).responseText;
    }

    function addNewResponseOptionForm(event) {
        event.preventDefault();
        var el = jQuery(addNewResponseOptionField(new_response_option_count));
        //jQuery('.delete_education', el).bind('click', deleteEducation);
        jQuery(this).closest('li').find('ul.response-option-list').append(el);

        new_response_option_count++;
        /*jQuery("form :input").change(function(){
         form_changed = true;
         });
         jQuery("a", jQuery("#header")).bind('click', ask_saving);
         jQuery("a", jQuery(".user-general-menu")).bind('click', ask_saving);
         jQuery("a", jQuery(".user-profile-nav-buttons")).bind('click', ask_saving);
         jQuery("a", jQuery("#footer")).bind('click', ask_saving);*/

    }

    function editRiskFactor(event){
        event.preventDefault();
        var root_el = jQuery(this).closest('li.risk-factor-entity');
        jQuery(this).addClass('hidden');
        root_el.find('a.cancel-risk-factor-link').removeClass('hidden');
        var risk_factor_id= root_el.find('input[type="hidden"]').val();
        var form_el = jQuery(jQuery.ajax({
            type: 'GET',
            data: {risk_factor_id: risk_factor_id, form_id: jQuery("form.main-form").attr("id")},
            url: '<?php echo url_for("@edit_risk_factor_field"); ?>',
            async: false
        }).responseText);
        jQuery('a.add-new-response-link', form_el).bind('click', addNewResponseOptionForm);
        root_el.append(form_el);

    }

    function cancelRiskFactorEdit(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li.risk-factor-entity');
        jQuery(this).addClass('hidden');
        root_li.find("div.risk-factor-wrapper").remove();
    }

    function cancelRiskFactorAdd(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li.new');
        root_li.remove();
    }

    function addRiskFactorSubmitted(data){
        if(data.result == "OK"){
            var root_li = jQuery('li#new_'+data.new_form_num);
            jQuery("div.risk-factor-wrapper", root_li).remove();
            jQuery("span.question", root_li).text(data.question);
            jQuery("div.entry-header", root_li).removeClass('hidden');
            jQuery("span.handler", root_li).removeClass('hidden');
            jQuery("input[type='hidden']", root_li).val(data.risk_id);
            root_li.bind('mouseover', showRiskFactorEditLink).bind('mouseout', hideRiskFactorEditLink);
            root_li.attr('id', 'rf_'+data.risk_id);
            root_li.removeClass('new').addClass('risk-factor-entity');
            jQuery("a.edit-risk-factor-link", root_li).bind('click', editRiskFactor);
            jQuery("a.cancel-risk-factor-link", root_li).bind('click', cancelRiskFactorEdit);
            jQuery('a.cancel-risk-factor-add', root_li).remove();
            jQuery( "#risk-factor-container").sortable({
                containment: "parent",
                axis: "y",
                handle: "span.handler",
                stop: saveRiskFactorPosition
            });
        }
    }

    function editRiskFactorSubmitted(data){
        if(data.result == "OK"){
            var root_li = jQuery('li#rf_'+data.risk_id);
            //alert(root_li.html());
            jQuery("div.risk-factor-wrapper", root_li).remove();
            jQuery("a.cancel-risk-factor-link", root_li).addClass('hidden');
        }
    }

    function showRiskFactorEditLink(){
        if(jQuery(this).find('a.cancel-risk-factor-link').hasClass('hidden')){
            jQuery(this).find('a.edit-risk-factor-link').removeClass('hidden');
        }
    }

    function hideRiskFactorEditLink(){
        if(jQuery(this).find('a.cancel-risk-factor-link').hasClass('hidden')){
            jQuery(this).find('a.edit-risk-factor-link').addClass('hidden');
        }
    }

    function saveRiskFactorPosition(){
        var positions = new Array();
        jQuery("#risk-factor-container li").each(function(){
            positions.push(jQuery(this).find("input[type='hidden']").val());
        });
        var json_obj =  JSON.stringify(positions);
<!--        jQuery.ajax({-->
<!--            url: '--><?php //echo url_for("@save_flight_info_position") ?><!--',-->
<!--            type: 'POST',-->
<!--            data: {ids: json_obj, form_id: jQuery('form.main-form').attr('id')},-->
<!--            success: function() {-->
<!---->
<!--            }-->
<!--        })        -->
    }


    jQuery(document).ready(function() {
        var form_id = jQuery('form.main-form').attr('id');
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
                    data: {ids: json_obj, form_id: jQuery('form.main-form').attr('id')},
                    success: function() {

                    }
                })
            }
        });

        jQuery( "#risk-factor-container").sortable({
            containment: "parent",
            axis: "y",
            handle: "span.handler",
            stop: saveRiskFactorPosition
        });


        jQuery("#flight-information-container ul, #flight-information-container li" ).disableSelection();

        jQuery("li.risk-factor-entity").bind('mouseover', showRiskFactorEditLink).bind('mouseout', hideRiskFactorEditLink);
        jQuery("a.edit-risk-factor-link").bind('click', editRiskFactor);
        jQuery("a.cancel-risk-factor-link").bind('click', cancelRiskFactorEdit);

        jQuery('#add-risk-factor-link').click(function(event){
            event.preventDefault();
            var el = jQuery(addNewRiskFactorField(new_risk_factor_count));
            jQuery('a.add-new-response-link', el).bind('click', addNewResponseOptionForm);
            jQuery('a.cancel-risk-factor-add', el).bind('click', cancelRiskFactorAdd);
            /*alert(jQuery("#risk_factor_form_"+new_risk_factor_count, el).html());
            jQuery("#risk_factor_form_"+new_risk_factor_count, el).ajaxForm(options_submit);*/
            new_risk_factor_count++;

            jQuery('ul.risk-factor-list').append(el);

            var response_el = jQuery(addNewResponseOptionField(new_response_option_count, 'default_no'));
            el.find('ul.response-option-list').append(response_el);
            new_response_option_count++;

            var response_el = jQuery(addNewResponseOptionField(new_response_option_count, 'default_yes'));
            el.find('ul.response-option-list').append(response_el);
            new_response_option_count++;


            /*jQuery("form :input").change(function(){
                form_changed = true;
            });
            jQuery("a", jQuery("#header")).bind('click', ask_saving);
            jQuery("a", jQuery(".user-general-menu")).bind('click', ask_saving);
            jQuery("a", jQuery(".user-profile-nav-buttons")).bind('click', ask_saving);
            jQuery("a", jQuery("#footer")).bind('click', ask_saving);*/
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
            root_li.find('div.field-wrapper').hide(500);
            var type = root_li.attr('id');
            jQuery.ajax({
                url: '<?php echo url_for("@cancel_mitigation_section") ?>',
                type: 'POST',
                dataType: 'json',
                data: {form_id: form_id},
                success: function(data) {
                    switch(type){
                        case 'low':
                            jQuery("#risk_builder_mitigation_low_message").val(data.mitigation_low_message);
                            jQuery("#risk_builder_mitigation_low_instructions").val(data.mitigation_low_instructions);
                            jQuery("#risk_builder_mitigation_low_notify").prop('checked', data.mitigation_low_notify);
                            disableLowNotifyCheckbox(jQuery("#risk_builder_mitigation_low_notify"));
                            break;
                        case 'medium':
                            jQuery("#risk_builder_mitigation_medium_message").val(data.mitigation_medium_message);
                            jQuery("#risk_builder_mitigation_medium_instructions").val(data.mitigation_medium_instructions);
                            jQuery("#risk_builder_mitigation_medium_notify").prop('checked', data.mitigation_medium_notify);
                            jQuery("#risk_builder_mitigation_medium_require_details").prop('checked', data.mitigation_medium_require_details);
                            disableMediumNotifyCheckbox(jQuery("#risk_builder_mitigation_medium_notify"));
                            break;
                        case 'high':
                            jQuery("#risk_builder_mitigation_high_message").val(data.mitigation_high_message);
                            jQuery("#risk_builder_mitigation_high_instructions").val(data.mitigation_high_message);
                            jQuery("#risk_builder_mitigation_high_notify").prop('checked', data.mitigation_high_notify);
                            jQuery("#risk_builder_mitigation_high_prevent_flight").prop('checked', data.mitigation_high_prevent_flight);
                            break;

                    }

                }
            });

        });




        jQuery("#risk_builder_mitigation_low_notify").click(function(){
            disableLowNotifyCheckbox(jQuery(this));
        });

        jQuery("#risk_builder_mitigation_medium_notify").click(function(){
            disableMediumNotifyCheckbox(jQuery(this));
        });




        jQuery("button.mitigation-save").click(function(event){
            event.preventDefault();
            var root_li = jQuery(this).closest('li');
            var type = root_li.attr('id');
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
                        root_li.find('div.field-wrapper').hide(500);
                        root_li.find('a.cancel').addClass('hidden');
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


        function disableLowNotifyCheckbox(notify_el) {
            if(notify_el.is(':checked')){
                jQuery("#risk_builder_mitigation_medium_notify, #risk_builder_mitigation_high_notify").attr('disabled', 'disabled');
            } else {
                if(jQuery('#risk_builder_mitigation_medium_notify').is(':checked')){
                    jQuery("#risk_builder_mitigation_medium_notify").removeAttr('disabled');
                } else {
                    jQuery("#risk_builder_mitigation_medium_notify, #risk_builder_mitigation_high_notify").removeAttr('disabled');
                }
            }
        }

        function disableMediumNotifyCheckbox(notify_el){
            if(notify_el.is(':checked')){
                jQuery("#risk_builder_mitigation_high_notify").attr('disabled', 'disabled');
            } else {
                jQuery("#risk_builder_mitigation_high_notify").removeAttr('disabled');
            }
        }


    });
</script>