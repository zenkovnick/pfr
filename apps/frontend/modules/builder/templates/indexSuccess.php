<?php include_partial("home/error"); ?>
<?php include_partial('home/notice'); ?>
<?php include_partial('home/success'); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<div class="form-builder-wrapper">
    <div>
        <form id="<?php echo $risk_builder->getId(); ?>" method="post" id="main_form">
            <?php echo $form->renderGlobalErrors();?>
            <?php echo $form->renderHiddenFields();?>
            <ul>
                <li>
                    <?php include_partial("builder/field", array('field' => $form['name'])); ?>
                </li>
                <li>
                    <?php include_partial("builder/field", array('field' => $form['instructions'])); ?>
                </li>
            </ul>
            <button type="submit">Save and Exit</button>
        </form>
    </div>

    <div class="flight-information-wrapper" style="width: 320px;margin: 0 auto; height: 400px">
        <ul class="flight-information-list" id="flight-information-container" style="height: 600px">
            <?php foreach($flight_information as $flight_information_field):?>
                <li class="<?php echo $flight_information_field->getIsHide() ? 'hidden-field' : "" ?>" style="height: 50px;">
                    <input type="hidden" value="<?php echo $flight_information_field->getId(); ?>" ?>
                    <span class="handler" style="display:inline-block; height: 100%; cursor: pointer">Handler</span>
                    <span><?php echo $flight_information_field->getInformationName() ?></span>
                    <?php if($flight_information_field->getHiddable()): ?>
                        <span class="hiddable">
                        <?php echo $flight_information_field->getIsHide() ? 'Enable Field' : "Disable field" ?>
                    </span>
                    <?php endif ?>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
    <div class="risk-factor-wrapper">
        <ul class="risk-factor-list">
            <?php foreach($risk_factors as $risk_factor): ?>
                <li></li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery( "#flight-information-container").sortable({
            containment: "parent",
            axis: "y",
            handle: "span.handler",
            stop: function() {
                var positions = Array();
                jQuery("#flight-information-container li").each(function(){
                    positions.push(jQuery(this).find("input[type='hidden']").val());
                });
                var json_obj =  JSON.stringify(positions);
                //alert(json_obj);
                jQuery.ajax({
                    url: '<?php echo url_for("@save_flight_info_position") ?>',
                    type: 'POST',
                    data: {ids: json_obj, form_id: jQuery('form').attr('id')},
                    success: function() {

                    }
                })
            }
        });

        jQuery( "#flight-information-container ul, #flight-information-container li" ).disableSelection();
        jQuery("span.hiddable").click(function(){
            var el = jQuery(this);
            var field_id = el.parent('li').find("input[type='hidden']").val();
            var field_hidding = !(el.parent().hasClass('hidden-field'));
            jQuery.ajax({
                url: '<?php echo url_for("@save_form_field_hidding") ?>',
                type: 'POST',
                data: {id: field_id, hidding: field_hidding, form_id: jQuery('form').attr('id')},
                success: function() {
                    if(el.parent().hasClass('hidden-field')) {
                        el.parent().removeClass('hidden-field');
                        el.text("Disable Field");
                    } else {
                        el.parent().addClass('hidden-field');
                        el.text("Enable Field");
                    }

                }
            });
        });
    });
</script>