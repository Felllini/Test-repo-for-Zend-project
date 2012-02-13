<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

    protected function _initAcl()
    {
        My_Form_Element_Uploadify::bypassSession();
        $fc = Zend_Controller_Front::getInstance();
        $fc->registerPlugin(new Application_Plugin_AccessCheck());
    }

    public function _initNavigation()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');

        $navigation = new My_Navigation(new Zend_Config(require APPLICATION_PATH . DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'navigation.php'));

        Zend_Registry::set('Zend_Navigation',$navigation);

//        $form = new Application_Form_Auth();
//        $view->auth = $form;
    }

    function _initViewRes() {

        $this->bootstrap('view');
        $this->bootstrap('layout');
        $layout=$this->getResource('layout');
        $view=$layout->getView();

        $view->addHelperPath("My/View/Helper", "My_View_Helper");
        return $view;
    }

}

