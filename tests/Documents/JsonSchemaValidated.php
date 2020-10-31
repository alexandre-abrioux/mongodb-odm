<?php

declare(strict_types=1);

namespace Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

/**
 * @ODM\Document(
 *     validationJsonSchema="{
            ""required"": [""name""],
            ""properties"": {
                ""name"": {
                    ""bsonType"": ""string"",
                    ""description"": ""must be a string and is required""
                }
            }
        }",
 *     validationAction=@ODM\ValidationAction(ClassMetadata::VALIDATION_ACTION_WARN),
 *     validationLevel=@ODM\ValidationLevel(ClassMetadata::VALIDATION_LEVEL_MODERATE),
 * )
 */
class JsonSchemaValidated
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $name;
}
