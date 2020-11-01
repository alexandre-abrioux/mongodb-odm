<?php

declare(strict_types=1);

require_once __DIR__ . '/config.php';


// Your code here...
$dm->getSchemaManager()->dropDatabases();
$dm->getSchemaManager()->createCollections();
//$dm->getSchemaManager()->updateValidators();
//$collections     = $dm->getDocumentDatabase(\Documents\Account::class)->listCollections();
//foreach ($collections as $key => $collection) {
//    var_dump($collection->getName());
//    var_dump($collection->getOptions());
//}
