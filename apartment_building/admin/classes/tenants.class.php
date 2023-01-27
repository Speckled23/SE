<?php
include 'database.php';

class Tenants{
    //Attributes

    public $id;
    public $frstname;
    public $lastname;
    public $email;
    public $contact_num;
    public $status;
    public $household_type;
    public $prev_address;
    public $city;
    public $state;
    public $zip;
    public $gender;
    public $birthdate;
    public $pet_num;
    public $pet_type;
    public $smoking;
    public $vehicles;
    public $occupants;
    public $pri;
    public $co_fname;
    public $co_lname;
    public $co_email;
    public $co_num;
    public $emergency_fname;
    public $emergency_num;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods
    function add(){
        $sql = "INSERT INTO tenants ( firstname, lastname, email, contact_num, status, household_type, prev_address, city,
         state, zip, gender, birthdate, pet_num, pet_type, smoking, vehicles, occupants, pri, co_fname, co_lname, co_email, 
         co_num, emergency_fname, emergency_num ) VALUES 
         ( :firstname, :lastname, :email, :contact_num, :status, :household_type, :prev_address, :city,
         :state, :zip, :gender, :birthdate, :pet_num, :pet_type, :smoking, :vehicles, :occupants, :pri, :co_fname, :co_lname, :co_email, 
         :co_num, :emergency_fname, :emergency_num );";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':contact_num', $this->contact_num);
        $query->bindParam(':status', $this->status);
        $query->bindParam(':household_type', $this->household_type);
        $query->bindParam(':prev_address', $this->prev_address);
        $query->bindParam(':city', $this->city);
        $query->bindParam(':state', $this->state);
        $query->bindParam(':zip', $this->zip);
        $query->bindParam(':gender', $this->gender);
        $query->bindParam(':pet_num', $this->pet_num);
        $query->bindParam(':pet_type', $this->pet_type);
        $query->bindParam(':smoking', $this->smoking);
        $query->bindParam(':vehicles', $this->vehicles);
        $query->bindParam(':occupants', $this->occupants);
        $query->bindParam(':pri', $this->pri);
        $query->bindParam(':co_fname', $this->co_fname);
        $query->bindParam(':co_lname', $this->co_lname);
        $query->bindParam(':co_email', $this->co_email);
        $query->bindParam(':co_num', $this->co_num);
        $query->bindParam(':emergency_fname', $this->emergency_fname);
        $query->bindParam(':emergency_num', $this->emergency_num);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function edit(){
        $sql = "UPDATE tenants SET firstname = :firstname, lastname =:lastname, email =:email, contact_num =:contact_num, status =:status, household_type =:household_type, prev_address =:prev_address, city =:city,
        state =:state, zip =:zip, gender =:gender, birthdate =:birthdate, pet_num =:pet_num, pet_type =:pet_type, smoking =:smoking, vehicles =:vehicles, occupants =:occupants, pri =:pri, co_fname =:co_fname, co_lname =:co_lname, co_email =:co_email, 
        co_num =:co_num, emergency_fname =:emergency_fname, emergency_num =:emergency_num WHERE id = :id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':contact_num', $this->contact_num);
        $query->bindParam(':status', $this->status);
        $query->bindParam(':household_type', $this->household_type);
        $query->bindParam(':prev_address', $this->prev_address);
        $query->bindParam(':city', $this->city);
        $query->bindParam(':state', $this->state);
        $query->bindParam(':zip', $this->zip);
        $query->bindParam(':gender', $this->gender);
        $query->bindParam(':pet_num', $this->pet_num);
        $query->bindParam(':pet_type', $this->pet_type);
        $query->bindParam(':smoking', $this->smoking);
        $query->bindParam(':vehicles', $this->vehicles);
        $query->bindParam(':occupants', $this->occupants);
        $query->bindParam(':pri', $this->pri);
        $query->bindParam(':co_fname', $this->co_fname);
        $query->bindParam(':co_lname', $this->co_lname);
        $query->bindParam(':co_email', $this->co_email);
        $query->bindParam(':co_num', $this->co_num);
        $query->bindParam(':emergency_fname', $this->emergency_fname);
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
        $sql = "DELETE FROM tenants WHERE id = :id;";
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
        $sql = "SELECT * FROM tenants WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM tenants;";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

}



?>