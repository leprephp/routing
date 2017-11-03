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

use Lepre\Routing\RouterMapInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequest;

/**
 * RouterTestCase
 */
abstract class RouterTestCase extends TestCase
{
    /**
     * @return RouterMapInterface
     */
    public abstract function createRouter(): RouterMapInterface;

    /**
     * @param string $path
     * @param string $method
     * @param array  $headers
     * @return ServerRequestInterface
     */
    public function createRequest(string $path = '/', string $method = 'GET', array $headers = []): ServerRequestInterface
    {
        return new ServerRequest([], [], $path, $method, 'php://input', $headers);
    }

    /**
     * @param string $method
     * @param string $name
     * @param string $path
     * @param mixed  $handler
     *
     * @dataProvider routesProvider
     */
    public function testMap($method, $name, $path, $handler)
    {
        $router = $this->createRouter();
        $router->{strtolower($method)}($name, $path, $handler);

        $result = $router->match($this->createRequest($path, strtoupper($method)));
        $this->assertEquals($handler, $result->getController());
        $this->assertEquals([], $result->getParams());
    }

    public function routesProvider()
    {
        $routes = [];
        foreach (['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS', 'HEAD'] as $method) {
            $routes[] = [$method, 'route_name', '/path', 'the handler'];
            $routes[] = [$method, 'route_name', '/path', function () {}];
        }

        return $routes;
    }
}
