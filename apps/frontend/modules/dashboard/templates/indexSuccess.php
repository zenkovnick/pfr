<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<div class="dashboard-page">
    
    <div class="caption-block">
        <a href="<?php echo url_for("@create_flight?account_id={$account->getId()}")?>" class="btn btn-blue">New Flight</a>
        <h1>Dashboard</h1>
    </div>
    
    <div class="dashboard-filters">
        <form id="flight_filter" action="<?php echo url_for("@flight_filter?account_id={$account->getId()}") ?>" method="post">
            <div class="filter-block">
                <span class="caption">Risk summary</span>
                <span>for</span>
                <div class="list-select plane-select">
                    <?php echo $filter['plane']->render(array('class' => 'plane-filter dashboard-select result')) ?>
                </div>
                <span class="plus">+</span>
                <div class="list-select pilot-select">
                    <?php echo $filter['pilot']->render(array('class' => 'pilot-filter dashboard-select result')) ?>
                </div>
                <span class="plus">+</span>

                <span class="no-margin">
                    <div class="list-select date-select">
                        <?php echo $filter['date']->render(array('class' => 'date-filter dashboard-select result')) ?>
                    </div>
                </span>
                <span>, sorted by</span>
                <div class="list-select sort-select">
                    <?php echo $filter['sort']->render(array('class' => 'sort-filter dashboard-select result')) ?>
                </div>
                <div class="clear"></div>
            </div>
        </form>
    </div>
    
    
    <div class="dashboard-content">
        <?php include_partial('dashboard/dashboard_content', array('account' => $account, 'pager' => $pager, 'additional_info' => $additional_info)) ?>
    </div>
    
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
        if(jQuery("#flight_filter_plane").val() == 'new_plane'){
            window.location.href="<?php echo url_for("@settings?account_id={$account->getId()}") ?>#planes";
        } else if(jQuery("#flight_filter_pilot").val() == 'new_pilot') {
            window.location.href="<?php echo url_for("@settings?account_id={$account->getId()}") ?>#pilots";
        } else {
            jQuery(this).ajaxSubmit(filter_options);
        }

    }

    function filterSubmitted(data){
        jQuery("div.dashboard-content").html(data.dashboard_data);
        drawChart(data);
    }

    function chartInit(){
        jQuery.ajax({
            url: '<?php echo url_for("@chart_init?account_id={$account->getId()}") ?>',
            dataType: 'json',
            type: 'GET',
            success: function(data){
                drawChart(data);
            }
        })
    }

    function drawChart(data) {
        var output_element = document.getElementById('chart');
        if(data.result == "OK"){
            var chart_info = data.flight_chart;
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
//                    width: 460, height: 230,
                    chartArea: {width: 420, height: 180},
                    legend: {alignment: 'center', position: 'top', textStyle: {color: 'black', fontSize: 18, fontName: 'Helvetica'}},
                    pointSize: 0,
                    interpolateNulls: true,
                    colors: colors_arr,
                    hAxis: {textStyle: {fontName: 'Helvetica', fontSize: 8 }},
                    vAxis: {textStyle: {fontName: 'Helvetica', fontSize: 8 }, minValue: 0, title: vAxis_title}
                };
                var chart = new google.visualization.LineChart(output_element);
                //google.visualization.events.addListener(chart, "ready", tweakChart);
                chart.draw(dataTable, options);

            } else {
                output_element.innerHTML = "";
            }
        } else {
            output_element.innerHTML = data.markup;
        }
    }


    jQuery(document).ready(function(){
        jQuery("#flight_filter").bind('submit', submitFilter);
        jQuery("#flight_filter_plane, #flight_filter_pilot, #flight_filter_date, #flight_filter_sort").bind('change', applyFilter);
        jQuery(".plane-select ul").append("<li id='new_plane'>New plane</li>");
        jQuery(".pilot-select ul").append("<li id='new_pilot'>New pilot</li>");
        google.load('visualization', '1', {'packages':['corechart'], 'callback': chartInit});

        jQuery('.list-select .result').bind('click', function(){
            jQuery("ul.expanded").trigger("mouseleave");
            jQuery("ul.expanded").hide().removeClass('expanded');
            var ul = jQuery(this).parent().find('ul');
            ul.show().addClass("expanded");

        });

        jQuery('.list-select ul li').click(function(){
            var root_el = jQuery(this).closest(".list-select");
            jQuery('.result', root_el).html(jQuery(this).text());
            var id = jQuery(this).prop('id');
            jQuery('input[type="hidden"]', root_el).val(id);
            jQuery(this).parent().hide().removeClass("expanded")/*.hide()*/;
            applyFilter();
        });
    });
</script>
