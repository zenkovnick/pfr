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
        </ul>
    </form>
</div>


<div class="dashboard-content">
    <?php include_partial('dashboard/dashboard_content', array('pager' => $pager)) ?>
</div>

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
        jQuery(this).ajaxSubmit(filter_options);
    }

    function filterSubmitted(data){
        jQuery("div.dashboard-content").html(data.dashboard_data);
    }

    jQuery(document).ready(function(){
        jQuery("#flight_filter").bind('submit', submitFilter);
        jQuery(".plane-filter, .pilot-filter, .date-filter").bind('change', applyFilter);

    });
</script>
