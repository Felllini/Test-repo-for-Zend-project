<?php

class My_Form_Element_File extends My_Form_Element_Uploadify
{
    public function setup()
    {
        $elementID = $this->getId();

        $options = array('uploader'     => '/flash/uploadify.swf',
            			 'cancelImg'    => '/images/public/cancel.png',
            			 'onSelect'	    => 'function() { $(\'#'.$elementID.'Upload\').show(); }',
            			 'onCancel'     => 'function() { $(\'#'.$elementID.'Upload\').hide(); }',
            			 'onComplete'   => 'function() { $(\'#'.$elementID.'Upload\').hide().parents(\'form:first\').submit(); }',
                         'myShowUpload' => false
                   );
        $this->getView()->headLink()->appendStylesheet('/css/uploadify.css', 'screen');

        $this->getView()->headScript()->appendFile('/js/jquery.uploadify.v2.1.4.min.js');

        //$this->getView()->headScript()->appendFile('/js/jquery.uploadify.v2.1.4.min.js')
                                      //->appendFile('/js/swfobject.js');
                                      //->appendScript($this->getJavaScript($options));

        $this->addFilter('rename', $this->getRandomFileName());

        /*$baseDir = realpath(APPLICATION_PATH . '/../public/media');
        print_r($_FILES);
        echo "<br>";
        if(file_exists($baseDir)){
            echo "OK";
        } else {
            echo "nima";
        }*/

        //configs/application.ini
    }
}