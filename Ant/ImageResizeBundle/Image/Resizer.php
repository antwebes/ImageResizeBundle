<?php
namespace Ant\ImageResizeBundle\Image;

class Resizer
{
    private $imageLoader;
    private $resizeProccessors;

    public function __construct(ImageLoaderInterface $imageLoader, array $resizeProccessors)
    {
        $this->imageLoader = $imageLoader;
        $this->resizeProccessors = $resizeProccessors;
    }

    public function resize($path, $with, $height, $method)
    {
        $image = $this->imageLoader->load($path);
        return $this->resizeProccessors[$method]->resize($image, $with, $height);
    }
}