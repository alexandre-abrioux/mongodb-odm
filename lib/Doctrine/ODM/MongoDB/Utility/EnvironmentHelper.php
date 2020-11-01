<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Utility;

use function extension_loaded;

class EnvironmentHelper
{
    public function isExtensionLoaded(string $extension)
    {
        return extension_loaded($extension);
    }
}
