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

if(isset($type) && isset($accept)){
    $options['accept'] = $accept;
}

?>


<?php echo $field->renderLabel() ?>

<?php
    echo $field->render($options);
    echo $field->renderError();
?>
