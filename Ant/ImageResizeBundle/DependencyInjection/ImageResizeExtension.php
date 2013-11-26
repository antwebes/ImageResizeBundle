<?php

namespace Ant\ImageResizeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

class ImageResizeExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('image.image_resizer.class', $config['image_loader']['imagine_class']);

        $imageResizerService = sprintf("image_resizer.image_loader.%s", $config['image_loader']['type']);
        $imageResizer = $container->getDefinition('image_resizer.resizer');
        $imageResizer->replaceArgument(0, new Reference($imageResizerService));

        if($config['image_loader']['type'] == 'gaufrette'){
            $imageLoader = $container->getDefinition('image_resizer.image_loader.gaufrette');
            $imageLoader->replaceArgument(1, new Reference($config['image_loader']['gaufrette_filesystem']));
        }
    }
}