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
 * MissingParametersException
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
class MissingParametersException extends \InvalidArgumentException implements ExceptionInterface
{
    /**
     * @param string   $routeName
     * @param string[] $missingParams
     */
    public function __construct(string $routeName, array $missingParams)
    {
        parent::__construct(
            'Cannot generate URI for route "' . $routeName . '"; missing parameters: ' . implode(', ', $missingParams)
        );
    }
}
