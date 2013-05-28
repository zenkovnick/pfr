<?php include_partial("home/error"); ?>
<?php include_partial('home/notice'); ?>
<?php include_partial('home/success'); ?>
<?php slot('title') ?>
    Select Account – Preflight Risk
<?php end_slot() ?>

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
                <ul class="scale">
                    <li id="li-5">5</li>
                    <li id="li-10">10</li>
                    <li id="li-15">15</li>
                    <li id="li-20">20</li>
                    <li id="li-25">25</li>
                    <li id="li-30">30</li>
                    <li id="li-35">35</li>
                    <li id="li-40">40</li>
                    <li id="li-45">45</li>
                    <li id="li-50">50+</li>
                </ul>
                <div id="slider-range"></div>
                <li id="low" class="low-risk">
                    <div class="mitigation-header">
                        <span class="risk-value"><?php echo $risk_builder->getMitigationLowMin() ?> - <?php echo $risk_builder->getMitigationLowMax() ?></span>
                        <span class="risk-title">Low Risk</span>
                        <a href="" class="mitigation-edit hidden">Edit</a>
                        <a href="" class="mitigation-cancel hidden">Cancel</a>
                    </div>
                    <div class="field-wrapper">
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_low_message'], 'class' => 'mitigation-message')); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_low_instructions'], 'class' => 'mitigation-instructions')); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_low_notify'])); ?></div>
                        <button class="mitigation-save">Save</button>
                    </div>
                </li>

                <li id="medium" class="medium-risk">
                    <div class="mitigation-header">
                        <span class="risk-value"><?php echo $risk_builder->getMitigationMediumMin() ?> - <?php echo $risk_builder->getMitigationMediumMax() ?></span>
                        <span class="risk-title">Medium Risk</span>
                        <a href="" class="mitigation-edit hidden">Edit</a>
                        <a href="" class="mitigation-cancel hidden">Cancel</a>
                    </div>
                    <div class="field-wrapper">
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_medium_message'], 'class' => 'mitigation-message')); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_medium_instructions'], 'class' => 'mitigation-instructions')); ?></div>
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
                        <a href="" class="mitigation-edit hidden">Edit</a>
                        <a href="" class="mitigation-cancel hidden">Cancel</a>
                    </div>
                    <div class="field-wrapper">
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_high_message'], 'class' => 'mitigation-message')); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_high_instructions'], 'class' => 'mitigation-instructions')); ?></div>
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
        <ul class="flight-information-list" id="flight-information-container">
            <?php foreach($flight_information as $flight_information_field):?>
                <li class="<?php echo $flight_information_field->getIsHide() ? 'hidden-field' : "" ?>">
                    <input type="hidden" value="<?php echo $flight_information_field->getId(); ?>" ?>
                    <span class="handler hidden">Handler</span>
                    <span><?php echo $flight_information_field->getInformationName() ?></span>
                    <?php if($flight_information_field->getHiddable()): ?>
                        <span class="hiddable hidden">
                            <a href="" class="show-hide-field"><?php echo $flight_information_field->getIsHide() ? 'Enable Field' : "Disable field" ?></a>
                        </span>
                    <?php else: ?>
                        <span class="uneditable hidden">Uneditable</span>
                    <?php endif ?>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
    <div class="risk-factor-global-wrapper">
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

    function flightInformationOver(){
        jQuery('span.uneditable, span.hiddable', this).removeClass('hidden');
        jQuery('span.handler', this).removeClass('hidden');
    }
    function colorScale(lower, higher) {
        var green = Math.floor(lower/5),
            red   = Math.ceil(higher/5);
        jQuery('ul.scale li').removeClass();
        jQuery('ul.scale li:nth-child('+green+')').prevAll().addClass('green');
        jQuery('ul.scale li:nth-child('+green+')').addClass('green');
        jQuery('ul.scale li:nth-child('+red+')').nextAll().addClass('red');
        jQuery('ul.scale li:nth-child('+red+')').addClass('red');
    }

    function flightInformationOut(){
        jQuery('span.uneditable, span.hiddable', this).addClass('hidden');
        jQuery('span.handler', this).addClass('hidden');
    }


    function showHideField(event){
        event.preventDefault();
        var link = jQuery(this);
        var root_li = link.closest('li');
        var field_id = jQuery("input[type='hidden']", root_li).val();
        jQuery.ajax({
            url: '<?php echo url_for('@show_hide_field'); ?>',
            data: {id: field_id},
            dataType: 'json',
            type: 'POST',
            success: function(data){
                if(data.result == "OK"){
                    link.text(data.is_hide ? 'Enable Field' : "Disable field");
                    if (data.is_hide) {
                        link.parent().parent().removeClass('solid');
                    } else {
                        link.parent().parent().addClass('solid');
                    }
                }
            }
        });
    }

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
        var root_li = jQuery(this).closest('li');
        jQuery('ul.response-option-list', root_li).append(el);
        el.bind('mouseover', showDeleteResponseOption).bind('mouseout', hideDeleteResponseOption);
        jQuery('a.add-note', el).bind('click', addRiskFactorNote);
        jQuery('a.remove-note', el).bind('click', removeRiskFactorNote);
        new_response_option_count++;
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
        jQuery('a.delete_risk_factor', form_el).bind('click', deleteRiskFactor);

        jQuery("ul.response-option-list li", form_el).bind('mouseover', showDeleteResponseOption).bind('mouseout', hideDeleteResponseOption);
        jQuery('a.add-note', form_el).bind('click', addRiskFactorNote);
        jQuery('a.remove-note', form_el).bind('click', removeRiskFactorNote);

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
            jQuery("a.edit-risk-factor-link", root_li).bind('click', editRiskFactor);
            jQuery("a.cancel-risk-factor-link", root_li).bind('click', cancelRiskFactorEdit);
            jQuery('a.delete_risk_factor', root_li).bind('click', deleteRiskFactor);
            jQuery('a.cancel-risk-factor-add', root_li).remove();
            jQuery("ul.response-option-list li", root_li).bind('mouseover', showDeleteResponseOption).bind('mouseout', hideDeleteResponseOption);
            jQuery('a.add-note', root_li).bind('click', addRiskFactorNote);
            jQuery('a.remove-note', root_li).bind('click', removeRiskFactorNote);

            root_li.bind('mouseover', showRiskFactorEditLink).bind('mouseout', hideRiskFactorEditLink);
            root_li.attr('id', 'rf_'+data.risk_id);
            root_li.removeClass('new').addClass('risk-factor-entity');

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
            jQuery("div.risk-factor-wrapper", root_li).remove();
            jQuery("a.cancel-risk-factor-link", root_li).addClass('hidden');
            jQuery("span.question", root_li).text(data.question);
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
        jQuery.ajax({
            url: '<?php echo url_for("@save_risk_factor_position") ?>',
            type: 'POST',
            data: {ids: json_obj, form_id: jQuery('form.main-form').attr('id')},
            success: function() {

            }
        })
    }

    function deleteRiskFactor() {
        if(confirm("Are You Sure?")){
            var root_li = jQuery(this).closest('li');
            jQuery.ajax({
                url: '<?php echo url_for('@delete_risk_factor'); ?>',
                data: {id: jQuery("input[type='hidden']", root_li).val()},
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data.result == "OK"){
                        root_li.remove();
                    }
                }
            });
        }
        return false;
    }


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

    function showDeleteResponseOption(){
       // alert(jQuery(this).closest('ul.response-option-list').find('li').length);
        if(jQuery(this).closest('ul.response-option-list').find('li').length > 2){
            jQuery("a.delete-response-option-link", this).removeClass("hidden").bind('click', deleteResponseOption);
        } else {
            jQuery("a.delete-response-option-link", this).addClass("hidden").unbind('click');
        }
    }

    function hideDeleteResponseOption(){
        jQuery("a.delete-response-option-link", this).addClass("hidden").unbind('click');
    }

    function deleteResponseOption(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li');
        if(!root_li.hasClass('new-response-option')){
            jQuery.ajax({
                url: '<?php echo url_for('@delete_response_option') ?>',
                data: {id: jQuery("input.response-option-id", root_li).val()},
                dataType: 'json',
                type: 'POST',
                success: function(data){
                    if(data.result == "OK"){
                        root_li.remove();
                    }
                }
            })
        } else {
            root_li.remove();
        }
    }

    function addRiskFactorNote(event) {
        event.preventDefault();
        var root_li = jQuery(this).closest('li');
        jQuery("div.remove-note-wrapper", root_li).removeClass('hidden');
        jQuery("div.add-note-wrapper", root_li).addClass('hidden');
    }

    function removeRiskFactorNote(event) {
        event.preventDefault();
        var root_li = jQuery(this).closest('li');
        jQuery("div.remove-note-wrapper", root_li).addClass('hidden');
        jQuery("div.remove-note-wrapper input[type='text']", root_li).val('');
        jQuery("div.add-note-wrapper", root_li).removeClass('hidden') ;
    }

    function validateAndSubmitAddRiskFactor(event) {
        event.preventDefault();
        var valid = true;
        var question = jQuery('input.question', this);
        if(question.val() == '') {
            valid = false;
            question.addClass('invalid-field');
        }

        jQuery('ul.response-option-list li', this).each(function(){
            var response_text = jQuery('input.response-text',this);
            var response_value = jQuery('input.response-value',this);
            if(response_text.val() == ''){
                valid = false;
                response_text.addClass('invalid-field');
            }
            if(response_value.val() == '' || !response_value.val().match(/[0-5]/)){
                valid = false;
                response_value.addClass('invalid-field');
            }
        });

        if(valid){
            jQuery('.invalid-field', this).removeClass('invalid-field');
            jQuery(this).ajaxSubmit(add_options_submit);
        }

    }

    function validateAndSubmitEditRiskFactor(event) {
        event.preventDefault();
        var valid = true;
        var question = jQuery('input.question', this);
        if(question.val() == '') {
            valid = false;
            question.addClass('invalid-field');
        }

        jQuery('ul.response-option-list li', this).each(function(){
            var response_text = jQuery('input.response-text',this);
            var response_value = jQuery('input.response-value',this);
            if(response_text.val() == ''){
                valid = false;
                response_text.addClass('invalid-field');
            }
            if(response_value.val() == '' || !response_value.val().match(/[0-5]/)){
                valid = false;
                response_value.addClass('invalid-field');
            }
        });

        if(valid){
            jQuery('.invalid-field', this).removeClass('invalid-field');
            jQuery(this).ajaxSubmit(edit_options_submit);
        }

    }

    var edit_options_submit = {
        dataType:  'json',
        clearForm: false,
        success: editRiskFactorSubmitted
    };

    var add_options_submit = {
        dataType:  'json',
        clearForm: false,
        success: addRiskFactorSubmitted
    };




    /* DOCUMENT READY */

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

        var flight_information_field = jQuery("ul.flight-information-list li");
        flight_information_field.bind('mouseover', flightInformationOver).bind('mouseout', flightInformationOut);
        jQuery("a.show-hide-field", flight_information_field).bind('click', showHideField);
        jQuery("li.risk-factor-entity").bind('mouseover', showRiskFactorEditLink).bind('mouseout', hideRiskFactorEditLink);
        jQuery("a.edit-risk-factor-link").bind('click', editRiskFactor);
        jQuery("a.cancel-risk-factor-link").bind('click', cancelRiskFactorEdit);

        jQuery('#add-risk-factor-link').click(function(event){
            event.preventDefault();
            var el = jQuery(addNewRiskFactorField(new_risk_factor_count));
            jQuery('a.add-new-response-link', el).bind('click', addNewResponseOptionForm);
            jQuery('a.cancel-risk-factor-add', el).bind('click', cancelRiskFactorAdd);

            new_risk_factor_count++;

            jQuery('ul.risk-factor-list').append(el);

            var response_el = jQuery(addNewResponseOptionField(new_response_option_count, 'default_no'));
            el.find('ul.response-option-list').append(response_el);
            response_el.bind('mouseover', showDeleteResponseOption).bind('mouseout', hideDeleteResponseOption);
            jQuery('a.add-note', response_el).bind('click', addRiskFactorNote);
            jQuery('a.remove-note', response_el).bind('click', removeRiskFactorNote);
            new_response_option_count++;

            var response_el = jQuery(addNewResponseOptionField(new_response_option_count, 'default_yes'));
            el.find('ul.response-option-list').append(response_el);
            response_el.bind('mouseover', showDeleteResponseOption).bind('mouseout', hideDeleteResponseOption);
            jQuery('a.add-note', response_el).bind('click', addRiskFactorNote);
            jQuery('a.remove-note', response_el).bind('click', removeRiskFactorNote);
            new_response_option_count++;

        });


        jQuery("div.mitigation-header").mouseover(function(){
            if(jQuery(this).find('a.mitigation-cancel').hasClass('hidden')){
               jQuery(this).find('a.mitigation-edit').removeClass('hidden');
            }
        });
        jQuery("div.mitigation-header").mouseout(function(){
            if(jQuery(this).find('a.mitigation-cancel').hasClass('hidden')){
                jQuery(this).find('a.mitigation-edit').addClass('hidden');
            }
        });

        jQuery('a.mitigation-edit').click(function(event){
            event.preventDefault();
            jQuery(this).addClass('hidden');
            var root_li = jQuery(this).closest('li');
            root_li.find('a.mitigation-cancel').removeClass('hidden');
            root_li.find('div.field-wrapper').show(500);
        });

        jQuery("a.mitigation-cancel").click(function(event){
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

            var valid = true;
            var mitigation_message = jQuery('input.mitigation-message', root_li);
            if(mitigation_message.val() == ''){
                valid = false;
                mitigation_message.addClass('invalid-field');
            }

            if(data && valid){
                mitigation_message.removeClass('invalid-field');
                jQuery.ajax({
                    url: '<?php echo url_for("@save_mitigation_section") ?>',
                    type: 'POST',
                    data: data,
                    success: function() {
                        root_li.find('div.field-wrapper').hide(500);
                        root_li.find('a.mitigation-cancel').addClass('hidden');
                    }
                });
            }

        });

        jQuery( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 49,
            values: [<?php echo $risk_builder->getMitigationLowMax() ?>, <?php echo $risk_builder->getMitigationMediumMax() ?> ],
            create: function( event, ui ) {
                colorScale('<?php echo $risk_builder->getMitigationLowMax() ?>', '<?php echo $risk_builder->getMitigationMediumMax() ?>');
            },

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
                var left_position = ui.values[0]*10-500;
                jQuery('#slider-range').css('background-position', left_position+'px top');
                colorScale(ui.values[0], ui.values[1]);

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

        var slider_bg_position = parseFloat(jQuery('a.ui-slider-handle').css('left'), 10)-500;
        jQuery('#slider-range').css('background-position', slider_bg_position+'px top');

    });

</script>