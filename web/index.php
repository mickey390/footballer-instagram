<?php


$connection = new MongoClient(getenv('MONGOLAB_URL1'));
$db = $connection->selectDB(getenv('MONGOLAB_DB1'));
$col = $db->selectCollection(getenv('MONGOLAB_COL1'));



$docs = $col->find();
// var_dump($connection);
// echo "<br>";
// var_dump($db);
// echo "<br>";
// var_dump($col);
// echo "<br>";
// var_dump($docs);
foreach ($docs as $id => $obj) {
    print "<pre>";
    print var_dump($obj);
    print "</pre><hr>";
}


exit;

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return 'Hellob aaa';
});

$app->run();

?>
