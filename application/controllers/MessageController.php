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
        $this->db = new Application_Model_DbTable_Message();
        $this->userId = Zend_Auth::getInstance()->getIdentity()->id;
        $this->result = $this->db->checkNewMessage($this->userId);

        $this->view->count = (count($this->result) > 0) ? '(' . count($this->result) . ')' : '' ;

    }

    public function indexAction(){

        $this->messageSend = new Application_Form_MessageSend();
        $this->view->form = $this->messageSend;

        $messageData = $this->getRequest()->getPost();

        if ($this->messageSend->isValid($messageData)) {

            $this->recipient = $this->getRequest()->getPost('recipient');
            $this->message = $this->getRequest()->getPost('message');

            $this->db->sendToUser($this->recipient , $this->message , $this->userId);

        }

    }

}
