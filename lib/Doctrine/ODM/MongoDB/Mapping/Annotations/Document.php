<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Mapping\Annotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Attribute;
use Doctrine\Common\Annotations\Annotation\Attributes;

/**
 * Identifies a class as a document that can be stored in the database
 *
 * @Annotation
 * @Attributes({
 *   @Attribute("validationJsonSchema", type = "string"),
 *   @Attribute("validationAction", type = "Doctrine\ODM\MongoDB\Mapping\Annotations\ValidationAction"),
 *   @Attribute("validationLevel",  type = "Doctrine\ODM\MongoDB\Mapping\Annotations\ValidationLevel"),
 * })
 */
final class Document extends AbstractDocument
{
    /** @var string|null */
    public $db;

    /** @var string|null */
    public $collection;

    /** @var string|null */
    public $repositoryClass;

    /** @var Index[] */
    public $indexes = [];

    /** @var bool */
    public $readOnly = false;

    /** @var string|null */
    public $shardKey;

    /** @var string|int|null */
    public $writeConcern;

    /** @var string|null */
    public $validationJsonSchema;

    /** @var ValidationAction|null */
    public $validationAction;

    /** @var ValidationLevel|null */
    public $validationLevel;
}
