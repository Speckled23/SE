<?php

require_once 'database.php';

class Tenant{

  public $id;
  public $first_name;
  public $middle_name;
  public $last_name;
  public $email;
  public $contact_no;
  public $relationship_status;
  public $type_of_household;
  public $previous_address;
  public $region;  
  public $provinces;
  public $city;
  public $sex;
  public $date_of_birth;
  public $has_pet;
  public $number_of_pets;
  public $type_of_pet;
  public $is_smoking;
  public $has_vehicle;
  public $vehicle_specification;
  public $spouse_first_name;
  public $spouse_last_name;
  public $spouse_email;
  public $spouse_num;
  public $occupants;
  public $occupants_relations;
  public $emergency_contact_person;
  public $emergency_contact_number;
  

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function tenants_add() {
        $sql = "INSERT INTO tenant (first_name, middle_name, last_name, email, contact_no, relationship_status, type_of_household, previous_address, region, provinces, city, sex, date_of_birth, has_pet, number_of_pets, type_of_pet, is_smoking, has_vehicle, vehicle_specification, spouse_first_name, spouse_last_name, spouse_email, spouse_num, occupants, occupants_relations, emergency_contact_person, emergency_contact_number) 
        VALUES (:first_name, :middle_name, :last_name, :email, :contact_no, :relationship_status, :type_of_household, :previous_address, :region, :provinces, :city, :sex, :date_of_birth, :has_pet, :number_of_pets, :type_of_pet, :is_smoking, :has_vehicle, :vehicle_specification, :spouse_first_name, :spouse_last_name, :spouse_email, :spouse_num, :occupants, :occupants_relations, :emergency_contact_person, :emergency_contact_number)";
    
      $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':first_name', $this->first_name);
        $query->bindParam(':middle_name', $this->middle_name);
        $query->bindParam(':last_name', $this->last_name);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':contact_no', $this->contact_no);
        $query->bindParam(':relationship_status', $this->relationship_status);
        $query->bindParam(':type_of_household', $this->type_of_household);
        $query->bindParam(':previous_address', $this->previous_address);
        $query->bindParam(':region', $this->region);        
        $query->bindParam(':provinces', $this->provinces);
        $query->bindParam(':city', $this->city);
        $query->bindParam(':sex', $this->sex);
        $query->bindParam(':date_of_birth', $this->date_of_birth);
        $query->bindParam(':has_pet', $this->has_pet);
        $query->bindParam(':number_of_pets', $this->number_of_pets);
        $query->bindParam(':type_of_pet', $this->type_of_pet);
        $query->bindParam(':is_smoking', $this->is_smoking);
        $query->bindParam(':has_vehicle', $this->has_vehicle);
        $query->bindParam(':vehicle_specification', $this->vehicle_specification);
        $query->bindParam(':spouse_first_name', $this->spouse_first_name);
        $query->bindParam(':spouse_last_name', $this->spouse_last_name);
        $query->bindParam(':spouse_email', $this->spouse_email);
        $query->bindParam(':spouse_num', $this->spouse_num);
        $query->bindParam(':occupants', $this->occupants);
        $query->bindParam(':occupants_relations', $this->occupants_relations);
        $query->bindParam(':emergency_contact_person', $this->emergency_contact_person);
        $query->bindParam(':emergency_contact_number', $this->emergency_contact_number);
  
        if($query->execute()){
          return true;
          }
          else{
             return false;
          }	
        }
  
        function tenants_edit() {
          $sql = "UPDATE tenant SET first_name=:first_name, middle_name=:middle_name, last_name=:last_name, email=:email, contact_no=:contact_no, relationship_status=:relationship_status, type_of_household=:type_of_household, previous_address=:previous_address, region=:region, provinces=:provinces, city=:city, sex=:sex, date_of_birth=:date_of_birth, has_pet=:has_pet, number_of_pets=:number_of_pets, type_of_pet=:type_of_pet, is_smoking=:is_smoking, has_vehicle=:has_vehicle, vehicle_specification=:vehicle_specification, spouse_first_name=:spouse_first_name, spouse_last_name=:spouse_last_name, spouse_email=:spouse_email, spouse_num=:spouse_num, occupants=:occupants, occupants_relations=:occupants_relations, emergency_contact_person=:emergency_contact_person, emergency_contact_number=:emergency_contact_number WHERE id=:id;";
      
          $query=$this->db->connect()->prepare($sql);
          $query->bindParam(':first_name', $this->first_name);
          $query->bindParam(':middle_name', $this->middle_name);
          $query->bindParam(':last_name', $this->last_name);
          $query->bindParam(':email', $this->email);
          $query->bindParam(':contact_no', $this->contact_no);
          $query->bindParam(':relationship_status', $this->relationship_status);
          $query->bindParam(':type_of_household', $this->type_of_household);
          $query->bindParam(':previous_address', $this->previous_address);
          $query->bindParam(':region', $this->region);        
          $query->bindParam(':provinces', $this->provinces);
          $query->bindParam(':city', $this->city);
          $query->bindParam(':sex', $this->sex);
          $query->bindParam(':date_of_birth', $this->date_of_birth);
          $query->bindParam(':has_pet', $this->has_pet);
          $query->bindParam(':number_of_pets', $this->number_of_pets);
          $query->bindParam(':type_of_pet', $this->type_of_pet);
          $query->bindParam(':is_smoking', $this->is_smoking);
          $query->bindParam(':has_vehicle', $this->has_vehicle);
          $query->bindParam(':vehicle_specification', $this->vehicle_specification);
          $query->bindParam(':spouse_first_name', $this->spouse_first_name);
          $query->bindParam(':spouse_last_name', $this->spouse_last_name);
          $query->bindParam(':spouse_email', $this->spouse_email);
          $query->bindParam(':spouse_num', $this->spouse_num);
          $query->bindParam(':occupants', $this->occupants);
          $query->bindParam(':occupants_relations', $this->occupants_relations);
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

        function fetch($id=0){
          $sql = "SELECT * FROM tenant WHERE id = :id;";
          $query=$this->db->connect()->prepare($sql);
          $query->bindParam(':id', $id);
          if($query->execute()){
              $data = $query->fetchAll();
          }
          return $data;
        }

      function show()
        {
      $sql = "SELECT * FROM tenant;";
      $query = $this->db->connect()->prepare($sql);
      if($query->execute()){
        $data = $query->fetchAll();
    }
    return $data;
    }

    function tenant_fetch($record_id){
      $sql = "SELECT * FROM tenant WHERE id = :id;";
      $query=$this->db->connect()->prepare($sql);
      $query->bindParam(':id', $record_id);
      if($query->execute()){
          $data = $query->fetch();
      }
      return $data;
    }
    function tenant_delete($record_id){
      $sql = "DELETE FROM tenant WHERE id = :id;";
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