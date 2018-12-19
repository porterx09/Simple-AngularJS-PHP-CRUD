angular.module("app")
  .factory("todoFactory", ['$http', function($http){
    
  var config = {
    headers : {
      'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    }
  }; 

  var getTodos = function() {
    return $http.get('api/controllers/todoController.php?f=getTodos').then(function(res) {
      return res.data;
    });
  }
  
  var createTodo = function(data) {
    return $http.post('api/controllers/todoController.php?f=createTodo', data, config).then(function(res) {
      return res.data
    });
  }
  
  var deleteTodo = function(data) {
    return $http.post('api/controllers/todoController.php?f=deleteTodoById', data, config).then(function(res) {
      return res.data;
    });
  }
  
  var updateTodo = function(data) {   
    return $http.post('api/controllers/todoController.php?f=updateTodoById', data, config).then(function(res) {
      return res.data;
    });
  } 
  
  return {
    getTodos: getTodos,
    createTodo: createTodo,
    deleteTodo: deleteTodo,
    updateTodo: updateTodo
  }
    
}]);