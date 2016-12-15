<?php
/**
 * QIImageExtension.php.
 *
 * @author Quinn Interactive, Inc.
 */

/**
 * StartGeneratedWithDataObjectAnnotator
 * 
 * @property Image|QIImageExtension $owner
 * 
 * EndGeneratedWithDataObjectAnnotator
 */
class QIImageExtension extends DataExtension
{
    # added to make sure thumbnail shows up in UploadField
    private static $summary_fields = array(
        'StripThumbnail' => 'Thumbnail',
        'Name' => 'Name',
        'Title' => 'Title',
    );

    /**
     * Resizes and crops an image to the top of the image.
     *
     * @param $width
     * @param $height
     *
     * @return Image
     */
    public function TopCroppedImage($width, $height)
    {
        return $this->owner->getFormattedImage('TopCroppedImage', $width, $height);
    }

    /**
     * @param object  $gd
     * @param unknown $width
     * @param unknown $height
     *
     * @return unknown
     */
    public function generateTopCroppedImage($gd, $width, $height)
    {

        # resize
        $gd = $gd->resizeByWidth($width);

        # crop to top
        $gd = $gd->crop(0, 0, $width, $height);

        return $gd;
    }

    public function Ratio()
    {
        return $this->owner->getWidth() / $this->owner->getHeight();
    }
    public function RatioPercent()
    {
        return $this->owner->getWidth() / $this->owner->getHeight() * 100;
    }
    public function InvertedRatio()
    {
        return $this->owner->getHeight() / $this->owner->getWidth();
    }
    public function InvertedRatioPercent()
    {
        return $this->owner->getHeight() / $this->owner->getWidth() * 100;
    }
    public function RatioLessThan($ratio)
    {
        return $this->Ratio() < $ratio;
    }
    public function RatioGreaterThan($ratio)
    {
        return $this->Ratio() > $ratio;
    }
    public function WiderThan($width)
    {
        return $this->owner->getWidth() > $width;
    }
    public function WiderThanOrEqual($width)
    {
        return $this->owner->getWidth() >= $width;
    }
    public function TallerThan($height)
    {
        return $this->owner->getHeight() > $height;
    }
    public function TallerThanOrEqual($height)
    {
        return $this->owner->getHeight() >= $height;
    }
    public function Rotate($degrees)
    {
        return $this->owner->getFormattedImage('RotateClockwise');
    }
    public function generateRotate(GD $gd, $degrees = 90)
    {
        return $gd->rotate($degrees);
    }
    public function SetQuality($quality)
    {
        return $this->owner->getFormattedImage('QualityVariantImage', $quality);
    }
    public function generateQualityVariantImage(Image_Backend $backend, $quality)
    {
        $new = clone $backend;
        $new->setQuality($quality);

        return $new;
    }
}
