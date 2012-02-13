<?php

abstract class Application_Model_Abstract
{
	protected $_data = array();
	protected $_underscoreCache = array();

	/**
	 * @param array|null $dataArray - associative array with fields to set for the object
	 */
	public function __construct($dataArray = array()) {
		if (isset($this->DbTable)) {
			$dataArray['db_table'] = $this->DbTable;
		}

		$this->setDataArray($dataArray);

		return $this;
	}

	public function  __set($name, $value) {
		throw new Exception("Cannot access properties directly through ".__CLASS__."::__set($name, \$value) method. User setKeyName() method instead.");
	}

	public function  __get($name) {
		throw new Exception("Cannot access properties directly through ".__CLASS__."::__get($name) method. User getKeyName() method instead.");
	}

	public function __call($method, $args) {
		if (method_exists($this, $method)) {
			call_user_method($method, $this, isset($args[0]) ? $args[0] : null);
		}
		switch (substr($method, 0, 3)) {
			case 'get':
				$key = $this->_underscore(substr($method, 3));
				return isset($this->_data[$key]) ? $this->_data[$key] : null;
			case 'set':
				$key = $this->_underscore(substr($method, 3));
				return $this->_data[$key] = isset($args[0]) ? $args[0] : null;
			case 'uns':
			case 'has':
			default:
				break;
		}
		throw new Exception("Invalid method ".__CLASS__."::".$method."(".print_r($args, 1).")");
	}

	public function getData() {
		return $this->_data;
	}

    public function getById($id){

        if ($id){
            $dbItem = $this->getDbTable();
            $itemData = $dbItem->getItem($id);
            $this->setDataArray($itemData);
        }

        return $this;
    }

	public function load($id) {
		return $this->getById($id);
	}

    public function save($data = null) {

		if (!is_null($data)) {
			$this->setDataArray($data);
		}

        $dbItem = $this->getDbTable();

		if(isset($this->id) && !is_null($this->getId()) && $this->getId()){
			$dbItem->updateItem($this, $this->getId());
        } else {
			$id = $dbItem->createItem($this);
			if ($id){
				$this->setId($id);
			}
		}

		return (int)$this->getId();
    }

    public function delete($id = false){
        $dbItem = $this->getDbTable();

        if (!$id){
            $id = $this->id;
        }

        if ($id){
            $dbItem->deleteItem($id);
        }
    }

    public function setDataArray($data){
        foreach ($data as $key => $value){
            $method = 'set'.$this->_camelize($key);
			$this->$method($value);
        }
    }

    public function getDataArray(){
        return $this->_data;
    }

    public function getFormatedDate($format = 1,$date){
        //TODO: if needed more formats write here
        switch($format){
            case 2:
                $format_str = 'Y-m-d';
                break;
            case 1:
            default:
                $format_str = 'M d, Y';

        }


        return date($format_str,$date);
    }

	/**
	 * Got from Varien_Object in Magento
	 *
	 * $this->setMyField($data) === $this->my_field = $data;
	 *
	 * @param string $name - string to convert
	 */
	protected function _underscore($name) {
		if (isset($this->_underscoreCache[$name])) {
			return $this->_underscoreCache[$name];
		}

		$result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
		$this->_underscoreCache[$name] = $result;

		return $result;
	}

	protected function _camelize($key) {
		return str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
	}

	public function getDbTable() {
		$class = $this->_data['db_table'];
		return new $class();
	}
}