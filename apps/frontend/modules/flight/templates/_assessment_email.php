<div class="assessment-wrapper" xmlns="http://www.w3.org/1999/html">
    <table style="background-color: #F2F2F2; border-bottom: 1px solid #E4E4E4; max-width: 540px; overflow: hidden; padding: 40px 40px 0;" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <h1 style="color: #000; font-size: 16px; text-align: center;"><?php echo $mitigation_info['message'] ?></h1>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="color: #999; display: block; text-align: center;">
                        Flight <span style="font-weight: bold;"> #<?php echo $flight->getTripNumber() ?></span> from <span style="font-weight: bold;"><?php echo $flight->getAirportFrom()->getICAO() ?></span> to <span style="font-weight: bold;"><?php echo $flight->getAirportTo()->getICAO() ?></span>
                        in <span style="font-weight: bold;"><?php echo $flight->getPlane()->getTailNumber() ?></span> has a <?php echo $mitigation_info['type'] ?> risk factor with <span style="font-weight: bold;"><?php echo $flight->getRiskFactorSum() ?></span> out of <span style="font-weight: bold;">50</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <span style="background: #CCC; border-radius: 5px 0 0 5px; -moz-border-radius: 5px 0 0 5px; -webkit-border-radius: 5px 0 0 5px; display: block; float: left; height: 12px; margin: 21px 0; width: <?php echo (460*$flight->getRiskFactorSum()/50 -25) ?>px; "></span>

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