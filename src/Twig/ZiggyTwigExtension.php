<?php

namespace Kefisu\Bundle\ZiggyBundle\Twig;

use Kefisu\Bundle\ZiggyBundle\Contract\ZiggyInterface;
use Symfony\Component\Routing\RouterInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ZiggyTwigExtension extends AbstractExtension
{
    public function __construct(
        private ZiggyInterface $ziggy,
    ){}

    public function getFunctions()
    {
        return [
            new TwigFunction('routes', [$this, 'getRoutes'], ['is_safe' => ['html']]),
        ];
    }

    public function getRoutes(): string
    {
        return '<script>window.Ziggy = ' . $this->ziggy->toJson() . '; console.log(window.Ziggy)  </script>';
    }
}