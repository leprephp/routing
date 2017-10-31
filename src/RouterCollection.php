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
 * RouterCollection
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 */
class RouterCollection implements RouterInterface
{
    /**
     * @var RouterInterface[]
     */
    protected $routers = [];

    /**
     * @param RouterInterface $router
     */
    public function registerRouter(RouterInterface $router)
    {
        $this->routers[] = $router;
    }

    /**
     * @return RouterInterface[]
     */
    public function getRouters(): array
    {
        return $this->routers;
    }

    /**
     * @inheritDoc
     */
    public function match(ServerRequestInterface $request): RouteResult
    {
        $methodNotAllowedException = null;
        $notAcceptableException = null;

        foreach ($this->routers as $router) {
            try {
                return $router->match($request);
            } catch (Exception\MethodNotAllowedException $e) {
                $methodNotAllowedException = $e;
            } catch (Exception\NotAcceptableException $e) {
                $notAcceptableException = $e;
            } catch (Exception\ResourceNotFoundException $e) {
                continue;
            }
        }

        if ($methodNotAllowedException) {
            throw $methodNotAllowedException;
        }

        if ($notAcceptableException) {
            throw $notAcceptableException;
        }

        throw new Exception\ResourceNotFoundException();
    }

    /**
     * @inheritDoc
     */
    public function generateUrl(string $routeName, array $params = []): string
    {
        foreach ($this->routers as $router) {
            try {
                return $router->generateUrl($routeName, $params);
            } catch (Exception\RouteNotFoundException $e) {
                continue;
            }
        }

        throw new Exception\RouteNotFoundException($routeName);
    }
}
