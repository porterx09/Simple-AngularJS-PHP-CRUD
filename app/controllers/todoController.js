angular.module("app")
  .controller("todoController", ['$scope', 'Notification', 'todoFactory', function($scope, Notification, todoFactory){
    
  $scope.todos = new Array();
  $scope.todo = {};
    
  $scope.maxSize = 5;
  $scope.itemsPerPage = 10;
  $scope.currentPage = 1;
    
  $scope.getTodos = function() {
    todoFactory.getTodos().then(function(res) {
      if(res.status)
      {
        $scope.todos = res.records;
      }
    }).catch(function(err) {
      console.log(err);
    });
  }
  
  $scope.createTodo = function() {
    var todo = $.param({
      todo: $scope.todo
    });
    
    todoFactory.createTodo(todo).then(function(res) {
      if(res.status)
      {
        $scope.todos.push({
          todo_id: res.record.todo_id,
          todo: res.record.todo
        });
        
        $scope.createForm.$setPristine();
        $scope.todo = {};
        
        $('#createTodoModal').modal('hide');
        Notification.success(createMessage);
      }
      else
      {
        Notification.error(errorMessage);
      }
    }).catch(function(err) {
      console.log(err);
    });
  }
  
  $scope.deleteTodo = function(todo) {
    var data = $.param({
      todo_id: todo.todo_id
    });
    
    if(confirm('Do you want to delete this record?'))
    {
      todoFactory.deleteTodo(data).then(function(res) {
        if(res.status)
        {
          var index = $scope.todos.indexOf(todo);
          $scope.todos.splice(index, 1);

          Notification.success(deleteMessage);
        }
        else
        {
          Notification.error(errorMessage);
        }
      }).catch(function(err) {
        console.log(err);
      });
    }
  }
  
  $scope.createModal = function() {
    $scope.todo = {};
    $scope.createForm.$setPristine();
    
    $('#createTodoModal').modal('show');
  }
  
  $scope.bindTodo = function(todo) {
    $scope.todo = ({
      todo_id: todo.todo_id,
      todo: todo.todo
    });
    
    $scope.index = $scope.todos.indexOf(todo);
    $('#updateTodoModal').modal('show');
  }
  
  $scope.updateTodo = function() {
    var data = $.param({
      todo: $scope.todo
    });
    
    todoFactory.updateTodo(data).then(function(res) {
      if(res.status)
      {
        $scope.todos[$scope.index].todo_id = $scope.todo.todo_id;
        $scope.todos[$scope.index].todo = $scope.todo.todo;
        
        $scope.updateForm.$setPristine();
        $scope.todo = {};
        
        $('#updateTodoModal').modal('hide');
        Notification.success(updateMessage);
      }
      else
      {
        Notification.error(errorMessage);
      }
    }).catch(function(err) {
      console.log(err);
    });
  }
  
  $scope.getTodos();  
  
}]);