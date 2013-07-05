<div class="assessment-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="risk-assessment">
        <h1 style="color: #000; text-align: center;"><?php echo $mitigation_info['message'] ?></h1>
        <p style="color: #999; display: block; text-align: center;">
            Flight <span style="font-weight: bold;"> #<?php echo $flight->getTripNumber() ?></span> from <span style="font-weight: bold;"><?php echo $flight->getAirportFrom() ?></span> to <span style="font-weight: bold;"><?php echo $flight->getAirportTo() ?></span>
            in <span style="font-weight: bold;"><?php echo $flight->getPlane()->getTailNumber() ?></span> has a <?php echo $mitigation_info['type'] ?> risk factor with <span style="font-weight: bold;"><?php echo $flight->getRiskFactorSum() ?></span> out of <span style="font-weight: bold;">50</span>
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