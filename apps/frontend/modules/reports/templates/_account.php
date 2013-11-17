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

<p>Max risk selected count: <?php echo $risk_selected_data['max'] ?></p>
<ul>
<?php foreach($risk_selected_data['data'] as $row): ?>
    <li>
        <span><?php echo $row['question'] ?></span>: <span><?php echo $row['count'] ?></span>
    </li>
<?php endforeach ?>
</ul>