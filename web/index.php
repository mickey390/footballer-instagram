<?php

$connection = new Mongo(getenv('MONGOLAB_URL1'));
$db = $connection->selectDB(getenv('MONGOLAB_DB1'));
$col = $db->selectCollection(getenv('MONGOLAB_COL1'));

$docs = $col->find();


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

$blogPosts = array(
    1 => array(
        'date'      => '2011-03-29',
        'author'    => 'igorw',
        'title'     => 'Using Silex',
        'body'      => '...',
    ),
);

$app->get('/accounts', function () use ($blogPosts) {
    $output = '';
    foreach ($blogPosts as $post) {
        $output .= $post['title'];
        $output .= '<br />';
    }

    return $output;
});












$app->run();

?>
