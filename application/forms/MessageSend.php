<?php

class Application_Form_MessageSend extends Zend_Form
{

    public function init(){

        /* Form Elements & Other Definitions Here ... */
    }

    public function __construct($options = null){

        parent::__construct($options);

        $this->setName('Messages');

        $recipient = new Zend_Form_Element_Text('recipient');
        $recipient->setLabel('recipient')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $message = new Zend_Form_Element_Textarea('message');
        $message->setLabel('message')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('send');
        $submit ->setAttrib('id', 'send')
                ->setLabel('send');

        $this->addElements(array($recipient, $message, $submit));
    }
}

