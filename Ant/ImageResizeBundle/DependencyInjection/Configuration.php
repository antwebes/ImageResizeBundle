<?php

namespace Ant\ImageResizeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('image_resize')
                ->isRequired()
                ->children()
                    ->arrayNode('image_loader')
                        ->children()
                            ->scalarNode('imagine_class')->defaultValue('Imagine\Gd\Imagine')->end()
                            ->scalarNode('type')
                                ->isRequired()
                                ->cannotBeEmpty()
                                ->validate()
                                    ->ifNotInArray(array('file', 'gaufrette'))
                                        ->thenInvalid('Invalid type: %s')
                                    ->end()
                            ->end()
                            ->scalarNode('gaufrette_filesystem')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
            ;

        return $treeBuilder;
    }
}