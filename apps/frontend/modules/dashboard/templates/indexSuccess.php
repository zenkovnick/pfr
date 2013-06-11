<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<h1>Dashboard</h1>

<a href="<?php echo url_for("@create_flight?account_id={$account->getId()}")?>">New Flight</a>
<div class="dashboard-filters">
    <form id="flight_filter" action="<?php echo url_for("@flight_filter?account_id={$account->getId()}") ?>" method="post">
        <ul class="flight-filter-links">
            <li><?php echo $filter['plane']->render(array('class' => 'plane-filter')) ?></li>
            <li><?php echo $filter['pilot']->render(array('class' => 'pilot-filter')) ?></li>
            <li><?php echo $filter['date']->render(array('class' => 'date-filter')) ?></li>
            <li><?php echo $filter['sort']->render(array('class' => 'sort-filter')) ?></li>
        </ul>
    </form>
</div>


<div class="dashboard-content">
    <?php include_partial('dashboard/dashboard_content', array('account' => $account, 'pager' => $pager, 'additional_info' => $additional_info)) ?>
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

    var filter_options = {
        dataType:  'json',
        clearForm: false,
        success: filterSubmitted
    };

    function applyFilter(){
        jQuery("#flight_filter").submit();
    }

    function submitFilter(event) {
        event.preventDefault();
        if(jQuery(".plane-filter").val() == 'new_plane'){
            window.location.href="<?php echo url_for("@settings?account_id={$account->getId()}") ?>#planes";
        } else if(jQuery(".pilot-filter").val() == 'new_pilot') {
            window.location.href="<?php echo url_for("@settings?account_id={$account->getId()}") ?>#pilots";
        } else {
            jQuery(this).ajaxSubmit(filter_options);
        }

    }

    function filterSubmitted(data){
        jQuery("div.dashboard-content").html(data.dashboard_data);
        drawChart(data.flight_chart);
    }

    function chartInit(){
        jQuery.ajax({
            url: '<?php echo url_for("@chart_init?account_id={$account->getId()}") ?>',
            dataType: 'json',
            type: 'GET',
            success: function(data){
                drawChart(data.flight_chart);
            }
        })
    }

    function drawChart(chart_info) {
        var output_element = document.getElementById('chart');
        if(chart_info.chart_data.rows){
            var dataTable = new google.visualization.DataTable(chart_info.chart_data);
            var colors = chart_info.chart_color;
            var colors_arr = new Array();
            var vAxis_title = "";
            for(var key_color in colors){
                if(colors.hasOwnProperty(key_color)){
                    colors_arr.push(colors[key_color]);
                }
            }
            //colors_arr.reverse();
            var options = {
                fontSize: 5,
                fontName: 'Times New Roman',
                enableInteractivity: false,
                width: 890, height: 400,
                chartArea: {width: 750, height: 300},
                legend: {alignment: 'center', position: 'top', textStyle: {color: 'black', fontSize: 18, fontName: 'Helvetica'}},
                pointSize: 0,
                interpolateNulls: true,
                colors: colors_arr,
                hAxis: {textStyle: {fontName: 'Helvetica', fontSize: 14 }},
                vAxis: {textStyle: {fontName: 'Helvetica'}, minValue: 0, title: vAxis_title}
            };
            var chart = new google.visualization.LineChart(output_element);
            //google.visualization.events.addListener(chart, "ready", tweakChart);
            chart.draw(dataTable, options);

        } else {
            output_element.innerHTML = "";
        }
    }

    jQuery(document).ready(function(){
        jQuery("#flight_filter").bind('submit', submitFilter);
        jQuery(".plane-filter, .pilot-filter, .date-filter, .sort-filter").bind('change', applyFilter);
        jQuery(".plane-filter").append("<option value='new_plane'>New plane</option>");
        jQuery(".pilot-filter").append("<option value='new_pilot'>New pilot</option>");
        google.load('visualization', '1', {'packages':['corechart'], 'callback': chartInit});
    });
</script>
