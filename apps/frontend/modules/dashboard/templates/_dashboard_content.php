<?php if($can_manage): ?>
    <div id="chart" class="chart-block">

    </div>
    <div class="additional-info">
        <ul>
            <li>
                <span class="number"><?php echo $additional_info['flights_count'] ?></span>
                <span class="caption">Flights</span>
            </li>
            <li>
                <span class="number"><?php echo number_format($additional_info['average_risk'], 1) ?></span>
                <span class="caption">Ave Risk</span>
            </li>
            <li>
                <span class="number"><?php echo $additional_info['max_risk'] ?></span>
                <span class="caption">Highest Score</span>
            </li>
            <li>
                <span class="number"><?php echo $additional_info['mitigations_count'] ?></span>
                <span class="caption">Mitigations</span>
            </li>
        </ul>
    </div>
<?php endif ?>

<div class="flight-list-wrapper">
    <?php include_partial('dashboard/flight_list', array('pager' => $pager, 'account' => $account, 'can_manage' => $can_manage)) ?>
</div>
