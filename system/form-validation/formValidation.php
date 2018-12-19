<?php

class FormValidation {
  
  protected $status = false;
  
  public function todoForm($data)
  {  
    $todo = false;
    
    if(preg_match('/[A-Za-z0-9 \.\'\-]{3,20}$/', $data['todo'])) {
      $todo = true;
    }
    
    if($todo)
    {
      $this->status = true;
    }
    
    return $this->status;
  }

}
