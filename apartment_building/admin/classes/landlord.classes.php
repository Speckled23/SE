<?php
include 'database.php';

class Landlord{
    //Attributes

    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $contact_num;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $id_doc;
    public $fname;
    public $emergency_num;
   

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods
    function add(){
        $sql = "INSERT INTO tenants ( firstname, lastname, email, contact_num, address, city, state, zip,
         id_doc, fname, emergency_num ) VALUES 
         ( :firstname, :lastname, :email, :contact_num, :address, :city, :state, :zip,
         :id_doc, :fname, :emergency_num );";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':contact_num', $this->contact_num);
        $query->bindParam(':address', $this->address);
        $query->bindParam(':household_type', $this->household_type);
        $query->bindParam(':city', $this->city);
        $query->bindParam(':state', $this->state);
        $query->bindParam(':zip', $this->zip);
        $query->bindParam(':id_doc', $this->id_doc);
        $query->bindParam(':fname', $this->fname);
        $query->bindParam(':emergency_num', $this->emergency_num);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function edit(){
        $sql = "UPDATE landlord SET firstname = :firstname, lastname =:lastname, email =:email, contact_num =:contact_num, address =:address, city =:city, state =:state, zip =:zip,
        id_doc =:id_doc, fname =:fname, emergency_num =:emergency_num WHERE id = :id;";

    $query=$this->db->connect()->prepare($sql);
    $query->bindParam(':firstname', $this->firstname);
    $query->bindParam(':lastname', $this->lastname);
    $query->bindParam(':email', $this->email);
    $query->bindParam(':contact_num', $this->contact_num);
    $query->bindParam(':address', $this->address);
    $query->bindParam(':household_type', $this->household_type);
    $query->bindParam(':city', $this->city);
    $query->bindParam(':state', $this->state);
    $query->bindParam(':zip', $this->zip);
    $query->bindParam(':id_doc', $this->id_doc);
    $query->bindParam(':fname', $this->fname);
    $query->bindParam(':emergency_num', $this->emergency_num);

    

        $query->bindParam(':id', $this->id);
    
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function delete($record_id){
        $sql = "DELETE FROM landlord WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function fetch($record_id){
        $sql = "SELECT * FROM landlord WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM landlord;";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

}



?>