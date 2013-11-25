<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<div class="assessment-wrapper">
    <div class="risk-assessment">
        <h2><?php echo $mitigation_info['message'] ?></h2>
        <p class="summary">
            Flight #<?php echo $flight->getTripNumber() ?> from <?php echo $flight->getAirportFrom()->getICAO() ?> to <?php echo $flight->getAirportTo()->getICAO() ?>
            in <?php echo $flight->getPlane()->getTailNumber() ?> has a <?php echo $mitigation_info['type'] ?> risk factor of <?php echo $flight->getRiskFactorSum() ?>
            <br />
            <?php echo date('m/d/Y Hi', strtotime($flight->getUpdatedAt()))?><?php echo $flight->getPilotName() ? ", PIC - {$flight->getPilotName()}" : "" ?>
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


        <?php if(count($high_risk_factors) > 0): ?>
            <ul>
                <?php foreach($high_risk_factors as $high_risk_factor): ?>
                    <?php if(isset($high_risk_factor['question'])): ?>
                        <?php if(isset($high_risk_factor['title'])): ?>
                            <li style="padding-top: 50px;">
                                <h2>
                                    <?php echo $high_risk_factor['title'];?>
                                </h2>
                            </li>
                        <?php endif ?>
                        <?php foreach($high_risk_factor['question'] as $key=>$risk_factor): ?>
                            <li class="assessment-risk-wrapper">
                                <div>
                                    <p class="question"><?php echo $risk_factor['question'] ?></p>
                                    <span class="answer"><?php echo $risk_factor['answer'] ?></span>
                                </div>
                                <span class="risk"><?php echo $risk_factor['risk'] ?></span>
                            </li>
                        <?php endforeach; ?>


                    <?php endif; ?>

                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <span class="no-high-risk-factors">No risk factors over 0.</span>
        <?php endif ?>
        <?php if($flight->getMitigationNote()): ?>
            <span class="user-note">Note</span>
            <p class="user-note-content"><?php echo $flight->getMitigationNote() ?></p>
        <?php endif ?>
    </div>
    <span class="bottom-border border"></span>
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