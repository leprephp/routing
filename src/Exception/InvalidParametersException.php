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
 * Invalid parameters exception.
 *
 * Thrown when some parameters are not valid in RouterInterface::generateUrl().
 *
 * @see RouterInterface::generateUrl()
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
final class InvalidParametersException extends \InvalidArgumentException implements ExceptionInterface
{
    /**
     * @param string   $routeName
     * @param string[] $invalidParams
     */
    public function __construct(string $routeName, array $invalidParams)
    {
        parent::__construct(
            'Cannot generate URI for route "' . $routeName . '"; invalid parameters: ' . implode(', ', $invalidParams)
        );
    }
}
