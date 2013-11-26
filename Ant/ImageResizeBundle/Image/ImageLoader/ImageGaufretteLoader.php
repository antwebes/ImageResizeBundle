<?php
namespace Ant\ImageResizeBundle\Image\ImageLoader;

use Ant\ImageResizeBundle\Image\ImageLoaderInterface;
use Imagine\Image\ImagineInterface;
use Gaufrette\Filesystem;

class ImageGaufretteLoader implements ImageLoaderInterface
{
    private $imagine;
    private $filesystem;

    public function __construct(ImagineInterface $imagine, Filesystem $filesystem)
    {
        $this->imagine = $imagine;
        $this->filesystem = $filesystem;
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
        $content = $this->filesystem->read($path);
        return $this->imagine->load($content);
    }
}