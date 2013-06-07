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
</div>