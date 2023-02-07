<?php

require_once 'database.php';

class Accounts{

    public $id;
    public $name;
    public $username;
    public $password;
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

}

?>