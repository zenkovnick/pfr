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

<?php
if(!($field->getWidget() instanceof sfWidgetFormInputHidden)){
    if(isset($label)){
        if($label !== false) {
            echo $field->renderLabel();
        }
    }
    echo "<div class='list-select plane-select'>".$field->render($options)."</div>";
    echo $field->renderError() ;
}


?>
