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
 * The requested content type is not supported.
 *
 * This exception should trigger an HTTP 406 response in the application code.
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
class NotAcceptableException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var string[]
     */
    private $acceptedTypes;

    /**
     * @param string[]   $acceptedTypes
     * @param string     $message
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct(array $acceptedTypes = [], $message = null, $code = 0, \Exception $previous = null)
    {
        $this->acceptedTypes = $acceptedTypes;

        if ($message === null) {
            $message = 'The requested content type is not supported';
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string[]
     */
    public function getAcceptedContentTypes(): array
    {
        return $this->acceptedTypes;
    }
}
