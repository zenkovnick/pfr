<?php include_component('menu', 'member_menu', array('active' => '', 'refer_link' => null)) ?>
<?php slot('title', "The Solution - ERROR {$status_code}") ?>

<div class="wrapper error-page">
    <div class="error-page-wrapper">
        <h1>OOPS!..&nbsp;&nbsp;&nbsp;:(</h1>
        <div class="error-code-status">
            <span class="error-code">ERROR <?php echo $status_code ?></span>
            <span class="error-code-message"><?php echo $status_code_message ?></span>
        </div>
        <div class="error-message">
            <span class="error-status-message"><?php echo $status_message ?></span>
        </div>
    </div>
</div>
