<?php

/*
 * This file is part of the Lepre package.
 *
 * (c) Daniele De Nobili <danieledenobili@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Lepre\Routing\Bridge\AuraRouter;

use Aura\Router\Exception\RouteNotFound;
use Aura\Router\RouterContainer;
use Lepre\Routing\Exception\MethodNotAllowedException;
use Lepre\Routing\Exception\ResourceNotFoundException;
use Lepre\Routing\Exception\RouteNotFoundException;
use Lepre\Routing\Route;
use Lepre\Routing\RouteResult;
use Lepre\Routing\RouterMapAdapterInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * AuraRouterMapAdapter
 */
final class AuraRouterMapAdapter implements RouterMapAdapterInterface
{
    /**
     * @var RouterContainer
     */
    private $container;

    /**
     * @var \Aura\Router\Map
     */
    private $map;

    /**
     * @param RouterContainer $container
     */
    public function __construct(RouterContainer $container = null)
    {
        $this->container = $container ?: new RouterContainer();
        $this->map = $this->container->getMap();
    }

    /**
     * @inheritDoc
     */
    public function match(ServerRequestInterface $request): RouteResult
    {
        $matcher = $this->container->getMatcher();
        $route = $matcher->match($request);

        if (!$route) {
            $failedRoute = $matcher->getFailedRoute();

            if ($failedRoute) {
                if ($failedRoute->failedRule === 'Aura\Router\Rule\Allows') {
                    throw new MethodNotAllowedException($failedRoute->allows);
                }
            }

            throw new ResourceNotFoundException();
        }

        return new RouteResult($route->handler, $route->attributes);
    }

    /**
     * @inheritDoc
     */
    public function generateUrl(string $routeName, array $params = []): string
    {
        try {
            return $this->container->getGenerator()->generateRaw($routeName, $params);
        } catch (RouteNotFound $e) {
            throw new RouteNotFoundException($routeName);
        }
    }

    /**
     * @inheritDoc
     */
    public function addRoute(Route $route)
    {
        $this->map
            ->route($route->getName(), $route->getPath(), $route->getHandler())
            ->allows($route->getAllowedMethods())
        ;
    }
}
