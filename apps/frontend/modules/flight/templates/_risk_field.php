<?php
$options = array();
if(isset($class)){
    $options['class'] = $class;
}
if(isset($placeholder))
    $options['placeholder'] = $placeholder;

if(isset($disabled) && $disabled){
    $options['disabled'] = 'disabled';
}

if(isset($help)){

}

?>

<div class="risk-factor-wrapper">
    <div class="risk-factor-question-wrapper">
        <span class="risk-factor-question"><?php echo isset($label) ? $field->renderLabel(): ''?></span>
        <?php if(isset($help) && $help): ?>
            <a href="" class="show-help-link">(Help?)</a>
            <p class="help-message hidden"><?php echo $help ?></p>
        <?php endif ?>
    </div>
    <div class="response-option-list">
        <?php echo $field->render($options); ?>
    </div>
    <div class="risk-note-wrapper">
        <span class="risk">
                <?php echo $risk ?>
        </span>
        <span class="note">
                <?php echo $note ?>
        </span>
    </div>
</div>