<?php slot('header') ?>
    <?php include_partial('menu/header_menu', array('account' => $account)); ?>
<?php end_slot() ?>

<div class="flight">
    <form action="<?php echo url_for("@create_flight?account_id={$account->getId()}") ?>" id="flight_form" method="POST">
        <?php include_partial('flight/form', array('form' => $form, 'data' => $data_fields, 'users' => $users)); ?>
        <button type="submit">Calculate Risk</button>
        <button class="finish-later">Finish Later</button>
    </form>
</div>
<script type="text/javascript">
    function submitFinishLater(event) {
        event.preventDefault();
        var form = jQuery("form");
        form.prop('action', form.prop('action') + "?drafted=true").submit();
    }
    jQuery(document).ready(function(){

    });
    jQuery("button.finish-later").bind('click', submitFinishLater);
</script>