<?php
namespace Controllers;
  //start session

session_start();
    //including the database connection file
    use \Dbconnection;

class UserController{
   public function viewUsers(){
include('views/view_user.php');
    }

   public function addUser(){
 if(isset($_POST['add'])) {  
    $crud = new Dbconnection();  
    $name = $crud->escape_string($_POST['name']);
    $surname = $crud->escape_string($_POST['surname']);
    $position = $crud->escape_string($_POST['position']);
 
    //insert data to database
    $sql = "INSERT INTO users (name, surname, position) VALUES ('$name','$surname','$position')";
 
    if($crud->execute($sql)){
        $_SESSION['message'] = 'User added successfully';
    }
    else{
        $_SESSION['message'] = 'Cannot add user';
    }
 
    header('Location:users');
}
else{
    $_SESSION['message'] = 'Fill up add form first';
    header('location: users');
}
   }
     public function updateUser()    {
   

    $id = $_GET['id'];
 
        if(isset($_POST['edit'])) { 
         $crud = new Dbconnection();     
         $name = $crud->escape_string($_POST['name']);
         $surname = $crud->escape_string($_POST['surname']);
         $position = $crud->escape_string($_POST['position']);
 
    
        $sql = "UPDATE users SET name = '$name', surname = '$surname', position = '$position' WHERE id = '$id'";
 
                if($crud->execute($sql)){
               $_SESSION['message'] = 'User updated successfully';
                 }
                else{
                $_SESSION['message'] = 'Cannot update user';
                 }
 
         header('location: users');
        }
    else{
    $_SESSION['message'] = 'Select user to edit first';
    header('location: users');
        }

    }
public function deleteUser(){
 $crud = new Dbconnection(); 
    if(isset($_GET['id'])){
    //getting the id
    $id = $_GET['id'];
 
    //delete data
    $sql = "DELETE FROM users WHERE id = '$id'";
 
        if($crud->execute($sql)){
        $_SESSION['message'] = 'User deleted successfully';
        }
        else{
        $_SESSION['message'] = 'Cannot delete user';
        }
 
    header('location: users');
    }
    else{
    $_SESSION['message'] = 'Select user to delete first';
    header('location: users');
    }
 }
}
?>