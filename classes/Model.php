<?php

  require_once('MysqliConnector.php');

  class Model extends MysqliConnector {

    private $table   = null;
    private $select  = null;
    private $where   = null;
    private $on      = null;
    private $count   = null;
    private $limit = null;
    private $model = null;

    function __construct(){
      parent::__construct();
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
      //echo json_encode(array('select'=>$select));
      $this->select = $select;
      return $this;
    }

    public function where($where) {
      //echo json_encode(array('where'=>$where));
      $this->where = $where;
      return $this;
    }

    public function limit($limit) {
      //echo json_encode(array('limit'=>$limit));
      $this->limit = $limit;
      return $this;
    }

    public function get($params = null) {
      //echo json_encode(array('get_params'=>$params));
      $query[] = 'SELECT';

      if($this->select == null){
        $query[] = '*';
      }else{
        $query[] = join(', ',$this->select);
      }

      $query[] = 'FROM';
      $query[] = $this->table;

      if($this->where != null){
        $query[] = 'WHERE';
        if(is_array($this->where)){
          $c = count($this->where);
          for ($i=-1; $i <= $c; $i++) {
            $query[] = $this->where[$i];
            if($i != $c){
              $query[] = 'AND';
            }
          }
        }else{
          $query[] = $this->where;
        }
      }

      if($this->limit != null){
        $query[] = 'LIMIT';
        $query[] = $this->limit;
      }

      $query_string = join(' ', $query);
      var_dump($query_string);
      $result = $this->instance->query($query_string);
      $this->instance->close();

      if($result){
        if($result->num_rows > 0){
          return $result->fetch_assoc();
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
