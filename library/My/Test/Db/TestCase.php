<?php
class My_Test_Db_TestCase extends Zend_Test_PHPUnit_DatabaseTestCase {
	public function getConnection() {
		$config = Zend_Registry::get('config');
		$db = new Zend_Db_Adapter_Mysqli($config->resources->db->params);
		$testDb = new Zend_Test_PHPUnit_Db_Connection($db, $config->resources->db->params->dbname);

		return $testDb;
	}

	public function  getDataSet() {
		$connection = $this->getConnection();

		return new Zend_Test_PHPUnit_Db_DataSet_QueryDataSet($connection);
	}
}