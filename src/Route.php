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

use Lepre\Routing\Exception\UnsupportedMethodException;

/**
 * Represents a single route.
 *
 * A route is the combination of a path, an handler and a list of HTTP methods. Two routes
 * with some path are allowed only with non-overlapping list of HTTP methods.
 *
 * You can provide also a name for the route, that is used as its identifier within the RouterMap.
 *
 * @see RouterMapInterface::addRoute()
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
final class Route
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var mixed
     */
    private $handler;

    /**
     * @var string[]
     */
    private $methods = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @var string[]
     */
    private static $supportedMethods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS', 'HEAD'];

    /**
     * @param string $path
     * @param mixed  $handler
     * @param array  $methods
     * @param string $name
     */
    public function __construct(string $path, $handler, array $methods = [], string $name = null)
    {
        $this->path = $path;
        $this->handler = $handler;
        $this->methods = $methods;
        $this->name = $name;
    }

    /**
     * Returns the path.
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Returns the handler.
     *
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * Allows an HTTP method.
     *
     * @param string $method The HTTP method to allow
     * @return $this
     * @throws UnsupportedMethodException If the method is not supported
     */
    public function allowMethod(string $method): Route
    {
        if (!in_array($method, self::$supportedMethods)) {
            throw new UnsupportedMethodException($method);
        }

        $this->methods[] = $method;

        return $this;
    }

    /**
     * Allows a list of HTTP methods.
     *
     * @param array $methods The HTTP methods list to allow
     * @return $this
     * @throws UnsupportedMethodException If at least one of the methods is not supported
     */
    public function allowMethods(array $methods = []): Route
    {
        $this->methods = [];
        foreach ($methods as $method) {
            $this->allowMethod($method);
        }

        return $this;
    }

    /**
     * Returns the allowed methods.
     *
     * @return string[]
     */
    public function getAllowedMethods(): array
    {
        return empty($this->methods) ? self::$supportedMethods : $this->methods;
    }

    /**
     * Binds a name to the route.
     *
     * @param string $name
     * @return $this
     */
    public function bindName(string $name): Route
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the name of the route.
     *
     * @return string
     */
    public function getName(): string
    {
        if ($this->name === null) {
            $this->name = $this->path;
        }

        return $this->name;
    }
}
