<?php

class Application_Model_Message{

    function sendMessage($user, $message){

        $db = new Application_Model_DbTable_Message();
        $db->sendToUser($user, $message);

    }


}

