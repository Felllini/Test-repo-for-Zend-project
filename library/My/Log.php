<?php
class My_Log {
	protected static $_instance = null;
	protected static $_logger = null;
	
	private function  __construct(Zend_Log_Writer_Abstract $writer = null) {
		$logFile = Zend_Registry::get('config')->path->logFile;

		if (!file_exists($logFile)) {
			$fp = @fopen($logFile, "a");
			if ($fp === false) {
				throw new Zend_Log_Exception("Log file is not writable at [".$logFile."] path.");
			}
		}

		$writer = new Zend_Log_Writer_Stream($logFile);
		self::$_logger = new Zend_Log($writer);
	}

	public static function log($message, $priority, $extras = null) {
		$log = My_Log::getInstance();
		self::$_logger->log($message, $priority, $extras);
	}

	public static function getInstance() {
		if (is_null(self::$_instance)) {
			$name = __CLASS__;
			self::$_instance = new $name();
		}

		return self::$_instance;
	}
}