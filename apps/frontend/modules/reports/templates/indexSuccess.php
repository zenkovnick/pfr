<?php slot('header') ?>
<?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<!--[if IE 9]>
<script type="text/javascript" src="/js/jquery.fileupload-ie9.js"></script>
<![endif]-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>

<script type="text/javascript">
    jQuery('body').addClass('settings-page');
    jQuery(document).ready(function(){
    });
</script>

<div class="reports-page">
    <h1>Reports</h1>

    <div class="filter-block">
        <span class="caption">Reports summary by </span>
        <span class="no-margin">
            <input type="hidden" value="<?php echo $account->getId() ?>" class="account-id">
            <div class="list-select report-select">
                <input name="report_type" value="" type="hidden" id="report_type">
                <div class="report_select result">Account</div>
                <ul class="" style="display: none;">
                    <?php foreach($account->getReportTypes() as $type => $value): ?>
                        <li id="<?php echo $type ?>"><?php echo $value ?></li>
                    <?Php endforeach ?>
                </ul>
            </div>
            <div class="list-select options-select">
            </div>
        </span>
        <span class="plus">+</span>
        <span class="no-margin">
            <div class="list-select date-select">
                <input name="date_type" value="" type="hidden" id="date_type">
                <div class="date_select result">all time</div>
                <ul class="" style="display: none;">
                    <?php foreach($account->getReportDateTypes() as $type => $value): ?>
                        <li id="<?php echo $type ?>"><?php echo $value ?></li>
                    <?Php endforeach ?>
                </ul>
                <span class="from-to-date hidden">
                    <span class="from-date">
                        <span class="text">from</span>
                        <input type="text" class="from-date-input" />
                        <input type="hidden" id="from_date_input" value="" />
                    </span>/
                    <span class="to-date">
                        <span class="text">to</span>
                        <input type="text" class="to-date-input" />
                        <input type="hidden" id="to_date_input" value="" />
                    </span>
                </span>
            </div>
        </span>
    </div>



    <a class="generate-pdf-link" href="<?php echo url_for("@reports_pdf?account_id={$account->getId()}&report_type={$report_type}") ?>" >PDF</a>
    <a class="print-link" href="">Print</a>

    <div class="report-wrapper" id="report_wrapper">
        <?php include_component('reports','showReport', array('account' => $account, 'report_type' => $report_type, 'to_pdf' => false)); ?>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(".from-date-input").datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(date) {
                jQuery('span.from-date span.text').text(date);
                jQuery('span.from-date input[type="hidden"]').val(date);
                getData();
            }
        });
        jQuery('.generate-pdf-link').bind('click', generatePDF);
        jQuery('.print-link').bind('click', printReport);

        jQuery(".to-date-input").datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(date) {
                jQuery('span.to-date span.text').text(date);
                jQuery('span.to-date input[type="hidden"]').val(date);
                getData();
            }
        });

        jQuery('.report-select .result').bind('click', listSelect);
        jQuery('.date-select .result').bind('click', listSelect);

        jQuery('.report-select ul li').bind('click', reportTypeSelect);
        jQuery('.date-select ul li').bind('click', dateSelect);
    });

    function printReport(event){
        event.preventDefault();
        var print_plot = jQuery("#report_wrapper").clone();
        jQuery('li.without-value', print_plot).remove();
        print_plot.printArea();
    }

    function generatePDF(event){
        event.preventDefault();
        var id = typeof(jQuery("#report_option").val() == 'undefined') ? "" : jQuery("#report_option").val();
        var date_type = jQuery("#date_type").val();
        var from_date = jQuery("#from_date_input").val();
        var to_date = jQuery("#to_date_input").val();
        window.location.href = jQuery(this).prop('href')+"&id="+id+"&date_type="+date_type+"&date_from"+from_date+"&date_to"+to_date
    }


    function listSelect(){
        jQuery(this).parent().find('ul').removeClass('right-side').removeClass('left-side');
        if ( ( jQuery(this).parent().position().left + 150 ) > jQuery(window).width() ) {
            jQuery(this).parent().find('ul').addClass('right-side');
        }

        jQuery("ul.expanded").trigger("mouseleave").hide().removeClass('expanded');
        var ul = jQuery(this).parent().find('ul');
        ul.show().addClass("expanded");
    }

    function reportTypeSelect(){
        var root_el = jQuery(this).closest(".list-select");
        jQuery('.result', root_el).html(jQuery(this).text());
        var type = jQuery(this).prop('id');
        jQuery('input[type="hidden"]', root_el).val(type);
        jQuery(this).parent().hide().removeClass("expanded")/*.hide()*/;
        if(type!='account'){
            jQuery.ajax({
                url: '<?php echo url_for("@reports_get_options?account_id={$account->getId()}") ?>',
                dataType: 'json',
                data: {report_type: type},
                type: 'get',
                success: function(data){
                    if(data.result == "OK"){
                        jQuery('.options-select').html(data.html);
                    }
                }
            });
        } else {
            jQuery('.options-select').html('');
            getData();
        }
    }

    function dateSelect(){
        var root_el = jQuery(this).closest(".list-select");
        jQuery('.result', root_el).html(jQuery(this).text());
        var id = jQuery(this).prop('id');
        jQuery('#date_type', root_el).val(id);
        jQuery(this).parent().hide().removeClass("expanded")/*.hide()*/;
        if(id == 'date_range'){
            jQuery('span.from-to-date').removeClass('hidden');
        } else {
            if(root_el.hasClass('date-select')){
                jQuery('span.from-to-date').addClass('hidden');
                jQuery('.from-date .text').text('from');
                jQuery('.to-date .text').text('to');
                jQuery('.from-date input').val('');
                jQuery('.to-date input').val('');
            }
            getData();
        }

    }

    function optionSelect(){
        var root_el = jQuery(this).closest(".list-select");
        jQuery('.result', root_el).html(jQuery(this).text());
        var id = jQuery(this).prop('id');
        jQuery('input[type="hidden"]', root_el).val(id);
        jQuery(this).parent().hide().removeClass("expanded")/*.hide()*/;
        getData();
    }

    function getData(){
        var report_type = jQuery("#report_type").val();
        var id = jQuery("#report_option").val();
        var date_type = jQuery("#date_type").val();
        var from_date = jQuery("#from_date_input").val();
        var to_date = jQuery("#to_date_input").val();

        jQuery.ajax({
            url: '<?php echo url_for("@reports?account_id={$account->getId()}") ?>',
            dataType: 'json',
            data: {report_type: report_type, id: id, date_type: date_type, date_from: from_date, date_to: to_date },
            type: 'get',
            success: function(data){
                if(data.result == "OK"){
                    jQuery('.report-wrapper').html(data.html);
                }
            }
        });
    }
</script>

