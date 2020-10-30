<?php

declare(strict_types=1);

namespace Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Index;

/**
 * @ODM\Document(collection="accounts")
 * @ODM\Validation(jsonSchema=Account::JSON_SCHEMA)
 *
 * @Index(keys={"name"="desc"}, options={"unique"=true})
 */
class Account
{
    public const JSON_SCHEMA = <<<'EOT'
{
    "required": ["name"],
    "properties": {
        "name": {
            "bsonType": "string",
            "description": "must be a string and is required"
        }
    }
}
EOT;

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
