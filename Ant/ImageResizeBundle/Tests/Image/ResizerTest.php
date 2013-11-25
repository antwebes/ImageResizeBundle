<?php
namespace Ant\ImageResizeBundle\Tests\Image;

use Ant\ImageResizeBundle\Image\Resizer;

class ResizerTest extends \PHPUnit_Framework_TestCase
{
    private $resizer;
    private $imageLoader;
    private $resizeProccessors = array();

    public function setUp()
    {
        $this->imageLoader = $this->getMockForAbstractClass('Ant\ImageResizeBundle\Image\ImageLoaderInterface');
        $this->resizeProccessors = $this->getMockedResizeProccessors();
        $this->resizer = new Resizer($this->imageLoader, $this->resizeProccessors);
    }

    public function testResize()
    {
        $imagine = new \Imagine\Gd\Imagine();
        $imagePath = __DIR__.'/fixtures/image.jpg';

        $this->imageLoader
            ->expects($this->once())
            ->method('load')
            ->with($imagePath)
            ->will($this->returnValue($imagine->open($imagePath)));

        $resizedImage = $this->resizer->resize($imagePath, 50, 50, 'adjust');


    }

    private function getMockedResizeProccessors()
    {
        $resizeProccesorKeys = array('crop' => false, 'adjust' => true, "dummy" => false);
        $resizeProccesors = array();

        foreach($resizeProccesorKeys as $resizeProcesorKey => $shouldBeCalled){
            $resizeProccesors[$resizeProcesorKey] = $this->createResizeProccessorMock($shouldBeCalled);
        }

        return $resizeProccesors;
    }

    private function createResizeProccessorMock($shouldBeCalled)
    {
        $resizeProccessor = $this->getMockForAbstractClass('Ant\ImageResizeBundle\Image\ResizeProccessorInterface');

        if($shouldBeCalled){
            $resizeProccessor->expects($this->once())
                ->method('resize');
        }else{
            $resizeProccessor->expects($this->never())
                ->method('resize');
        }

        return $resizeProccessor;
    }
}