<li class="new" id="new_pilot_<?php echo $number ?>" style="display: none">
    
    <span class="handler hidden">Handler</span>
    <input type="hidden" value="" />
    
    <div class="caption-block">
        <span class="name">New Pilot</span>
        <a href="" class="cancel-pilot-add link">Cancel</a>
    </div>
    
    <div class="pilot-header caption-block hidden">
        <span class="name"></span>
        <a href="" class="edit-pilot-link link hidden">Edit</a>
        <a href="" class="cancel-pilot-link link hidden">Cancel</a>
    </div>
    
    <div class="pilot-wrapper info-block">
        <?php echo($form->renderHiddenFields()) ?>
        <?php echo($form->renderGlobalErrors()) ?>
        <form id="pilot_form_<?php echo $number ?>" action="<?php echo url_for("@save_pilot?account_id={$account_id}&new_form_num={$number}") ?>" method="post">
            <ul>
                <li class="input-block">
                    <?php include_partial("settings/field", array('field' => $form['first_name'], 'class' => 'name', 'placeholder' => 'Name')); ?>
                </li>
                
                <li class="input-block">
                    <?php include_partial("settings/field", array('field' => $form['username'], 'class' => 'username', 'placeholder' => 'Email')); ?>
                </li>
                
                <li class="check-block">
                    <?php include_partial("settings/field", array('field' => $form['can_manage'], 'class' => 'can-manage', 'placeholder' => 'Email')); ?>
                </li>
                
                <li class="hint-block">
                    <p>Adding this pilot will give you the ability to measure their flights' risk over time, but be aware that by adding them, you will be adding <span>$3 every month</span> to your bill.</p>
                </li>                
                
                <li class="buttons-block">
                    <button class="btn btn-green" type="submit">Save</button>
                </li>
            </ul>
        </form>
    </div>
    <script type="text/javascript">

        jQuery("#pilot_form_<?php echo $number ?>").bind('submit', validateAndSubmitAddPilot)


    </script>
</li>
