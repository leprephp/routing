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
     * @param array  $methods
     * @param string $name
     * @param string $path
     * @param mixed  $handler
     */
    public function addRoute(array $methods, string $name, string $path, $handler);

    /**
     * Adds a GET route.
     *
     * @param string $name
     * @param string $path
     * @param mixed  $handler
     */
    public function get(string $name, string $path, $handler);

    /**
     * Adds a POST route.
     *
     * @param string $name
     * @param string $path
     * @param mixed  $handler
     */
    public function post(string $name, string $path, $handler);

    /**
     * Adds a PUT route.
     *
     * @param string $name
     * @param string $path
     * @param mixed  $handler
     */
    public function put(string $name, string $path, $handler);

    /**
     * Adds a PATCH route.
     *
     * @param string $name
     * @param string $path
     * @param mixed  $handler
     */
    public function patch(string $name, string $path, $handler);

    /**
     * Adds a DELETE route.
     *
     * @param string $name
     * @param string $path
     * @param mixed  $handler
     */
    public function delete(string $name, string $path, $handler);

    /**
     * Adds a OPTIONS route.
     *
     * @param string $name
     * @param string $path
     * @param mixed  $handler
     */
    public function options(string $name, string $path, $handler);

    /**
     * Adds a HEAD route.
     *
     * @param string $name
     * @param string $path
     * @param mixed  $handler
     */
    public function head(string $name, string $path, $handler);
}
