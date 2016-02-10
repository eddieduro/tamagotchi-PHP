<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Tamagotchi.php";

    session_start();
    if(empty($_SESSION['tamagotchi_attributes'])){
      $_SESSION['tamagotchi_attributes'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider, array(
      'twig.path' => __DIR__."/../views"
    ));

    $app->get("/", function() use ($app){
      return $app['twig']->render('tamagotchi.html.twig', array('attributes' => Tamagotchi::getAll()));
    });

    $app->post("/attributes", function() use ($app){
        $attribute = new Tamagotchi($_POST['name'], $_POST['food'], $_POST['attention'], $_POST['sleep']);
        $attribute->save();
        return $app['twig']->render('create_attribute.html.twig', array('newattribute' => $attribute));
    });


    $app->post('/delete_attr', function() use ($app){
      Tamagotchi::deleteAll();
      return $app['twig']->render('delete_attr.html.twig');
    });
    // $app->post("/sleep", function() use ($app) {
    //   $attribute = new Tamagotchi($_POST['name'], $_POST['food'], $_POST['attention'], $_POST['sleep']);
    //   $sleep = $attribute->getSleep();
    //   $sleep->save();
    //   return $app['twig']->render('create_attribute.html.twig', array('newfood' => $attribute));
    // });
    return $app;
 ?>
