<?php

  require_once('MysqliConnector.php');
//require_once('helpers.php');

  class Model {

    private $table   = null;
    private $select  = null;
    private $where   = null;
    private $on      = null;
    private $count   = null;
    private $limit = null;
    //private $model = null;
    private $instance = null;
    private $order_by = null;
    private $order_dir = null;

    function __construct(){
    //  parent::__construct();
    $this->instance = MysqliConnector::getInstance();

    }

    public function order_by($order_by, $order_dir){
      $this->order_by = $order_by;
      $this->order_dir = $order_dir;
      return $this;
    }

    function clean(){
      //$this->table   = null;
      $this->select  = null;
      $this->where   = null;
      $this->on      = null;
      $this->count   = null;
      $this->limit = null;
      $this->model = null;

      return $this;
    }

    public function from($table) {
      $this->table = $table;
      return $this;
    }

    public function on($table, $column_one, $column_two, $as = null) {
      $this->on = ' JOIN ' . $table . $as . ' ON ' . $column_one . '=' . $column_two;
      return $this;
    }

    public function select($select = array()) {
      $this->select = $select;
      return $this;
    }

    public function where($where) {
      $this->where[] = $where;
      return $this;
    }

    public function limit($limit) {
      $this->limit = $limit;
      return $this;
    }

    public function get($params = null) {
      if($this->instance == null){
        //dump('hola2');
//echo 'instancia nula model';
        $this->instance = MysqliConnector::getInstance();
      }else{
        //dump('hola');
      }
      $query[] = 'SELECT';

      if($this->select == null){
        $query[] = '*';
      }else{
        $query[] = join(', ',$this->select);
      }

      $query[] = 'FROM';
      $query[] = $this->table;
      //echo "<pre>";
      if($this->where != null){
        $query[] = 'WHERE';
        if(is_array($this->where)){
          $c = count($this->where);

          for ($i = 0; $i < $c; $i++) {
            $query[] = $this->where[$i];
            if($i + 1 != $c){
              $query[] = 'AND';
            }
          }
        }else{
          $query[] = $this->where;
        }
      }
      //echo "</pre>";
      if($this->order_by != null){
        $query[] = 'ORDER BY';
        $query[] = $this->order_by;
      }

      if($this->limit != null){
        $query[] = 'LIMIT';
        $query[] = $this->limit;
      }

      $query_string = join(' ', $query);
    //  dump($query_string);

      $result = $this->instance->query($query_string) or die('error db');
      $this->clean();

      if($result){
      //  dump($result->num_rows);
        if($result->num_rows == 1){
          //echo 'es uno';
          $data = $result->fetch_assoc();
          //dump($data);
          return $data;
        }else{
          $rows = [];

          while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
          }

          return $rows;
        }
      }else{
        return false;
      }
    }

    public function insert() {}

    public function delete() {}

    public function update() {}

  }


?>
