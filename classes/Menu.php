<?php

  require_once('Model.php');

  class Menu extends Model{

    protected $model = null;
    protected $table = 'menu';

    function __construct(){

      //parent::__construct();
      $this->model = new Model();

    }

    public function get_menu($lugar) {

      $result = $this->model
        ->select()
        ->from($this->table)
        ->where("lugar = '".$lugar."'")
        ->where("parent_id IS NULL")
        ->get();

      return $result;
    }

    public function get_childrens($id){
      //echo $id;
      $result = $this->model
        ->select()
        ->from($this->table)
        ->where("parent_id = ".$id)
        ->order_by("orden","ASC")
        ->get();
      //dump($result);
      return $result;
    }

  }

?>
