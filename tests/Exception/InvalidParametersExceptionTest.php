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

use Lepre\Routing\Exception\InvalidParametersException;
use PHPUnit\Framework\TestCase;

class InvalidParametersExceptionTest extends TestCase
{
    public function testMessage()
    {
        $e = new InvalidParametersException('routeName', ['param1', 'param2']);

        $this->assertEquals(
            'Cannot generate URI for route "routeName"; invalid parameters: param1, param2',
            $e->getMessage()
        );
    }
}
