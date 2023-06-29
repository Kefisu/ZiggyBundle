<?php

namespace Kefisu\Bundle\ZiggyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements \Symfony\Component\Config\Definition\ConfigurationInterface
{

    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
       return new TreeBuilder('kefisu_ziggy');
    }
}