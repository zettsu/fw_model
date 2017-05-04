<?php

  require_once('Model.php');

  class Menu extends Model{

    protected $model = null;
    protected $table = 'menu';

    function __construct(){
      $this->model = new Model();
    }

    public function get_menu() {

      return $this->model->select()->from($this->table)->get();
    }

  }

?>
