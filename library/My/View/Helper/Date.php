<?php

class My_View_Helper_Date extends Zend_View_Helper_Abstract
{
	protected static $_locale = null;
	
	protected static function _getLocale()
	{
		if (self::$_locale===null)
		{
			self::$_locale=Zend_Registry::get('Zend_Locale');
		}
		
		return self::$_locale;
	}
	
	public function date($date,$format=null)
	{
		return self::format($date, $format);
	}
	
	public static function format($date, $format=null)
	{
		$result='';
		if(empty($date) || $date == '0000-00-00' || $date == '0000-00-00 00:00:00')
		{			
			$result='-';
		}
		else
		{
			if ($format===null)
			{
				$format=Zend_Date::DATE_MEDIUM;
			}
			
			if (preg_match('/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}( [0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}){0,1}$/',$date))
			{
				$date=strtotime($date);
			}
			
			$date = new My_Date($date); 
			$result=$date->toString($format,self::_getLocale());
		}
		
		return $result;
	}
}	

