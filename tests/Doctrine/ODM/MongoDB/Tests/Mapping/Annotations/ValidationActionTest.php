<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Tests\Mapping\Annotations;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Tests\BaseTest;

class ValidationActionTest extends BaseTest
{
    public function testWrongValueForValidationActionShouldThrowException()
    {
        $this->expectException(AnnotationException::class);
        $this->expectExceptionMessage('[Enum Error] Attribute "value" of @Doctrine\ODM\MongoDB\Mapping\Annotations\ValidationAction declared on class Doctrine\ODM\MongoDB\Tests\Mapping\Annotations\WrongValueForValidationAction accepts only [error, warn], but got wrong.');
        $this->dm->getClassMetadata(WrongValueForValidationAction::class);
    }
}

/** @ODM\Document(validationAction=@ODM\ValidationAction("wrong")) */
class WrongValueForValidationAction
{
    /** @ODM\Id */
    public $id;
}
