<?php

declare(strict_types=1);

namespace Doctrine\ODM\MongoDB\Tests\Mapping\Symfony;

use Doctrine\Common\Persistence\Mapping\MappingException;
use PHPUnit\Framework\TestCase;
use function mkdir;
use function rmdir;
use function sys_get_temp_dir;
use function touch;
use function unlink;

/**
 * @group DDC-1418
 */
abstract class AbstractDriverTest extends TestCase
{
    public function testFindMappingFile()
    {
        $driver = $this->getDriver([
            'MyNamespace\MySubnamespace\DocumentFoo' => 'foo',
            'MyNamespace\MySubnamespace\Document' => $this->dir,
        ]);

        touch($filename = $this->dir . '/Foo' . $this->getFileExtension());
        $this->assertEquals($filename, $driver->getLocator()->findMappingFile('MyNamespace\MySubnamespace\Document\Foo'));
    }

    public function testFindMappingFileInSubnamespace()
    {
        $driver = $this->getDriver([
            'MyNamespace\MySubnamespace\Document' => $this->dir,
        ]);

        touch($filename = $this->dir . '/Foo.Bar' . $this->getFileExtension());
        $this->assertEquals($filename, $driver->getLocator()->findMappingFile('MyNamespace\MySubnamespace\Document\Foo\Bar'));
    }

    public function testFindMappingFileNamespacedFoundFileNotFound()
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage('No mapping file found named');

        $driver = $this->getDriver([
            'MyNamespace\MySubnamespace\Document' => $this->dir,
        ]);

        $driver->getLocator()->findMappingFile('MyNamespace\MySubnamespace\Document\Foo');
    }

    public function testFindMappingNamespaceNotFound()
    {
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage("No mapping file found named 'Foo" . $this->getFileExtension() . "' for class 'MyOtherNamespace\MySubnamespace\Document\Foo'.");

        $driver = $this->getDriver([
            'MyNamespace\MySubnamespace\Document' => $this->dir,
        ]);

        $driver->getLocator()->findMappingFile('MyOtherNamespace\MySubnamespace\Document\Foo');
    }

    protected function setUp()
    {
        $this->dir = sys_get_temp_dir() . '/abstract_driver_test';
        @mkdir($this->dir, 0775, true);
    }

    protected function tearDown()
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->dir), \RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($iterator as $path) {
            if ($path->isDir()) {
                @rmdir($path);
            } else {
                @unlink($path);
            }
        }

        @rmdir($this->dir);
    }

    abstract protected function getFileExtension();
    abstract protected function getDriver(array $paths = []);

    private function setField($obj, $field, $value)
    {
        $ref = new \ReflectionProperty($obj, $field);
        $ref->setAccessible(true);
        $ref->setValue($obj, $value);
    }

    private function invoke($obj, $method, array $args = [])
    {
        $ref = new \ReflectionMethod($obj, $method);
        $ref->setAccessible(true);

        return $ref->invokeArgs($obj, $args);
    }
}
