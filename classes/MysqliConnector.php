<?php

  require_once('config.php');

  class MysqliConnector {

    protected $instance = null;

     function __construct() {
      if($this->instance == null) {
        $this->instance = new mysqli('localhost', 'root', 'Sakura23!', 'local');
        return $this->instance;
      }else{
        return $this->instance;
      }
    }
  }

?>
