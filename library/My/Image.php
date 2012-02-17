<?php
class My_Image
{
    protected $_filename = '';
    protected $_image = '';
    protected $_width = '';
    protected $_height = '';
    protected $_mimeType = '';
    protected $_view = null;
    const IMAGETYPE_GIF = 'gif';
    const IMAGETYPE_JPEG = 'jpeg';
    const IMAGETYPE_PNG = 'png';
    const IMAGETYPE_JPG ='jpg';

    public function setView($view)
    {
        $this->_view = $view;
    return $this;
    }

    protected function _newDimension($forDim,$maxWidth,$maxHeight)
    {
      if ($this->_width > $maxWidth)
      {
          $ration = $maxWidth/$this->_width;
          $newwidth = round($this->_width*$ration);
          $newheight = round($this->_height*$ration);
          if ($newheight > $maxHeight)
          {
            $ration = $maxHeight/$newheight;
            $newwidth = round($newwidth*$ration);
            $newheight = round($newheight*$ration);

            if($forDim == 'w')
                return $newwidth;
            else
                return $newheight;
          }
          else
          {
            if($forDim == 'w')
                return $newwidth;
            else
                return $newheight;
          }
      }
      else if ($this->_height > $maxHeight)
      {
        $ration = $maxHeight/$this->_height;
        $newwidth = round($this->_width*$ration);
        $newheight = round($this->_height*$ration);
        if ($newwidth > $maxWidth)
        {
            $ration = $maxWidth/$newwidth;
            $newwidth = round($newwidth*$ration);
            $newheight = round($newheight*$ration);
            if($forDim == 'w')
                return $newwidth;
            else
                return $newheight;
        }
        else
        {
            if($forDim == 'w')
                return $newwidth;
            else
                return $newheight;
        }
      }
      else
      {
        if($forDim == 'w')
            return $this->_width;
        else
            return $this->_height;
      }
    }

    public function open($filename)
    {
        $this->_filename = $filename;
        $this->_setInfo();
        /*echo $this->_mimeType;
        die; */
        $mime = substr(strrchr($this->_mimeType, '/'), 1 );

        switch($mime) {
            case self::IMAGETYPE_GIF:
                $this->_image = imagecreatefromgif($this->_filename);
            break;
            case self::IMAGETYPE_JPEG:
            case self::IMAGETYPE_JPG:
                $this->_image = imagecreatefromjpeg($this->_filename);
            break;
            case self::IMAGETYPE_PNG:
                $this->_image = imagecreatefrompng($this->_filename);
            break;
            default:
            throw new Exception('Image extension is invalid or not supported.');
            break;
        }
    return $this;
    }

    protected function _output($_saveIn=null, $_quality, $_filters=null)
    {
        $mime = substr(strrchr($this->_mimeType, '/'), 1 );
        switch($mime) {
            case self::IMAGETYPE_GIF:
                return imagegif($this->_image, $_saveIn);
            break;
            case self::IMAGETYPE_JPEG:
            case self::IMAGETYPE_JPG:
                $_quality = is_null($_quality)? 9 : $_quality;
                return imagejpeg($this->_image, $_saveIn, $_quality);
            break;
            case self::IMAGETYPE_PNG:
                $_quality = is_null($_quality)? 0 : $_quality;
                $_filters = is_null($_filters)? null : $_filters;
                return imagepng($this->_image, $_saveIn, $_quality, $_filters);
            break;
            default:
                throw new Exception('Image cannot be created.');
            break;
        }
    }

    public function display($_quality=null, $_filters=null)
    {
        if($this->_view instanceof Zend_View) {
            $this->_view->getResponse()->setHeader('Content-Type', $this->_mimeType);
        } else {
            header('Content-Type', $this->_mimeType);
        }
        return $this->_output(null,$_quality, $_filters);
    }

    public function save($_saveIn=null, $_quality=null, $_filters=null)
    {
        return $this->_output($_saveIn,$_quality, $_filters);
    }

    public function __destruct()
    {
        @imagedestroy($this->_image);
    }

    protected function _setInfo()
    {
        //die($this->_filename);
        $imgSize = @getimagesize($this->_filename);
        if(!$imgSize) {
            throw new Exception('Could not extract image size.');
        } elseif($imgSize[0] == 0 || $imgSize[1] == 0) {
            throw new Exception('Image has dimension of zero.');
        }
        $this->_width = $imgSize[0];
        $this->_height = $imgSize[1];
        $this->_mimeType = $imgSize['mime'];
    }

    public function getWidth()
    {
        return $this->_width;
    }

    public function getHeight()
    {
        return $this->_height;
    }

    protected function _refreshDimensions()
    {
        $this->_height = imagesy($this->_image);
        $this->_width = imagesx($this->_image);
    }

    /**
     * If image is GIF or PNG keep transparent colors
     *
     * @credit http://github.com/maxim/smart_resize_image/tree/master
     * @param $image src of the image
     * @return the modified image
     */
    protected function _handleTransparentColor($image=null)
    {
        $image = is_null($image)? $this->_image : $image;

        if ( ($this->_mimeType == self::IMAGETYPE_GIF) || ($this->_mimeType == self::IMAGETYPE_PNG) ) {
              $trnprt_indx = imagecolortransparent($this->_image);

              // If we have a specific transparent color
              if ($trnprt_indx >= 0) {
                // Get the original image's transparent color's RGB values
                $trnprt_color    = imagecolorsforindex($this->_image, $trnprt_indx);

                // Allocate the same color in the new image resource
                $trnprt_indx    = imagecolorallocate($image, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

                // Completely fill the background of the new image with allocated color.
                imagefill($image, 0, 0, $trnprt_indx);

                // Set the background color for new image to transparent
                imagecolortransparent($image, $trnprt_indx);
              } elseif ($this->_mimeType == self::IMAGETYPE_PNG) {
                 // Always make a transparent background color for PNGs that don't have one allocated already
                // Turn off transparency blending (temporarily)
                imagealphablending($image, false);

                // Create a new transparent color for image
                $color = imagecolorallocatealpha($image, 0, 0, 0, 127);

                // Completely fill the background of the new image with allocated color.
                imagefill($image, 0, 0, $color);

                // Restore transparency blending
                imagesavealpha($image, true);
              }
         return $image;
        }
    }

    /**
     * Resize image based on max width and height
     *
     * @param integer $maxWidth
     * @param integer$maxHeight
     * @return resized image
     */
    public function resize($maxWidth, $maxHeight)
    {
        if ($this->_width < $maxWidth && $this->_height < $maxHeight) {
            $this->_handleTransparentColor();
            return $this;
        }

        $newWidth = $this->_newDimension('w', $maxWidth, $maxHeight);
        $newHeight = $this->_newDimension('h', $maxWidth, $maxHeight);

           $newImage = imagecreatetruecolor( $newWidth, $newHeight );
        $this->_handleTransparentColor($newImage);
        imagecopyresampled($newImage, $this->_image, 0, 0, 0, 0, $newWidth, $newHeight, $this->_width, $this->_height);

        $this->_image = $newImage;
        $this->_refreshDimensions();
     return $this;
    }
}
