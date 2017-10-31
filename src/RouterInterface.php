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

namespace Lepre\Routing;

use Psr\Http\Message\ServerRequestInterface;

/**
 * RouterInterface
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
interface RouterInterface
{
    /**
     * Returns the route that match the given request.
     *
     * @param ServerRequestInterface $request The request to match
     *
     * @return RouteResult The matched route
     *
     * @throws Exception\ResourceNotFoundException If no matching resource could be found
     * @throws Exception\MethodNotAllowedException If a matching resource was found but the request method is not allowed
     * @throws Exception\NotAcceptableException    If a matching resource was found but the request content type is not supported
     */
    public function match(ServerRequestInterface $request): RouteResult;

    /**
     * Generate a URL for the given route.
     *
     * @param string $routeName The name of the route
     * @param array  $params    An array of parameters
     *
     * @return string The generated URL
     *
     * @throws Exception\RouteNotFoundException     If the named route doesn’t exist
     * @throws Exception\MissingParametersException When some parameters are missing
     * @throws Exception\InvalidParametersException If a parameter value does not match the requirement
     */
    public function generateUrl(string $routeName, array $params = []): string;
}
