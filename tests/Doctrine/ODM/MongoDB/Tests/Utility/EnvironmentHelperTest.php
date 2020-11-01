<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Tests\Utility;

use Doctrine\ODM\MongoDB\Utility\EnvironmentHelper;
use PHPUnit\Framework\TestCase;

class EnvironmentHelperTest extends TestCase
{
    public function testExtensionLoadedFunction()
    {
        $environmentHelper = new EnvironmentHelper();
        $this->assertEquals(true, $environmentHelper->isExtensionLoaded('json'));
    }
}
