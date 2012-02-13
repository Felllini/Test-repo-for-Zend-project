<?php
class My_View_Helper_Image_Action_Small
    implements My_View_Helper_Image_ActionInterface
{
    public function build($imageInstance) {
        // add your code to generate thumbnail
        return $this->_test($imageInstance);
    }

    /**
     * Test method to generate the thumbnail
     *
     * @return boolean
     */
    private function _test($imageInstance) {
        // dir to where you want to save the thumbnail image
        $relativePath = dirname($imageInstance->getImagePath()) . '/small/';
        $dir = realpath(APPLICATION_PATH . '/../public') . '/' . $relativePath;

        // create the directory if it does not exist
        clearstatcache();
        if(!is_dir($dir)) {
            mkdir($dir, 0777);
        }
        // name of the image based on the size of the thumbnail
        // @todo the sizes can be in config file/database. for not its hard coded
        $newFileName = '200x200' . '_'  . $imageInstance->getImageName();
        $thumbPath = $dir . $newFileName;

        // if thumbnail exists then set new image and return false
        if(file_exists($thumbPath)) {
            $imageInstance->setNewImage($relativePath . $newFileName);
            return false;
        }

        // resize image
        $image = new My_Image();
        // open original image to resize it
        // set the thumnail sizes
        // set new image path and quality
        $image->open(realpath(APPLICATION_PATH . '/../public/') . $imageInstance->getImagePath())
              ->resize(200, 200)
              ->save($thumbPath, 9);

        // pass new image details to image view helper
        $imageInstance->setNewImage($relativePath . $newFileName, $image->getWidth(), $image->getHeight());
        return true;
    }
}
