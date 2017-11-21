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

/**
 * RoutesMap
 */
interface RouterMapInterface extends RouterInterface
{
    /**
     * Adds a route.
     *
     * @param Route $route
     */
    public function addRoute(Route $route);

    /**
     * Adds a GET route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function get(string $path, $handler, string $name = null): Route;

    /**
     * Adds a POST route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function post(string $path, $handler, string $name = null): Route;

    /**
     * Adds a PUT route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function put(string $path, $handler, string $name = null): Route;

    /**
     * Adds a PATCH route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function patch(string $path, $handler, string $name = null): Route;

    /**
     * Adds a DELETE route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function delete(string $path, $handler, string $name = null): Route;

    /**
     * Adds a OPTIONS route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function options(string $path, $handler, string $name = null): Route;

    /**
     * Adds a HEAD route.
     *
     * @param string $path
     * @param mixed  $handler
     * @param string $name
     * @return Route
     */
    public function head(string $path, $handler, string $name = null): Route;
}
