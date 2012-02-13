<?php

class Application_Form_Register extends My_Form
{
    const MAX_FILE_SIZE = 5120000;
    //protected $_formHtmlTagDecoratorOptions = array('tag' => 'div','class' => 'data-form', 'style' => 'float:left');

    public function init()
    {

        $this->addElement('text','firstname',array
        (
            'label' => 'First Name:',
            'id' => 'firstname',
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
                array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'white')),
           ),
             'validators' => array('NotEmpty'),
             'filters' => array('StringTrim','StripTags')
        ));

        $this->addElement('text','lastname',array
        (
            'label' => 'Last Name:',
            'id' => 'lastname',
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
                array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'white')),
           ),
             'validators' => array('NotEmpty'),
             'filters' => array('StringTrim','StripTags')
        ));

        $this->addElement('text','email',array
        (
            'label' => 'Email Address:',
            'id' => 'email',
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
                array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'white')),
           ),
             'validators' => array
             (
                 array('EmailAddress', false, array('messages' => array('emailAddressInvalidHostname' => 'email is invalid!'))),
             ),
             'filters' => array('StringTrim','StripTags')
        ));

        $this->addElement('password','password',array
        (
            'label' => 'Password:',
            'id' => 'password',
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
                 array('StringLength', true, array(6), array('messages'=>'6 characters or more'))
             ),
             'filters' => array('StringTrim','StripTags')
        ));

        $confirmValidator = new My_Validate_EqualInputs('password');

        $this->addElement('password','confirm_pass',array
        (
            'label' => 'Confirm Password:',
            'id' => 'confirm_pass',
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
                array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'white')),
            ),
             'validators' => array($confirmValidator),
             'filters' => array('StringTrim','StripTags')
        ));

//        $this->addElement('checkbox','user',array
//        (
//            'label' => 'User',
//            'decorators' => array
//             (
//                'ViewHelper',
//                 array('Label',array('placement' => Zend_Form_Decorator_Abstract::APPEND)),
//                 array(array('data' => 'HtmlTag'),array('tag' => 'div')),
//                 array(array('row' => 'HtmlTag'), array('tag' => 'span', 'class' => 'chekelement'))
//             ),
//             'filters' => array('StringTrim')
//        ));
//
//        $this->addElement('checkbox','coach',array
//        (
//            'label' => 'Coach',
//            'decorators' => array
//             (
//                'ViewHelper',
//                 array('Label',array('placement' => Zend_Form_Decorator_Abstract::APPEND)),
//                 array(array('data' => 'HtmlTag'),array('tag' => 'div')),
//                 array(array('row' => 'HtmlTag'), array('tag' => 'span', 'class' => 'chekelement'))
//             ),
//             'filters' => array('StringTrim')
//        ));
//
//        $this->addDisplayGroup(
//        array('user', 'coach'),
//                'type',
//
//                array
//                (
//                    'description' => 'Role:',
//                    'decorators' => array
//                    (
//                        'FormElements',
//
//                        array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'check-elements')),
//                        //array('Label', array('tag' => 'div')),
//                        array('Description', array('tag' => 'div', 'class' => 'desc', 'placement' => Zend_Form_Decorator_Abstract::PREPEND)),
//                        array(array('br'=>'HtmlTag'), array('tag' => 'br', 'openOnly' => true, 'class' => 'clear', 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
//                        array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'gray')),
//                    )
//                )
//        );
//
//        $this->addElement(
//            new Zend_Form_Element_Captcha('captcha', array(
//                'ignore'  => true, // игнорируем, чтобы не получать значение элемента при вызове
//                                   // метода getValues() нашей формы
//                'label'   => 'Captcha:',
//                'captcha' => array(
//                               'captcha' => 'ReCaptcha',
//                               //'pubKey'  => '6Lcbq8MSAAAAAMV6wePSTVDU8eHNMPZQ-ejVXLa7', // для получения ключей, нужно зарегистроваться
//                               'pubKey'  => '6Le90cQSAAAAAIKx9fKgF48J1Keq7F1p8UHaeSbu',
//                               //'privKey' => '6Lcbq8MSAAAAANKqisOURNihgq0FNXMMMoXyZ62Q', // в сервисе ReCaptcha
//                               'privKey' => '6Le90cQSAAAAAERWi9Wa_bGKOub0d-IV7NP6wWqd',
//              ),
//
//              'captchaOptions'=> array( 'theme' => 'red', // возможны варианты 'red' | 'white'
//                                                                 // | 'blackglass' | 'clean' | 'custom'
//                                        'lang' => 'ru'),         // здесь также возможны 'en', 'nl',
//                                                                 // 'fr', 'de', 'pt', 'ru', 'es', 'tr'
//
//        // Captcha использует свой собственный декоратор, поэтому, для корректного ее отображения
//        // декоратор должен быть задан примерно следующим образом:
//
//              'decorators' => array(
//                    'Captcha',
//                    'Errors',
//                    array(array('data' => 'HtmlTag'), array('tag' => 'div')),
//                    array('Label', array('class' => 'normal', 'tag' => 'div', 'className' => 'title-name')),
//                    array(array('row' => 'HtmlTag'), array('tag' => 'div'))
//              )
//        )));
//
//
        $this->addElement('image','next',array
        (
            'label' => 'Next',
            'image' => '/images/public/btn-next-2.jpg',
            'class' => 'marginCenter',
            'decorators' => array(
                   'ViewHelper',
                   'Errors',
                   //array(array('data'=>'HtmlTag'), array('tag' => 'div','class' => 'textCenter')),
                   //array(array('row'=>'HtmlTag'),array('tag'=>'div'))
            ),
        ));

        $this->addDisplayGroup(array('next'), 'footerbutton');

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

        $this->setName('Register')
                 ->setMethod('post');
    }


}

