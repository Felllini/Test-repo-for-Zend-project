<?php

class Application_Model_Users
{

    public  $id;
    public  $firstname;
    public  $lastname;
    public  $image;

    public function getCurrentUserName() {
        $userId = Zend_Auth::getInstance()->getIdentity()->id;
        $userModel = new Application_Model_DbTable_Users();
        $userData = $userModel->getUser($userId);

        $firstname = $userData['firstname'];
        $lastname = $userData['lastname'];

        return $firstname . " " . $lastname;
    }

    public function getUserName(){
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getImageUrl($image = false, $id = false) {
        if (!$image){
            $image = $this->image;
        }

        if (!$id){
            $id = $this->id;
        }

        if ($id){
            $useId = $id;
        } else {
            $useId = current(explode('_', $image));
        }

        if ($image=='')
            $url = '/images/public/no-avatar-200.png'; // .
        else
            $url = '/media/' . $useId . '/ava/' . $image; // .

        return $url;
    }

    // Get users list from DB by role.
    // return array of this class with setted attributes
    public static function getUsersListByRole($role){
        $userModel = new Application_Model_DbTable_Users();
        $users_list = $userModel->getUsersListByRole($role);

        $results_array = array();
        foreach ($users_list as $user_data){
            $user = new Application_Model_Users();
            $user->setUserDataArray($user_data);
            $results_array[] = $user;
        }
        return $results_array;
    }

    // set user attributes
    // insert array $key = this class attribute. $value = this class attribute value
    private function setUserDataArray($data){
        foreach ($data as $key=>$value){
                $this->$key=$value;
        }
    }

    public function getCountryList() {
        $countriesModel = new Application_Model_DbTable_Countries();
        $countryList = $countriesModel->getCountryList();
        return $countryList;
    }

}

