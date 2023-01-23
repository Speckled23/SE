<?php

require_once 'database.php';

class Accounts{

    public $id;
    public $name;
    public $password;
    public $username;
    public $role;

    protected $db;

    function __construct(){
        $this->db = new Database();
    }

    //Methods
    function check($input_user, $input_pass){
        $sql = "SELECT * FROM user WHERE username = :username AND password = :password;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':username', $input_user);
        $query->bindParam(':password', $input_pass);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function fetch($record_id){
        $sql = "SELECT * FROM user WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM user ORDER BY code ASC;";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }
}

?>