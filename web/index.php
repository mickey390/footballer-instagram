<?php
echo "hello!";
// phpinfo();
// exit;
 $mongo_url = parse_url(getenv("MONGO_URL"));
$dbname = str_replace("/", "", $mongo_url["path"]);

 # connect
$m   = new MongoClient(getenv("MONGO_URL"));
$db  = $m->$dbname;
$col = $db->access;

 # print all existing documents
  $data = $col->find();
  foreach($data as $visit) {
    echo "<li>" . $visit["ip"] . "</li>";
  }

  # disconnect
  $m->close();










exit;
$connection = new Mongo(getenv('MONGOLAB_URI'));
$db = $connection->selectDB(getenv('MONGOLAB_DB1'));
$col = $db->selectCollection(getenv('MONGOLAB_COL1'));

$docs = $col->find();
//
//
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
  return 'Hello!!';
});

$app->run();

?>
