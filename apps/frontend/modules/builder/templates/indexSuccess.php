<?php include_partial("home/error"); ?>
<?php include_partial('home/notice'); ?>
<?php include_partial('home/success'); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<div>
    <ul>
        <li>
            <?php include_partial("builder/field", array('field' => $form['name'])); ?>
        </li>
        <li>
            <?php include_partial("builder/field", array('field' => $form['instructions'])); ?>
        </li>
    </ul>
</div>

<div class="wrapper" style="width: 300px;margin: 0 auto; height: 400px">
    <ul id="flight-information-container" style="height: 600px">
        <?php foreach($flight_information as $flight_information_field):?>
            <li style="height: 50px;">
                <span class="handler">Handler</span>
                <span><?php echo $flight_information_field->getInformationName() ?><span>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

<script type="text/javascript">
    jQuery(function() {
        jQuery( "#flight-information-container").sortable({
            containment: "parent",
            axis: "y",
            handle: "span.handler"
        });

        jQuery( "#flight-information-container ul, #flight-information-container li" ).disableSelection();
    });
</script>