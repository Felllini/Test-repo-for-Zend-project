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

        /*
         * message form initialization
         */

        $messageSend = new Application_Form_MessageSend();
        $this->view->form = $messageSend;

        /*
         * message sending
         */

        $messageData = $this->getRequest()->getPost();

        if ($messageSend->isValid($messageData)) {

            $user = $this->getRequest()->getPost('recipient');
            $message = $this->getRequest()->getPost('message');

            $send = new Application_Model_Message();
            $send->sendMessage($user , $message);

        }
    }

}
