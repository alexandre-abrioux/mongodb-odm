<?php

declare(strict_types=1);

namespace Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="accounts", validator={
 *     "$jsonSchema": {
 *         "required": {"name"},
 *         "properties": {
 *             "name": {
 *                 "bsonType": "string",
 *                 "description": "must be a string and is required"
 *             }
 *         }
 *     }
 * }) */
class Account
{
    /** @ODM\Id */
    protected $id;

    /** @ODM\Field(type="string") */
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return (string) $this->name;
    }
}
