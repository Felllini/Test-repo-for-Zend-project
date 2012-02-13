<?php

require_once "Zend/Form.php";

class My_Form extends Zend_Form
{
	protected $_formHtmlTagDecoratorOptions = array();

	public function __construct($options=null)
	{
		$this->addPrefixPath('My_Form_Decorator','My/Form/Decorator','decorator')
			->addPrefixPath('My_Form_Element','My/Form/Element','element')
			->addElementPrefixPath('My_Form_Decorator','My/Form/Decorator','decorator')
			->addElementPrefixPath('My_Validate','My/Validate','validate')
			->addElementPrefixPath('My_Filter','My/Filter','filter')
			->addDisplayGroupPrefixPath('My_Form_Decorator','My/Form/Decorator');
		parent::__construct($options);
	}

	public function loadDefaultDecorators()
	{
		if ($this->_withFootnote)
		{
			$this->setDescription('<span class="blue">*</span> is required field');
			$this->setDecorators(array
			(
				'FormElements',
				array('HtmlTag',$this->_formHtmlTagDecoratorOptions),
				array('Description',array('placement' => Zend_Form_Decorator_Abstract::APPEND,'class' => 'textRight grey font10','escape' => false)),
				'Form',
			));
		}
		else
		{
			$this->setDecorators(array
			(
				'FormElements',
				array('HtmlTag',$this->_formHtmlTagDecoratorOptions),
				'Form',
			));
		}
	}
}