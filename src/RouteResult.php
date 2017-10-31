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
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
class RouteResult
{
    /**
     * @var mixed
     */
    private $controller;

    /**
     * @var string[]
     */
    private $params;

    /**
     * RouteResult constructor.
     *
     * @param mixed    $controller
     * @param string[] $params
     */
    public function __construct($controller, array $params = [])
    {
        $this->controller = $controller;
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return string[]
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
