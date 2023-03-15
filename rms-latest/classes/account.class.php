<?php

require_once 'database.php';

class Account{

    public $id;
    public $email;
    public $password;
    public $type;
    public $username;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function sign_in(){
        $sql = "SELECT * FROM account WHERE BINARY email = :email AND BINARY password = :password AND type = 'tenant' AND username =:username";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':password', $this->password);
        $query->bindParam(':username', $this->username);
        if($query->execute()){
            if($query->rowCount()>0){
                return true;
            }
        }
        return false;
    }

    function sign_in_admin(){
        $sql = "SELECT * FROM account WHERE BINARY email = :email AND BINARY password = :password AND type != 'tenant'AND username =:username";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':password', $this->password);
        $query->bindParam(':username', $this->username);
        if($query->execute()){
            if($query->rowCount()>0){
                return true;
            }
        }
        return false;
    }

    function get_account_info($id=0){
        if($id == 0){
            $sql = "SELECT * FROM account WHERE BINARY email = :email AND BINARY password = :password AND username =:username";
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':email', $this->email);
            $query->bindParam(':password', $this->password);
            $query->bindParam(':username', $this->username);
        }else{
            $sql = "SELECT * FROM account WHERE id = :id;";
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':id', $id);
        }
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }
    function account_reset($account_id, $new_password) {
        $sql = "UPDATE account SET password = :password WHERE email = :email";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':password', $new_password);
        $query->bindParam(':account_id', $account_id);
        return $query->execute();
    }
    function get_account_info_by_email($email) {
        $query = "SELECT * FROM account WHERE BINARY email = :email";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bindParam(':email', $email);
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
            return $data;
        } else {
            return false;
        }
    }
    
    

}

?>