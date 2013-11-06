<div class="popup-block">
    <h1>Delete an item</h1>
    <p>You are trying to delete a flight report: </p>
    <span class="name">
        <?php echo $flight->getAirportFrom()->getICAO() ? $flight->getAirportFrom()->getICAO() : "" ?>
        <?php echo $flight->getAirportTo()->getICAO() ? "- {$flight->getAirportTo()->getICAO()}" : "" ?>
    </span>
    <span class="info">
        <?php echo date('m/d/Y', strtotime($flight->getDepartureDate()))?>
        <?php if($flight->getTimeStr()): ?>
            ETD <?php echo $flight->getTimeStr(); ?>
        <?php endif ?>
        <?php echo $flight->getTripNumber() ? "({$flight->getPlane()->getTailNumber()})" : "" ?>.<br />
        <?php echo "Submitted ".date('m/d/Y Hi', strtotime($flight->getUpdatedAt()))?>.<br />
    </span>
    <p>Are you sure?</p>
    <div class="button-wrapper">
        <button class='delete_confirm btn btn-red'>Delete</button>
        <button class='delete_cancel btn btn-grey'>Cancel</button>
    </div>

</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
       jQuery('.delete_confirm').bind('click', confirmDelete);
       jQuery('.delete_cancel').click(function(){
           jQuery.fancybox.close();
           return false;
       })
    });

    function confirmDelete() {
        jQuery.ajax({
            url: '<?php echo url_for("@delete_risk_assessment?id={$flight->getId()}") ?>',
            dataType: 'json',
            type: "GET",
            cache: false,
            success: function(data) {
                if(data.result == "OK"){
                    jQuery('ul.flights-list li#<?php echo $flight->getId() ?>').remove();
                } else {
                    alert(data.error);
                }
                jQuery.fancybox.close();
                return false;
            }
        });
    }
</script>
