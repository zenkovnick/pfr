<div class="assessment-wrapper" xmlns="http://www.w3.org/1999/html" style="overflow: hidden; width: 100%;">
<!--    <meta name="viewport" content="width=500" />-->
    <table style="background-color: #F2F2F2; border-bottom: 1px solid #E4E4E4; max-width: 100%; overflow: hidden; padding: 40px 40px 0;" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <h1 style="color: #000 !important; font-size: 16px; text-align: center;"><?php echo $mitigation_info['message'] ?></h1>
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
                    <span style="background: #CCC; border-radius: 5px 0 0 5px; -moz-border-radius: 5px 0 0 5px; -webkit-border-radius: 5px 0 0 5px; display: block; float: left; height: 12px; margin: 21px 0; width: <?php echo (100*$flight->getRiskFactorSum()/50) ?>%; "></span>

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
                        height: 15px;
                        line-height: 100%;
                        max-height: 15px;
                        padding: 17px 0;
                        text-align: center;
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
                    <h2 style="color: #000 !important; font-size: 16px;">Risk Factors</h2>
                </td>
            </tr>
            <?php if(count($high_risk_factors) > 0): ?>
                <?php foreach($high_risk_factors as $high_risk_factor): ?>
                    <tr>
                        <td style="border-bottom: 1px dashed #CCC; padding: 10px 0;">
                            <div style="float: left; max-width: 75%;">
                                <p style="color: #000 !important; margin: 0;" class="question"><?php echo $high_risk_factor['question'] ?></p>
                                <span style="color: #CCC;" class="answer"><?php echo $high_risk_factor['answer'] ?></span>
                            </div>
                            <div style="background: #F33; border: 1px solid #F00; float: right; padding: 10px 0; text-align: center; width: 40px;" class="risk">
                                <span style="color: #FFF;"><?php echo $high_risk_factor['risk'] ?></span>
                            </div>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <span style="color: #999; display: inline-block; margin: 0 0 20px;">No risk factors over 0</span>
            <?php endif ?>
<!--            <tr>-->
<!--                <td style="border-top: 1px solid #CCC; border-bottom: 1px solid #FFF; padding: 0;"></td>-->
<!--            </tr>-->
            <tr>
                <td style="padding-bottom: 30px"></td>
            </tr>
    </table>
    <table style="background: #FFF; max-width: 100%">
        <tr>
            <td style="height: 70px; text-align: center; vertical-align: middle; width: 540px;">
                <img style="display:inline-block; height: 60px; width: 114px;" src="<?php echo $_SERVER["SERVER_NAME"]; ?>/images/logo.png" alt="Logo" />
            </td>
        </tr>
    </table>
</div>