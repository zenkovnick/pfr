<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>
<div class="assessment-wrapper">
    <div class="risk-assessment">
        <h1><?php echo $mitigation_info['message'] ?></h1>
        <p>
            Flight #<?php echo $flight->getTripNumber() ?> from <?php echo $flight->getAirportFrom() ?> to <?php echo $flight->getAirportTo() ?>
            in <?php echo $flight->getPlane()->getTailNumber() ?> has a <?php echo $mitigation_info['type'] ?> risk factor with <?php echo $flight->getRiskFactorSum() ?> of 50
        </p>

        <span class="risk"><?php echo $flight->getRiskFactorSum() ?></span>
    </div>
    <div class="critical-risks">
        <ul>
            <?php foreach($high_risk_factors as $high_risk_factor): ?>
                <li>
                    <div>
                        <p class="question"><?php echo $high_risk_factor['question'] ?></p>
                        <span class="answer"><?php echo $high_risk_factor['answer'] ?></span>
                    </div>
                    <div class="risk">
                        <span><?php echo $high_risk_factor['risk'] ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="mitigation-buttons">
        <?php if($mitigation_info['type'] != 'low'): ?>
            <a href="<?php echo url_for("@edit_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>" class="re-assess">Re-assess Risk Before Flying</a>
        <?php else: ?>
            <a href="" class="re-assess prevent-click">Re-assess Risk Before Flying</a>
        <?php endif ?>


        <?php if($mitigation_info['type'] == 'high' && $mitigation_info['prevent_flight']): ?>
            <a href="" class="submit prevent-click">Submit Assessment and Fly</a>
        <?php else: ?>
            <a href="<?php echo url_for("@submit_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>" class="submit">Submit Assessment and Fly</a>
        <?php endif ?>
    </div>
</div>

<script type="text/javascript">
    function preventClick(event){
        event.preventDefault();
    }

    jQuery(document).ready(function(){
        jQuery("a.prevent-click").bind('click', preventClick);
    })
</script>