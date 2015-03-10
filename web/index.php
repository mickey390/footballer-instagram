<?php
# --------------------------------------------------------------
#  init section
# --------------------------------------------------------------
require('../vendor/autoload.php');
require('../class/InstagramAccount.class.php');
require('../class/InstagramPosts.class.php');

$app = new Silex\Application();
$app['debug'] = true;


// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register the Twig templating engine
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/../views',
));

# --------------------------------------------------------------
#  Our web handlers
# --------------------------------------------------------------

$app->get('/', function() use($app) {
    // $app['monolog']->addDebug('logging output.');
    $instagram = new InstagramPosts();
    $instagram->setCollection();
    $posts = $instagram->getPostData();

    return $app['twig']->render('index.twig', array(
        'posts' => $posts,
        'nav_var' => "posts",
    ));

});

$app->get('/api/posts', function () use($app) {

    $instagram = new InstagramPosts();
    $instagram->setCollection();
    $posts = $instagram->getPostData($page);

    return $app->json($posts, 201);
});


$app->get('/accounts/{page}', function ($page) use ($app) {

    $instagram = new InstagramAccounts();
    $instagram->setCollection();
    $accounts = $instagram->getAccountData($page);

    return $app['twig']->render('accounts.twig', array(
        'accounts' => $accounts,
        'nav_var' => "accounts",
    ));

});



$app->get('/about/', function () use ($app) {
    return $app['twig']->render('about.twig', array(
        'nav_var' => "about",
    ));
});


// error page
use Symfony\Component\HttpFoundation\Response;
$app->error(function (\Exception $e, $code) {
    return new Response('<h1>woops</h1>');
});


$app->run();

?>
