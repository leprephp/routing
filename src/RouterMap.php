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

namespace Lepre\Routing;

use Psr\Http\Message\ServerRequestInterface;

/**
 * RouterMap
 */
class RouterMap implements RouterMapInterface
{
    /**
     * @var RouterMapInterface
     */
    private $adapter;

    /**
     * @param RouterMapInterface $adapter
     */
    public function __construct(RouterMapInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @inheritDoc
     */
    public function match(ServerRequestInterface $request): RouteResult
    {
        return $this->adapter->match($request);
    }

    /**
     * @inheritDoc
     */
    public function generateUrl(string $routeName, array $params = []): string
    {
        return $this->adapter->generateUrl($routeName, $params);
    }

    /**
     * @inheritDoc
     */
    public function addRoute(Route $route)
    {
        $this->adapter->addRoute($route);
    }

    /**
     * Adds a GET route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function get(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['GET'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * Adds a POST route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function post(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['POST'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * Adds a PUT route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function put(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['PUT'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * Adds a PATCH route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function patch(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['PATCH'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * Adds a DELETE route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function delete(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['DELETE'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * Adds a OPTIONS route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function options(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['OPTIONS'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * Adds a HEAD route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function head(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['HEAD'], $name);

        $this->addRoute($route);

        return $route;
    }
}
