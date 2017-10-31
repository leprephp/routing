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
class RouteResultTest extends TestCase
{
    public function testBasic()
    {
        $result = new RouteResult('controller');

        $this->assertEquals('controller', $result->getController());
        $this->assertEquals([], $result->getParams());
    }

    public function testWithParams()
    {
        $result = new RouteResult('controller2', ['key' => 'value']);

        $this->assertEquals('controller2', $result->getController());
        $this->assertEquals(['key' => 'value'], $result->getParams());
    }
}
