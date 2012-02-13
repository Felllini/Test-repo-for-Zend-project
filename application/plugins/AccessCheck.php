<?php
class Application_Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract
{
    private $_acl = null;
    private $_auth = null;

    const ACCESS_DENIED = 401;
    /*
     *
     */
    public function __construct()
    {
        $this->_acl = $this->getRole();
        $this->_auth = Zend_Auth::getInstance();
    }

    protected function getRole()
    {
        $acl = new Zend_Acl();

        $acl->addResource('index');

        $acl->addResource('error');

        $acl->addResource('users');
        $acl->addResource('news');
        $acl->addResource('account');
        $acl->addResource('image');

        //$acl->addResource('login', 'users');

        $acl->addRole('guest');

        $acl->addRole('user', 'guest');

        $acl->addRole('admin', 'user');

        $acl->allow('guest', 'index', array('index'));
        $acl->allow('guest', 'error', array('page404'));


        $acl->allow('guest', 'users', array('index', 'login', 'register'));
        $acl->allow('guest', 'news', array('index'));
        $acl->allow('guest', 'image');
        //$acl->deny('guest', 'account', array('index'));

        $acl->allow('user', 'users', array('index' ,'logout'));
        $acl->allow('user', 'account', array('index', 'edit'));
        $acl->deny('user', 'users', array('register', 'login'));


        $acl->allow('admin', 'error');

        Zend_View_Helper_Navigation_HelperAbstract::setDefaultAcl($acl);

        return $acl;
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        // get current controller
        $resource = $request->getControllerName();

        // get current action
        $action = $request->getActionName();


        // get role
        $identity = $this->_auth->getStorage()->read();

        $role = !empty($identity->role) ? $identity->role : 'guest';

        Zend_View_Helper_Navigation_HelperAbstract::setDefaultRole($role);
        //echo $role .' '. $resource .' '. $action . '<br>';
        if (!$this->_acl->isAllowed($role, $resource, $action)) {
            //$request->setControllerName('error')->setActionName('page404');
            //throw new Zend_Acl_Exception("This page is not accessible.", Application_Plugin_AccessCheck::ACCESS_DENIED);
        }
    }
}
