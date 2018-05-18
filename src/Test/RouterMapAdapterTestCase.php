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

namespace Lepre\Routing\Test;

use Lepre\Routing\RouterMap;
use Lepre\Routing\RouterMapAdapterInterface;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

/**
 * @codeCoverageIgnore
 */
abstract class RouterMapAdapterTestCase extends TestCase
{
    /**
     * @var RouterMap
     */
    private $routerMap;

    public function setUp()
    {
        $this->routerMap = new RouterMap($this->createAdapter());
    }

    protected abstract function createAdapter(): RouterMapAdapterInterface;

    public function testMatch()
    {
        $this->routerMap->all('/blog/{postId}', 'handler');
        $request = new ServerRequest([], [], '/blog/123', 'GET');

        $route = $this->routerMap->match($request);

        $this->assertEquals('handler', $route->getHandler());
        $this->assertEquals(['postId' => 123], $route->getParams());
    }

    /**
     * @expectedException \Lepre\Routing\Exception\ResourceNotFoundException
     */
    public function testMatchThrowsResourceNotFoundException()
    {
        $request = new ServerRequest([], [], '/about', 'GET');

        $this->routerMap->match($request);
    }

    /**
     * @expectedException \Lepre\Routing\Exception\MethodNotAllowedException
     */
    public function testMatchThrowsMethodNotAllowedException()
    {
        $this->routerMap->post('/save-post', 'handler');
        $request = new ServerRequest([], [], '/save-post', 'GET');

        $this->routerMap->match($request);
    }

    public function testGenerateUrl()
    {
        $this->routerMap->all('/blog', 'handler', 'blog-home');
        $this->routerMap->all('/blog/{postId}', 'handler', 'blog-post');

        $this->assertEquals('/blog', $this->routerMap->generateUrl('blog-home'));
        $this->assertEquals('/blog/123', $this->routerMap->generateUrl('blog-post', ['postId' => 123]));
    }

    /**
     * @expectedException \Lepre\Routing\Exception\RouteNotFoundException
     */
    public function testGenerateUrlThrowsRouteNotFoundException()
    {
        $this->routerMap->generateUrl('undefined');
    }

    /**
     * @expectedException \Lepre\Routing\Exception\MissingParametersException
     */
    public function testGenerateUrlThrowsMissingParametersException()
    {
        $this->markTestIncomplete();
    }

    /**
     * @expectedException \Lepre\Routing\Exception\InvalidParametersException
     */
    public function testGenerateUrlThrowsInvalidParametersException()
    {
        $this->markTestIncomplete();
    }
}
