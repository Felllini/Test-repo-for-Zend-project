<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {   
        $userId = $this->getRequest()->getParam('id');
        
        $users = new Application_Model_DbTable_Users();
        
        $user = $users->getUser($userId);
        if($user) {
            $userData = $user;  
        } else {
            $this->_helper->redirector('pageNotFound','user');
        }
        
        $this->view->userData = $userData;
    }                             

    public function loginAction()
    {
        $this->_helper->layout()->getView()->headTitle('Sign In');
        if (Zend_Auth::getInstance()->hasIdentity()) {
            $this->_helper->redirector('index', 'index');
        } 

    
        $form = new Application_Form_Login();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();
            

            if ($form->isValid($formData)) {

                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
                
                $authAdapter->setTableName('users')
                    ->setIdentityColumn('email')
                    ->setCredentialColumn('password');
                
                $username = $this->getRequest()->getPost('email');
                $password = md5($this->getRequest()->getPost('password'));
                
                $authAdapter->setIdentity($username)
                    ->setCredential($password);
                

                $auth = Zend_Auth::getInstance();
                
                $result = $auth->authenticate($authAdapter);
                

                if ($result->isValid()) {
                    $identity = $authAdapter->getResultRowObject();
                    
                    $authStorage = $auth->getStorage();
                    
                    $authStorage->write($identity);
                    
                    $this->_helper->redirector('index', 'index');
                } else {
                    $this->view->errMessage = 'Username or password is incorrect';
                }
            }
        }
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index', 'index');
    }

    public function registerAction()
    {
        $this->_helper->layout()->getView()->headTitle('Runner Registration - Account Details - Step 1');
        
        $role = 'user';
        $form = new Application_Form_Register();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {               
                //$_SESSION['userData'] = array('email' => $formData['email'], 'password' =>$formData['password'], 'first-step-url' => $this->getRequest()->getActionName());
                
                $email = $form->getValue('email');
                
                // Извлекаем название фильма
                $password = md5($form->getValue('password'));
                
                // Создаём объект модели
                $users = new Application_Model_DbTable_Users();
                
                
                // Вызываем метод модели addMovie для вставки новой записи
                if($form->getValue('coach') == 1){
                    $role = 'coach';
                    //print_r($formData);  
                }
                
                $users->createUser($email, $password, $role);
                
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
                
                // указываем таблицу, где необходимо искать данные о пользователях
                // колонку, где искать имена пользователей,
                // а также колонку, где хранятся пароли
                $authAdapter->setTableName('users')
                    ->setIdentityColumn('email')
                    ->setCredentialColumn('password');
                
                // подставляем полученные данные из формы
                $authAdapter->setIdentity($email)
                    ->setCredential($password);
                
                $auth = Zend_Auth::getInstance();
                
                // делаем попытку авторизировать пользователя
                $result = $auth->authenticate($authAdapter);
                
                // если авторизация прошла успешно
                if ($result->isValid()) {
                    // используем адаптер для извлечения оставшихся данных о пользователе
                    $identity = $authAdapter->getResultRowObject();
                    
                    // получаем доступ к хранилищу данных Zend
                    $authStorage = $auth->getStorage();
                    
                    $authStorage->write($identity);
                    
                    $this->_helper->redirector('register2', 'user');
                } 
            } else {
                $this->view->errMessage = 'Form data is not valid';
            }
        } 
    }

    public function register2Action()
    {
        $this->_helper->layout()->getView()->headTitle('Runner Registration - Account Details - Step 2');
         
        //if(!isset($_SESSION['userData'])) {
            //$this->_helper->redirector('register', 'user');  
        //}
        
        /*if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('register3', 'user'); 
        }*/
    }

    public function register3Action()
    {
        $this->_helper->layout()->getView()->headTitle('Runner Registration - Account Details - Step 2');
    }

    public function viewAction()
    {
        $this->_helper->layout()->getView()->headTitle('View Profile');
        
        $users = new Application_Model_DbTable_Users();
        
        $userId = Zend_Auth::getInstance()->getIdentity()->id;
        $userData = $users->getUser($userId);
        $this->view->data = $userData;
    }

    public function manageAction()
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
                    $users->updateUser($userId, $this->getRequest()->getParam('firstname'), $this->getRequest()->getParam('lastname'), $this->getRequest()->getParam('location'), $uploadFileName);
                    
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













