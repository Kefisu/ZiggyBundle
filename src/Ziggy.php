<?php

namespace Kefisu\Bundle\ZiggyBundle;

use JsonException;
use Symfony\Component\Routing\RouterInterface;
use Kefisu\Bundle\ZiggyBundle\Contract\ZiggyInterface;

class Ziggy implements ZiggyInterface
{
    public function __construct(
        private RouterInterface $router,
    ){
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function getRoutes(): array
    {
        $routes = [];
        foreach ($this->router->getRouteCollection()->all() as $name => $route) {
            $routes[$name] = [
                'uri' => $route->getPath(),
                'methods' => empty($route->getMethods()) === false ? $route->getMethods() : ['GET']
            ];
        }

        return $routes;
    }

    public function toArray(): array
    {
        $routingContext = $this->router->getContext();
        $baseUrl = sprintf(
            '%s://%s',
            $routingContext->getScheme(),
            $routingContext->getHost(),
        );

        if ($routingContext->getHttpsPort() !== 443) {
            $baseUrl = sprintf('%s:%s', $baseUrl, $routingContext->getHttpsPort());
        }

        return [
            'url' => $baseUrl,
            'port' => parse_url($baseUrl)['port'] ?? null,
            'defaults' => [],
            'routes' => $this->getRoutes(),
        ];
    }

    /**
     * @throws JsonException
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }
}