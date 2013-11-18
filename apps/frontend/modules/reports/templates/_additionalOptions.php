<input name="report_option" value="" type="hidden" id="report_option">
<div class="option_select result">Select</div>
<ul class="" style="display: none;">
    <?php foreach($options as $id => $value): ?>
        <li id="<?php echo $id ?>"><?php echo $value ?></li>
    <?Php endforeach ?>
</ul>

<script type="text/javascript">
    jQuery('.options-select .result').bind('click', listSelect);
    jQuery('.options-select ul li').bind('click', optionSelect);
</script>
