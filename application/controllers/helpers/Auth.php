 <?php

class Application_Controller_Helper_Auth extends Zend_Controller_Action_Helper_Abstract
{
    public function preDispatch()
    {
        $view = $this->getActionController()->view;
        $form = new Application_Form_Auth();

        $request = $this->getActionController()->getRequest();
        if($request->isPost() && $request->getPost('submitauth')) {
            if($form->isValid($request->getPost())) {
                $data = $form->getValues();
                // process data

                $form->processed = true;
            }
        }
        
        $view->authForm = $form;
    }
}
