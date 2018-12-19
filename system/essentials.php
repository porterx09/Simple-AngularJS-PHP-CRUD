<?php

include_once('database.php');

class Essentials extends Db {
  
  protected $data;
  
  public function __construct()
  {
    parent::__construct();
  }
  
  public function check($data)
  {
    $this->data = stripslashes($data);
    $this->data = mysqli_real_escape_string($this->con, $this->data);
    
    return $this->data;
  }
  
}