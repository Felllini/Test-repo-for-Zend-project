<?php

class Application_Model_Friends
{

    public function getUserList() {

        $userModel = new Application_Model_DbTable_Users();
        $userData = $userModel->getUserList();

        return $userData;
    }

}

