<?php

namespace Isics\SipsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder
            ->root('isics_sips')
                ->children()
                    ->scalarNode('merchant_id')->defaultValue('013044876511111')->end()
                    ->scalarNode('merchant_country')->defaultValue('fr')->end()
                    ->scalarNode('currency_code')->defaultValue(978)->end()
                    ->scalarNode('pathfile')->defaultValue('%kernel.root_dir%/config/sips/pathfile')->end()
                    ->scalarNode('request')->defaultValue('%kernel.root_dir%/../bin/sips/request')->end()
                    ->scalarNode('response')->defaultValue('%kernel.root_dir%/../bin/sips/response')->end()
                    ->arrayNode('options')
                        ->children()
                            ->scalarNode('normal_return_url')->end()
                            ->scalarNode('cancel_return_url')->end()
                            ->scalarNode('automatic_response_url')->end()
                            ->scalarNode('language')->end()
                            ->scalarNode('payment_means')->end()
                            ->scalarNode('header_flag')->end()
                            ->scalarNode('capture_day')->end()
                            ->scalarNode('capture_mode')->end()
                            ->scalarNode('bgcolor')->end()
                            ->scalarNode('block_align')->end()
                            ->scalarNode('block_order')->end()
                            ->scalarNode('textcolor')->end()
                            ->scalarNode('logo_id')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
            ->buildTree();

        return $treeBuilder;
    }
}
