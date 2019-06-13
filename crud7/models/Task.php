<?php

namespace Model;
use \Dbconnection;

class Task
{
    public $id;
    public $name;
    

    public function  __construct ($id,$name) {
        $this->id=$id;
        $this->name=$name;
        
    }
    public static function all ()
    {

        $list=[];

        $db = new Dbconnection();
        $query = 'SELECT * FROM tasks';
        $stmt = $db->link->prepare($query);

        $stmt->execute();
        $rez=$stmt->get_result();

        if($rez){
            while ($task = $rez->fetch_object()) {

                $list[]=new Task ($task->task_id,$task->task_name);
            }
            return $list;
        }else return null;



    }
    public static function  add($name){
        $db = new Dbconnection();

        $query = "INSERT INTO tasks (task_name) VALUES (?)";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("s",$name);

        $stmt->execute();


    }
    public static function  update($id,$name){
        $db = new Dbconnection();

        $query = "UPDATE tasks SET task_name=? WHERE users_id=?";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("si",$name, $id);

        $stmt->execute();


    }
    public static function find($id) {
        $db = new Dbconnection();
        $id=intval ($id);
        $query="SELECT * from tasks WHERE task_id=?";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("i",$id);

        $stmt->execute();
        $rez=$stmt->get_result();
        $task = $rez->fetch_object();

        return  new Task ($task->task_id,$task->task_name );

    }
    public static function  delete($id){
        $db = new Dbconnection();
        $id=intval ($id);
        $query = "DELETE FROM tasks WHERE task_id=?";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("i",$id);

        $stmt->execute();

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }
}