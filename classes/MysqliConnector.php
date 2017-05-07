<?php

  require_once('config.php');
  require_once('helpers.php');
  class MysqliConnector {

    static $mysqli_instance = null;

    function __construct() {}

    function getInstance(){
      if(self::$mysqli_instance == null) {
        //dump('instancia de connector null');
        self::$mysqli_instance = new mysqli('localhost', 'root', 'Sakura23!', 'local');
      //  dump(self::$mysqli_instance);
        return self::$mysqli_instance;
      }else{
      //  dump('ya existe la instancia del connector');
        return self::$mysqli_instance;
      }
    }

    function __destructor(){
      if(self::$mysqli_instance!=null){
        self::$mysqli_instance->close();
        self::$mysqli_instance=null;
      }
    }

  }






?>
