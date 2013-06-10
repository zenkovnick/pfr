<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<!--[if IE 9]>
<script type="text/javascript" src="/js/jquery.fileupload-ie9.js"></script>
<![endif]-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function(){
    });
</script>

<h1>Settings</h1>
<input type="hidden" value="<?php echo $account->getId() ?>" class="account-id">
<ul class="settings-list">
    <li class="my-information">
        <span>My Information</span>
        <a href="" class="edit-mi-link hidden">Edit</a>
        <a href="" class="cancel-mi-link hidden">Cancel</a>
    </li>
    <?php if($can_manage): ?>
        <li class="account-information">
            <span>Account Information</span>
            <a href="" class="edit-ai-link hidden">Edit</a>
            <a href="" class="cancel-ai-link hidden">Cancel</a>
        </li>

        <li class="planes" id="planes">
            <ul class="plane-list" id="plane_container">
                <?php foreach($planes as $plane): ?>
                    <li class="plane-entity" id="plane_<?php echo $plane->getId() ?>">
                        <span class="handler hidden">Handler</span>
                        <input type="hidden" value="<?php echo $plane->getId() ?>" />
                        <div class="plane-header">
                            <span class="tail-number"><?php echo $plane->getTailNumber() ?></span>
                            <a href="" class="edit-plane-link hidden">Edit</a>
                            <a href="" class="cancel-plane-link hidden">Cancel</a>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
            <a href="" id="add-plane-link" class="add-new">+ New Plane</a>
        </li>
        <li class="pilots" id="pilots">
            <ul class="pilot-list" id="pilot_container">
                <?php foreach($pilots as $pilot): ?>
                    <li class="pilot-entity <?php echo $pilot->getIsActive() ? '' : 'not-active' ?>" id="pilot_<?php echo $pilot->getId() ?>">
                        <span class="handler hidden">Handler</span>
                        <input type="hidden" value="<?php echo $pilot->getId() ?>" />
                        <div class="pilot-header">
                            <span class="name"><?php echo $pilot->getFirstName() ?></span>
                            <?php if($pilot->getIsActiveAccount()): ?>
                                <a href="" class="edit-pilot-link hidden">Edit</a>
                                <a href="" class="cancel-pilot-link hidden">Cancel</a>
                            <?php else: ?>
                                <span class="invited">(Invited)</span>
                            <?php endif ?>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
            <a href="" id="add-pilot-link" class="add-new">+ New Pilot</a>
        </li>
        <li>
            <a href="<?php echo url_for("@form?id={$assessment_form->getId()}") ?>">Modify Risk Assessment Form</a>
        </li>
    <?php endif ?>
</ul>

<script type="text/javascript">
    var information_submit = {
        dataType:  'json',
        clearForm: false,
        success: informationSubmitted
    };

    var account_submit = {
        dataType:  'json',
        clearForm: false,
        success: accountSubmitted
    };

    var add_plane_options_submit = {
        dataType:  'json',
        clearForm: false,
        success: addPlaneSubmitted
    };

    var edit_plane_options_submit = {
        dataType:  'json',
        clearForm: false,
        success: editPlaneSubmitted
    };

    var add_pilot_options_submit = {
        dataType:  'json',
        clearForm: false,
        success: addPilotSubmitted
    };

    var edit_pilot_options_submit = {
        dataType:  'json',
        clearForm: false,
        success: editPilotSubmitted
    };

    var new_plane_count = 0;
    var new_pilot_count = 0;
    var show_delay = 500;
    var hide_delay = 500;
    var email_pattern = /^[-a-z0-9!#\$%&'*+\/=?\^_`{|}~]+(\.[-a-z0-9!#\$%&'*+\/=?\^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/i;
    var account_id = null;

    function validateAndSubmitInformationForm(event) {
        event.preventDefault();
        var valid = true;
        var username = jQuery('input.username', this);
        var new_pass = jQuery('input.new-password', this);
        var new_pass_confirm = jQuery('input.new-password-confirm', this);

        if(username.val() == '' || !username.val().match(email_pattern)) {
            valid = false;
            username.addClass('invalid-field');
        }

        if(new_pass.val() != new_pass_confirm.val()){
            valid = false;
            new_pass.addClass('invalid-field');
            new_pass_confirm.addClass('invalid-field');
        }
        if(valid){
            jQuery('.invalid-field', this).removeClass('invalid-field');
            jQuery(this).ajaxSubmit(information_submit);
        }

    }

    function informationSubmitted(data){
        if(data.result == "OK"){
            //alert(data.widget);
            jQuery('span.header-user-avatar').html(data.widget);
            var root_li = jQuery('li.my-information');
            jQuery("a.cancel-mi-link", root_li).addClass('hidden');
            jQuery("div.my-information-wrapper", root_li).hide(hide_delay, function(){jQuery(this).remove()});
            root_li.removeClass('editing');
        }
    }

    function showMIEditLink(){
        if(jQuery(this).find('a.cancel-mi-link').hasClass('hidden')){
            jQuery(this).find('a.edit-mi-link').removeClass('hidden');
            jQuery(this).find('.handler').removeClass('hidden');
        }
    }

    function hideMIEditLink(){
        if(jQuery(this).find('a.cancel-mi-link').hasClass('hidden')){
            jQuery(this).find('a.edit-mi-link').addClass('hidden');
            jQuery(this).find('.handler').addClass('hidden');
        }
    }


    function editMI(event){
        event.preventDefault();
        var root_el = jQuery(this).closest('li.my-information');
        root_el.addClass('editing');
        jQuery(this).addClass('hidden');
        root_el.find('a.cancel-mi-link').removeClass('hidden');

        var form_el = jQuery(jQuery.ajax({
            type: 'GET',
            url: '<?php echo url_for("@my_information_data?account_id={$account->getId()}"); ?>',
            async: false
        }).responseText);
        jQuery('a.delete-my-information', form_el).bind('click', deleteMI);

        root_el.append(form_el);
        form_el.show(show_delay);

    }

    function cancelMIEdit(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li.my-information');
        jQuery(this).addClass('hidden');
        root_li.find("div.my-information-wrapper").hide(hide_delay, function(){jQuery(this).remove()});
        root_li.removeClass('editing');
    }

    function deleteMI(event) {
        event.preventDefault();
        if(confirm("Confirm deleting from current account")){
            if(confirm("Are You Sure?")){
                window.location.href=jQuery(this).prop('href');
            }
        }
        return false;
    }

    /* ACCOUNT */

    function validateAndSubmitAccountForm(event) {
        event.preventDefault();
        var valid = true;
        var title = jQuery('input.title', this);
        var cpn = jQuery('input.cpn', this);

        if(title.val() == '') {
            valid = false;
            title.addClass('invalid-field');
        }

        /*if(cpn.val() == ''){
         valid = false;
         cpn.addClass('invalid-field');
         }*/
        if(valid){
            jQuery('.invalid-field', this).removeClass('invalid-field');
            jQuery(this).ajaxSubmit(account_submit);
        }

    }

    function accountSubmitted(data){
        jQuery('span.header-account-avatar').html(data.widget);
        var root_li = jQuery('li.account-information');
        jQuery("a.cancel-ai-link", root_li).addClass('hidden');
        jQuery("div.account-information-wrapper", root_li).hide(hide_delay, function(){jQuery(this).remove()});
        root_li.removeClass('editing');
    }

    function showAIEditLink(){
        if(jQuery(this).find('a.cancel-ai-link').hasClass('hidden')){
            jQuery(this).find('a.edit-ai-link').removeClass('hidden');
            jQuery(this).find('.handler').removeClass('hidden');
        }
    }

    function hideAIEditLink(){
        if(jQuery(this).find('a.cancel-ai-link').hasClass('hidden')){
            jQuery(this).find('a.edit-ai-link').addClass('hidden');
            jQuery(this).find('.handler').addClass('hidden');
        }
    }


    function editAI(event){
        event.preventDefault();
        var root_el = jQuery(this).closest('li.account-information');
        root_el.addClass('editing');
        jQuery(this).addClass('hidden');
        root_el.find('a.cancel-ai-link').removeClass('hidden');

        var form_el = jQuery(jQuery.ajax({
            type: 'GET',
            url: '<?php echo url_for("@account_information_data?account_id={$account->getId()}"); ?>',
            async: false
        }).responseText);
        jQuery('a.delete-account-information', form_el).bind('click', deleteAI);

        root_el.append(form_el);
        form_el.show(show_delay);

    }

    function cancelAIEdit(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li.account-information');
        jQuery(this).addClass('hidden');
        root_li.find("div.account-information-wrapper").hide(hide_delay, function(){jQuery(this).remove()});
        root_li.removeClass('editing');
    }

    function deleteAI(event) {
        event.preventDefault();
        if(confirm("Confirm deleting current account(all pilots of this account will be deattached)")){
            if(confirm("Are You Sure?")){
                window.location.href=jQuery(this).prop('href');
            }
        }
        return false;
    }

    
    

    /* PLANE */
    function showPlaneEditLink(){
        if(jQuery(this).find('a.cancel-plane-link').hasClass('hidden')){
            jQuery(this).find('a.edit-plane-link').removeClass('hidden');
            jQuery(this).find('.handler').removeClass('hidden');
        }
    }

    function hidePlaneEditLink(){
        if(jQuery(this).find('a.cancel-plane-link').hasClass('hidden')){
            jQuery(this).find('a.edit-plane-link').addClass('hidden');
            jQuery(this).find('.handler').addClass('hidden');
        }
    }

    function addNewPlaneField(num){
        return jQuery.ajax({
            type: 'POST',
            data: {plane_num: num, account_id: account_id},
            url: '<?php echo url_for("@add_new_plane_field"); ?>',
            async: false
        }).responseText;
    }

    function addPlane(event){
        event.preventDefault();
        var el = jQuery(addNewPlaneField(new_plane_count));
        jQuery('a.cancel-plane-add', el).bind('click', cancelPlaneAdd);
        new_plane_count++;
        jQuery('ul.plane-list').append(el);
        el.show(show_delay);
    }

    function cancelPlaneAdd(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li.new');
        root_li.hide(hide_delay, function(){jQuery(this).remove()});
    }

    function validateAndSubmitAddPlane(event) {
        event.preventDefault();
        var valid = true;
        var tail_number = jQuery('input.tail-number', this);
        if(tail_number.val() == '') {
            valid = false;
            tail_number.addClass('invalid-field');
        }

        if(valid){
            jQuery('.invalid-field', this).removeClass('invalid-field');
            jQuery(this).ajaxSubmit(add_plane_options_submit);
        }

    }

    function addPlaneSubmitted(data){
        var root_li = jQuery('li#new_plane_'+data.new_form_num);
        if(data.result == "OK"){
            jQuery("div.plane-wrapper", root_li).hide(hide_delay, function(){jQuery(this).remove()});
            jQuery("span.tail-number", root_li).text(data.tail_number);
            jQuery("div.plane-header", root_li).removeClass('hidden');
            //jQuery("span.handler", root_li).removeClass('hidden');
            jQuery("input[type='hidden']", root_li).val(data.plane_id);
            jQuery("a.edit-plane-link", root_li).bind('click', editPlane);
            jQuery("a.cancel-plane-link", root_li).bind('click', cancelPlaneEdit);
            jQuery('a.delete_plane', root_li).bind('click', deletePlane);
            jQuery('a.cancel-plane-add', root_li).remove();
            root_li.bind('mouseover', showPlaneEditLink).bind('mouseout', hidePlaneEditLink);
            root_li.attr('id', 'plane_'+data.plane_id);
            root_li.removeClass('new').addClass('plane-entity');

            jQuery( "#plane_container").sortable({
                containment: "parent",
                axis: "y",
                handle: "span.handler",
                scroll: false,
                stop: savePlanePosition
            });
        }  else if(data.result == "Failed"){

            for(var i in data.error_fields){
                if(data.error_fields.hasOwnProperty(i)){
                    jQuery("#plane_"+data.error_fields[i], root_li).addClass('invalid-field');
                }
            }

        }
    }

    function editPlane(event){
        event.preventDefault();
        var root_el = jQuery(this).closest('li.plane-entity');
        root_el.addClass('editing');
        jQuery(this).addClass('hidden');
        root_el.find('a.cancel-plane-link').removeClass('hidden');
        var plane_id= root_el.find('input[type="hidden"]').val();
        var form_el = jQuery(jQuery.ajax({
            type: 'GET',
            data: {plane_id: plane_id, account_id: account_id},
            url: '<?php echo url_for("@edit_plane"); ?>',
            async: false
        }).responseText);
        jQuery('a.delete-plane', form_el).bind('click', deletePlane);

        root_el.append(form_el);
        form_el.show(show_delay);

    }

    function validateAndSubmitEditPlane(event) {
        event.preventDefault();
        var valid = true;
        var tail_number = jQuery('input.tail-number', this);
        if(tail_number.val() == '') {
            valid = false;
            tail_number.addClass('invalid-field');
        }

        if(valid){
            jQuery('.invalid-field', this).removeClass('invalid-field');
            jQuery(this).ajaxSubmit(edit_plane_options_submit);
        }

    }

    function editPlaneSubmitted(data){
        var root_li = null;
        if(data.result == "OK"){
            jQuery('li#plane_'+data.plane_id);
            jQuery("div.plane-wrapper", root_li).hide(hide_delay, function(){jQuery(this).remove()});
            jQuery("a.cancel-plane-link", root_li).addClass('hidden');
            jQuery("span.tail-number", root_li).text(data.tail_number);
        } else if(data.result == "Changed") {
            root_li = jQuery('li#plane_'+data.old_plane_id);
            root_li.attr('id', 'plane_'+data.new_plane_id);
            jQuery("input[type='hidden']").val(data.new_plane_id);
            jQuery("div.plane-wrapper", root_li).hide(hide_delay, function(){jQuery(this).remove()});
            jQuery("a.cancel-plane-link", root_li).addClass('hidden');
            jQuery("span.tail-number", root_li).text(data.tail_number);

        }
    }

    function cancelPlaneEdit(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li.plane-entity');
        jQuery(this).addClass('hidden');
        root_li.find("div.plane-wrapper").hide(hide_delay, function(){jQuery(this).remove()});
        root_li.removeClass('editing');
    }

    function deletePlane() {
        if(confirm("Are You Sure?")){
            var root_li = jQuery(this).closest('li');
            jQuery.ajax({
                url: '<?php echo url_for('@delete_plane'); ?>',
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

    function savePlanePosition(){
        var positions = new Array();
        jQuery("#plane_container li").each(function(){
            positions.push(jQuery(this).find("input[type='hidden']").val());
        });
        var json_obj =  JSON.stringify(positions);
        jQuery.ajax({
            url: '<?php echo url_for("@save_plane_position") ?>',
            type: 'POST',
            data: {ids: json_obj, account_id: account_id},
            success: function() {

            }
        })
    }

    /* PILOT */

    function showPilotEditLink(){
        jQuery(this).find('.handler').removeClass('hidden');
        if(jQuery(this).find('a.cancel-pilot-link').hasClass('hidden')){
            jQuery(this).find('a.edit-pilot-link').removeClass('hidden');
        }
    }

    function hidePilotEditLink(){
        jQuery(this).find('.handler').addClass('hidden');
        if(jQuery(this).find('a.cancel-pilot-link').hasClass('hidden')){
            jQuery(this).find('a.edit-pilot-link').addClass('hidden');
        }
    }

    function addNewPilotField(num){
        return jQuery.ajax({
            type: 'POST',
            data: {pilot_num: num, account_id: account_id},
            url: '<?php echo url_for("@add_new_pilot_field"); ?>',
            async: false
        }).responseText;
    }

    function addPilot(event){
        event.preventDefault();
        var el = jQuery(addNewPilotField(new_pilot_count));
        jQuery('a.cancel-pilot-add', el).bind('click', cancelPilotAdd);
        new_pilot_count++;
        jQuery('ul.pilot-list').append(el);
        el.show(show_delay);
    }

    function cancelPilotAdd(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li.new');
        root_li.hide(hide_delay, function(){jQuery(this).remove()});
    }

    function validateAndSubmitAddPilot(event) {
        event.preventDefault();
        var valid = true;
        var name = jQuery('input.name', this);
        if(name.val() == '') {
            valid = false;
            name.addClass('invalid-field');
        }
        var username = jQuery('input.username', this);
        if(username.val() == '') {
            valid = false;
            username.addClass('invalid-field');
        }

        if(valid){
            jQuery('.invalid-field', this).removeClass('invalid-field');
            jQuery(this).ajaxSubmit(add_pilot_options_submit);
        }

    }

    function addPilotSubmitted(data){
        var root_li = jQuery('li#new_pilot_'+data.new_form_num);

        if(data.result == "OK"){

            jQuery("span.name", root_li).text(data.name);

            jQuery("div.pilot-header", root_li).append("<span class='invited'>(Invited)</span>").removeClass('hidden');
            //jQuery("span.handler", root_li).removeClass('hidden');
            jQuery("input[type='hidden']", root_li).val(data.pilot_id);
            jQuery("a.edit-pilot-link", root_li).bind('click', editPilot);
            jQuery("a.cancel-pilot-link", root_li).bind('click', cancelPilotEdit);
            jQuery('a.delete_pilot', root_li).bind('click', deletePilot);
            jQuery('a.cancel-pilot-add', root_li).remove();
            root_li.bind('mouseover', showPilotEditLink).bind('mouseout', hidePilotEditLink);
            root_li.attr('id', 'pilot_'+data.pilot_id);
            root_li.removeClass('new').addClass('pilot-entity');

            jQuery( "#pilot_container").sortable({
                containment: "parent",
                axis: "y",
                handle: "span.handler",
                scroll: false,
                stop: savePilotPosition
            });
            jQuery("div.pilot-wrapper", root_li).hide(hide_delay, function(){jQuery(this).remove()});
        } else if(data.result == "Failed"){

            for(var i in data.error_fields){
                if(data.error_fields.hasOwnProperty(i)){
                    jQuery("#sf_guard_user_"+data.error_fields[i], root_li).addClass('invalid-field');
                }
            }

        }
    }

    function editPilot(event){
        event.preventDefault();
        var root_el = jQuery(this).closest('li.pilot-entity');
        root_el.addClass('editing');
        jQuery(this).addClass('hidden');
        root_el.find('a.cancel-pilot-link').removeClass('hidden');
        var pilot_id= root_el.find('input[type="hidden"]').val();
        var form_el = jQuery(jQuery.ajax({
            type: 'GET',
            data: {pilot_id: pilot_id, account_id: account_id},
            url: '<?php echo url_for("@edit_pilot"); ?>',
            async: false
        }).responseText);
        jQuery('a.delete-pilot', form_el).bind('click', deletePilot);

        root_el.append(form_el);
        form_el.show(show_delay);

    }

    function validateAndSubmitEditPilot(event) {
        event.preventDefault();
        var valid = true;
        var name = jQuery('input.name', this);
        if(name.val() == '') {
            valid = false;
            name.addClass('invalid-field');
        }
        var username = jQuery('input.username', this);
        if(username.val() == '') {
            valid = false;
            username.addClass('invalid-field');
        }


        if(valid){
            jQuery('.invalid-field', this).removeClass('invalid-field');
            jQuery(this).ajaxSubmit(edit_pilot_options_submit);
        }

    }

    function editPilotSubmitted(data){
        var root_li = jQuery('li#pilot_'+data.pilot_id);
        if(data.result == "OK"){
            jQuery("div.pilot-wrapper", root_li).hide(hide_delay, function(){jQuery(this).remove()});
            jQuery("a.cancel-pilot-link", root_li).addClass('hidden');
            jQuery("span.name", root_li).text(data.name);
        } else if(data.result == "Failed"){

            for(var i in data.error_fields){
                if(data.error_fields.hasOwnProperty(i)){
                    jQuery("#sf_guard_user_"+data.error_fields[i], root_li).addClass('invalid-field');
                }
            }

        }
    }

    function cancelPilotEdit(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li.pilot-entity');
        jQuery(this).addClass('hidden');
        root_li.find("div.pilot-wrapper").hide(hide_delay, function(){jQuery(this).remove()});
        root_li.removeClass('editing');
    }

    function deletePilot() {
        if(confirm("Are You Sure?")){
            var root_li = jQuery(this).closest('li');
            jQuery.ajax({
                url: '<?php echo url_for('@delete_pilot'); ?>',
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

    function savePilotPosition(){
        var positions = new Array();
        jQuery("#pilot_container li").each(function(){
            positions.push(jQuery(this).find("input[type='hidden']").val());
        });
        var json_obj =  JSON.stringify(positions);
        jQuery.ajax({
            url: '<?php echo url_for("@save_pilot_position") ?>',
            type: 'POST',
            data: {ids: json_obj, account_id: account_id},
            success: function() {

            }
        })
    }



    jQuery(document).ready(function(){

        account_id = jQuery("input[type='hidden'].account-id").val();

        jQuery("li.my-information").bind('mouseover', showMIEditLink).bind('mouseout', hideMIEditLink);
        jQuery("a.edit-mi-link").bind('click', editMI);
        jQuery("a.cancel-mi-link").bind('click', cancelMIEdit);

        jQuery("li.account-information").bind('mouseover', showAIEditLink).bind('mouseout', hideAIEditLink);
        jQuery("a.edit-ai-link").bind('click', editAI);
        jQuery("a.cancel-ai-link").bind('click', cancelAIEdit);


        jQuery("li.plane-entity").bind('mouseover', showPlaneEditLink).bind('mouseout', hidePlaneEditLink);
        jQuery("a.edit-plane-link").bind('click', editPlane);
        jQuery("a.cancel-plane-link").bind('click', cancelPlaneEdit);
        jQuery('#add-plane-link').bind('click', addPlane);

        jQuery("li.pilot-entity").bind('mouseover', showPilotEditLink).bind('mouseout', hidePilotEditLink);
        jQuery("a.edit-pilot-link").bind('click', editPilot);
        jQuery("a.cancel-pilot-link").bind('click', cancelPilotEdit);
        jQuery('#add-pilot-link').bind('click', addPilot);

        if(window.location.hash){
            var el = jQuery(window.location.hash);
            jQuery('a.add-new', el).trigger('click');
        }


        jQuery( "#plane_container").sortable({
            containment: "parent",
            axis: "y",
            handle: "span.handler",
            scroll: false,
            stop: savePlanePosition
        });

        jQuery( "#pilot_container").sortable({
            containment: "parent",
            axis: "y",
            handle: "span.handler",
            scroll: false,
            stop: savePilotPosition
        });
    });
</script>
