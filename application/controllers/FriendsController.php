<?php

class FriendsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->layout()->getView()->headTitle('Friends');
    }

    public function peopleAction()
    {
        $this->_helper->layout()->getView()->headTitle('People');

        $userModel = new Application_Model_Users;
        $users = $userModel->getUserList();

        $this->view->users = $users;

    }


}



