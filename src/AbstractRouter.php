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
 * AbstractRouter
 */
abstract class AbstractRouter implements RouterMapInterface
{
    /**
     * @inheritDoc
     */
    public function get(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['GET'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * @inheritDoc
     */
    public function post(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['POST'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * @inheritDoc
     */
    public function put(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['PUT'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * @inheritDoc
     */
    public function patch(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['PATCH'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['DELETE'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * @inheritDoc
     */
    public function options(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['OPTIONS'], $name);

        $this->addRoute($route);

        return $route;
    }

    /**
     * @inheritDoc
     */
    public function head(string $path, $handler, string $name = null): Route
    {
        $route = new Route($path, $handler, ['HEAD'], $name);

        $this->addRoute($route);

        return $route;
    }
}
