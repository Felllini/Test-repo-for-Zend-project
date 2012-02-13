<?php

class My_Form_Decorator_Date extends Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		$element=$this->getElement();
		if (!$element instanceof My_Form_Element_Date)
		{
			return $content;
		}
		
		$view=$element->getView();
		if (!$view instanceof Zend_View_Interface)
		{
			return $content;
		}
		
		$separator=$this->getSeparator();
		$day=$element->getDay();
		$month=$element->getMonth();
		$year=$element->getYear();
		$name=$element->getFullyQualifiedName();
		$class=$this->getOption('class');
		$dayClass=$this->getOption('dayClass');
		$monthClass=$this->getOption('monthClass');
		$yearClass=$this->getOption('yearClass');
		$dateSeparator=$this->getOption('dateSeparator');
		$disabled=$this->getOption('disabled');
		if (empty($dateSeparator)) $dateSeparator='&nbsp;';
		$datePositionFormat=$this->getOption('datePositionFormat');
		if (empty($datePositionFormat)) $datePositionFormat='d-m-y';
		$datePositionFormatArray=array_flip(explode('-',strtolower($datePositionFormat)));
		
		$language=Zend_Registry::isRegistered('Zend_Locale') ? Zend_Registry::get('Zend_Locale')->getLanguage() : key(Zend_Locale::getDefault());
		$localeMonthList=Zend_Locale_Data::getList($language,'months');
		
		if (!empty($disabled))
		{
			$dayParams['disabled']=$monthParams['disabled']=$yearParams['disabled']=$disabled;
		}
		if (!empty($dayClass) || !empty($class))
		{
			$dayParams['class']=$dayClass.(empty($dayClass) ? $class : ' '.$class);
		}
		if (!empty($monthClass) || !empty($class))
		{
			$monthParams['class']=$monthClass.(empty($monthClass) ? $class : ' '.$class);
		}
		//$yearParams=array('size' => '4','maxlength' => '4');
		if (!empty($yearClass) || !empty($class))
		{
			$yearParams['class']=$yearClass.(empty($yearClass) ? $class : ' '.$class);
		}
		
		$daysList=array('0'=>'day')+range(0,31);
		$monthList=array('0'=>'month')+$localeMonthList['format']['wide'];
		$yearRange=array_reverse(range(1900,date('Y')));
		$yearList=array('0'=>'year')+array_combine($yearRange,$yearRange);
		$datePositionFormatArray['d']=$view->formSelect($name.'[day]',$day,$dayParams,$daysList);
		$datePositionFormatArray['m']=$view->formSelect($name.'[month]',$month,$monthParams,$monthList);
		$datePositionFormatArray['y']=$view->formSelect($name.'[year]',$year,$yearParams,$yearList);
		
		$elementContent=implode($dateSeparator,$datePositionFormatArray);
										
		switch ($this->getPlacement()) 
		{
			case self::PREPEND:
				return $elementContent . $separator . $content;
			case self::APPEND: default:
				return $content . $separator . $elementContent;
		}
	}
}