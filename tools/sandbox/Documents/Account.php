<?php

declare(strict_types=1);

namespace Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(
 *     collection="accounts",
 *     validationJsonSchema="{
            ""required"": [""name""],
            ""properties"": {
                ""name"": {
                    ""bsonType"": ""string"",
                    ""description"": ""must be a string and is required""
                }
            }
        }"
 * )
 */
class Account
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $name;

    /** @ODM\Field(type="string") */
    private $phone;

    /** @ODM\Field(type="string") */
    private $email;

    /** @ODM\Field(type="string") */
    private $status;
}
