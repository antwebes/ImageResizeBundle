<?php
namespace Ant\ImageResizeBundle\Image;

interface ImageLoaderInterface
{
    /**
     * Load an image
     *
     * @param string @path the path of the image
     *
     * @return Imagine\Imag\ImageInterface
     */
    public function load($path);
}