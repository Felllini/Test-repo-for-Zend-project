<?php

class Application_Model_DbTable_Message extends Zend_Db_Table_Abstract{

    protected $_name = 'messages';

    public function sendToUser($user, $message , $userId){

        $data = array(

            'sender_id' => $userId ,
            'out' => $message ,
            'in' => $message ,
            'recipient_id' => $user,
            'sender_status' => 1

        );

        $this->insert($data);

    }

    public function checkNewMessage($id){

        $result = $this->select()
                       ->from('messages' , array('id'))
                       ->where('recipient_id = ?', $id);

        $data = $result->query();
        return $data->fetchAll();
    }
}

