<?php
  class Place
  {
    private $city;

    function __construct($new_city)
    {
      $this->city = $new_city;
    }

    function getCity()
    {
        return $this->city;
    }

    function save()
    {
        array_push($_SESSION['list_of_places'], $this);
    }

    static function getAll()
    {
        return $_SESSION['list_of_places'];
    }

    static function deleteAll()
    {
        return $_SESSION['list_of_places'] = array();
    }
  }
?>
