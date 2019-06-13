<?php

namespace Model;
use \Dbconnection;

class User
{
    public $id;
    public $name;
    public $surname;
        public $position;

    public function  __construct ($id,$name,$surname,$position) {
        $this->id=$id;
        $this->name=$name;
        $this->surname=$surname;
        $this->position=$position;
    }
    public static function all ()
    {

        $list=[];

        $db = new Dbconnection();
        $query = 'SELECT * FROM users';
        $stmt = $db->link->prepare($query);

        $stmt->execute();
        $rez=$stmt->get_result();

        if($rez){
            while ($user = $rez->fetch_object()) {

                $list[]=new User ($user->users_id,$user->users_name,$user->users_surname,$user->users_position);
            }
            return $list;
        }else return null;



    }
    public static function  add($name,$surname,$position){
        $db = new Dbconnection();

        $query = "INSERT INTO users (users_name, users_surname,users_position) VALUES (?,?,?)";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("sss",$name, $surname,$position);

        $stmt->execute();


    }
    public static function  update($id,$name,$surname,$position){
        $db = new Dbconnection();

        $query = "UPDATE users SET users_name=?,users_surname=?,users_position=? WHERE users_id=?";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("sssi",$name, $surname, $position, $id);

        $stmt->execute();


    }
    public static function find($id) {
        $db = new Dbconnection();
        $id=intval ($id);
        $query="SELECT * from users WHERE users_id=?";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("i",$id);

        $stmt->execute();
        $rez=$stmt->get_result();
        $user = $rez->fetch_object();

        return  new User ($user->users_id,$user->users_name,$user->users_surname,$user->users_position );

    }
    public static function  delete($id){
        $db = new Dbconnection();
        $id=intval ($id);
        $query = "DELETE FROM users WHERE users_id=?";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("i",$id);

        $stmt->execute();

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }
}