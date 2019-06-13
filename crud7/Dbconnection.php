<?php
class DbConnection 
{    
    private $host = 'localhost';
    private $port= 3308;
    private $username = 'root';
    private $password = '';
    private $database = 'mysqltest';
 
    protected $connection;
 
    public function __construct(){
 
        if (!isset($this->connection)) {
 
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database,$this->port);
 
            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
 
        return $this->connection;
    }
    
 
    public function read($sql){
 
        $query = $this->connection->query($sql);
 
        if ($query == false) {
            return false;
        } 
 
        $rows = array();
 
        while ($row = $query->fetch_array()) {
            $rows[] = $row;
        }
 
        return $rows;
    }
 
    public function execute($sql){
 
        $query = $this->connection->query($sql);
 
        if ($query == false) {
            return false;
        } else {
            return true;
        }        
    }
 
    public function escape_string($value){
 
        return $this->connection->real_escape_string($value);
    }
}
?>