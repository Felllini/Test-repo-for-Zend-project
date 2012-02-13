<?php

class AccountController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->layout()->getView()->headTitle('View Profile');

        $users = new Application_Model_DbTable_Users();

        $userId = Zend_Auth::getInstance()->getIdentity()->id;
        $userData = $users->getUser($userId);
        $this->view->data = $userData;
    }

    public function editAction()
    {
        $this->_helper->layout()->getView()->headTitle('Manage Profile');

        $userId = Zend_Auth::getInstance()->getIdentity()->id;
        $avaDir = realpath(APPLICATION_PATH . '/../public/media/' . $userId . '/ava');

        $userMediaDir = realpath(APPLICATION_PATH . '/../public/media/');

        $users = new Application_Model_DbTable_Users();

        $userData = $users->getUser($userId);

        $form = new Application_Form_Profile();

        $this->view->form = $form;

            if ($this->getRequest()->isPost()) {

                if ($form->isValid($this->getRequest()->getParams())) {

                    $filePath = $form->getElement('file')->getFileName();
                    $uploadFileName = $form->getElement('file')->getUploadFileName($filePath);

                    if (method_exists($form->getElement('file'), 'isUploadify')) {
                        if (! $form->getElement('file')->isUploadify()) {
                            // Uploadify was not used even it was meant to be, f.e. javascript was disabled
                            $uploadFileName = $userData['image'];
                            $form->getElement('file')->addFilter('rename', $form->getElement('file')->getRandomFileName())->receive();
                        }

                        if(!file_exists($avaDir) && $form->getElement('file')->isUploadify()) {
                            mkdir($userMediaDir . "/" . $userId, 0777);
                            mkdir($path = $userMediaDir . "/" . $userId . "/ava", 0777);
                            copy($filePath, $path . "/" . $uploadFileName);
                        } elseif( $form->getElement('file')->isUploadify()) {
                            $form->getElement('file')->formatDir($avaDir);
                            copy($filePath, $userMediaDir . "/" . $userId . "/ava" . "/" . $uploadFileName);
                        }
                    } else {
                        $form->getElement('file')->addFilter('rename', 'random')->receive();
                    }
                    $users->updateUser($userId, $this->getRequest()->getParam('firstname'), $this->getRequest()->getParam('lastname'), $this->getRequest()->getParam('country'), $uploadFileName);

                    //$userModel = new Application_Model_Users();
                    //$userModel->updateSession($userId);

                    //print_r($_SESSION);
                }
        } else {


        }

        $userData = $users->getUser($userId);
        $form->populate($userData);
        $this->view->data = $userData;
    }


}



