<div id="dialog" class="popup-block" title="Confirmation Required">
    <h1>Delete section</h1>
    <input type="hidden" id="section_id" value="<?php echo $section_id ?>" />
    <input type="hidden" id="obj_ids" value="<?php echo $obj_ids ?>"/>
    <p>Warning!  All the sub-questions will be removed completely as well.</p>
    <div class="button-wrapper">
        <a class='confirm-delete-section btn btn-red'>Confirm</a>
        <a class='reject-delete-section btn btn-grey'>Cancel</a>
    </div>

</div>

<script type="text/javascript">
    jQuery("a.confirm-delete-section").bind('click', confirmDeleteSection);
    jQuery("a.reject-delete-section").bind('click', function(event){
        event.preventDefault();
        jQuery.fancybox.close();
    });

</script>