<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>
<div class="first-time-dashboard">
    <div class="first-time-header">
        <h1>Dashboard</h1>
        <div class="new-flight-wrapper">
            <?php if($account->getHasPlane()): ?>
                <a class="btn btn-blue new-flight" href="<?php echo url_for("@create_flight?account_id={$account->getId()}")?>">New Flight</a>
            <?php else: ?>
                <a class="btn btn-grey new-flight disabled" href="">New Flight</a>
            <?php endif ?>
        </div>
    </div>

    <div class="first-time-wrapper">
        <h2 class="first-time-title">Get started!</h2>
        <ul class="conditions">
            <li class="signup-condition condition">
                <span>1. Sign up for Preflight Risk</span>
            </li>
            <li class="plane-condition condition">
                <?php if($account->getHasPlane()): ?>
                    <span>2 .Add your first plane</span>
                <?php else: ?>
                    <a href="<?php echo url_for("@settings?account_id={$account->getId()}#planes") ?>">2. Add your first plane</a>
                <?php endif ?>
            </li>
            <li class="risk-condition condition">
                <?php if($account->getHasModifiedForm()): ?>
                    <span>3. Edit your default risk assessment form</span>
                <?php else: ?>
                    <a href="<?php echo url_for("@form?id={$form->getId()}") ?>">3. Edit your default risk assessment form</a>
                <?php endif ?>
            </li>
            <li class="pilot-condition condition">
                <?php if($account->getHasPilot() || $account->getHasSkippedPilot()): ?>
                    <span>4. Invite other pilots</span>
                <?php else: ?>
                    <a href="<?php echo url_for("@settings?account_id={$account->getId()}#pilots") ?>">4. Invite other pilots</a>
                    <a class="skip-pilot hidden" href="#">Skip</a>
                <?php endif ?>
            </li>
            <li class="flight-condition condition">
                <?php if($account->getHasFlight()): ?>
                    <span>5. Measure your first flight's risk</span>
                <?php else: ?>
                    <?php if($account->getHasPlane()): ?>
                        <a href="<?php echo url_for("@create_flight?account_id={$account->getId()}") ?>#">5. Measure your first flight's risk</a>
                    <?php else: ?>
                        <span class="disabled-link">5. Measure your first flight's risk</span>
                    <?php endif ?>
                <?php endif ?>
            </li>
        </ul>
    </div>
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
                    root_li.html("<span>4. Invite other pilots</span>");
                }
            }

        });
    }

    function showSkip() {
        jQuery("a.skip-pilot", this).removeClass("hidden");
    }
    function hideSkip() {
        jQuery("a.skip-pilot", this).addClass("hidden");
    }
    jQuery(document).ready(function(){
        jQuery("a.skip-pilot").bind('click', skipPilotCondition);
        jQuery("a.disabled").click(function(event){event.preventDefault()});
        jQuery("li.pilot-condition").bind("mouseover", showSkip).bind("mouseout", hideSkip);
    });
</script>