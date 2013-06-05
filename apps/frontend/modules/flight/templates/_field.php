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
            echo $field->renderLabel();
        }
        echo $field->render($options);
        echo $field->renderError() ;
    }


?>
