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

use Lepre\Routing\Exception\UnsupportedMethodException;
use PHPUnit\Framework\TestCase;

final class UnsupportedMethodExceptionTest extends TestCase
{
    public function testMessage()
    {
        $e = new UnsupportedMethodException('unsupported-method');

        $this->assertEquals(
            'The method "unsupported-method" is not supported.',
            $e->getMessage()
        );
    }
}
