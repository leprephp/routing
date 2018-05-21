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
 * Unsupported method exception.
 *
 * Thrown when try to allow an unsupported HTTP method in a Route object.
 *
 * @see Route::allowMethod()
 * @see Route::allowMethods()
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
class UnsupportedMethodException extends \InvalidArgumentException implements ExceptionInterface
{
    public function __construct(string $method)
    {
        parent::__construct('The method "' . $method . '" is not supported.');
    }
}
