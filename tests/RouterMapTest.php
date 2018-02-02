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
use Lepre\Routing\RouterMapInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class RouterMapTest extends TestCase
{
    public function testMatchCallsInternalRouterMapInterface()
    {
        $adapter = $this->createMock(RouterMapInterface::class);
        $request = $this->createMock(ServerRequestInterface::class);
        $result = $this->createMock(RouteResult::class);

        $adapter->expects($this->once())
            ->method('match')
            ->with($request)
            ->willReturn($result);

        /**
         * @var RouterMapInterface     $adapter
         * @var ServerRequestInterface $request
         * @var RouteResult            $result
         */

        $this->assertEquals($result, (new RouterMap($adapter))->match($request));
    }

    public function testGenerateUrlCallsInternalRouterMapInterface()
    {
        $adapter = $this->createMock(RouterMapInterface::class);

        $adapter->expects($this->once())
            ->method('generateUrl')
            ->with('routeName', ['key' => 'value'])
            ->willReturn('/path-of-route');

        /**
         * @var RouterMapInterface $adapter
         */

        $this->assertEquals('/path-of-route', (new RouterMap($adapter))->generateUrl('routeName', ['key' => 'value']));
    }

    public function testAddRouteCallsInternalRouterMapInterface()
    {
        $adapter = $this->createMock(RouterMapInterface::class);
        $route = $this->createMock(Route::class);

        $adapter->expects($this->once())
            ->method('addRoute')
            ->with($route);

        /**
         * @var RouterMapInterface $adapter
         * @var Route              $route
         */

        (new RouterMap($adapter))->addRoute($route);
    }

    /**
     * @dataProvider helperMethodProvider
     * @param string $method
     */
    public function testHelperMethod(string $method)
    {
        $check = new \stdClass();
        $check->route = null;

        $adapter = new class($check) implements RouterMapInterface
        {
            private $check;

            public function __construct(\stdClass $check)
            {
                $this->check = $check;
            }

            public function match(ServerRequestInterface $request): RouteResult
            {
                // This method is irrelevant for the the purpose of the test.
            }

            public function generateUrl(string $routeName, array $params = []): string
            {
                // This method is irrelevant for the the purpose of the test.
            }

            public function addRoute(Route $route)
            {
                $this->check->route = $route;
            }
        };

        /** @var Route $route */
        $route = (new RouterMap($adapter))->$method('/', 'handler', 'routeName');
        $this->assertSame($check->route, $route);

        $this->assertEquals('/', $route->getPath());
        $this->assertEquals('handler', $route->getHandler());
        $this->assertEquals([strtoupper($method)], $route->getAllowedMethods());
        $this->assertEquals('routeName', $route->getName());
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
