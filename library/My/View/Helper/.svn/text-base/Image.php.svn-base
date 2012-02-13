<?php
class My_View_Helper_Image extends Zend_View_Helper_Abstract
{
    private $_name = null;
    private $_width = null;
    private $_height = null;
    private $_src = null;
    private $_imagePath = null;
    private $_fileName = null;
    private $_imgMime = null;
    private $_validMime = array(
            'image/png',
            'image/jpeg',
            'image/jpg',
            'image/gif'
    );

    public function image($name, $imagePath=null,
                          $attribs = array(),
                          $action=null) {
        // set name
        $this->_name = $this->view->escape($name);

        // set path
        $this->_setImagepath($imagePath);

        // set attributes
        $this->_setAttributes($attribs);

        // add action to image (e.g. generate thumbnail)
        // default action set dimensions
        if(!$this->_setAction($action)) {
            $this->_setDimensions();
        }

        // render image
        return $this->_render();
    }

    /**
     * Return image relative path
     *
     * @return string
     */
    public function getImagePath() {
        return $this->_imagePath;
    }

    /**
     * Return image src
     *
     * @return string
     */
    public function getSrc() {
        return $this->_src;
    }

    /**
     * Return image width
     *
     * @return string
     */
    public function getWidth() {
        return $this->_width;
    }

    /**
     * Return image height
     *
     * @return string
     */
    public function getHeight() {
        return $this->_height;
    }

    /**
     * Return image name
     *
     * @return string
     */
    public function getImageName() {
        return $this->_fileName;
    }

    /**
     * Set new image after a specific action applied  on the current image
     *
     * @param string $path
     * @return self
     */
    public function setNewImage($path, $width = null, $height = null) {
        // set image new path
        $this->_setImagepath($path);

        if($width !== null) {
            $this->_width = $width;
        }

        if($height !== null) {
            $this->_height = $height;
        }
    }

    /**
     * render image html tag
     *
     * @return string
     */
    protected function _render() {
        $xhtml  = '<img src="' . $this->_src . '" ' .
                  $this->_attribs . ' id="' . $this->_name . '"';
        $xhtml .= !empty($this->_width)? ' width="' . $this->_width . '"' : '';
        $xhtml .= !empty($this->_height)? ' height="' . $this->_height . '"' : '';

        $endTag = " />";
        if (($this->view instanceof Zend_View_Abstract)
            && !$this->view->doctype()->isXhtml()) {
            $endTag= ">";
        }
        return $xhtml . $endTag;
   }

   /**
    * Retrieve image sizes and type
    * APPLICATION_PUBLIC constants needed for path to public root
    *
    * @todo add cache beacuse getimagesize() is expensive to use.
    * @return boolean
    */
   protected function _setDimensions() {
      // get image size
      $path = realpath(APPLICATION_PATH . '/../public') . $this->_imagePath;

      if(!$imgInfo = @getimagesize($path)) {
             return false;
      }
      // is image mime allowed
      if(!in_array($imgInfo['mime'] , $this->_validMime)) {
         return false;
      }
      // set image info
      $this->_imgMime = $imgInfo['mime'];
      $this->_height = $imgInfo[1];
      $this->_width  = $imgInfo[0];
      return true;
    }

    /**
     * Set image path
     *
     * @param string $path
     * @return self
     */
    protected function _setImagepath($path) {
        $this->_imagePath = $path;
        $this->_fileName = basename($path);
        $this->_src = $this->view->baseUrl($path, true);
        return $this;
    }

    /**
     * Set image attributes
     *
     * @param array $attribs
     * @return self
     */
    protected function _setAttributes($attribs) {
        $alt = '';
        $class = '';
        $map = '';
        $class  = '';
        if(isset($attribs['alt'])) {
            $alt = 'alt="' . $this->view->escape($attribs['alt']) . '" ';
        }

        if(isset($attribs['title'])) {
            $title = 'title="' . $this->view->escape($attribs['title']) . '" ';
        } else {
            $title = 'title="' . $this->view->escape($attribs['alt']) . '" ';
        }

        if(isset($attribs['map'])) {
            $map = 'usemap="#' . $this->view->escape($attribs['map']) . '" ';
        }

        if(isset($attribs['class'])) {
            $class = 'class="' . $this->view->escape($attribs['class']) . '" ';
        }
        $this->_attribs = $alt . $title . $map . $class;
        return $this;
    }

    /**
     * Set specific action your image. e.g. resize image, crop, etc...
     *
     * @param string $action
     * @return boolean
     */
    protected function _setAction($actionCallback) {
        if($actionCallback === null) {
            return false;
        }

        $options = null;
        $action = $actionCallback;
        if(is_array($actionCallback)) {
            $action = $actionCallback[0];
            $options = $actionCallback[1];
        }
        $actionClass = 'My_View_Helper_Image_Action_' . ucfirst($action);
        $actionClass = new $actionClass($options);

        // if action class is not valid then return false
        if(!$actionClass instanceof My_View_Helper_Image_ActionInterface) {
            return false;
        }
        return $actionClass->build($this);
    }
}
