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

use Lepre\Routing\Exception\RouteNotFoundException;
use PHPUnit\Framework\TestCase;

class RouteNotFoundExceptionTest extends TestCase
{
    public function testMessage()
    {
        $e = new RouteNotFoundException('routeName');

        $this->assertEquals(
            'Cannot generate URI for route "routeName": route not found',
            $e->getMessage()
        );
    }
}
