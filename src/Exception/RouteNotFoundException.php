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

namespace Lepre\Routing\Exception;

/**
 * Route not found exception.
 *
 * Thrown when the requested route does not exist in RouterInterface::generateUrl().
 *
 * @see RouterInterface::generateUrl()
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
class RouteNotFoundException extends \InvalidArgumentException implements ExceptionInterface
{
    /**
     * @param string $routeName
     */
    public function __construct(string $routeName)
    {
        parent::__construct('Cannot generate URI for route "' . $routeName . '": route not found');
    }
}
