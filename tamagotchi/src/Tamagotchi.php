<?php

  class Tamagotchi
  {

    private $name;
    private $food;
    private $attention;
    private $sleep;

    function __construct($name, $food, $attention, $sleep){
      $this->name = $name;
      $this->food = $food;
      $this->attention = $attention;
      $this->sleep = $sleep;
    }
    function getName()
    {
      return $this->name;
    }

    function getFood()
    {
      return $this->food;
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
