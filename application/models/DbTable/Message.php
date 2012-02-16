<?php

class Application_Model_DbTable_Message extends Zend_Db_Table_Abstract{

    protected $_name = 'messages';

    public function sendToUser($user, $message , $userId){

        $data = array(

            'sender_id' => $userId ,
            'out' => $message ,
            'in' => $message ,
            'recipient_id' => $user

        );

        $this->insert($data);

    }

}

