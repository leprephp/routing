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

namespace Lepre\Routing\Tests\Bridge\AuraRouter;

use Aura\Router\RouterContainer;
use Lepre\Routing\Bridge\AuraRouter\AuraRouterMapAdapter;
use Lepre\Routing\RouterMapAdapterInterface;
use Lepre\Routing\Test\RouterMapAdapterTestCase;

class AuraRouterMapAdapterTest extends RouterMapAdapterTestCase
{
    protected function createAdapter(): RouterMapAdapterInterface
    {
        return new AuraRouterMapAdapter(
            new RouterContainer()
        );
    }
}
