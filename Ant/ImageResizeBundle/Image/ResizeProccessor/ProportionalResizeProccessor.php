<?php
namespace Ant\ImageResizeBundle\Image\ResizeProccessor;

use Ant\ImageResizeBundle\Image\ResizeProccessorInterface;
use Imagine\Image\ImageInterface;

class ProportionalResizeProccessor implements ResizeProccessorInterface
{
    public function resize(ImageInterface $image, $with, $height)
    {
        list($width, $height) = $this->scaleImage($image->getImageWidth(), $image->getImageHeight(), $width, $height);

        $image->thumbnailImage($width, $height);
    }

    protected function scaleImage($width, $height, $maximumWidth, $maximumHeight)
    {
        list($nx, $ny) = array($width, $height);

        if ($width >= $maximumWidth || $height >= $maximumHeight) {

            if ($width > 0) {
                $rx = $maximumWidth / $width;
            }
            if ($height > 0) {
                $ry = $maximumHeight / $height;
            }

            if ($rx > $ry) {
                $r = $ry;
            } else {
                $r = $rx;
            }

            $nx = intval($width * $r);

            $ny = intval($height * $r);
        }

        return array($nx, $ny);
    }
}