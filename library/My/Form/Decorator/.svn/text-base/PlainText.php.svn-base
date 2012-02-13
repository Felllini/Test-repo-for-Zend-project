<?php

class My_Form_Decorator_PlainText extends Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		$element=$this->getElement();
		
		$view=$element->getView();
		if (!$view instanceof Zend_View_Interface)
		{
			return $content;
		}
		
		$separator=$this->getSeparator();
		$elementContent=$element->getValue();
		
		if ($element instanceof My_Form_Element_Date)
		{
			$elementContent=$view->date($elementContent);
		}
		
		$elementContent.=$view->formHidden($element->getName(),$element->getValue());
										
		switch ($this->getPlacement()) 
		{
			case self::PREPEND:
				return $elementContent . $separator . $content;
			case self::APPEND: default:
				return $content . $separator . $elementContent;
		}
	}
}