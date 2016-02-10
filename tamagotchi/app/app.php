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

    $app->post("/name", function() use ($app){
        $new_tamagotchi = new Tamagotchi($_POST['name']);
        $new_tamagotchi->save();
        return $app['twig']->render('create_name.html.twig');
    });

    $app->get("/food", function() use ($app) {

      $current_tamagotchi = Tamagotchi::getAll();
      $current_tamagotchi[0]->setFood(10);
      $food = $current_tamagotchi[0]->getFood();
      $sleep = $current_tamagotchi[0]->getSleep();
      $attention = $current_tamagotchi[0]->getAttention();

      if ($sleep == 0 || $attention == 0) {
        return $app['twig']->render('dead.html.twig');
      } else {
      $current_tamagotchi[0]->setFood($food + 1);
      $current_tamagotchi[0]->setSleep($sleep - 1);
      $current_tamagotchi[0]->setAttention($attention - 1);
      return $app['twig']->render('create_food.html.twig');
      }
    });

    $app->get("/attention", function() use ($app) {
      $current_tamagotchi = Tamagotchi::getAll();
      $current_tamagotchi[0]->setAttention(10);
      $food = $current_tamagotchi[0]->getFood();
      $sleep = $current_tamagotchi[0]->getSleep();
      $attention = $current_tamagotchi[0]->getAttention();

      if ($sleep == 0 || $food == 0) {
        return $app['twig']->render('dead.html.twig');
      } else {
        $current_tamagotchi[0]->setFood($food - 1);
        $current_tamagotchi[0]->setSleep($sleep - 1);
        $current_tamagotchi[0]->setAttention($attention + 1);
        return $app['twig']->render('create_attention.html.twig');
      }
    });

    $app->get("/sleep", function() use ($app) {
      $current_tamagotchi = Tamagotchi::getAll();
      $current_tamagotchi[0]->setSleep(10);
      $food = $current_tamagotchi[0]->getFood();
      $sleep = $current_tamagotchi[0]->getSleep();
      $attention = $current_tamagotchi[0]->getAttention();

      if ($sleep == 0 || $food == 0) {
        return $app['twig']->render('dead.html.twig');
      } else {
        $current_tamagotchi[0]->setFood($food - 1);
        $current_tamagotchi[0]->setSleep($sleep + 1);
        $current_tamagotchi[0]->setAttention($attention - 1);
        return $app['twig']->render('create_sleep.html.twig');
      }
    });

    $app->post('/delete_attr', function() use ($app){
      Tamagotchi::deleteAll();
      return $app['twig']->render('delete_attr.html.twig');
    });




    return $app;
 ?>
