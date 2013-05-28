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

<?php if($options['label'] !== false): ?>
    <?php echo $field->renderLabel() ?>
<?php endif ?>

<?php
    echo $field->render($options);
    echo $field->renderError()

?>
