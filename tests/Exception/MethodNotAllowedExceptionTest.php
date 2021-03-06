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

namespace Lepre\Routing\Tests\Exception;

use Lepre\Routing\Exception\MethodNotAllowedException;
use PHPUnit\Framework\TestCase;

final class MethodNotAllowedExceptionTest extends TestCase
{
    public function testMessage()
    {
        $e = new MethodNotAllowedException([], 'Custom explanation');

        $this->assertEquals(
            'Custom explanation',
            $e->getMessage()
        );
    }

    public function testWithoutMessage()
    {
        $e = new MethodNotAllowedException();

        $this->assertEquals(
            'The request method is not allowed',
            $e->getMessage()
        );
    }

    public function testGetAllowedMethods()
    {
        $e = new MethodNotAllowedException(['get', 'POST', 'pAtCh']);

        $this->assertEquals(
            ['GET', 'POST', 'PATCH'],
            $e->getAllowedMethods()
        );
    }
}
