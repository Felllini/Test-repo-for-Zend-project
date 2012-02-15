<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    protected $_name = '`';

    public function createUser($email, $password, $role, $firstname, $lastname){
        $data = array(
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'firstname' => $firstname,
            'lastname' => $lastname,
        );

        $this->insert($data);
    }

    public function updateUser($id, $firstname, $lastname, $country, $picture)
    {
        $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'country' => $country,
            'image' => $picture
        );

        $this->update($data, 'id = ' . (int)$id);
    }

    public function getUserName($id)
    {
        $id = (int)$id;

        // Используем метод fetchRow для получения записи из базы.
        // В скобках указываем условие выборки (привычное для вас where)
        $data = $this->select()
             ->from('users',
                    array('firstname', 'lastname'))
             ->where('id = ?', $id);

        if(!$data) {
            throw new Exception("Нет записи с id - $id");
        }

        return $data->toArray();

    }

    public function getUsersListByRole($role = 'user')
    {
        $data = $this->select()
             ->from('users',
                    array('firstname', 'lastname', 'id', 'image'))
             ->where('role = ?', $role);

        return $data->query()->fetchAll();
    }

    /*public function getUserData($id)
    {
        $select = $this->select()
                 ->from('users')
                 ->where('id = ?', $id);
        $stmt = $select->query();
        $result = $stmt->fetchAll();
        return $result;
    }*/

    public function getUser($id)
    {
        $id = (int)$id;

        $row = $this->fetchRow('id = ' . $id);

        if(!$row) {
            return '';
        }

        return $row->toArray();
    }
}

