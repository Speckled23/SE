<?php

require_once 'database.php';

class Leases{
    //Attributes

    public $id;
    public $property_unit_id;
    public $monthly_rent;
    public $tenant_id;
    public $lease_start;
    public $lease_end;
    public $property_picture;
    public $electricity;
    public $water;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }
    function fetch($id=0){
        $sql = "SELECT * FROM lease WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $id);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM lease;";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }
    function lease_fetch($record_id){
        $sql = "SELECT * FROM lease WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
            // Add the file contents to the returned data array
        }
        return $data;
    }

    function lease_add() {
        // attempt insert query execution
        $sql = "INSERT INTO lease (property_unit_id, monthly_rent, tenant_name, lease_start, lease_end, property_picture, electricity, water) 
        VALUES (:property_unit_id, :monthly_rent, :tenant_name, :lease_start, :lease_end, :property_picture :electricity, :water)";
    
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':property_unit_id', $this->property_unit_id);
        $query->bindParam(':monthly_rent', $this->monthly_rent);
        $query->bindParam(':tenant_name', $this->tenant_name);
        $query->bindParam(':lease_start', $this->lease_start);
        $query->bindParam(':lease_end', $this->lease_end);
        $query->bindParam(':property_picture', $this->property_picture);
        $query->bindParam(':electricity', $this->electricity);
        $query->bindParam(':water', $this->water);


        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    function lease_delete($record_id){
        $sql = "DELETE FROM lease WHERE id = :id;";
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