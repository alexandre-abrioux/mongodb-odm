<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Tests\Mapping\Annotations;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Tests\BaseTest;

class DocumentTest extends BaseTest
{
    public function testWrongTypeForValidationActionShouldThrowException()
    {
        $this->expectException(AnnotationException::class);
        $this->expectExceptionMessage('[Type Error] Attribute "validationAction" of @ODM\Document declared on class Doctrine\ODM\MongoDB\Tests\Mapping\Annotations\WrongTypeForValidationAction expects a(n) Doctrine\ODM\MongoDB\Mapping\Annotations\ValidationAction, but got string.');
        $this->dm->getClassMetadata(WrongTypeForValidationAction::class);
    }

    public function testWrongTypeForValidationLevelShouldThrowException()
    {
        $this->expectException(AnnotationException::class);
        $this->expectExceptionMessage('[Type Error] Attribute "validationLevel" of @ODM\Document declared on class Doctrine\ODM\MongoDB\Tests\Mapping\Annotations\WrongTypeForValidationLevel expects a(n) Doctrine\ODM\MongoDB\Mapping\Annotations\ValidationLevel, but got string.');
        $this->dm->getClassMetadata(WrongTypeForValidationLevel::class);
    }
}

/** @ODM\Document(validationAction="wrong") */
class WrongTypeForValidationAction
{
    /** @ODM\Id */
    public $id;
}

/** @ODM\Document(validationLevel="wrong") */
class WrongTypeForValidationLevel
{
    /** @ODM\Id */
    public $id;
}
