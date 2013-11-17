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

<h1>Reports</h1>
<span>Reports summary by </span>
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
<div class="report-wrapper" style="height:1000px;">
    <?php include_component('reports','account', array('account' => $account)); ?>

</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.list-select .result').bind('click', function(){
            jQuery(this).parent().find('ul').removeClass('right-side').removeClass('left-side');
            if ( ( jQuery(this).parent().position().left + 150 ) > jQuery(window).width() ) {
                jQuery(this).parent().find('ul').addClass('right-side');
            }
//            alert(jQuery(this).parent().position().left);
//            if ( ( jQuery(this).position().left + 150 + jQuery(this).width() ) > jQuery(window).width() ) {
//                jQuery(this).parent().find('ul').addClass('left-side');
//            }


            jQuery("ul.expanded").trigger("mouseleave");
            jQuery("ul.expanded").hide().removeClass('expanded');
            var ul = jQuery(this).parent().find('ul');
            ul.show().addClass("expanded");

        });

        jQuery('.list-select ul li').click(function(){
            var root_el = jQuery(this).closest(".list-select");
            jQuery('.result', root_el).html(jQuery(this).text());
            var type = jQuery(this).prop('id');
            jQuery('input[type="hidden"]', root_el).val(type);
            jQuery(this).parent().hide().removeClass("expanded")/*.hide()*/;


        });
    });
</script>

