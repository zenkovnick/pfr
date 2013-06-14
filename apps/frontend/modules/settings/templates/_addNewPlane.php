<li class="new" id="new_plane_<?php echo $number ?>" style="display: none">
    
    <span class="handler hidden">Handler</span>
    <input type="hidden" value="" />
    
    <div class="caption-block">
        <span class="tail-number">New Plane</span>
        <a href="" class="cancel-plane-add link">Cancel</a>
    </div>
    
    <div class="plane-header caption-block hidden">
        <span class="tail-number"></span>
        <a href="" class="edit-plane-link link hidden">Edit</a>
        <a href="" class="cancel-plane-link link hidden">Cancel</a>
    </div>
    
    <div class="plane-wrapper info-block">
        
        <?php echo($form->renderHiddenFields()) ?>
        <?php echo($form->renderGlobalErrors()) ?>
        <form id="plane_form_<?php echo $number ?>" action="<?php echo url_for("@save_plane?account_id={$account_id}&new_form_num={$number}") ?>" method="post">
            <ul>
                <li class="input-block">
                    <?php include_partial("settings/field", array('field' => $form['tail_number'], 'class' => 'tail-number', 'placeholder' => 'Tail Number')); ?>
                </li>
                
                <li class="hint-block">
                    <p>Adding this plane will give you the ability to measure its flights' risk over time, but be aware that by adding this plane, you will be adding <span>$5 every month</span> to your bill.</p>
                </li>
                
                <li class="buttons-block">
                    <button class="btn btn-green" type="submit">Save</button>
                </li>
            </ul>
        </form>
    </div>
</li>
<script type="text/javascript">

    jQuery("#plane_form_<?php echo $number ?>").bind('submit', validateAndSubmitAddPlane)


</script>