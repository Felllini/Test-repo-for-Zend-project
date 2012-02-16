<?php
/**
 * Created by  Volodymyr Pasika.
 * Date: 15.02.12
 * Time: 10:54
 * Skype: passika_web
 */

class MessageController extends Zend_Controller_Action{

    public function init(){

        /* Initialize action controller here */

    }

    public function indexAction(){

        $this->messageSend = new Application_Form_MessageSend();
        $this->view->form = $this->messageSend;

        $messageData = $this->getRequest()->getPost();

        if ($this->messageSend->isValid($messageData)) {

            $recipient = $this->getRequest()->getPost('recipient');
            $message = $this->getRequest()->getPost('message');

            $userId = Zend_Auth::getInstance()->getIdentity()->id;
            $this->db = new Application_Model_DbTable_Message();
            $this->db->sendToUser($recipient , $message , $userId);

        }
    }

}
