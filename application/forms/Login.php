`<?php

class Application_Form_Login extends My_Form
{
    const MAX_FILE_SIZE = 5120000;
    protected $_formHtmlTagDecoratorOptions = array('tag' => 'div','class' => 'data-form');

    public function init()
    {

        $this->addElement('text','email',array
        (
            'label' => 'Email:',
            'required' => true,
            'id' => 'email',
            'class' => 'input-valid',
            'decorators' => array(
               'ViewHelper',
               array(array('data'=>'HtmlTag'), array('tag' => 'div', 'class' => 'td-valid-input')),
               array('RequiredLabel', array('class' => 'normal', 'tag' => 'div', 'requredSymbol' => '<span class="asterisk">*</span>', 'escape' => false, 'requredSymbolPlacement' => Zend_Form_Decorator_Abstract::PREPEND, 'className' => 'title-name')),
               array(array('openerror' => 'HtmlTag'), array('tag' => 'div', 'class' => 'input-error', 'openOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
               'Errors',
               array(array('closeerror' => 'HtmlTag'), array('tag' => 'div', 'closeOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
               array(array('br'=>'HtmlTag'), array('tag' => 'br', 'openOnly' => true, 'class' => 'clear', 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
               array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'white')),

             ),
             'validators' => array
             (
                  array('NotEmpty', true, array('messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => 'Required field')))
             ),
             'filters' => array('StringTrim','StripTags')
        ));

        $this->addElement('password','password',array
        (
            'label' => 'Password:',
            'required' => true,
            'class' => 'input-valid',
            'decorators' => array(
               'ViewHelper',
               array(array('data'=>'HtmlTag'), array('tag' => 'div', 'class' => 'td-valid-input')),
               array('RequiredLabel', array('class' => 'normal', 'tag' => 'div', 'requredSymbol' => '<span class="asterisk">*</span>', 'escape' => false, 'requredSymbolPlacement' => Zend_Form_Decorator_Abstract::PREPEND, 'className' => 'title-name')),
               array(array('openerror' => 'HtmlTag'), array('tag' => 'div', 'class' => 'input-error', 'openOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
               'Errors',
               array(array('closeerror' => 'HtmlTag'), array('tag' => 'div', 'closeOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
               array(array('br'=>'HtmlTag'), array('tag' => 'br', 'openOnly' => true, 'class' => 'clear', 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
               array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'gray')),
             ),
             'validators' => array
             (
                  array('NotEmpty', true, array('messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => 'Required field')))
             ),
             'filters' => array('StringTrim','StripTags')
        ));

        $this->addElement('image','submit',array
        (
            'label' => 'Submit',
            'image' => '/images/public/submit-btn.jpg',
            'class' => 'marginCenter',
            'decorators' => array(
                   'ViewHelper',
                   'Errors',
                   //array(array('data'=>'HtmlTag'), array('tag' => 'div','class' => 'textCenter')),
                   //array(array('row'=>'HtmlTag'),array('tag'=>'div'))
            ),
        ));

        $this->addDisplayGroup(array('submit'), 'footerbutton');

        $footerbutton = $this->getDisplayGroup('footerbutton');
        $footerbutton->setDecorators(array(
                    'FormElements',
                    'Fieldset',
                    array('HtmlTag',array('tag'=>'div','class' => 'textCenter removeBorder'))
        ));

        $this->setDecorators(array(
               'FormElements',
               array(array('data'=>'HtmlTag'),array('tag'=>'div', 'style'=>'float:left', 'class' => 'data-form')),
               'Form'
       ));

        $this->setName('Login')
                 ->setMethod('post');
    }
}

