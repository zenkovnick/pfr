<?php echo $flights->count() ?>
<br />
<?php echo $avg_sum ?>
<br />
<?php echo $max_sum ?>
<br />
<?php echo $mitigation_count ?>
<br />
<br />
<br />
<?php if($report_type != 'plane'): ?>
    <h1>Total Flights by Planes</h1>
    <h3>Max plane flights count: <?php echo $plane_data['max'] ?></h3>
    <ul>
        <?php foreach($plane_data['data'] as $row): ?>
            <li>
                <span><?php echo $row['tail_number'] ?></span>: <span><?php echo $row['count'] ?></span>
            </li>
        <?php endforeach ?>
    </ul>
    <br />
    <br />
<?php endif ?>
<?php if($report_type != 'pic' && $report_type != 'sic'): ?>
    <h1>Total Flights by Pilots</h1>
    <h3>Max pilot flights count: <?php echo $pilot_data['max'] ?></h3>
    <ul>
        <?php foreach($pilot_data['data'] as $row): ?>
            <li>
                <span><?php echo $row['name'] ?></span>: <span><?php echo $row['count'] ?></span>
            </li>
        <?php endforeach ?>
    </ul>
    <br />
    <br />
<?php endif ?>
<h1>Times Risk Selected</h1>
<h3>Max risk selected count: <?php echo $risk_selected_data['max'] ?></h3>
<ul>
<?php foreach($risk_selected_data['data'] as $row): ?>
    <li>
        <span><?php echo $row['question'] ?></span>: <span><?php echo $row['count'] ?></span>
    </li>
<?php endforeach ?>
</ul>