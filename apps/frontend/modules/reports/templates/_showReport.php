<style type="text/css">
    .reports-page {
        padding-bottom: 50px;
    }
    .reports-page h1 {
        margin: 0 0 35px;
    }
    .reports-page > span {
        display: block;
        float: left;
    }

    ul.reports-general-statistics {
        clear: both;
        margin: 20px -3px 20px;
        overflow: hidden;
        text-align: center;
    }
    ul.reports-general-statistics li {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        display: inline-block;
        margin: 0 1%;
        overflow: hidden;
        vertical-align: top;
        width: 22%;
    }
    ul.reports-general-statistics li span {
        border: 1px solid #C3C3C3;
        display: block;
        font-size: 34px;
        line-height: 48px;
        text-align: center;
    }
    ul.reports-general-statistics li label {
        line-height: 150%;
    }
    .report-grid {
        overflow: hidden;
    }
    .report-grid ul {
        background: url(<?php echo $sf_request->getUriPrefix() ?>/images/report-grid-bg.jpg) repeat -3% top;
        background-size: 32.6% auto;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border: 1px solid #A3A3A3;
        padding: 13px 0 0;
    }
    .report-grid ul li {
        margin: 0 0 13px;
        overflow: hidden;
    }
    .report-grid ul li span.report-note {
        color: #444;
        display: block;
        font-size: 12px;
        line-height: 150%;
    }
    .report-grid ul li span.report-index {
        background-color: #00A3D9;
        display: block;
        float: left;
        height: 10px;
        min-width: 3px;
    }
    .report-grid.risks ul li span.report-index {
        background-color: #FFCC00;
    }
    .report-grid.risks ul li span.report-index.green {
        background-color: #66CC00;
    }
    .report-grid.risks ul li span.report-index.red {
        background-color: #FF3333;
    }
    .report-grid ul li span.report-value {
        color: #000;
        display: block;
        font-size: 12px;
        font-weight: bold;
        line-height: 10px;
    }
    .report-grid > span {
        display: block;
        float: left;
        text-align: right;
        width: 32%;
    }
    .report-grid > span.min {
        width: auto;
    }
    .report-grid > span.max {
        float: none;
        overflow: hidden;
        padding-right: 3.5%;
        width: auto;


</style>
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

            <li<?php echo $row['count'] ? '' : ' class="without-value"' ?>>
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
