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

use Lepre\Routing\RouterCollection;
use Lepre\Routing\RouterInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @covers \Lepre\Routing\RouterCollection
 */
class RouterCollectionTest extends TestCase
{
    /**
     * @var RouterCollection
     */
    private $collection;

    public function setUp()
    {
        $this->collection = new RouterCollection();
    }

    public function testRegisterOneRouter()
    {
        /** @var RouterInterface $router */
        $router = $this->createMock(RouterInterface::class);

        $this->collection->registerRouter($router);

        $this->assertCount(1, $this->collection->getRouters());
    }

    public function testRegisterMultipleRouters()
    {
        /**
         * @var RouterInterface $router1
         * @var RouterInterface $router2
         * @var RouterInterface $router3
         */
        $router1 = $this->createMock(RouterInterface::class);
        $router2 = $this->createMock(RouterInterface::class);
        $router3 = $this->createMock(RouterInterface::class);

        $this->collection->registerRouter($router1);
        $this->collection->registerRouter($router2);
        $this->collection->registerRouter($router3);

        $this->assertCount(3, $this->collection->getRouters());
    }

    /**
     * @expectedException \Lepre\Routing\Exception\ResourceNotFoundException
     * @expectedExceptionMessage The resource was not found
     */
    public function testVoidCollectionMatch()
    {
        /** @var ServerRequestInterface $request */
        $request = $this->createMock(ServerRequestInterface::class);

        $this->collection->match($request);
    }

    public function testRouterMatchThrownMethodNotAllowedException()
    {
        $this->markTestIncomplete();
    }

    public function testRouterMatchThrownNotAcceptableException()
    {
        $this->markTestIncomplete();
    }

    public function testRouterMatchThrownResourceNotFoundException()
    {
        $this->markTestIncomplete();
    }

    public function testFirstRouterMatchThrownMethodNotAllowedExceptionAndTheSecondOneFoundTheRoute()
    {
        $this->markTestIncomplete();
    }

    public function testFirstRouterMatchThrownNotAcceptableExceptionAndTheSecondOneFoundTheRoute()
    {
        $this->markTestIncomplete();
    }

    public function testFirstRouterMatchThrownResourceNotFoundExceptionAndTheSecondOneFoundTheRoute()
    {
        $this->markTestIncomplete();
    }

    public function testRegisterRouterOrder()
    {
        $this->markTestIncomplete();
    }

    /**
     * @expectedException \Lepre\Routing\Exception\RouteNotFoundException
     * @expectedExceptionMessage Cannot generate URI for route "the route name": route not found
     */
    public function testVoidCollectionGenerateUrl()
    {
        $this->collection->generateUrl('the route name');
    }
}
