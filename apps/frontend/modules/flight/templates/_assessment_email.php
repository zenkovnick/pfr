<div class="assessment-wrapper" xmlns="http://www.w3.org/1999/html">
    <table style="background-color: #F2F2F2; border-bottom: 1px solid #E4E4E4; width: 540px; overflow: hidden; padding: 40px 40px 0;" cellpadding="0" cellspacing="0">
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

                    <span class="risk" style="
                        <?php if ($mitigation_info['type'] == 'low'): ?>
                            background: #6C0;
                            border: 1px solid #690;
                        <?php elseif ($mitigation_info['type'] == 'medium'): ?>
                            background: #FC0;
                            border: 1px solid #F90;
                        <?php else:?>
                            background: #F33;
                            border: 1px solid #F00;
                        <?php endif;?>
                        border-radius: 35px;
                        -moz-border-radius: 35px;
                        -webkit-border-radius: 35px;
                        color: #FFF;
                        display: block;
                        float: left;
                        padding: 17px 0;
                        position: absolute;
                        text-align: center;
                        top: -19px;
                        width: 50px;">
                        <?php echo $flight->getRiskFactorSum() ?>
                    </span>
                    <span style="background: #CCC; border-radius: 0 5px 5px 0; -moz-border-radius: 0 5px 5px 0; -webkit-border-radius: 0 5px 5px 0; display: block; height: 12px; margin: 21px 0; overflow: hidden;"></span>

                </td>

            </tr>
            <tr>
                <td height="20"></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #CCC; border-bottom: 1px solid #FFF; padding: 0;"></td>
            </tr>
            <tr>
                <td>
                    <h2 style="color: #000; font-size: 16px;">Risk Factors</h2>
<!--                    --><?php //print_r($high_risk_factors)?>
                </td>
            </tr>
            <?php foreach($high_risk_factors as $high_risk_factor): ?>
                <tr>
                    <td style="border-bottom: 1px dashed #CCC; padding: 10px 0;">
                        <div style="float: left; width: 390px;">
                            <p style="color: #000; margin: 0;" class="question"><?php echo $high_risk_factor['question'] ?></p>
                            <span style="color: #CCC;" class="answer"><?php echo $high_risk_factor['answer'] ?></span>
                        </div>
                        <div style="background: #F33; border: 1px solid #F00; float: right; padding: 14px 0; text-align: center; width: 40px;" class="risk">
                            <span style="color: #FFF;"><?php echo $high_risk_factor['risk'] ?></span>
                        </div>

                    </td>
                </tr>
            <?php endforeach; ?>
<!--            <tr>-->
<!--                <td style="border-top: 1px solid #CCC; border-bottom: 1px solid #FFF; padding: 0;"></td>-->
<!--            </tr>-->
            <tr>
                <td style="padding-bottom: 30px"></td>
            </tr>
    </table>
    <img src="/images/logo.png" alt="Logo" />
</div>