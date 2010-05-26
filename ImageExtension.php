<?php
/**
 * ImageExtension.php
 *
 * @author Quinn Interactive, Inc.
 * @package ImageExtension
 */


class ImageExtension extends Extension {

    /**
     * make ResizeByWidth an alias for SetWidth, which is already in Image.php
     * our version annotates with Title
     *
     * @param int     $width
     * @return Image
     */
    public function ResizeByWidth($width) {
        return $this->getAnnotatedImage('SetWidth', $width);
    }


    /**
     * make ResizeByHeight an alias for SetHeight, which is already in Image.php
     * our version annotates with Title
     *
     * @param unknown $height
     * @return Image
     */
    public function ResizeByHeight($height) {
        return $this->getAnnotatedImage('SetHeight', $height);
    }


    /**
     * override built in Image function SetWidth
     *
     * @param int     $width
     * @return Image
     */
    public function SetWidth($width) {
        return $this->getAnnotatedImage('SetWidth', $width);
    }


    /**
     * override built in Image function SetHeight
     *
     * @param unknown $height
     * @return Image
     */
    public function SetHeight($height) {
        return $this->getAnnotatedImage('SetHeight', $height);
    }


    /**
     * override built in Image function SetSize
     *
     * @param string  $size width and height like: '100x200'
     * @return Image
     */
    public function SetSize($size) {
        list($width, $height) = preg_split('/\D/', $size);
        return $this->getAnnotatedImage('SetSize', $width, $height);
    }


    /**
     * Very basic resize, just skews the image if necessary
     * uses $gd->resize(width,height)
     *
     * @param string  $size width and height like: '100x200'
     * @return Image
     */
    public function Resize($size) {
        list($width, $height) = preg_split('/\D/', $size);
        return $this->getAnnotatedImage('Resize', $width, $height);
    }


    /**
     * Adds additional padding if necessary after resizing to width height.
     * uses $gd->paddedResize(width,height)
     *
     * @param string  $size width and height like: '100x200'
     * @return Image
     */
    public function PaddedResize($size) {
        list($width, $height) = preg_split('/\D/', $size);
        return $this->getAnnotatedImage('PaddedResize', $width, $height);
    }


    /**
     * Resizes then crops the image from the centre, to the given width and height.
     * uses $gd->croppedResize(width,height)
     *
     * @param string  $size width and height like: '100x200'
     * @return Image
     */
    public function CroppedResize($size) {
        list($width, $height) = preg_split('/\D/', $size);
        return $this->getAnnotatedImage('CroppedResize', $width, $height);
    }


    /**
     * Resizes an image with a maximum width and height
     * uses $gd->resizeRatio(width,height)
     *
     * @param string  $size width and height like: '100x200'
     * @return Image
     */
    public function ResizeRatio($size) {
        list($width, $height) = preg_split('/\D/', $size);
        return $this->getAnnotatedImage('ResizeRatio', $width, $height);
    }


    /**
     * Resizes and crops an image to the top of the image
     *
     * @param string  $size width and height like: '100x200'
     * @return Image
     */
    public function TopCroppedResize($size) {
        list($width, $height) = preg_split('/\D/', $size);
        return $this->getAnnotatedImage('TopCroppedResize', $width, $height);
    }


    /**
     * Rotates an image to a particular angle
     * uses $gd->rotate(angle)
     *
     * @param int     $angle
     * @return Image
     */
    public function Rotate($angle) {
        return $this->getAnnotatedImage('Rotate', $angle);
    }


    /**
     * Crop's part of image.
     * top y position of left upper corner of crop rectangle
     * left x position of left upper corner of crop rectangle
     * width rectangle width
     * height rectangle height
     * uses:  function crop($top, $left, $width, $height)
     *
     * @param string  $size
     * @return Image
     */
    //     public function Crop($size) {
    //         list($top, $left, $width, $height) = preg_split('/\D/', $size);
    //         return $this->getAnnotatedImage('Crop', $top, $left, $width, $height);
    //     }

    //------------------------------------------------------------------------------------------//
    // Custom Generators


    /**
     *
     *
     * @param object  $gd
     * @param int     $width
     * @param int     $height
     * @return GD
     */
    public function generateResize(GD $gd, $width, $height) {
        return $gd->resize($width, $height);
    }


    /**
     *
     *
     * @param object  $gd
     * @param int     $width
     * @param int     $height
     * @return GD
     */
    public function generatePaddedResize(GD $gd, $width, $height) {
        return $gd->paddedResize($width, $height);
    }


    /**
     *
     *
     * @param object  $gd
     * @param int     $width
     * @param int     $height
     * @return GD
     */
    public function generateCroppedResize(GD $gd, $width, $height) {
        return $gd->croppedResize($width, $height);
    }


    /**
     *
     *
     * @param object  $gd
     * @param int     $width
     * @param int     $height
     * @return GD
     */
    public function generateResizeRatio(GD $gd, $width, $height) {
        return $gd->resizeRatio($width, $height);
    }


    /**
     *
     *
     * @param object  $gd
     * @param int     $angle
     * @return GD
     */
    public function generateRotate(GD $gd, $angle) {
        return $gd->rotate($angle);
    }



    /**
     *
     *
     * @param object  $gd
     * @param unknown $width
     * @param unknown $height
     * @return unknown
     */
    public function generateTopCroppedResize(GD $gd, $width, $height) {

        # resize
        $gd = $gd->resizeByWidth($width);

        # crop to top
        $gd = $gd->crop(0, 0, $width, $height);

        return $gd;
    }




    /*
    public function generateCrop(GD $gd, $top, $left, $width, $height) {
        return $gd->crop($top, $left, $width, $height);
    }
    */


    /**
     *
     *
     * @param int     $width  (optional)
     * @param int     $height (optional)
     * @return string
     */
    function getTag($width = null, $height = null) {
        if ( file_exists( "../" . $this->owner->Filename ) ) {
            $url    = $this->owner->URL();
            $title  = $this->owner->Title;
            $width  = $width ? $width : $this->owner->Width;
            $height = $height ? $height : $this->owner->Height;
            return
            "<img src=\"$url\" alt=\"$title\" height=\"$height\" width=\"$width\" />";
        }
    }


    /**
     * Take the image and make a cached version.
     * Adds passes through Title
     * Based on Image::getFormattedImage()
     *
     * @param string  $format (optional)
     * @param int     $width  (optional)
     * @param int     $height (optional)
     * @return Image
     */
    private function getAnnotatedImage($format = null, $width = null, $height = null) {
        $cached_image = $this->owner->getFormattedImage($format, $width, $height);
        $cached_image->Title = $this->owner->Title;
        return $cached_image;
    }


}


?>
