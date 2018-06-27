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

namespace Lepre\Routing\Tests;

use Lepre\Routing\RouteResult;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Lepre\Routing\RouteResult
 */
final class RouteResultTest extends TestCase
{
    public function testBasic()
    {
        $result = new RouteResult('handler');

        $this->assertEquals('handler', $result->getHandler());
        $this->assertEquals([], $result->getParams());
    }

    public function testWithParams()
    {
        $result = new RouteResult('handler', ['key' => 'value']);

        $this->assertEquals('handler', $result->getHandler());
        $this->assertEquals(['key' => 'value'], $result->getParams());
    }
}
