<?php
namespace Controllers;
 //start session

session_start();

    //including the database connection file
    use \Dbconnection;

class TaskController{

    public function viewTasks(){
include('views/view_task.php');
    }
    

    public function createTask()  {
$crud = new Dbconnection();
 
if(isset($_POST['add'])) {    
    $name = $crud->escape_string($_POST['name']);
    
 
    //insert data to database
    $sql = "INSERT INTO tasks (name) VALUES ('$name')";
    if($crud->execute($sql)){
        $_SESSION['message'] = 'Task added successfully';
    }
    else{
        $_SESSION['message'] = 'Cannot add task';
    }
 
    header('location: tasks');
}
else{
    $_SESSION['message'] = 'Fill up add form first';
    header('location: tasks');
}
    }
    public function editTask(){
        $crud = new Dbconnection();
    	$id = $_GET['id'];
 
if(isset($_POST['edit'])) {    
    $name = $crud->escape_string($_POST['name']);
 
    
    $sql = "UPDATE tasks SET name = '$name' WHERE id = '$id'";
 
    if($crud->execute($sql)){
        $_SESSION['message'] = 'Task updated successfully';
    }
    else{
        $_SESSION['message'] = 'Cannot update task';
    }
 
    header('location: tasks');
}
else{
    $_SESSION['message'] = 'Select user to edit first';
    header('location: tasks');
}
    }
    public function deleteTask(){
        $crud = new Dbconnection();
    	if(isset($_GET['id'])){
 
    //getting the id
    $id = $_GET['id'];
 
    //delete data
    $sql = "DELETE FROM tasks WHERE id = '$id'";
 
    if($crud->execute($sql)){
        $_SESSION['message'] = 'Task deleted successfully';
    }
    else{
        $_SESSION['message'] = 'Cannot delete task';
    }
 
    header('location: tasks');
}
else{
    $_SESSION['message'] = 'Select task to delete first';
    header('location: tasks');
}
    }
}