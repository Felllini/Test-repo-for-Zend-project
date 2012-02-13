<?php

class Application_Model_DbTable_Abstract extends Zend_Db_Table_Abstract
{

    public function getItem($id){
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if(!$row) {
            throw new Exception("Нет записи с id - $id");
        }

        return $row->toArray();
    }

    public function getItemsList(){
        return $this->fetchAll()->toArray();
    }

    public function createItem($data)
    {
        if (!$data['id'])
            unset($data['id']);
        
        try{
            $pk = $this->insert($data);
        } catch  (Exception $e) {
            $pk = false;
        }
        return $pk;
    }

    public function deleteItem($id)
    {
        $this->delete('id=' . ((int)$id));
    }

    public function updateItem($data,$id)
    {
        $this->update($data, 'id = ' . (int)$id);
    }
}
?>