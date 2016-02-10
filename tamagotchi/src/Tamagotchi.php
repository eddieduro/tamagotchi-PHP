<?php

  class Tamagotchi
  {

    private $name;
    private $food;
    private $attention;
    private $sleep;

    function __construct($name){
      $this->name = $name;
      $this->food = 10;
      $this->attention = 10;
      $this->sleep = 10;
    }
    function getName()
    {
      return $this->name;
    }

    function getFood()
    {
      return $this->food;
    }

    function setAttention($newAttention)
    {
      return $this->attention = $newAttention;
    }

    function setFood($newFood)
    {
      $this->food = $newFood;
    }
    function getAttention()
    {
      return $this->attention;
    }


    function getSleep()
    {
      return $this->sleep;
    }

    function setSleep($newSleep)
    {
      $this->sleep = $newSleep;
    }

    function save()
    {
      array_push($_SESSION['tamagotchi_attributes'], $this);
    }

    static function getAll()
    {
      return $_SESSION['tamagotchi_attributes'];
    }

    static function deleteAll()
    {
      return $_SESSION['tamagotchi_attributes'] = array();
    }
  }
?>
