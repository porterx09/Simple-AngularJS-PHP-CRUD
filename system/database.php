<?php

class Db {
  
  protected $host = 'localhost';
  protected $user = 'root';
  protected $pass = '';
  protected $dbname = 'angularjs_php_crud';
  protected $con;
  
  public function __construct()
  {
    $this->connect();
  }
  
  protected function connect()
  {
    $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
    if(!$this->con)
    {
      header('Location: ../../error/503.html');
    }
  }
  
}