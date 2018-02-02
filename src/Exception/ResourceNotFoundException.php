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
 * The resource was not found.
 *
 * This exception should trigger an HTTP 404 response in the application code.
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
class ResourceNotFoundException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @param string $message
     */
    public function __construct(string $message = null)
    {
        if ($message === null) {
            $message = 'The resource was not found';
        }

        parent::__construct($message);
    }
}
