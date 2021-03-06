<?php include_partial("home/error"); ?>
<?php include_partial('home/notice'); ?>
<?php include_partial('home/success'); ?>
<?php slot('title') ?>
    Select Account – Preflight Risk
<?php end_slot() ?>

<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)) ?>
<?php end_slot() ?>


<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<script src="/js/jquery.ui.timepicker.js"></script>

<div class="form-builder-wrapper">

    <h1>Form editor</h1>
    <div class="flight-information-wrapper">
        <h2>Flight information</h2>
        <ul class="flight-information-list editable-list" id="flight-information-container">
            <?php foreach($flight_information as $flight_information_field):?>
                <li class="<?php echo $flight_information_field->getIsHide() ? 'hidden-field' : "solid" ?>">
                    <span class="handler">Handler</span>
                    <div class="element-wrapper" style="<?php if($flight_information_field->getIsRequired()){echo 'border: 1px solid #CCCCCC !important;';}?>">
                        <input type="hidden" value="<?php echo $flight_information_field->getId(); ?>" ?>
                        <span><?php echo $flight_information_field->getInformationName() ?></span>
                        <?php if($flight_information_field->getHiddable()): ?>
                            <span class="hiddable">
                                <a href="" class="show-hide-field"><?php echo $flight_information_field->getIsHide() ? 'Enable Field' : "Disable field" ?></a>
                            </span>
                        <?php elseif($flight_information_field->getIsRequired()): ?>
                            <span class="hiddable hidden">
                                <a href="" class="required-field" style="display: block;"><?php echo !$flight_information_field->getRequired() ? 'Required field' : "Not required field" ?></a>
                            </span>
                        <?php else: ?>
                            <span class="uneditable">Uneditable</span>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <span class="bottom-border"></span>
    </div>
    <div class="risk-factor-global-wrapper">
        <h2>Risk Analysis</h2>
        <ul class="risk-factor-list editable-list" id="risk-factor-container">
            <?php foreach($risk_factors as $risk_factor): ?>
                <?php if($risk_factor->getSectionTitle()): ?>
                    <li class="risk-factor-entity li_section_title" id="rf_<?php echo $risk_factor->getId() ?>">
                        <input type="hidden" value="<?php echo $risk_factor->getId() ?>" class="question_id" />
                        <div class="entry-header" style="background: #FFF !important;">
                            <span class="question truncate"><?php echo $risk_factor->getQuestion() ?></span>
                            <a href="<?php echo url_for('@delete_section_popup') ?>" class="delete-section" style="display: none;">Delete</a>
                        </div>
                        <input style="display: none;" type="text" class="section_title_value" value="<?php echo $risk_factor->getQuestion(); ?>" />
                    </li>
                <?php else: ?>
                    <li class="risk-factor-entity" id="rf_<?php echo $risk_factor->getId() ?>">
                        <span class="handler">Handler</span>
                        <input type="hidden" value="<?php echo $risk_factor->getId() ?>" class="question_id" />
                        <div class="entry-header">
                            <span class="question truncate"><?php echo $risk_factor->getQuestion() ?></span>
                            <a href="" class="edit-risk-factor-link">Edit</a>
                            <a href="" class="cancel-risk-factor-link hidden">Cancel</a>
                        </div>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <a href="" id="add-section-factor-link">+ Add Section</a>
        <a href="" id="add-risk-factor-link">+ Add Risk Factor</a>
    </div>
    <div>
        <form id="<?php echo $risk_builder->getId(); ?>" method="post" class="main-form">
            <?php echo $form->renderGlobalErrors();?>
            <?php echo $form->renderHiddenFields();?>
            <ul class="form-fields">
                <li><?php include_partial("builder/field", array('field' => $form['form_name'], 'class' => 'form-title', 'label' => false)); ?></li>
                <li><?php include_partial("builder/field", array('field' => $form['form_instructions'], 'label' => false, 'placeholder' => 'Add form instructions (if any)')); ?></li>
            </ul>
            <ul class="mitigation-fields">
                <li>
                    <h2>Risk factor mitigation</h2>
                </li>
                <li>
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
                </li>
                <li>
                    <div id="slider-range"></div>
                </li>
                <li id="low" class="risk-value-edit low-risk">
                    <div class="mitigation-header">
                        <span class="risk-value"><?php echo $risk_builder->getMitigationLowMin() ?> - <?php echo $risk_builder->getMitigationLowMax() ?></span>
                        <span class="risk-title">Low Risk</span>
                        <a href="" class="mitigation-edit hidden">Edit</a>
                        <a href="" class="mitigation-cancel hidden">Cancel</a>
                    </div>
                    <div class="field-wrapper">
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_low_message'], 'class' => 'mitigation-message', 'label' => false)); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_low_instructions'], 'class' => 'mitigation-instructions', 'label' => false)); ?></div>
                        <div class="checkbox-wrapper"><?php include_partial("builder/field", array('field' => $form['mitigation_low_notify'])); ?></div>
                        <input name="risk_builder[low_mitigation_val]" id="low_mitigation_val" type="hidden" value="<?php echo $form['mitigation_low_notify']->getValue() ? 1:0; ?>" />
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_low_email'], 'class' => 'mitigation-email', 'placeholder'=>'Add more emails to notify (separate with comma)', 'label' => false)); ?></div>
                        <button class="mitigation-save btn btn-green">Save</button>
                    </div>
                </li>

                <li id="medium" class="risk-value-edit medium-risk">
                    <div class="mitigation-header">
                        <span class="risk-value"><?php echo $risk_builder->getMitigationMediumMin() ?> - <?php echo $risk_builder->getMitigationMediumMax() ?></span>
                        <span class="risk-title">Medium Risk</span>
                        <a href="" class="mitigation-edit hidden">Edit</a>
                        <a href="" class="mitigation-cancel hidden">Cancel</a>
                    </div>
                    <div class="field-wrapper">
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_medium_message'], 'class' => 'mitigation-message', 'label' => false)); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_medium_instructions'], 'class' => 'mitigation-instructions', 'label' => false)); ?></div>
                        <div class="checkbox-wrapper"><?php include_partial("builder/field", array('field' => $form['mitigation_medium_require_details'])); ?></div>
                        <div class="checkbox-wrapper"><?php include_partial("builder/field",
                            array('field' => $form['mitigation_medium_notify'], 'disabled'=>$risk_builder->getMitigationLowNotify())); ?></div>
                        <input name="risk_builder[medium_mitigation_val]" id="medium_mitigation_val" type="hidden" value="<?php echo $form['mitigation_medium_notify']->getValue() ? 1:0; ?>" />
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_medium_email'], 'class' => 'mitigation-email', 'placeholder'=>'Add more emails to notify (separate with comma)', 'label' => false)); ?></div>
                        <button class="mitigation-save btn btn-green">Save</button>
                    </div>
                </li>

                <li id="high" class="risk-value-edit high-risk">
                    <div class="mitigation-header">
                        <span class="risk-value"><?php echo $risk_builder->getMitigationHighMin() ?>+</span>
                        <span class="risk-title">High Risk</span>
                        <a href="" class="mitigation-edit hidden">Edit</a>
                        <a href="" class="mitigation-cancel hidden">Cancel</a>
                    </div>
                    <div class="field-wrapper">
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_high_message'], 'class' => 'mitigation-message', 'label' => false)); ?></div>
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_high_instructions'], 'class' => 'mitigation-instructions', 'label' => false)); ?></div>
                        <div class="checkbox-wrapper"><?php include_partial("builder/field", array('field' => $form['mitigation_high_prevent_flight'])); ?></div>
                        <div class="checkbox-wrapper"><?php include_partial("builder/field",
                            array('field' => $form['mitigation_high_notify'], 'disabled'=> ($risk_builder->getMitigationLowNotify() || $risk_builder->getMitigationMediumNotify()))); ?></div>
                        <input name="risk_builder[high_mitigation_val]" id="high_mitigation_val" type="hidden" value="<?php echo $form['mitigation_high_notify']->getValue() ? 1:0; ?>" />
                        <div><?php include_partial("builder/field", array('field' => $form['mitigation_high_email'], 'class' => 'mitigation-email', 'placeholder'=>'Add more emails to notify (separate with comma)', 'label' => false)); ?></div>
                        <button class="mitigation-save btn btn-green">Save</button>
                    </div>
                </li>
                <li class="risk-value-notify">
                    <div class="checkbox-wrapper"><?php include_partial("builder/field",
                            array('field' => $form['high_risk_factor_notify'])); ?></div>
                    <input name="risk_builder[high_risk_factor_val]" id="high_risk_factor_val" type="hidden" value="<?php echo $form['high_risk_factor_notify']->getValue() ? 1:0; ?>" />
                    <div><?php include_partial("builder/field", array('field' => $form['high_risk_factor_email'], 'class' => 'high-risk-factor-email', 'placeholder'=>'Add more emails to notify (separate with comma)', 'label' => false)); ?></div>
                </li>
            </ul>
            <button class="preview-mode-link btn btn-blue" type="submit">Preview Form</button>
            <button class="btn btn-green" type="submit">Save and Exit</button>
        </form>
    </div>

</div>
<div class="preview-mode hidden">
    <div class="preview-header">
        <div class="wrapper">
            <button class="save-and-exit btn btn-green">Save and Exit</button>
            <h1>You are in preview mode</h1>
            <a href="" class="back-to-form">Back to the form builder</a>
        </div>
    </div>

    <div class="flight">
        <h2>Preflight Risk Record</h2>
        <form id="preview_form" method="POST">
        </form>
    </div>
</div>
<div class="hidden">

</div>

<script type="text/javascript">
    var email_pattern = /^[-a-z0-9!#\$%&'*+\/=?\^_`{|}~]+(\.[-a-z0-9!#\$%&'*+\/=?\^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/i;
    jQuery("div.field-wrapper").hide();
    var new_risk_factor_count = 0;
    var new_response_option_count = 0;
    var show_delay = 500;
    var hide_delay = 500;
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

    var main_form_submit = {
        dataType:  'json',
        url: '<?php echo url_for("@preview_submit?id={$risk_builder->getId()}") ?>',
        clearForm: false,
        success: mainFormSubmitted
    };

    jQuery(document).ready(function(){

        //jQuery("#dialog").dialog({autoOpen:false});
        /*when click on section title*/
        SectionTitleClick();

        SectionTitleShowDelete();
        //SectionTitleOnClickDelete();


        jQuery(".delete-section").bind('click', deleteSectionPopup);

        jQuery("#risk-factor-container li.li_section_title input.section_title_value").bind('blur', SectionTitleFocusOut);

        jQuery("#risk_builder_mitigation_low_email, #risk_builder_mitigation_medium_email, #risk_builder_mitigation_high_email, #risk_builder_high_risk_factor_email").hide();
        if(jQuery('#risk_builder_mitigation_low_notify').is(":checked")){
            jQuery("#risk_builder_mitigation_low_email").show();
        }
        else{
            if(jQuery('#risk_builder_mitigation_medium_notify').is(":checked") &&
                !jQuery('#risk_builder_mitigation_medium_notify').is(":disabled")){
                jQuery("#risk_builder_mitigation_medium_email").show();
            }
            else
            {
                if(jQuery('#risk_builder_mitigation_high_notify').is(":checked") &&
                    !jQuery('#risk_builder_mitigation_high_notify').is(":disabled")){
                    jQuery("#risk_builder_mitigation_high_email").show();
                }
            }
        }

        jQuery("#risk_builder_mitigation_low_notify, #risk_builder_mitigation_medium_notify, #risk_builder_mitigation_high_notify").bind('click',function(){
            jQuery("#risk_builder_mitigation_low_email, #risk_builder_mitigation_medium_email, #risk_builder_mitigation_high_email").hide();
            if(jQuery('#risk_builder_mitigation_low_notify').is(":checked")){
                jQuery("#risk_builder_mitigation_low_email").show();
            }
            else
            {
                jQuery("#risk_builder_mitigation_low_email").hide();
                if(jQuery('#risk_builder_mitigation_medium_notify').is(":checked")){
                    jQuery("#risk_builder_mitigation_medium_email").show();
                }
                else
                {
                    jQuery("#risk_builder_mitigation_medium_email").hide();
                    if(jQuery('#risk_builder_mitigation_high_notify').is(":checked")){
                        jQuery("#risk_builder_mitigation_high_email").show();
                    }
                    else
                    {
                        jQuery("#risk_builder_mitigation_high_email").hide();
                    }
                }
            }
        });

        if(jQuery('#risk_builder_high_risk_factor_notify').is(":checked")){
            jQuery("#risk_builder_high_risk_factor_email").show();
        }

        jQuery('#risk_builder_high_risk_factor_notify').bind('click', function(){
            if(jQuery('#risk_builder_high_risk_factor_notify').is(":checked")){
                jQuery("#risk_builder_high_risk_factor_email").show();
            } else {
                jQuery("#risk_builder_high_risk_factor_email").val('').hide();
            }
        });

//        jQuery("#risk_builder_mitigation_medium_notify").bind('click',function(){
//
//        })
//
//        jQuery("#risk_builder_mitigation_high_notify").bind('click',function(){
//
//        })



        sortablQuestion();

        var isiOS = false;
        var agent = navigator.userAgent.toLowerCase();
        if(agent.indexOf('iphone') >= 0 || agent.indexOf('ipad') >= 0){
            isiOS = true;
        }
        var form_id = jQuery('form.main-form').attr('id');
        jQuery( "#flight-information-container").sortable({
            containment: ".flight-information-wrapper",
            axis: "y",
            handle: "span.handler",
            scroll: false,
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






        jQuery("#flight-information-container ul, #flight-information-container li" ).disableSelection();

        var flight_information_field = jQuery("ul.flight-information-list li");
        flight_information_field.bind('mouseover', flightInformationOver).bind('mouseout', flightInformationOut);
        if(isiOS){
            jQuery("a.show-hide-field", flight_information_field).bind('click touchend', showHideField);
        } else {
            jQuery("a.show-hide-field", flight_information_field).bind('click', showHideField);
        }
        if(isiOS){
            jQuery("a.required-field", flight_information_field).bind('click touchend', requiredField);
        } else {
            jQuery("a.required-field", flight_information_field).bind('click', requiredField);
        }
        jQuery("li.risk-factor-entity").bind('mouseover', showRiskFactorEditLink).bind('mouseout', hideRiskFactorEditLink);

        if(isiOS){
            jQuery("a.edit-risk-factor-link").bind('click touchend', editRiskFactor);
        } else {
            jQuery("a.edit-risk-factor-link").bind('click', editRiskFactor);
        }
        jQuery("a.cancel-risk-factor-link").bind('click', cancelRiskFactorEdit);
        jQuery("form.main-form button[type='submit']").bind('click', validateAndSubmitMainForm);
        jQuery("button.save-and-exit").bind('click', saveAndExit);
        jQuery("a.back-to-form").bind('click', switchToForm);

        jQuery('#add-risk-factor-link').click(function(event){
            event.preventDefault();
            if(jQuery("#risk-factor-container li.li_section_title").length == 0)
            {
                jQuery("#add-section-factor-link").click();
            }
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

            /**/
            el.show(show_delay);
        });

        jQuery("#add-section-factor-link").click(function(event){
            var response_el = jQuery(addNewSectionTitle('Section Title'));
            jQuery(".section_title_value", response_el).bind('blur', SectionTitleFocusOut);
            jQuery("#risk-factor-container").append(response_el);

            return false;
        });


        jQuery("div.mitigation-header").mouseover(function(){
            if(jQuery(this).find('a.mitigation-cancel').hasClass('hidden') && !jQuery(this).find('a.mitigation-edit').hasClass('opening')){
                jQuery(this).find('a.mitigation-edit').removeClass('hidden');
            }
        });
        jQuery("div.mitigation-header").mouseout(function(){
            if(jQuery(this).find('a.mitigation-cancel').hasClass('hidden')){
                jQuery(this).find('a.mitigation-edit').addClass('hidden');
            }
        });
        if(isiOS){
            jQuery('a.mitigation-edit').bind('click touchend', mitigationEdit);
        } else {
            jQuery('a.mitigation-edit').bind('click', mitigationEdit);
        }
        function mitigationEdit(event){
            event.preventDefault();
            var el = jQuery(this)
            el.addClass('hidden').addClass('opening');
            var root_li = jQuery(this).closest('li');
            root_li.find('div.field-wrapper').show(show_delay, function(){
                root_li.find('a.mitigation-cancel').removeClass('hidden');
                el.removeClass('opening');
            });
        }

        jQuery("a.mitigation-cancel").click(function(event){
            event.preventDefault();
            jQuery(this).addClass('hidden');
            var root_li = jQuery(this).closest('li');
            root_li.find('div.field-wrapper').hide(hide_delay);
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
                            jQuery("#risk_builder_mitigation_low_email").val(data.mitigation_low_email);
                            disableLowNotifyCheckbox(jQuery("#risk_builder_mitigation_low_notify"));
                            break;
                        case 'medium':
                            jQuery("#risk_builder_mitigation_medium_message").val(data.mitigation_medium_message);
                            jQuery("#risk_builder_mitigation_medium_instructions").val(data.mitigation_medium_instructions);
                            jQuery("#risk_builder_mitigation_medium_notify").prop('checked', data.mitigation_medium_notify);
                            jQuery("#risk_builder_mitigation_medium_require_details").prop('checked', data.mitigation_medium_require_details);
                            jQuery("#risk_builder_mitigation_medium_email").val(data.mitigation_medium_email);
                            disableMediumNotifyCheckbox(jQuery("#risk_builder_mitigation_medium_notify"));
                            break;
                        case 'high':
                            jQuery("#risk_builder_mitigation_high_message").val(data.mitigation_high_message);
                            jQuery("#risk_builder_mitigation_high_instructions").val(data.mitigation_high_message);
                            jQuery("#risk_builder_mitigation_high_notify").prop('checked', data.mitigation_high_notify);
                            jQuery("#risk_builder_mitigation_high_prevent_flight").prop('checked', data.mitigation_high_prevent_flight);
                            jQuery("#risk_builder_mitigation_high_email").val(data.mitigation_high_email);
                            disableHighNotifyCheckbox(jQuery("#risk_builder_mitigation_high_notify"));
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

        jQuery("#risk_builder_mitigation_high_notify").click(function(){
            disableHighNotifyCheckbox(jQuery(this));
        });



        jQuery("button.mitigation-save").click(function(event){
            event.preventDefault();
            var root_li = jQuery(this).closest('li');
            var type = root_li.attr('id');
            var data = null;

            if(!IsEmail((root_li.find(".mitigation-email")).val()))
            {
                root_li.find(".mitigation-email").addClass('invalid-field');
                return false;
            }
            else
            {
                root_li.find(".mitigation-email").removeClass('invalid-field');
            }




            switch(type){
                case 'low':
                    data = {
                        form_id: form_id,
                        type: type,
                        message: jQuery("#risk_builder_mitigation_low_message").val(),
                        instructions: jQuery("#risk_builder_mitigation_low_instructions").val(),
                        notify: jQuery("#risk_builder_mitigation_low_notify").is(':checked') ? 1 : 0,
                        email: (jQuery("#risk_builder_mitigation_low_notify").is(':checked')) ? jQuery("#risk_builder_mitigation_low_email").val() : null

                    };
                    break;
                case 'medium':
                    data = {
                        form_id: form_id,
                        type: type,
                        message: jQuery("#risk_builder_mitigation_medium_message").val(),
                        instructions: jQuery("#risk_builder_mitigation_medium_instructions").val(),
                        notify: jQuery("#risk_builder_mitigation_medium_notify").is(':checked') ? 1 : 0,
                        require: jQuery("#risk_builder_mitigation_medium_require_details").is(':checked') ? 1 : 0,
                        email: (jQuery("#risk_builder_mitigation_medium_notify").is(':checked') && !jQuery("#risk_builder_mitigation_medium_notify").is(':disabled') ) ? jQuery("#risk_builder_mitigation_medium_email").val() : null
                    };
                    break;
                case 'high':
                    data = {
                        form_id: form_id,
                        type: type,
                        message: jQuery("#risk_builder_mitigation_high_message").val(),
                        instructions: jQuery("#risk_builder_mitigation_high_instructions").val(),
                        notify: jQuery("#risk_builder_mitigation_high_notify").is(':checked') ? 1 : 0,
                        prevent: jQuery("#risk_builder_mitigation_high_prevent_flight").is(':checked') ? 1 : 0,
                        email: (jQuery("#risk_builder_mitigation_high_notify").is(':checked') && !jQuery("#risk_builder_mitigation_high_notify").is(':disabled')) ? jQuery("#risk_builder_mitigation_high_email").val() : null
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
                        root_li.find('div.field-wrapper').hide(hide_delay);
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
                var left_position = ui.values[0]*jQuery('#slider-range').width()/50-500;
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

        var ua = navigator.userAgent.toLowerCase();
        var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
        if(isAndroid) {
            jQuery('body').addClass('android');
        }

        var supportsOrientationChange = "onorientationchange" in window,
            orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";
        window.addEventListener(orientationEvent, function() {
            var left_position = parseFloat(jQuery('a.ui-slider-handle').css('left'), 10);

            jQuery('ul.form-fields').css('margin-left', -jQuery('ul.form-fields').width()/2-20+'px');
            if(isAndroid) {
                if (window.orientation == 0) {
                    jQuery('ul.form-fields').css('margin-left', -(jQuery(window).height()-40)/2-35+'px');
                }
                if (window.orientation == 90 || window.orientation == -90) {
                    jQuery('ul.form-fields').css('margin-left', -(jQuery(window).height()-40)/2-21+'px');
                }
                if (jQuery('#slider-range').width() == 300) {
                    left_position *= 1.5;
                }
                if (jQuery('#slider-range').width() == 440) {
                    left_position *= 2/3;
                }
            }
            jQuery('#slider-range').css('background-position', left_position-500+'px top');
        }, false);

        jQuery('ul.form-fields').css('margin-left', -jQuery('ul.form-fields').width()/2-20+'px');

    });



    function flightInformationOver(){
        jQuery('span.uneditable, span.hiddable, span.required', this).removeClass('hidden');
        //jQuery('span.handler', this).removeClass('hidden');
    }
    function colorScale(lower, higher) {
        var green = Math.floor(lower/5),
            red   = Math.ceil(higher/5);
        jQuery('ul.scale li').removeClass();
        jQuery('ul.scale li:nth-child('+green+')').prevAll().addClass('green');
        jQuery('ul.scale li:nth-child('+green+')').addClass('green');
        jQuery('ul.scale li:nth-child('+red+')').nextAll().addClass('red');
        if ( Math.ceil(higher/5) != (higher/5) ) {
            jQuery('ul.scale li:nth-child('+red+')').addClass('red');
        }
    }

    function flightInformationOut(){
        jQuery('span.uneditable, span.hiddable, span.required', this).addClass('hidden');
        //jQuery('span.handler', this).addClass('hidden');
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
                        root_li.removeClass('solid');
                        root_li.addClass('hidden-field');
                    } else {
                        root_li.addClass('solid');
                        root_li.removeClass('hidden-field');
                    }
                } else if(data.result == "login") {
                    window.location.href = "<?php echo url_for('@signin') ?>";
                }
            }
        });
    }

    function requiredField(event){
        event.preventDefault();
        var link = jQuery(this);
        var root_li = link.closest('li');
        var field_id = jQuery("input[type='hidden']", root_li).val();
        jQuery.ajax({
            url: '<?php echo url_for('@required_field'); ?>',
            data: {id: field_id},
            dataType: 'json',
            type: 'POST',
            success: function(data){
                if(data.result == "OK"){
                    link.text(data.is_required ? 'Required field' : "Not required field");
                    if (data.is_required) {
                        root_li.removeClass('solid');
                        root_li.addClass('hidden-field');
                    } else {
                        root_li.addClass('solid');
                        root_li.removeClass('hidden-field');
                    }
                } else if(data.result == "login") {
                    window.location.href = "<?php echo url_for('@signin') ?>";
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
        root_el.addClass('editing').removeClass('truncate');
        var el = jQuery(this);
        el.addClass('hidden').addClass('opening');
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
        form_el.show(show_delay, function(){
            root_el.find('a.cancel-risk-factor-link').removeClass('hidden');
            el.removeClass('opening');
        });

    }

    function cancelRiskFactorEdit(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li.risk-factor-entity');
        jQuery(this).addClass('hidden');
        root_li.find("div.risk-factor-wrapper").hide(hide_delay, function(){jQuery(this).remove()});
        root_li.removeClass('editing');
    }

    function cancelRiskFactorAdd(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li.new');
        root_li.hide(hide_delay, function(){jQuery(this).remove()});
    }

    function addRiskFactorSubmitted(data){
        if(data.result == "OK"){
            var root_li = jQuery('li#new_'+data.new_form_num);
            jQuery("div.risk-factor-wrapper", root_li).hide(hide_delay, function(){jQuery(this).remove()});
            jQuery("span.question", root_li).text(data.question).addClass('truncate');
            jQuery("div.entry-header", root_li).removeClass('hidden');
            jQuery("span.handler", root_li).removeClass('hidden');
            jQuery("input[type='hidden']", root_li).val(data.risk_id);
            jQuery("input[type='hidden']", root_li).addClass('question_id');
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

//            jQuery( "#risk-factor-container").sortable({
//                containment: "parent",
//                axis: "y",
//                handle: "span.handler",
//                scroll: false,
//                stop: saveRiskFactorPosition
//            });
            sortablQuestion();
        } else if(data.result == "login") {
            window.location.href = "<?php echo url_for('@signin') ?>";
        }
    }

    function editRiskFactorSubmitted(data){
        if(data.result == "OK"){
            var root_li = jQuery('li#rf_'+data.risk_id);
            jQuery("div.risk-factor-wrapper", root_li).hide(hide_delay, function(){jQuery(this).remove()});
            jQuery("a.cancel-risk-factor-link", root_li).addClass('hidden');
            jQuery("span.question", root_li).text(data.question);
            root_li.removeClass("editing");
        } else if(data.result == "login") {
            window.location.href = "<?php echo url_for('@signin') ?>";
        }
    }

    function showRiskFactorEditLink(){
        if(jQuery(this).find('a.cancel-risk-factor-link').hasClass('hidden') && !jQuery(this).find('a.edit-risk-factor-link').hasClass('opening')){
            jQuery(this).find('a.edit-risk-factor-link').removeClass('hidden');
            //jQuery(this).find('.handler').removeClass('hidden');
        }
    }

    function hideRiskFactorEditLink(){
        if(jQuery(this).find('a.cancel-risk-factor-link').hasClass('hidden')){
//            jQuery(this).find('a.edit-risk-factor-link').addClass('hidden');
            //jQuery(this).find('.handler').addClass('hidden');
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
                    } else if(data.result == "login") {
                        window.location.href = "<?php echo url_for('@signin') ?>";
                    }
                }
            });
        }
        return false;
    }


    function disableLowNotifyCheckbox(notify_el) {
        if(notify_el.is(':checked')){
            jQuery("#risk_builder_mitigation_medium_notify, #risk_builder_mitigation_high_notify").prop('checked', true).prop('disabled', 'disabled');
            jQuery("#low_mitigation_val, #medium_mitigation_val, #high_mitigation_val").val(1);
        } else {
            if(jQuery('#risk_builder_mitigation_medium_notify').is(':checked')){
                jQuery("#low_mitigation_val").val(0);
                jQuery("#medium_mitigation_val, #high_mitigation_val").val(1);
                jQuery("#risk_builder_mitigation_medium_notify").removeAttr('disabled');
            } else {
                jQuery("#risk_builder_mitigation_medium_notify, #risk_builder_mitigation_high_notify").removeAttr('disabled');
            }
        }
    }

    function disableMediumNotifyCheckbox(notify_el){
        if(notify_el.is(':checked')){
            jQuery("#risk_builder_mitigation_high_notify").prop('checked', true).prop('disabled', 'disabled');
            jQuery("#medium_mitigation_val, #high_mitigation_val").val(1);
        } else {
            jQuery("#risk_builder_mitigation_high_notify").removeAttr('disabled');
            jQuery("#medium_mitigation_val").val(0);
            jQuery("#high_mitigation_val").val(1);
        }
    }

    function disableHighNotifyCheckbox(notify_el){
        if(notify_el.is(':checked')){
            jQuery("#high_mitigation_val").val(1);
        } else {
            jQuery("#high_mitigation_val").val(0);
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
                    } else if(data.result == "login") {
                        window.location.href = "<?php echo url_for('@signin') ?>";
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

    function validateAndSubmitMainForm(event) {
        event.preventDefault();
        var valid = true;
        var anchor = null;
        var form = jQuery(this).closest('form.main-form');
        var form_title = jQuery('input.form-title', form);
        var high_risk_factor_email = jQuery('input.high-risk-factor-email', form);

        jQuery('.invalid-field').removeClass('invalid-field');
        if(form_title.val() == '') {
            valid = false;
            form_title.addClass('invalid-field');
            if(!anchor){
                anchor = form_title.prop('id');
            }
        }
//        if(high_risk_factor_email.val() != '')
//            var emails = high_risk_factor_email.val().split(',');
//            for(var idx=0; idx<emails.length; idx++) {
//                if(!jQuery.trim(emails[idx]).match(email_pattern)){
//                    valid = false;
//                    high_risk_factor_email.addClass('invalid-field');
//                    if(!anchor){
//                        anchor = high_risk_factor_email.prop('id');
//                    }
//                }
//            }
//
//        }

        if(!IsEmail(high_risk_factor_email.val())){
            valid = false;
            high_risk_factor_email.addClass('invalid-field');
            if(!anchor){
                anchor = high_risk_factor_email.prop('id');
            }

        }
        //alert('a');
        if(valid){
            jQuery('.invalid-field', form).removeClass('invalid-field');

            if(jQuery(this).hasClass('preview-mode-link')){
                form.ajaxSubmit(main_form_submit);
            } else {
                form.submit();
            }
        } else {
            window.location.href = "#"+anchor;
        }
        return false;

    }


    function mainFormSubmitted(data){
        if(data.result == "OK"){
            jQuery("#preview_form").html(data.form_data);
            jQuery("div.form-builder-wrapper").addClass('hidden');
            jQuery("div.preview-mode").removeClass('hidden');
            window.scrollTo(0, 0);
			jQuery('.header').addClass('preview');
        } else if(data.result == "login") {
            window.location.href = "<?php echo url_for('@signin') ?>";
        }
    }

    function switchToPreview(event){
        event.preventDefault();
        jQuery("div.form-builder-wrapper").addClass('hidden');
        jQuery("div.preview-mode").removeClass('hidden');

    }

    function switchToForm(event){
        event.preventDefault();
        jQuery("div.form-builder-wrapper").removeClass('hidden');
        jQuery("div.preview-mode").addClass('hidden');
        jQuery('.header').removeClass('preview');
    }

    function saveAndExit(event){
        event.preventDefault();
        jQuery("form.main-form").submit();
    }



    function IsEmail(emails) {
        if(emails.length > 1)
        {
            var ems = emails.split(',');

            for(var i in ems){
                email = jQuery.trim(ems[i]);
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test(email)){
                    return false;
                }
            }
        }

        return true;
    }


    function addNewSectionTitle(title)
    {
        return jQuery.ajax({
            type: 'POST',
            data: {title: title, form_id: jQuery("form.main-form").attr("id") },
            url: '<?php echo url_for("@add_new_section_title_field"); ?>',
            async: false
        }).responseText;
    }


    function SectionTitleClick()
    {
        jQuery("#risk-factor-container").on('click', '.li_section_title .entry-header', function(){
            var obj = jQuery(this).parent("li");
            obj.children("div").hide();
            obj.children(".section_title_value").show();
            obj.children(".section_title_value").focus();

        });
    }

    function SectionTitleFocusOut()
    {
            var obj = jQuery(this).parent("li");
            var rec = obj.children(".section_title_value").val();
            if(rec.length == 0)
            {
                jQuery(this).addClass("invalid-field");
                jQuery(this).focus();
                return false;
            }
            else
            {
                jQuery(this).removeClass("invalid-field");
            }
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    title: obj.children(".section_title_value").val(),
                    section_title_id: obj.children(".question_id").val()
                },
                url: '<?php echo url_for("@edit_section_title"); ?>',
                success: function(data){
                    if (data.result == 'OK')
                    {
                        obj.find('span.question').html(data.title);
                    }
                    obj.children(".section_title_value").hide();
                    obj.children("div").show();
                }
            });
            return false;
    }

    function SectionTitleShowDelete()
    {
        jQuery("#risk-factor-container")
            .on('mouseenter', '.li_section_title .entry-header', function(){
                jQuery(this).children(".delete-section").show();
            })
            .on('mouseleave', '.li_section_title .entry-header', function(){
                jQuery(this).children(".delete-section").hide();
            });
    }

<!--    function SectionTitleOnClickDelete()-->
<!--    {-->
<!--        jQuery("#risk-factor-container").on('click', '.li_section_title .entry-header .delete-section', function(){-->
<!--            var obj_id = new Array();-->
<!--            var obj = jQuery(this).closest('li.li_section_title');-->
<!--            obj_id.push(obj.children("input.question_id").val());-->
<!--            var objs = obj.nextUntil("li.li_section_title");-->
<!--            jQuery.each(objs, function(index, value){-->
<!--                obj_id.push(jQuery(this).children("input.question_id").val());-->
<!--            });-->
<!---->
<!--            var json_obj = JSON.stringify(obj_id);-->
<!--            jQuery(this).fancybox({href: jQuery(this).prop('href') + '?section_id='+jQuery('.question_id', obj).val()+'&obj_ids='+json_obj});-->
<!--            jQuery("#dialog").dialog({-->
<!--                autoOpen: true,-->
<!--                modal: true,-->
<!--                buttons : {-->
<!--                    "Confirm" : function() {-->
<!--                        jQuery.ajax({-->
<!--                            url: '--><?php //echo url_for("@delete_section") ?><!--',-->
<!--                            type: 'POST',-->
<!--                            dataType: 'json',-->
<!--                            data: {ids: json_obj},-->
<!--                            success: function(data) {-->
<!--                                if (data.result == 'OK')-->
<!--                                {-->
<!--                                    obj.remove();-->
<!--                                    objs.remove();-->
<!---->
<!--                                }-->
<!--                            }-->
<!--                        });-->
<!--                        jQuery("#dialog").dialog("close");-->
<!--                    },-->
<!--                    "Cancel" : function() {-->
<!--                        jQuery(this).dialog("close");-->
<!--                    }-->
<!--                }-->
<!--            });-->
<!---->
<!---->
<!--            return false;-->
<!--        });-->
<!--    }-->
<!---->
    function sortablQuestion()
    {
        jQuery( "#risk-factor-container").sortable({
            containment: ".risk-factor-global-wrapper",
            axis: "y",
            handle: "span.handler",
            scroll: false,
            stop: function(event, ui){
                console.log(ui.item.index());
                if(ui.item.index() == 0)
                {

                    return false;
                }

                saveRiskFactorPosition();
            }
        });
    }

    function deleteSectionPopup(event){
        event.preventDefault();
        var obj_id = new Array();
        var obj = jQuery(this).closest('li.li_section_title');
        obj_id.push(obj.children("input.question_id").val());
        var objs = obj.nextUntil("li.li_section_title");
        jQuery.each(objs, function(index, value){
            if(parseInt(jQuery(this).children("input.question_id").val()) != 0){
                obj_id.push(jQuery(this).children("input.question_id").val());
            }
        });

        var json_obj = obj_id.join(',');

        jQuery.fancybox({
            href: jQuery(this).prop('href') + '?section_id='+jQuery('.question_id', obj).val()+'&obj_ids='+json_obj,
            'titlePosition'     : 'over',
            'overlayOpacity'    : 0.4,
            'centerOnScroll'    : true,
            showCloseButton     : false,
            'type'              : 'ajax',
            hideOnOverlayClick  : true
        });
    }

    function confirmDeleteSection(){
        var section_id = jQuery(this).closest('#dialog').find("#section_id");
        var obj_ids = jQuery('#dialog input#obj_ids');
        var obj = jQuery("li#rf_"+section_id.val());
        var objs = obj.nextUntil("li.li_section_title");

        var json_obj = obj_ids.val();
        jQuery.ajax({
            url: '<?php echo url_for("@delete_section") ?>',
            type: 'POST',
            dataType: 'json',
            data: {ids: json_obj},
            success: function(data) {
                if (data.result == 'OK')
                {
                    obj.remove();
                    objs.remove();
                    section_id.val('');
                    obj_ids.val('');
                    jQuery.fancybox.close();
                }
            }
        });


    }


</script>