<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Tests\Mapping\Annotations;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Tests\BaseTest;

class ValidationLevelTest extends BaseTest
{
    public function testWrongValueForValidationLevelShouldThrowException()
    {
        $this->expectException(AnnotationException::class);
        $this->expectExceptionMessageRegExp('#^\[Enum Error\] Attribute "value" of @Doctrine\\\\ODM\\\\MongoDB\\\\Mapping\\\\Annotations\\\\ValidationLevel declared on class Doctrine\\\\ODM\\\\MongoDB\\\\Tests\\\\Mapping\\\\Annotations\\\\WrongValueForValidationLevel accepts? only \[off, strict, moderate\], but got wrong\.$#');
        $this->dm->getClassMetadata(WrongValueForValidationLevel::class);
    }
}

/** @ODM\Document(validationLevel=@ODM\ValidationLevel("wrong")) */
class WrongValueForValidationLevel
{
    /** @ODM\Id */
    public $id;
}
