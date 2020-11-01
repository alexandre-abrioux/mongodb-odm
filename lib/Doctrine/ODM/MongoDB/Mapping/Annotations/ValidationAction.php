<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Mapping\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Enum;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Specifies the collection schema validation action
 *
 * @Annotation
 * @Target({"ANNOTATION"})
 */
class ValidationAction
{
    /**
     * @var string
     * @Enum({
     *     \Doctrine\ODM\MongoDB\Mapping\ClassMetadata::VALIDATION_ACTION_ERROR,
     *     \Doctrine\ODM\MongoDB\Mapping\ClassMetadata::VALIDATION_ACTION_WARN,
     *     })
     */
    public $value;
}
