<?php if($can_manage): ?>
    <div id="chart" class="chart-block">

    </div>
    <div class="additional-info">
        <ul>
            <li>
                <span class="number"><?php echo number_format($additional_info['average_risk'], 1) ?></span>
                <span class="caption">Average Risk</span>
            </li>
            <li>
                <span class="number"><?php echo $additional_info['flights_count'] ?></span>
                <span class="caption">Flights</span>
            </li>
            <li>
                <span class="number"><?php echo number_format($additional_info['average_mitigation'], 1) ?></span>
                <span class="caption">Average Mitigation</span>
            </li>
        </ul>
    </div>
<?php endif ?>

<div class="flight-list-wrapper">
    <?php include_partial('dashboard/flight_list', array('pager' => $pager, 'account' => $account, 'can_manage' => $can_manage)) ?>
</div>
