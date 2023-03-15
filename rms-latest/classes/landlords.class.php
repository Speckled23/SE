<?php

require_once 'database.php';

class Landlord{
    //Attributes

    public $id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $date_of_birth;
    public $email;
    public $contact_no;
    public $address;
    public $region;
    public $provinces;
    public $city;
    public $identification_document;
    public $emergency_contact_person;
    public $emergency_contact_number;
   
    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }
    function fetch($id=0){
        $sql = "SELECT * FROM landlord WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $id);
        if($query->execute()){
            $data = $query->fetchAll();
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
    function landlord_fetch($record_id){
        $sql = "SELECT * FROM landlord WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
            // Add the file contents to the returned data array
        }
        return $data;
    }
    

    function landlord_add() {
        // attempt insert query execution
        $sql = "INSERT INTO landlord (first_name, middle_name, last_name, date_of_birth, email, contact_no, address, region, provinces, city, identification_document, emergency_contact_person, emergency_contact_number) 
        VALUES (:first_name, :middle_name, :last_name, :date_of_birth, :email, :contact_no, :address, :region, :provinces, :city, :identification_document, :emergency_contact_person, :emergency_contact_number)";
    
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':first_name', $this->first_name);
        $query->bindParam(':middle_name', $this->middle_name);
        $query->bindParam(':last_name', $this->last_name);
        $query->bindParam(':date_of_birth', $this->date_of_birth);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':contact_no', $this->contact_no);
        $query->bindParam(':address', $this->address);
        $query->bindParam(':region', $this->region);        
        $query->bindParam(':provinces', $this->provinces);
        $query->bindParam(':city', $this->city);
        $query->bindParam(':identification_document', $this->identification_document);
        $query->bindParam(':emergency_contact_person', $this->emergency_contact_person);
        $query->bindParam(':emergency_contact_number', $this->emergency_contact_number);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function landlord_edit() {
        // attempt insert query execution
        $sql = "UPDATE landlord SET first_name=:first_name, middle_name=:middle_name, last_name=:last_name, date_of_birth=:date_of_birth, email=:email, contact_no=:contact_no, address=:address, region=:region, provinces=:provinces, city=:city, identification_document=:identification_document, emergency_contact_person=:emergency_contact_person, emergency_contact_number=:emergency_contact_number WHERE id=:id;";
        
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':first_name', $this->first_name);
            $query->bindParam(':middle_name', $this->middle_name);
            $query->bindParam(':last_name', $this->last_name);
            $query->bindParam(':date_of_birth', $this->date_of_birth);
            $query->bindParam(':email', $this->email);
            $query->bindParam(':contact_no', $this->contact_no);
            $query->bindParam(':address', $this->address);
            $query->bindParam(':region', $this->region);        
            $query->bindParam(':provinces', $this->provinces);
            $query->bindParam(':city', $this->city);
            $query->bindParam(':identification_document', $this->identification_document);
            $query->bindParam(':emergency_contact_person', $this->emergency_contact_person);
            $query->bindParam(':emergency_contact_number', $this->emergency_contact_number);
            $query->bindParam(':id', $this->id);
    
            if($query->execute()){
                return true;
            }
            else{
                return false;
            }	
    }
    function landlord_delete($record_id){
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

}

?>