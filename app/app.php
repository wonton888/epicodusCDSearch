<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/CD.php";

    session_start();
    if (empty($_SESSION['list_of_cds'])) {
      $_SESSION['list_of_cds'] = array();
    }

    $app = new Silex\Application();
    $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app){
        return $app['twig']->render('cd_catalog.html.twig', array('catalog' => CD::getAll()));
    });
    $app->post('/cdCatalog', function() use($app) {
        $cd = new CD($_POST['title'], $_POST['artist'], $_POST['cover_art'], $_POST['price']);
        $cd->save();
        return $app['twig']->render('create_cd.html.twig', array('newcd' => $cd));
    });

    $app->get('/cdSearch', function() use ($app) {

        return $app['twig']->render('cdSearch.html.twig', array('CD_catalog_search' => CD::getAll(), 'artist2' => $_GET['artist2']));
    });

    $app->post('/deleteCDS', function() use ($app) {
        CD::deleteAll();
        return $app['twig']->render('deleteCDS.html.twig');
    });

return $app;
?>
