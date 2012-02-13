<?php

class My_Form_Element_Date extends Zend_Form_Element_Xhtml
{
	protected $_day;
	protected $_month;
	protected $_year;
	
	public function __construct($spec,$options=null)
	{
		$this->addPrefixPath('My_Form_Decorator','My/Form/Decorator','decorator');
		parent::__construct($spec,$options);
	}
	
	public function setValue($value)
	{
		if (is_int($value))
		{
			$dateArray=getdate($value);
			$this->_day=$dateArray['mday'];
			$this->_month=$dateArray['mon'];
			$this->_year=$dateArray['year'];
			
			$this->_value=$this->_year.'-'.$this->_month.'-'.$this->_day;
		}
		elseif (is_string($value))
		{
			$dateArray=getdate(strtotime($value));
			$this->_day=$dateArray['mday'];
			$this->_month=$dateArray['mon'];
			$this->_year=$dateArray['year'];
			
			$this->_value=$this->_year.'-'.$this->_month.'-'.$this->_day;
		}
		elseif (is_array($value))
		{
			if (!empty($value ['year']) && !empty($value ['month']) && !empty($value ['day']))
			{
				$this->_day=$value['day'];
				$this->_month=$value['month'];
				$this->_year=$value['year'];
				
				$this->_value=$this->_year.'-'.$this->_month.'-'.$this->_day;
			}
		}
		else
		{
			throw new Exception('Invalid date value provider');
		}
		
		return $this;
	}
	
	public function getDay()
	{
		return $this->_day;
	}
	
	public function getMonth()
	{
		return $this->_month;
	}
	
	public function getYear()
	{
		return $this->_year;
	}
	
	public function loadDefaultDecorators()
	{
		if ($this->loadDefaultDecoratorsIsDisabled())
		{
			return;
		}
		
		$decorators=$this->getDecorators();
		if (empty($decorators))
		{
			$this->addDecorator('Date')
					 ->addDecorator('Errors')
					 ->addDecorator('Description',array('tag' => 'p', 'class' => 'description'))
					 ->addDecorator('HtmlTag',array('tag' => 'dd'))
					 ->addDecorator('Label',array('tag' => 'dt'));
		}
	}
}