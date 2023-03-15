<?php

require_once 'database.php';

class Property_Units {
    //Attributes
    public $id;
    public $property_id;
    public $unit_type_id;
    public $unit_no;
    public $num_rooms;
    public $num_bathrooms;
    public $monthly_rent;
    public $unit_condition_id;
    public $status;
    public $one_month_deposit;
    public $one_month_advance;
   
    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function fetch($id = 0) {
        $sql = "SELECT * FROM property_units WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':id', $id);
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function show() {
        $sql = "SELECT * FROM property_units;";
        $query = $this->db->connect()->prepare($sql);
        if ($query->execute()) {
            $data = $query->fetchAll();
        }
        return $data;
    }

    function property_unit_fetch($record_id) {
        $sql = "SELECT * FROM property_units WHERE id = :id;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if ($query->execute()) {
            $data = $query->fetch();
        }
        return $data;
    }

    function property_unit_add() {
        // attempt insert query execution
        $sql = "INSERT INTO property_units (property_id, unit_type_id, unit_no, num_rooms, num_bathrooms, monthly_rent, unit_condition_id, status, one_month_deposit, one_month_advance) 
        VALUES (:property_id, :unit_type_id, :unit_no, :num_rooms, :num_bathrooms, :monthly_rent, :unit_condition_id, :status, :one_month_deposit, :one_month_advance)";
    
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':property_id', $this->property_id);
        $query->bindParam(':unit_type_id', $this->unit_type_id);
        $query->bindParam(':unit_no', $this->unit_no);
        $query->bindParam(':num_rooms', $this->num_rooms);
        $query->bindParam(':num_bathrooms', $this->num_bathrooms);
        $query->bindParam(':monthly_rent', $this->monthly_rent);
        $query->bindParam(':unit_condition_id', $this->unit_condition_id);
        $query->bindParam(':status', $this->status);
        $query->bindParam(':one_month_deposit', $this->one_month_deposit);
        $query->bindParam(':one_month_advance', $this->one_month_advance);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }	
    }

    function property_unit_edit() {
        // attempt insert query execution
        $sql = "UPDATE property_units SET property_id=:property_id, unit_type_id=:unit_type_id, unit_no=:unit_no, num_rooms=:num_rooms, num_bathrooms=:num_bathrooms,monthly_rent=:monthly_rent, unit_condition_id=:unit_condition_id, status=:status, one_month_deposit=:one_month_deposit, one_month_advance=:one_month_advance WHERE id=:id;";
        
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':property_id', $this->property_id);
        $query->bindParam(':unit_type_id', $this->unit_type_id);
        $query->bindParam(':unit_no', $this->unit_no);
        $query->bindParam(':num_rooms', $this->num_rooms);
        $query->bindParam(':num_bathrooms', $this->num_bathrooms);
        $query->bindParam(':monthly_rent', $this->monthly_rent);
        $query->bindParam(':unit_condition_id', $this->unit_condition_id);
        $query->bindParam(':status', $this->status);
        $query->bindParam(':one_month_deposit', $this->one_month_deposit);
        $query->bindParam(':one_month_advance', $this->one_month_advance);
        $query->bindParam(':id', $this->id);
    
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function property_unit_delete($record_id){
        $sql = "DELETE FROM property_units WHERE id = :id;";
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