<?php

class My_Form_Element_File extends My_Form_Element_Uploadify
{
    public function setup()
    {
        $options = array('uploader'     => '/flash/uploadify.swf',
            			 'cancelImg'    => '/images/public/cancel.png',
            			 'onSelect'	    => 'function() {}',
            			 'onCancel'     => 'function() {}',
            			 'onComplete'   => 'function() { $(\'#'.$this->getId().'Upload\').parents(\'form:first\').submit(); }',
                         'myShowUpload' => true
                   );
        $this->getView()->headLink()->appendStylesheet('/css/uploadify.css', 'screen');
        $this->getView()->headScript()->appendFile('/js/jquery.uploadify.v2.1.4.min.js')
                                      ->appendFile('/js/swfobject.js')
                                      ->appendScript($this->getJavaScript($options));
        // Rename uploaded file
        $this->addFilter('rename', $this->getRandomFileName());
    }
}