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

use Lepre\Routing\Route;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Lepre\Routing\Route
 */
class RouteTest extends TestCase
{
    public function testSimpleInitialization()
    {
        $route = new Route('/', 'handler');

        $this->assertEquals('/', $route->getPath());
        $this->assertEquals('handler', $route->getHandler());
        $this->assertEquals(['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS', 'HEAD'], $route->getAllowedMethods());
        $this->assertEquals('/', $route->getName());
    }

    public function testAllowMethodsOnInitialization()
    {
        $route = new Route('/', 'handler', ['GET']);

        $this->assertEquals('/', $route->getPath());
        $this->assertEquals('handler', $route->getHandler());
        $this->assertEquals(['GET'], $route->getAllowedMethods());
        $this->assertEquals('/', $route->getName());
    }

    public function testBindNameOnInitialization()
    {
        $route = new Route('/', 'handler', [], 'home');

        $this->assertEquals('/', $route->getPath());
        $this->assertEquals('handler', $route->getHandler());
        $this->assertEquals(['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS', 'HEAD'], $route->getAllowedMethods());
        $this->assertEquals('home', $route->getName());
    }

    public function testAllowedMethodsManipulation()
    {
        $route = new Route('/', 'handler');

        $route->allowMethod('PATCH');
        $this->assertEquals(['PATCH'], $route->getAllowedMethods());

        $route->allowMethod('DELETE');
        $this->assertEquals(['PATCH', 'DELETE'], $route->getAllowedMethods());

        $route->allowMethods();
        $this->assertEquals(['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS', 'HEAD'], $route->getAllowedMethods());

        $route->allowMethods(['POST']);
        $this->assertEquals(['POST'], $route->getAllowedMethods());

        $route->allowMethod('HEAD');
        $this->assertEquals(['POST', 'HEAD'], $route->getAllowedMethods());
    }

    /**
     * @expectedException \Lepre\Routing\Exception\UnsupportedMethodException
     * @expectedExceptionMessage The method "UNKNOWN" is not supported.
     */
    public function testAllowUnsupportedMethodThrowsException()
    {
        $route = new Route('/', 'handler');
        $route->allowMethod('UNKNOWN');
    }

    /**
     * @expectedException \Lepre\Routing\Exception\UnsupportedMethodException
     * @expectedExceptionMessage The method "UNKNOWN" is not supported.
     */
    public function testAllowUnsupportedMethodsThrowsException()
    {
        $route = new Route('/', 'handler');
        $route->allowMethods(['GET', 'UNKNOWN']);
    }

    public function testBindName()
    {
        $route = new Route('/', 'handler');
        $this->assertEquals('/', $route->getName());
        $route->bindName('home');
        $this->assertEquals('home', $route->getName());
    }
}
