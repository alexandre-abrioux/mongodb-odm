<?php

declare(strict_types=1);

namespace Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(
 *     validator={
 *         "$jsonSchema": {
 *             "required": {"name"},
 *             "properties": {
 *                 "name": {
 *                     "bsonType": "string",
 *                     "description": "must be a string and is required"
 *                 }
 *             }
 *         }
 *     },
 *     validationAction="warn",
 *     validationLevel="moderate",
 * )
 */
class JsonSchemaValidated
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $name;
}
