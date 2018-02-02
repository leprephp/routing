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

namespace Lepre\Routing\Tests\Exception;

use Lepre\Routing\Exception\MissingParametersException;
use PHPUnit\Framework\TestCase;

class MissingParametersExceptionTest extends TestCase
{
    public function testMessage()
    {
        $e = new MissingParametersException('routeName', ['param1', 'param2']);

        $this->assertEquals(
            'Cannot generate URI for route "routeName"; missing parameters: param1, param2',
            $e->getMessage()
        );
    }
}
