<ul class="reports-general-statistics">
    <li>
        <span>
            <?php echo $flights->count() ?>
        </span>
        <label>Flights</label>
    </li>
    <li>
        <span>
            <?php echo number_format($avg_sum, 1) ?>
        </span>
        <label>Ave risk</label>
    </li>
    <li>
        <span>
            <?php echo $max_sum ? $max_sum : 0?>
        </span>
        <label>Highest score</label>
    </li>
    <li>
        <span>
            <?php echo $mitigation_count ?>
        </span>
        <label>Mitigations</label>
    </li>
</ul>


<?php if($report_type != 'plane'): ?>
    <h2>Total Flights by Planes</h2>
<!--    <h3>Max plane flights count: --><?php //echo $plane_data['max'] ?><!--</h3>-->
    <div class="report-grid">
        <ul class="report-grid">
            <?php foreach($plane_data['data'] as $row): ?>
                <li>
                    <span class="report-note"><?php echo $row['tail_number'] ?></span>
                    <span class="report-index" style="width:<?php echo $row['count']/$plane_data['max']*100 - 4.4 ?>% "></span>
                    <span class="report-value"><?php echo $row['count'] ?></span>
                </li>
            <?php endforeach ?>
        </ul>
        <span class="min">0</span>
        <span><?php echo round($plane_data['max']/3, 2) ?></span>
        <span><?php echo round($plane_data['max']*2/3, 2) ?></span>
        <span class="max"><?php echo round($plane_data['max'], 2) ?></span>
    </div>
<?php endif ?>
<?php if($report_type != 'pic' && $report_type != 'sic'): ?>
    <h2>Total Flights by Pilots</h2>
<!--    <h3>Max pilot flights count: --><?php //echo $pilot_data['max'] ?><!--</h3>-->
    <div class="report-grid">
        <ul>
            <?php foreach($pilot_data['data'] as $row): ?>
                <li>
                    <span class="report-note"><?php echo $row['name'] ?></span>
                    <span class="report-index" style="width:<?php echo $row['count']/$pilot_data['max']*100 - 4.4 ?>% "></span>
                    <span class="report-value"><?php echo $row['count'] ?></span>
                </li>
            <?php endforeach ?>
        </ul>
        <span class="min">0</span>
        <span><?php echo round($pilot_data['max']/3, 2) ?></span>
        <span><?php echo round($pilot_data['max']*2/3, 2) ?></span>
        <span class="max"><?php echo round($pilot_data['max'], 2) ?></span>
    </div>

<?php endif ?>
<h2>Times Risk Selected</h2>
<!--<h3>Max risk selected count: --><?php //echo $risk_selected_data['max'] ?><!--</h3>-->
<div class="report-grid risks">
    <ul>
        <?php foreach($risk_selected_data['data'] as $row): ?>
            <li>
                <span class="report-note"><?php echo $row['question'] ?></span>
                <span class="report-index <?php if($row['count']/$flights->count()*100 < 30): echo "green"; elseif ($row['count']/$flights->count()*100 > 70): echo "red"; endif; ?>" style="width:<?php echo $row['count']/$flights->count()*100 - 4.4 ?>% "></span>
                <span class="report-value"><?php echo $row['count'] ?></span>
            </li>
        <?php endforeach ?>
    </ul>
    <span class="min">0</span>
    <span><?php echo round($flights->count()/3, 2) ?></span>
    <span><?php echo round($flights->count()*2/3, 2) ?></span>
    <span class="max"><?php echo round($flights->count(), 2) ?></span>
</div>


