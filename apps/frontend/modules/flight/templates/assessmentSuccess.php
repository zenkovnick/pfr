<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>
<div class="assessment-wrapper">
    <div class="risk-assessment">
        <h2><?php echo $mitigation_info['message'] ?></h2>
        <p class="summary">
            Flight #<?php echo $flight->getTripNumber() ?> from <?php echo $flight->getAirportFrom() ?> to <?php echo $flight->getAirportTo() ?>
            in <?php echo $flight->getPlane()->getTailNumber() ?> has a <?php echo $mitigation_info['type'] ?> risk factor with <?php echo $flight->getRiskFactorSum() ?> of 50
        </p>

        <span class="risk-sum"></span>
        <?php if($mitigation_info['type'] == 'high' && $mitigation_info['prevent_flight']): ?>
            <span class="note">You must mitigate risk before proceeding with this flight</span>
        <?php endif ?>
    </div>
    <span class="top-border border"></span>
    <div class="critical-risks">
        <h2>Risk Factors</h2>
        <ul>
            <?php foreach($high_risk_factors as $high_risk_factor): ?>
                <li class="assessment-risk-wrapper <?php echo $high_risk_factor === end(array_values($high_risk_factors)) ? "last" : ""?>">
                    <div>
                        <p class="question"><?php echo $high_risk_factor['question'] ?></p>
                        <span class="answer"><?php echo $high_risk_factor['answer'] ?></span>
                    </div>
                    <span class="risk"><?php echo $high_risk_factor['risk'] ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <span class="bottom-border border"></span>
    <div class="mitigation-buttons">
        <?php if($mitigation_info['type'] != 'low'): ?>
            <a href="<?php echo url_for("@edit_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>" class="re-assess btn-green btn">Re-assess Risk Before Flying</a>
        <?php else: ?>
            <a href="" class="re-assess prevent-click btn-grey btn">Re-assess Risk Before Flying</a>
        <?php endif ?>


        <?php if($mitigation_info['type'] == 'high' && $mitigation_info['prevent_flight']): ?>
            <a href="" class="submit prevent-click btn-grey btn">Submit Assessment and Fly</a>
        <?php else: ?>
            <a href="<?php echo url_for("@submit_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>"
               class="submit <?php echo $mitigation_info['type'] == 'medium' ? "btn-red" : "btn-green" ?> btn">Submit Assessment and Fly</a>
        <?php endif ?>
    </div>
</div>

<script type="text/javascript">
    function preventClick(event){
        event.preventDefault();
    }

    jQuery(document).ready(function(){
        jQuery("a.prevent-click").bind('click', preventClick);
        /*var x = jQuery('.risk-sum').offset().left;
        var y = jQuery('.risk-sum').offset().top;
        var risk_factor_sum = <?php echo $flight->getRiskFactorSum() ?>;
        var offset = 10 * risk_factor_sum;
        var paper = Raphael(x+offset, y, 50, 50);
        var circle = paper.circle(25, 25, 25);
        circle.attr("fill", "#FF3333");
        circle.attr("stroke", "#AA3333");
        paper.text(25, 25, risk_factor_sum).attr({fill: '#ffffff', "font-size": 16, "font-family": "Arial, Helvetica, sans-serif"});*/
    })
</script>