<?php

class Application_Model_DbTable_Message extends Zend_Db_Table_Abstract{

    protected $_name = 'messages';

    public function sendToUser($user, $message){

        $data = array(

            'out' => $message ,
            'in' => $message ,
            'recipient_id' => $user

        );

        $this->insert($data);

    }

}

