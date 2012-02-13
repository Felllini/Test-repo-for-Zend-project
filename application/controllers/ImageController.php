<?php
class ImageController extends Zend_Controller_Action {
    function resizeAction() {
        $this->_helper->viewRenderer->setNoRender();

        $this->_helper->layout()->disableLayout();

        $Image = new My_Image();

        $filename = '..' . $_GET['filename'];

        $im   = $Image->readImage($filename);

        $new  = $Image->resize($im, $_GET['width'], $_GET['height'], true);
        $type = $Image->filenameToMime($filename);

        header("Content-type:image/jpeg");
        header('Expires: ' . date('r',time() + 864000));
        header("Pragma: public");
        header("Cache-Control: public");
        $Image->writeImage($new, $type);
    }
}
