<?php

include_once('./../../system/essentials.php');

class TodoModel extends Essentials {
  
  protected $table = 'todos';
  protected $status = false;
  
  public function __construct()
  {
    date_default_timezone_set('Asia/Manila');
    parent::__construct();
  }
  
  public function getTodos()
  {
    $sql = "SELECT * FROM $this->table";
    $res = mysqli_query($this->con, $sql);
    
    if($res)
    {
      return $res;
    }
    else
    {
      return $this->status;
    }
  }
  
  public function createTodo($data)
  {
    $todo = $this->check($data['todo']);
    
    $sql = "INSERT INTO todos(todo) VALUES('$todo')";
    $res = mysqli_query($this->con, $sql);
    
    if($res)
    {
      $data['todo_id'] = $this->con->insert_id;
      return $data;
    }
  }
  
  public function updateTodoById($data)
  {
    $id = $this->check($data['todo_id']);
    $todo = $this->check($data['todo']);
    
    $sql = "UPDATE $this->table SET todo = '$todo' WHERE todo_id = $id";
    $res = mysqli_query($this->con, $sql);
    
    if($res)
    {
      $this->status = true;
    }
    return $this->status;
  }
  
  public function deleteTodoById($id = '')
  {
    $sql = "DELETE FROM $this->table WHERE todo_id = $id";
    $res = mysqli_query($this->con, $sql);
    
    if($res)
    {
      $this->status = true;
    }
    return $this->status;
  }
}