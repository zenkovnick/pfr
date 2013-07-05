<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<div class="assessment-wrapper">
    <?php include_partial('flight/report', array(
        'mitigation_info' => $mitigation_info,
        'high_risk_factors' => $high_risk_factors,
        'flight' => $flight
    )) ?>
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
               class="submit <?php echo $mitigation_info['type'] == 'medium' || ($mitigation_info['type'] == 'high' && !$mitigation_info['prevent_flight']) ? "btn-red" : "btn-green" ?> btn">Submit Assessment and Fly</a>
        <?php endif ?>
    </div>
</div>
