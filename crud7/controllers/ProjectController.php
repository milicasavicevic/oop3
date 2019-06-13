<?php
namespace Controllers;
use \Dbconnection;
//start session
session_start();
 
//including the database connection file

class ProjectController{

 public function viewProjects(){
include('views/view_project.php');
    }



 public function addProject(){


if(isset($_POST['add'])) { 
$crud = new Dbconnection();   
    $name = $crud->escape_string($_POST['name']);
    $status = $crud->escape_string($_POST['status']);
    $duration = $crud->escape_string($_POST['duration']);
 
    //insert data to database
    $sql = "INSERT INTO projects (name, status, duration) VALUES ('$name','$status','$duration')";
 
    if($crud->execute($sql)){
        $_SESSION['message'] = 'Project added successfully';
    }
    else{
        $_SESSION['message'] = 'Cannot add project';
    }
 
    header('location: projects');
}
else{
    $_SESSION['message'] = 'Fill up add form first';
    header('location: projects');
}
    } 
    public function editProject(){
        $id = $_GET['id'];
 
if(isset($_POST['edit']))
 {    
    $crud = new Dbconnection();
    $name = $crud->escape_string($_POST['name']);
    $status = $crud->escape_string($_POST['status']);
    $duration = $crud->escape_string($_POST['duration']);
 
    
    $sql = "UPDATE projects SET name = '$name', status = '$status', duration = '$duration' WHERE id = '$id'";
 
    if($crud->execute($sql)){
        $_SESSION['message'] = 'Project updated successfully';
    }
    else{
        $_SESSION['message'] = 'Cannot update project';
    }
 
    header('location: projects');
}
else{
    $_SESSION['message'] = 'Select project to edit first';
    header('location: projects');
}
    }
    public function deleteProject(){
$crud = new Dbconnection();
        if(isset($_GET['id'])){
 
    //getting the id
    $id = $_GET['id'];
 
    //delete data
    $sql = "DELETE FROM projects WHERE id = '$id'";
 
    if($crud->execute($sql)){
        $_SESSION['message'] = 'Project deleted successfully';
    }
    else{
        $_SESSION['message'] = 'Cannot delete project';
    }
 
    header('location: projects');
}
else{
    $_SESSION['message'] = 'Select project to delete first';
    header('location: projects');
}
    }
}
?>