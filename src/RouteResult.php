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
 * A value object representing the result of the router match.
 *
 * @see RouterInterface::match()
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
class RouteResult
{
    /**
     * @var mixed
     */
    private $handler;

    /**
     * @var array
     */
    private $params;

    /**
     * @param mixed $handler
     * @param array $params
     */
    public function __construct($handler, array $params = [])
    {
        $this->handler = $handler;
        $this->params = $params;
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
     * Returns the parameters list.
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
