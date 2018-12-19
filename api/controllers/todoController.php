<?php

include_once('../models/todoModel.php');
include_once('../../system/form-validation/formValidation.php');

$todoModel = new TodoModel;
$formValidation = new FormValidation;

$function = $_GET['f'];

$data = array('status' => false);
$array = array();

switch($function) {
  case 'getTodos':
    if($todos = $todoModel->getTodos())
    {
      foreach($todos as $todo)
      {
        $array[] = array(
          'todo_id' => $todo['todo_id'],
          'todo' => $todo['todo']
        );
        $data = array('records' => $array, 'status' => true);
      }
    }

    echo json_encode($data);
    break;
    
  case 'createTodo':
    if($formValidation->todoForm($_POST['todo']))
    {
      if($res = $todoModel->createTodo($_POST['todo']))
      {
        $data = array('record' => $res, 'status' => true);
      }
    }

    echo json_encode($data);
    break;
    
  case 'deleteTodoById':
    if(!empty($_POST['todo_id']))
    {
      if($todoModel->deleteTodoById($_POST['todo_id']))
      {
        $data = array('status' => true);
      }
    }
    
    echo json_encode($data);
    break;
    
  case 'updateTodoById':
    if($formValidation->todoForm($_POST['todo']))
    {
      if($todoModel->updateTodoById($_POST['todo']))
      {
        $data = array('status' => true);
      }
    }
    
    echo json_encode($data);
    break;
    
  default:
    header('Location: ../../error/404.html');
    break;
}
