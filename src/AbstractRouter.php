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
    public function get(string $name, string $path, $handler)
    {
        $this->addRoute(['GET'], $name, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public function post(string $name, string $path, $handler)
    {
        $this->addRoute(['POST'], $name, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public function put(string $name, string $path, $handler)
    {
        $this->addRoute(['PUT'], $name, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public function patch(string $name, string $path, $handler)
    {
        $this->addRoute(['PATCH'], $name, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name, string $path, $handler)
    {
        $this->addRoute(['DELETE'], $name, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public function options(string $name, string $path, $handler)
    {
        $this->addRoute(['OPTIONS'], $name, $path, $handler);
    }

    /**
     * @inheritDoc
     */
    public function head(string $name, string $path, $handler)
    {
        $this->addRoute(['HEAD'], $name, $path, $handler);
    }
}
