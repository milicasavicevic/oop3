<?php
namespace model;
use \Dbconnection;

class Client
{
    public $id;
    public $name;
    public $surname;
    public $phone;


    public function __construct($id, $name, $surname,$phone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
    }


    public static function all()
    {

        $list = [];

        $db = new Dbconnection();
        $query = "SELECT * FROM clients";
        $stmt = $db->link->prepare($query);

        $stmt->execute();
        $rez=$stmt->get_result();

        if ($rez) {
            while ($client = $rez->fetch_object()) {

                $list[] = new Client ($client->client_id, $client->client_name, $client->client_surname, $client->client_surname);
            }

            return $list;


        }else {
            return null;
        }
    }

    public static function add($name, $surname, $position)
    {
        $db = new Dbconnection();

        $query = "INSERT INTO client (client_name, client_surtname, client_phone) VALUES (?,?)";
        $stmt  = $db->link->prepare($query);
        $stmt ->bind_param("sss",$name, $surname, $phone);


        $stmt->execute();
//        $rez=$prep_state->get_result();
//        $db->insert($query);


    }

    public static function update($id, $name, $surname,$phone)
    {
        $db = new Dbconnection();

        $query = "UPDATE client SET client_name=?,client_surname=?,client_phone=? WHERE client_id=?";;
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("sssi",$name, $surname, $surname, $id);

        $stmt->execute();
        //$rez=$prep_state->get_result();


    }

    public static function find($id)
    {
        $db = new Dbconnection();
        $id = intval($id);
        $query = "SELECT * from client WHERE client_id=?";

        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("i",$id);

        $stmt->execute();
        $rez=$stmt->get_result();
        $client = $rez->fetch_object();

        return new Client ($client->client_id, $client->client_name, $client->client_surname, $client->client_phone);

    }

    public static function delete($id)
    {
        $db = new Dbconnection();
        $id = intval($id);
        $query = "DELETE FROM client WHERE client_id=?";
        $stmt = $db->link->prepare($query);
        $stmt ->bind_param("i",$id);

        $stmt->execute();

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

}