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

?>
<?php if(isset($label)): ?>
    <?php if($label !== false): ?>
        <?php echo $field->renderLabel() ?>
    <?php endif ?>
<?php else: ?>
    <?php echo $field->renderLabel() ?>
<?php endif ?>
<?php
    echo $field->render($options);
    echo $field->renderError()

?>
