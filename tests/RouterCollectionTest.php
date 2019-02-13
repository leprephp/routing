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

use Lepre\Routing\Exception\InvalidParametersException;
use Lepre\Routing\Exception\MethodNotAllowedException;
use Lepre\Routing\Exception\MissingParametersException;
use Lepre\Routing\Exception\ResourceNotFoundException;
use Lepre\Routing\Exception\RouteNotFoundException;
use Lepre\Routing\RouterCollection;
use Lepre\Routing\RouteResult;
use Lepre\Routing\RouterInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @covers \Lepre\Routing\RouterCollection
 */
final class RouterCollectionTest extends TestCase
{
    /**
     * @var RouterCollection
     */
    private $collection;

    public function setUp(): void
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

    public function testVoidCollectionMatch()
    {
        $this->expectException(ResourceNotFoundException::class);
        $this->expectExceptionMessage('The resource was not found');

        /** @var ServerRequestInterface $request */
        $request = $this->createMock(ServerRequestInterface::class);

        $this->collection->match($request);
    }

    /**
     * @dataProvider routerMatchExceptionProvider
     * @param string $exceptionClass
     */
    public function test_On_OneRouterThrownException($exceptionClass)
    {
        $request = $this->createMock(ServerRequestInterface::class);

        $router = $this->createMock(RouterInterface::class);
        $router->expects($this->once())->method('match')->willThrowException(new $exceptionClass());

        /**
         * @var RouterInterface        $router
         * @var ServerRequestInterface $request
         */

        $this->collection->registerRouter($router);

        try {
            $this->collection->match($request);
        } catch (\Exception $e) {
            $this->assertInstanceOf($exceptionClass, $e);

            return;
        }

        $this->fail("Expected exception '{$exceptionClass}' not thrown.");
    }

    /**
     * @dataProvider routerMatchExceptionProvider
     * @param string $exceptionClass
     */
    public function test_On_FirstRouterThrownException_And_SecondRouterMatchAValidResult($exceptionClass)
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $routeResult = new RouteResult('handler', []);

        $router1 = $this->createMock(RouterInterface::class);
        $router1->expects($this->once())->method('match')->willThrowException(new $exceptionClass());

        $router2 = $this->createMock(RouterInterface::class);
        $router2->expects($this->once())->method('match')->willReturn($routeResult);

        /**
         * @var ServerRequestInterface $request
         * @var RouterInterface        $router1
         * @var RouterInterface        $router2
         */

        $this->collection->registerRouter($router1);
        $this->collection->registerRouter($router2);

        $this->assertEquals($routeResult, $this->collection->match($request));
    }

    public function routerMatchExceptionProvider()
    {
        return [
            [ResourceNotFoundException::class],
            [MethodNotAllowedException::class],
        ];
    }

    public function testRegisterRouterOrder()
    {
        $request = $this->createMock(ServerRequestInterface::class);

        $router1 = $this->createMock(RouterInterface::class);
        $router1->expects($this->once())->method('match')
            ->willThrowException(new ResourceNotFoundException());
        $router1->expects($this->once())->method('generateUrl')
            ->with('route2', ['param1' => 'value1'])
            ->willThrowException(new RouteNotFoundException('route2'));

        $router2 = $this->createMock(RouterInterface::class);
        $router2->expects($this->once())->method('match')->willReturn(new RouteResult('handler2', []));
        $router2->expects($this->once())->method('generateUrl')
            ->with('route2', ['param1' => 'value1'])
            ->willReturn('/page2.html');

        $router3 = $this->createMock(RouterInterface::class);
        $router3->expects($this->never())->method('match');
        $router3->expects($this->never())->method('generateUrl');

        /**
         * @var ServerRequestInterface $request
         * @var RouterInterface        $router1
         * @var RouterInterface        $router2
         * @var RouterInterface        $router3
         */

        $this->collection->registerRouter($router1);
        $this->collection->registerRouter($router2);
        $this->collection->registerRouter($router3);

        $this->assertEquals('handler2', $this->collection->match($request)->getHandler());
        $this->assertEquals('/page2.html', $this->collection->generateUrl('route2', ['param1' => 'value1']));
    }

    public function testVoidCollectionGenerateUrl()
    {
        $this->expectException(RouteNotFoundException::class);
        $this->expectExceptionMessage('Cannot generate URI for route "the route name": route not found');

        $this->collection->generateUrl('the route name');
    }

    public function testGenerateUrlHonorMissingParametersException()
    {
        $this->expectException(MissingParametersException::class);

        $router = $this->createMock(RouterInterface::class);
        $router->expects($this->once())->method('generateUrl')
            ->with('routeName')
            ->willThrowException(new MissingParametersException('routeName', ['requiredParam']));

        /**
         * @var RouterInterface $router
         */

        $this->collection->registerRouter($router);

        $this->collection->generateUrl('routeName');
    }

    public function testGenerateUrlHonorInvalidParametersException()
    {
        $this->expectException(InvalidParametersException::class);

        $router = $this->createMock(RouterInterface::class);
        $router->expects($this->once())->method('generateUrl')
            ->with('routeName')
            ->willThrowException(new InvalidParametersException('routeName', ['invalidParam']));

        /**
         * @var RouterInterface $router
         */

        $this->collection->registerRouter($router);

        $this->collection->generateUrl('routeName');
    }
}
