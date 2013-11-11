<div id="dialog" title="Confirmation Required">
    <input type="hidden" id="section_id" value="<?php echo $section_id ?>" />
    <input type="hidden" id="obj_ids" value="<?php echo $obj_ids ?>"/>
    <p>Warning!  All the sub-questions will be removed completely as well.</p>
    <a class='confirm-delete-section'>Confirm</a>
    <a class='reject-delete-section'>Cancel</a>
</div>

<script type="text/javascript">
    jQuery("a.confirm-delete-section").bind('click', confirmDeleteSection);
</script>