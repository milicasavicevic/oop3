<?php
namespace Controllers;
//start session

session_start();

//including the database connection file
use \Dbconnection;
 
class ClientController{
    public function viewClients(){
include('views/view_client.php');
    }



  public function addClient(){

if(isset($_POST['add'])) { 

$crud = new Dbconnection();

    $name = $crud->escape_string($_POST['name']);
    $surname = $crud->escape_string($_POST['surname']);
    $phone = $crud->escape_string($_POST['phone']);
 
    //insert data to database
    $sql = "INSERT INTO clients (name, surname, phone) VALUES ('$name','$surname','$phone')";
 
    if($crud->execute($sql)){
        $_SESSION['message'] = 'Client added successfully';
    }
    else{
        $_SESSION['message'] = 'Cannot add client';
    }
 
    header('location: clients');
}
else{
    $_SESSION['message'] = 'Fill up add form first';
    header('location: clients');
}
 }
 public function editClient(){
        $id = $_GET['id'];
 
if(isset($_POST['edit']))
 {    
    $crud = new Dbconnection();
    $name = $crud->escape_string($_POST['name']);
    $surname = $crud->escape_string($_POST['surname']);
    $phone = $crud->escape_string($_POST['phone']);
 
    
    $sql = "UPDATE clients SET name = '$name', surname = '$surname', phone = '$phone' WHERE id = '$id'";
 
    if($crud->execute($sql)){
        $_SESSION['message'] = 'Client updated successfully';
    }
    else{
        $_SESSION['message'] = 'Cannot update client';
    }
 
    header('location: clients');
}
else{
    $_SESSION['message'] = 'Select client to edit first';
    header('location: clients');
}
    }
public function deleteClient(){
    $crud = new Dbconnection();
    if(isset($_GET['id'])){
 
    //getting the id
    $id = $_GET['id'];
  
    //delete data
    $sql = "DELETE FROM clients WHERE id = '$id'";
 
    if($crud->execute($sql)){
        $_SESSION['message'] = 'Client deleted successfully';
    }
    else{
        $_SESSION['message'] = 'Cannot delete client';
    }
 
    header('location: clients');
}
else{
    $_SESSION['message'] = 'Select client to delete first';
    header('location: clients');
}
}
}
?>