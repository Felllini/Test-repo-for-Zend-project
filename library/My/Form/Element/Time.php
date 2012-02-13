<?php

require_once 'Zend/Form/Element/Xhtml.php';

/**
 * Phone number form element.
 * 
 * This will render 3 text fields for parts of phone number - country code, operator code and subscriber number
 * The values of these three fields jointly will be considered as the value.
 * Optionally, a separator can be used between these fields. This separator can be ignored from/included in value
 *
 * @author	Anis uddin Ahmad <anisniit@gmail.com>
 * @example
 *      $primaryPhone = new Project_Form_Element_Phone('primary_phone');

        $primaryPhone->setLabel('Primary phone')
                  ->setAttrib('class' ,'some class' )
                  ->setAttrib('separator' ,'#' )  // Separator between Phone number parts
                  ->setAttrib('ignoreSeparator', true)  // Ignore seperators from in field value
                  ->setDescription('Phone number format: XXX # XXXX # XXXXXX')
                  ->setValue(isset($data['primary_phone']) ? $data['primary_phone'] : '')
                  ->addValidator('digits');

        $form->addElement($primaryPhone);
 *
 * Phone number format : XXX-XXXX-XXXXXX
 */
class My_Form_Element_Time extends Zend_Form_Element_Xhtml
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'timeElement';
    
    public $options;

    /**
     * Length of phone number parts
     * 
     * @var array
     */
    public $codeLength = array(
        'self' => 2,
        'operator' => 2,
        'country' => 2
    );

    /**
     * Should separators exclude from value or not
     * Default is true (exclude them)
     * 
     * @var boolean
     */
    public $ignoreSeparator = true;

    public function __construct($field_name, $attributes = null, $data_item = null) {
        $this->options = $data_item;

        // Set special attributes for Phone number
        if(!isset($attributes['codeLength'])){
            $attributes['codeLength'] = $this->codeLength;
        }
        if(!isset($attributes['ignoreSeparator'])){
            $attributes['ignoreSeparator'] = $this->ignpreSeparator;
        }

        parent::__construct($field_name, $attributes);
    }

    /**
     * Validate element value
     *
     * Note: The *filtered* value is validated.
     *
     * @param  mixed $value
     * @param  mixed $context
     * @return boolean
     */
    public function isValid($value, $context = null)
    {    
        $attributes = $this->getAttribs();
        
        //$sep  = ($attributes['separator'] && !$attributes['ignoreSeparator'])? $attributes['separator'] : '';
        $sep  = '';
        $name = $this->getName();
        //print_r($name);
        //print_r($context[$name]);
        //$joinedValue = $context[$name . '_country'] . $sep . $context[$name . '_operator'] . $sep . $value;
        
        //print_r($context);
        //$values = array($name . '_country' => $context[$name . '_country'], $name . '_operator' => $context[$name . '_operator'], $name => $context[$name]);
        echo '<br>';

        $values = $context[$name . '_country'] . $sep . $context[$name . '_operator'] . $sep . $context[$name];
        //return parent::isValid($joinedValue, $context);
        /*return parent::isValid($context[$name . '_country'], $context);
        return parent::isValid($context[$name . '_operator'], $context);
        return parent::isValid($context[$name], $context);*/
        return parent::isValid($values, $context);
    }

}
