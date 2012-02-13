<?php
class My_Db_Exception_Unique extends Zend_Db_Exception {
	const ITEM_NOT_UNIQUE = 23000;

	public function  __construct($msg = '', $code = 0, Exception $previous = null) {
		parent::__construct("The object is not unique", self::ITEM_NOT_UNIQUE, $previous);
	}
}