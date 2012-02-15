<?php

class Application_Model_Message{

    public function __construct(){

        $this->db = new Application_Model_DbTable_Message();

    }

    public function sendMessage($user, $message){

        $this->db->sendToUser($user, $message);

    }


}

