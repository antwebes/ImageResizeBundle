<?php
namespace Ant\ImageResizeBundle\Image\ResizeProccessor;

use Ant\ImageResizeBundle\Image\ResizeProccessorInterface;
use Imagine\Image\ImageInterface;
use Imagine\Image\Box;

class ProportionaResizeProccessor implements ResizeProccessorInterface
{
    public function resize(ImageInterface $image, $width, $height)
    {
        $box = $image->getSize();
        list($width, $height) = $this->scaleImage($box->getWidth(), $box->getHeight(), $width, $height);

        return $image->thumbnail(new Box($width, $height));
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