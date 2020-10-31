<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Mapping\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Enum;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Specifies the collection schema validation level
 *
 * @Annotation
 * @Target({"ANNOTATION"})
 */
class ValidationLevel
{
    /**
     * @Enum({
     *     \Doctrine\ODM\MongoDB\Mapping\ClassMetadata::VALIDATION_LEVEL_OFF,
     *     \Doctrine\ODM\MongoDB\Mapping\ClassMetadata::VALIDATION_LEVEL_STRICT,
     *     \Doctrine\ODM\MongoDB\Mapping\ClassMetadata::VALIDATION_LEVEL_MODERATE,
     *     })
     */
    public $value;
}
