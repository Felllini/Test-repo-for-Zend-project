<?php

class UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $userId = $this->getRequest()->getParam('id');

        $users = new Application_Model_Users();

        $user = $users->getUser($userId);
        if($user) {
            $userData = $user;
        } else {
            $this->_helper->redirector('page404','error');
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
        $this->_helper->layout()->getView()->headTitle('Registration');

        $role = 'user';
        $form = new Application_Form_Register();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {
                //$_SESSION['userData'] = array('email' => $formData['email'], 'password' =>$formData['password'], 'first-step-url' => $this->getRequest()->getActionName());


                $email = $form->getValue('email');
                $password = md5($form->getValue('password'));
                $firstname = $form->getValue('firstname');
                $lastname = $form->getValue('lastname');


                // Создаём объект модели
                $users = new Application_Model_DbTable_Users();


                $users->createUser($email, $password, $role, $firstname, $lastname);

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

                    $this->_helper->redirector('index', 'index');
                }
            } else {
                $this->view->errMessage = 'Form data is not valid';
            }
        }

    }


}









