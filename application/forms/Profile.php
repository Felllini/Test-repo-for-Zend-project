<?php

class Application_Form_Profile extends My_Form
{

    const MAX_FILE_SIZE = 5120000;
    const DIR_TMP = '/uploads/';
    protected $_formHtmlTagDecoratorOptions = array('tag' => 'div','class' => 'data-form');

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
               array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'gray')),
             ),
             'filters' => array('StringTrim','StripTags')
        ));

        $confirmValidator = new My_Validate_EqualInputs('password');

        $userModel = new Application_Model_Users();
        $countries = $userModel->getCountryList();
        //print_r($countries);

        $this->addElement('select','country',array
        (
            'label' => 'Country:',
            'id' => 'country',
            'required' => false,
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
             'filters' => array('StringTrim','StripTags'),
             'multiOptions' => $countries,
        ));


//        $this->addElement('text','easytraningpace',array
//        (
//            'label' => 'Easy Training Pace:',
//            'id' => 'easytraningpace',
//            'required' => false,
//            'class' => 'input-valid',
//            'decorators' => array(
//               'ViewHelper',
//               array(array('data'=>'HtmlTag'), array('tag' => 'div', 'class' => 'td-valid-input')),
//               array('RequiredLabel', array('class' => 'normal', 'tag' => 'div', 'requredSymbol' => '<span class="asterisk">*</span>', 'escape' => false, 'requredSymbolPlacement' => Zend_Form_Decorator_Abstract::PREPEND, 'className' => 'title-name')),
//               array(array('openerror' => 'HtmlTag'), array('tag' => 'div', 'class' => 'input-error', 'openOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
//               'Errors',
//               array(array('closeerror' => 'HtmlTag'), array('tag' => 'div', 'closeOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
//               array(array('br'=>'HtmlTag'), array('tag' => 'br', 'openOnly' => true, 'class' => 'clear', 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
//               array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'gray')),
//             ),
//             'filters' => array('StringTrim','StripTags')
//        ));

//        $this->addElement('text','weeklymileage',array
//        (
//            'label' => 'Weekly Mileage:',
//            'id' => 'weeklymileage',
//            'required' => false,
//            'class' => 'input-valid',
//            'decorators' => array(
//               'ViewHelper',
//               array(array('data'=>'HtmlTag'), array('tag' => 'div', 'class' => 'td-valid-input')),
//               array('RequiredLabel', array('class' => 'normal', 'tag' => 'div', 'requredSymbol' => '<span class="asterisk">*</span>', 'escape' => false, 'requredSymbolPlacement' => Zend_Form_Decorator_Abstract::PREPEND, 'className' => 'title-name')),
//               array(array('openerror' => 'HtmlTag'), array('tag' => 'div', 'class' => 'input-error', 'openOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
//               'Errors',
//               array(array('closeerror' => 'HtmlTag'), array('tag' => 'div', 'closeOnly' => true, 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
//               array(array('br'=>'HtmlTag'), array('tag' => 'br', 'openOnly' => true, 'class' => 'clear', 'placement' => Zend_Form_Decorator_Abstract::APPEND)),
//               array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'white')),
//
//             ),
//             'filters' => array('StringTrim','StripTags')
//        ));

        $this->setEnctype('multipart/form-data');
        $this->setAttrib('accept-charset', 'UTF-8');

        //$file = new Zend_Form_Element_File('file');
        $file = new My_Form_Element_File('file');
        $file->setOptions(array(
            'required' => false,
            'label' => 'Upload file:'
        ))
        //->setDestination(realpath(APPLICATION_PATH . self::DIR_TMP))
        ->addValidators(array(
            array('Count',
                true,
                1
            ),
            array('Extension',
                true,
                array(
                    'jpg',
                    'jpeg',
                    'gif',
                    'png'
                )
            ),
            array('Size',
                true,
                self::MAX_FILE_SIZE
            )
        ))
        ->addPrefixPath('My_Form_Decorator', 'My/Form/Decorator/', 'decorator')
        ->setDecorators(array(
            'File',
            'Description',
            array('Uploadify', array('text' => 'Upload')),
            array(array('data'=>'HtmlTag'), array('tag' => 'div')),
            array('RequiredLabel', array('class' => 'normal', 'tag' => 'div', 'className' => 'title-name')),
            array('Errors', array('placement' => 'prepend')),
            array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class' => 'gray'))
        ))->create();
        $this->addElement($file);

        $this->addElement('image','submit',array
        (
            'label' => 'Submit',
            'image' => '/images/public/submit-btn.jpg',
            'decorators' => array(
                   'ViewHelper',
                   'Errors',
                   array(array('data'=>'HtmlTag'), array('tag' => 'div')),
                   array(array('row'=>'HtmlTag'),array('tag'=>'div','class' => 'textCenter'))
            ),
            /*'decorators' => array
             (
                 'ColorButton',
                 array(array('data' => 'HtmlTag'), array('tag' => 'td','colspan' => '2','class' => 'textCenter')),
                 array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
             )*/
        ));

        $this->addDisplayGroup(array('submit'), 'footerbutton');

        $footerbutton = $this->getDisplayGroup('footerbutton');

        $this->setDecorators(array(
               'FormElements',
               array(array('data'=>'HtmlTag'),array('tag'=>'div', 'style'=>'float:left', 'class' => 'data-form')),
               'Form'
       ));

        $this->setName('Profile')
                 ->setMethod('post');
    }


}

