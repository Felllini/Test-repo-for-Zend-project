<?php
/**
 * Created by  Volodymyr Pasika.
 * Date: 15.02.12
 * Time: 10:54
 * Skype: passika_web
 */

class MessageController extends Zend_Controller_Action
{

    public function init(){

        /* Initialize action controller here */

    }

    public function indexAction(){

        $message = new Application_Form_MessageSend();
        $this->view->form = $message;

    }

}
