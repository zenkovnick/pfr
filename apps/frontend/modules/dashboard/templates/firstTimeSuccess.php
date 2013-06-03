<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>
<a href="<?php echo url_for("@create_flight?account_id={$account->getId()}")?>">New Flight</a>
<div>
    <ul class="conditions">
        <li class="signup-condition condition">
            <span>Sign up for Preflight Risk</span>
        </li>
        <li class="plane-condition condition">
            <?php if($account->getHasPlane()): ?>
                <span>Add your first plane</span>
            <?php else: ?>
                <a href="<?php echo url_for("@settings?account_id={$account->getId()}#planes") ?>">Add your first plane</a>
            <?php endif ?>
        </li>
        <li class="risk-condition condition">
            <?php if($account->getHasModifiedForm()): ?>
                <span>Edit your default risk assessment form</span>
            <?php else: ?>
                <a href="<?php echo url_for("@form?id={$form->getId()}") ?>">Edit your default risk assessment form</a>
            <?php endif ?>
        </li>
        <li class="pilot-condition condition">
            <?php if($account->getHasPilot() || $account->getHasSkippedPilot()): ?>
                <span>Invite other pilots</span>
            <?php else: ?>
                <a href="<?php echo url_for("@settings?account_id={$account->getId()}#pilots") ?>">Invite other pilots</a>
                <a class="skip-pilot" href="#">Skip</a>
            <?php endif ?>
        </li>
        <li class="flight-condition condition">
            <?php if($account->getHasFlight()): ?>
                <span>Measure your first flight's risk</span>
            <?php else: ?>
                <a href="#">Measure your first flight's risk</a>
            <?php endif ?>
        </li>
    </ul>
</div>
<script type="text/javascript">
    function skipPilotCondition(event) {
        event.preventDefault();
        var root_li = jQuery(this).closest("li.condition");
        jQuery.ajax({
            url: '<?php echo url_for("@skip_pilot_condition?account_id={$account->getId()}") ?>',
            dataType: 'json',
            type: 'POST',
            success: function(data){
                if(data.result == "OK"){
                    jQuery("a", root_li).remove();
                    root_li.html("<span>Invite other pilots</span>");
                }
            }

        });
    }

    jQuery(document).ready(function(){
        jQuery("a.skip-pilot").bind('click', skipPilotCondition);
    });
</script>