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
    public function get(string $path, $handler, string $name = null)
    {
        $this->addRoute($path, $handler, ['GET'], $name);
    }

    /**
     * @inheritDoc
     */
    public function post(string $path, $handler, string $name = null)
    {
        $this->addRoute($path, $handler, ['POST'], $name);
    }

    /**
     * @inheritDoc
     */
    public function put(string $path, $handler, string $name = null)
    {
        $this->addRoute($path, $handler, ['PUT'], $name);
    }

    /**
     * @inheritDoc
     */
    public function patch(string $path, $handler, string $name = null)
    {
        $this->addRoute($path, $handler, ['PATCH'], $name);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $path, $handler, string $name = null)
    {
        $this->addRoute($path, $handler, ['DELETE'], $name);
    }

    /**
     * @inheritDoc
     */
    public function options(string $path, $handler, string $name = null)
    {
        $this->addRoute($path, $handler, ['OPTIONS'], $name);
    }

    /**
     * @inheritDoc
     */
    public function head(string $path, $handler, string $name = null)
    {
        $this->addRoute($path, $handler, ['HEAD'], $name);
    }
}
