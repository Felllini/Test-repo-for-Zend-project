<?php

class My_Form_Decorator_ColorButton extends Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		$element=$this->getElement();
		
		$view=$element->getView();
		if (null === $view) 
		{
			require_once 'Zend/Form/Decorator/Exception.php';
			throw new Zend_Form_Decorator_Exception('ViewHelper decorator cannot render without a registered view object');
		}
		
		$attribs=array();
		$separator=$this->getSeparator();
		$caption=$element->getLabel();
		$name=$element->getFullyQualifiedName();
		$value=$this->getOption('value');
		$color=$this->getOption('color');
		$attribs['color']=$color;
		$size=$this->getOption('size');
		$attribs['size']=$size;
		$id=$element->getId();	        
		$attribs['id']=$id;
		$attribs['type']='submit';
		
		$elementContent = $view->colorButton($name, $caption, $value, $attribs);
		switch ($this->getPlacement()) 
		{
			case self::APPEND:
				return $content . $separator . $elementContent;
			case self::PREPEND:
				return $elementContent . $separator . $content;
			default:
				return $elementContent;
		}
	}
}