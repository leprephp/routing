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
use Lepre\Routing\RouteResult;
use Lepre\Routing\RouterMap;
use Lepre\Routing\RouterMapAdapterInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class RouterMapTest extends TestCase
{
    public function testMatchCallsInternalAdapterImplementation()
    {
        $adapter = $this->createMock(RouterMapAdapterInterface::class);
        $request = $this->createMock(ServerRequestInterface::class);
        $result = new RouteResult('fake handler');

        $adapter->expects($this->once())
            ->method('match')
            ->with($request)
            ->willReturn($result);

        /**
         * @var RouterMapAdapterInterface $adapter
         * @var ServerRequestInterface    $request
         * @var RouteResult               $result
         */

        $this->assertEquals($result, (new RouterMap($adapter))->match($request));
    }

    public function testGenerateUrlCallsInternalAdapterImplementation()
    {
        $adapter = $this->createMock(RouterMapAdapterInterface::class);

        $adapter->expects($this->once())
            ->method('generateUrl')
            ->with('routeName', ['key' => 'value'])
            ->willReturn('/path-of-route');

        /**
         * @var RouterMapAdapterInterface $adapter
         */

        $this->assertEquals('/path-of-route', (new RouterMap($adapter))->generateUrl('routeName', ['key' => 'value']));
    }

    public function testAddRouteCallsInternalAdapterImplementation()
    {
        $adapter = $this->createMock(RouterMapAdapterInterface::class);
        $route = new Route('/', 'fake handler');

        $adapter->expects($this->once())
            ->method('addRoute')
            ->with($route);

        /**
         * @var RouterMapAdapterInterface $adapter
         * @var Route                     $route
         */

        (new RouterMap($adapter))->addRoute($route);
    }

    public function testAll()
    {
        $adapter = $this->createMock(RouterMapAdapterInterface::class);

        $adapter->expects($this->once())
            ->method('addRoute')
            ->with($this->callback(function (Route $route) {
                $this->assertEquals('/', $route->getPath());
                $this->assertEquals('handler', $route->getHandler());
                $this->assertEquals(['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS', 'HEAD'], $route->getAllowedMethods());
                $this->assertEquals('routeName', $route->getName());

                return true;
            }))
        ;

        /**
         * @var RouterMapAdapterInterface $adapter
         */

        $routerMap = new RouterMap($adapter);
        $routerMap->all('/', 'handler', 'routeName');
    }

    /**
     * @dataProvider helperMethodProvider
     * @param string $method
     */
    public function testHelperMethod(string $method)
    {
        $adapter = $this->createMock(RouterMapAdapterInterface::class);

        $adapter->expects($this->once())
            ->method('addRoute')
            ->with($this->callback(function (Route $route) use ($method) {
                $this->assertEquals('/', $route->getPath());
                $this->assertEquals('handler', $route->getHandler());
                $this->assertEquals([strtoupper($method)], $route->getAllowedMethods());
                $this->assertEquals('routeName', $route->getName());

                return true;
            }))
        ;

        /**
         * @var RouterMapAdapterInterface $adapter
         */

        $routerMap = new RouterMap($adapter);
        $routerMap->$method('/', 'handler', 'routeName');
    }

    public function helperMethodProvider()
    {
        return [
            ['get'],
            ['post'],
            ['put'],
            ['patch'],
            ['delete'],
            ['options'],
            ['head'],
        ];
    }
}
