<?php

namespace Doctrine\ODM\MongoDB\Tests\Functional;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Documents\Phonebook;
use Documents\Phonenumber;

/**
 * CollectionPersister will throw exception when collection with atomicSet
 * or atomicSetArray should be handled by it. If no exception was thrown it
 * means that collection update was handled by DocumentPersister.
 */
class AtomicSetTest extends \Doctrine\ODM\MongoDB\Tests\BaseTest
{
    public function testAtomicInsertAndUpdate()
    {
        $user = new AtomicUser('Maciej');
        $user->phonenumbers['home'] = new Phonenumber('12345678');
        $this->dm->persist($user);
        $this->dm->flush();
        $user->surname = "Malarz";
        $user->phonenumbers['work'] = new Phonenumber('87654321');
        $this->dm->flush();
        $this->dm->clear();
        $newUser = $this->dm->getRepository(get_class($user))->find($user->id);
        $this->assertEquals('Maciej', $newUser->name);
        $this->assertEquals('Malarz', $newUser->surname);
        $this->assertCount(2, $newUser->phonenumbers);
        $this->assertNotNull($newUser->phonenumbers->get('home'));
        $this->assertNotNull($newUser->phonenumbers->get('work'));
    }
    
    public function testAtomicUpsert()
    {
        $user = new AtomicUser('Maciej');
        $user->id = new \MongoId();
        $user->phonenumbers[] = new Phonenumber('12345678');
        $this->dm->persist($user);
        $this->dm->flush();
        $this->dm->clear();
        $newUser = $this->dm->getRepository(get_class($user))->find($user->id);
        $this->assertEquals('Maciej', $newUser->name);
        $this->assertCount(1, $newUser->phonenumbers);
    }
    
    public function testAtomicCollectionUnset()
    {
        $user = new AtomicUser('Maciej');
        $user->phonenumbers[] = new Phonenumber('12345678');
        $this->dm->persist($user);
        $this->dm->flush();
        $user->surname = "Malarz";
        $user->phonenumbers = null;
        $this->dm->flush();
        $this->dm->clear();
        $newUser = $this->dm->getRepository(get_class($user))->find($user->id);
        $this->assertEquals('Maciej', $newUser->name);
        $this->assertEquals('Malarz', $newUser->surname);
        $this->assertCount(0, $newUser->phonenumbers);
    }
    
    public function testAtomicSetArray()
    {
        $user = new AtomicUser('Maciej');
        $user->phonenumbersArray[] = new Phonenumber('12345678');
        $user->phonenumbersArray[] = new Phonenumber('87654321');
        $this->dm->persist($user);
        $this->dm->flush();
        unset($user->phonenumbersArray[0]);
        $this->dm->flush();
        $this->dm->clear();
        $newUser = $this->dm->getRepository(get_class($user))->find($user->id);
        $this->assertCount(1, $newUser->phonenumbersArray);
        $this->assertFalse(isset($newUser->phonenumbersArray[1]));
    }
    
    public function testAtomicCollectionWithAnotherNested()
    {
        $user = new AtomicUser('Maciej');
        $phonebook = new Phonebook('Private');
        $phonebook->addPhonenumber(new Phonenumber('12345678'));
        $user->phonebooks['private'] = $phonebook;
        $this->dm->persist($user);
        $this->dm->flush();
        $this->dm->clear();
        $newUser = $this->dm->getRepository(get_class($user))->find($user->id);
        $this->assertNotNull($newUser->phonebooks->get('private'));
        $this->assertCount(1, $newUser->phonebooks->get('private')->getPhonenumbers());
    }
}

/**
 * @ODM\Document
 */
class AtomicUser
{
    /** @ODM\Id */
    public $id;
    
    /** @ODM\String */
    public $name;
    
    /** @ODM\String */
    public $surname;
    
    /** @ODM\EmbedMany(strategy="atomicSet", targetDocument="Documents\Phonenumber") */
    public $phonenumbers;
    
    /** @ODM\EmbedMany(strategy="atomicSetArray", targetDocument="Documents\Phonenumber") */
    public $phonenumbersArray;
    
    /** @ODM\EmbedMany(strategy="atomicSet", targetDocument="Documents\Phonebook") */
    public $phonebooks;
    
    public function __construct($name)
    {
        $this->name = $name;
        $this->phonenumbers = new ArrayCollection();
        $this->phonenumbersArray = new ArrayCollection();
        $this->phonebooks = new ArrayCollection();
    }
}