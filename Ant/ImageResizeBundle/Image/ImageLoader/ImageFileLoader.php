<?php
namespace Ant\ImageResizeBundle\Image\ImageLoader;

use Ant\ImageResizeBundle\Image\ImageLoaderInterface;
use Imagine\Image\ImagineInterface;

class ImageFileLoader implements ImageLoaderInterface
{
    private $imagine;

    public function __construct(ImagineInterface $imagine)
    {
        $this->imagine = $imagine;
    }

    /**
     * Load an image
     *
     * @param string @path the path of the image
     *
     * @return Imagine\Imag\ImageInterface
     */
    public function load($path)
    {
        return $this->imagine->open($path);
    }
}