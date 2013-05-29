<li class="new" id="new_<?php echo $number ?>" style="display: none">
    <a href="" class="cancel-plane-add">Cancel</a>
    <span class="handler hidden">Handler</span>
    <input type="hidden" value="" />
    <div class="plane-header hidden">
        <span class="question"></span>
        <a href="" class="edit-plane-link hidden">Edit</a>
        <a href="" class="cancel-plane-link hidden">Cancel</a>
    </div>
    <div class="plane-wrapper">
        <h2>New Plane</h2>
        <form id="plane_form_<?php echo $number ?>" action="<?php echo url_for("@save_plane?account_id={$form_id}&new_form_num={$number}") ?>" method="post">
            <fieldset>
                <?php include_partial("builder/field", array('field' => $form['tail_number'], 'class' => 'tail-number', 'placeholder' => 'Tail Number')); ?>
            </fieldset>
            <button class="btn btn-green" type="submit">Save</button>
        </form>
    </div>
</li>
<script type="text/javascript">

    jQuery("#plane_form_<?php echo $number ?>").bind('submit', validateAndSubmitAddPlane)


</script>