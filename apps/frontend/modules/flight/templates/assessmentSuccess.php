<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<div class="assessment-wrapper">
    <div class="risk-assessment">
        <h2><?php echo $mitigation_info['message'] ?></h2>
        <p class="summary">
            Flight #<?php echo $flight->getTripNumber() ?> from <?php echo $flight->getAirportFrom()->getName() ?> to <?php echo $flight->getAirportTo()->getName() ?>
            in <?php echo $flight->getPlane()->getTailNumber() ?> has a <?php echo $mitigation_info['type'] ?> risk factor with <?php echo $flight->getRiskFactorSum() ?> of 50
        </p>
        <div class="risk-sum-wrapper">
            <div id="risk_sum"></div>
        </div>
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
    var risk_factor_sum = <?php echo $flight->getRiskFactorSum() ?>;
    var risk_factor_type = '<?php echo $mitigation_info['type'] ?>';
    function preventClick(event){
        event.preventDefault();
    }

    jQuery(document).ready(function(){
        jQuery("a.prevent-click").bind('click', preventClick);
        jQuery( "#risk_sum" ).slider({
            min: 0,
            max: 49,
            value: risk_factor_sum,
            create: function(){
                var marker = jQuery("a.ui-slider-handle.ui-state-default.ui-corner-all");
                marker.text(risk_factor_sum);
                switch(risk_factor_type){
                    case 'low':
                      marker.addClass('green-marker');
                      break;
                    case 'medium':
                        marker.addClass('yellow-marker');
                        break;
                    case 'high':
                        marker.addClass('red-marker');
                        break;
                }
            },
            slide: function( event, ui ) {
                return false;
            }
        });


    });
</script>