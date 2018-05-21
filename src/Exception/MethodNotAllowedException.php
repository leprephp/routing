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
 * The HTTP method of the request is not allowed.
 *
 * This exception should trigger an HTTP 405 response in the application code.
 *
 * @see RouterInterface::match()
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
class MethodNotAllowedException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var string[]
     */
    private $allowedMethods;

    /**
     * @param string[] $allowedMethods
     * @param string   $message
     */
    public function __construct(array $allowedMethods = [], string $message = null)
    {
        $this->allowedMethods = array_map('strtoupper', $allowedMethods);

        if ($message === null) {
            $message = 'The request method is not allowed';
        }

        parent::__construct($message);
    }

    /**
     * @return string[]
     */
    public function getAllowedMethods(): array
    {
        return $this->allowedMethods;
    }
}
