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
 * The adapter interface for the RouterMap.
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
interface RouterMapAdapterInterface extends RouterInterface
{
    /**
     * Adds a generic route.
     *
     * @param Route $route
     */
    public function addRoute(Route $route);
}
