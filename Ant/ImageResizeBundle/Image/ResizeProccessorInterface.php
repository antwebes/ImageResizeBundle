<?php
namespace Ant\ImageResizeBundle\Image;

use Imagine\Image\ImageInterface;

interface ResizeProccessorInterface
{
    public function resize(ImageInterface $image, $with, $height);
}