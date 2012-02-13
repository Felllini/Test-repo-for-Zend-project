<?php
class My_Db_Table extends Zend_Db_Table_Abstract {
	/**
	 *
	 * Creates record in DB
	 *
	 * @param Application_Model_Abstract $item - the model object that should be saved
	 * @return int|bool - record ID if successful and false if not
	 */

	public function createItem(Application_Model_Abstract $item) {
		try {
			$data = $this->checkFields($item->getData());
			$id = $this->insert($data);
		} catch (Zend_Db_Exception $e) {
			throw $e;
		} catch (Exception $e) {
			if ($e->getCode() == My_Db_Exception_Unique::ITEM_NOT_UNIQUE)
				throw new My_Db_Exception_Unique ("Item not unique");
			else
				return false;
		}

		return $id;
	}

	/**
	 *
	 * Updates record in DB
	 *
	 * @param Application_Model_Abstract $item - the item to get data from
	 * @param int $id - primary key
	 */

	public function updateItem(Application_Model_Abstract $item, int $id) {
		
	}

	private function checkFields($data) {
		$cols = array_values($this->_getCols());
		foreach ($data as $k => $v) {
			if (!in_array($k, $cols))
				unset($data[$k]);
		}
		foreach ($cols as $column) {
			if (!isset($data[$column]))
				$data[$column] = null;
		}

		return $data;
	}

	public function getItem($id) {
		return $this->fetchRow("id = $id")->toArray();
	}
}