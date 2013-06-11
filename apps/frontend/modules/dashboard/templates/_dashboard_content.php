<div id="chart">

</div>
<div class="additional-info">
    <ul>
        <li>
            <span><?php echo number_format($additional_info['average_risk'], 1) ?></span>
            <span>Average Risk</span>
        </li>
        <li>
            <span><?php echo $additional_info['flights_count'] ?></span>
            <span>Flights</span>
        </li>
        <li>
            <span><?php echo number_format($additional_info['average_mitigation'], 1) ?></span>
            <span>Average Mitigation</span>
        </li>
    </ul>
</div>
<div class="flight-list-wrapper">
    <?php include_partial('dashboard/flight_list', array('pager' => $pager, 'account' => $account)) ?>
</div>
