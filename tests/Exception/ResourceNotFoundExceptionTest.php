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

use Lepre\Routing\Exception\ResourceNotFoundException;
use PHPUnit\Framework\TestCase;

class ResourceNotFoundExceptionTest extends TestCase
{
    public function testMessage()
    {
        $e = new ResourceNotFoundException('Custom explanation');

        $this->assertEquals(
            'Custom explanation',
            $e->getMessage()
        );
    }

    public function testWithoutMessage()
    {
        $e = new ResourceNotFoundException();

        $this->assertEquals(
            'The resource was not found',
            $e->getMessage()
        );
    }
}
