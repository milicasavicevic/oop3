<?php

namespace Model;
use \Dbconnection;

class Project
{
    public $id;
    public $name;
    public $status;
    public $duration;

    public function  __construct ($id,$name,$status,$duration) {
        $this->id=$id;
        $this->name=$name;
        $this->status=$status;
        $this->duration=$duration;
    }
    public static function all ()
    {

        $list=[];

        $db = new DbConnection();
        $query = 'SELECT * FROM projects';
        $stmt = $db->link->prepare($query);

        $stmt->execute();
        $rez=$stmt->get_result();

        if($rez){
            while ($project = $rez->fetch_object()) {

                $list[]=new Project ($project->project_id,$project->project_name,$user->project_status,$project->project_duration);
            }
            return $list;
        }else return null;



    }
    public static function  add($name,$status,$duration){
        $db = new Dbconnection();

        $query = "INSERT INTO projects (project_name, project_status,project_duration) VALUES (?,?,?)";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("sss",$name, $status,$duration);

        $stmt->execute();


    }
    public static function  update($id,$name,$status,$duration){
        $db = new Dbconnection();

        $query = "UPDATE projects SET project_name=?,project_status=?,project_duration=? WHERE project_id=?";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("sssi",$name, $status, $duration, $id);

        $stmt->execute();


    }
    public static function find($id) {
        $db = new Dbconnection();
        $id=intval ($id);
        $query="SELECT * from projects WHERE project_id=?";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("i",$id);

        $stmt->execute();
        $rez=$stmt->get_result();
        $user = $rez->fetch_object();

        return  new Project ($project->project_id,$project->project_name,$project->project_status,$projct->project_duration );

    }
    public static function  delete($id){
        $db = new Dbconnection();
        $id=intval ($id);
        $query = "DELETE FROM projects WHERE project_id=?";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("i",$id);

        $stmt->execute();

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }
}