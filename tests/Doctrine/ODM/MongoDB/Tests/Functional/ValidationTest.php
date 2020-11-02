<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Tests\Functional;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Tests\BaseTest;
use Documents\JsonSchemaValidated;

class ValidationTest extends BaseTest
{
    public function testCreateUpdateValidatedDocument()
    {
        $this->requireVersion($this->getServerVersion(), '3.6.0', '<', 'MongoDB cannot perform JSON schema validation before version 3.6');

        // Test creation of JsonSchemaValidated collection
        $cm = $this->dm->getClassMetadata(JsonSchemaValidated::class);
        $this->dm->getSchemaManager()->createDocumentCollection($cm->name);
        $expectedOptions = [
            'validator' => [
                '$jsonSchema' => [
                    'required' => ['name'],
                    'properties' => [
                        'name' => [
                            'bsonType' => 'string',
                            'description' => 'must be a string and is required',
                        ],
                    ],
                ],
            ],
            'validationLevel' => ClassMetadata::VALIDATION_LEVEL_MODERATE,
            'validationAction' => ClassMetadata::VALIDATION_ACTION_WARN,
        ];
        $collections     = $this->dm->getDocumentDatabase($cm->name)->listCollections();
        foreach ($collections as $key => $collection) {
            $this->assertEquals(0, $key);
            $this->assertEquals($cm->getCollection(), $collection->getName());
            $this->assertEquals($expectedOptions, $collection->getOptions());
        }

        // Test updating the same collection, this time removing the validators and resetting to default options
        $cmUpdated = $this->dm->getClassMetadata(JsonSchemaValidatedUpdate::class);
        $this->dm->getSchemaManager()->updateDocumentValidator($cmUpdated->name);
        // We expect the default values set by MongoDB
        // See: https://docs.mongodb.com/manual/reference/command/collMod/#document-validation
        $expectedOptions = [
            'validationLevel' => ClassMetadata::VALIDATION_LEVEL_STRICT,
            'validationAction' => ClassMetadata::VALIDATION_ACTION_ERROR,
        ];
        $collections     = $this->dm->getDocumentDatabase($cmUpdated->name)->listCollections();
        foreach ($collections as $key => $collection) {
            $this->assertEquals(0, $key);
            $this->assertEquals($cm->getCollection(), $collection->getName());
            $this->assertEquals($expectedOptions, $collection->getOptions());
        }
    }
}

/**
 * @ODM\Document(collection="JsonSchemaValidated")
 */
class JsonSchemaValidatedUpdate extends JsonSchemaValidated
{
}
