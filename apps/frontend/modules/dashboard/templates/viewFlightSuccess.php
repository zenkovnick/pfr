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
</div>