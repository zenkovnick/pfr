<?php
/**
 * Created by JetBrains PhpStorm.
 * User: stmax
 * Date: 10.09.12
 * Time: 15:07
 * To change this template use File | Settings | File Templates.
 */
class widgetFormSelectRadioImageLabels extends sfWidgetFormSelectRadio
{
    protected function configure($options = array(), $attributes = array())
    {
        parent::configure($options, $attributes);

        $this->addOption('image_source', '');
    }

    protected function formatChoices($name, $value, $choices, $attributes)
    {
        $inputs = array();
        foreach ($choices as $key => $option)
        {
            $baseAttributes = array(
                'name'  => substr($name, 0, -2),
                'type'  => 'radio',
                'value' => self::escapeOnce($key),
                'id'    => $id = $this->generateId($name, self::escapeOnce($key)),
            );

            if (strval($key) == strval($value === false ? 0 : $value))
            {
                $baseAttributes['checked'] = 'checked';
            }
            $imagePath = '';
            if($this->getOption('image_source')) {
                $imagePath = $this->getOption('image_source') . '/';
            }
            $inputs[$id] = array(
                'input' => $this->renderTag('input', array_merge($baseAttributes, $attributes)),
                'label' => $this->renderContentTag('label', image_tag( $imagePath . self::escapeOnce($option)), array('for' => $id)),
            );
        }

        return call_user_func($this->getOption('formatter'), $this, $inputs);
    }
}
