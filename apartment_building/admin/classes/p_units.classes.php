<?php
include 'database.php';

class P_units{
    //Attributes

    public $id;
    public $unit_name;
    public $main_property;
    public $type;
    public $description;
    public $rent;
    public $unit_condition;


    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods
    function add(){
        $sql = "INSERT INTO propert_units ( unit_name, main_property, type, description, rent,
         unit_condition,  ) VALUES 
         ( :unit_name, :main_property, :type, :type, :description, :rent, :unit_condition );";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':unit_name', $this->unit_name);
        $query->bindParam(':main_property', $this->main_property);
        $query->bindParam(':type', $this->type);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':rent', $this->rent);
        $query->bindParam(':unit_condition', $this->unit_condition);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function edit(){
        $sql = "UPDATE property_units SET unit_name = :unit_name, main_property =:main_property, type =:type, description =:description, rent =:rent,
        unit_condition =:unit_condition WHERE id = :id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':unit_name', $this->unit_name);
        $query->bindParam(':main_property', $this->main_property);
        $query->bindParam(':type', $this->type);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':rent', $this->rent);
        $query->bindParam(':unit_condition', $this->unit_condition);



        $query->bindParam(':id', $this->id);
        if($query->execute()){

            return true;
        }
        else{
            return false;
        }
    }

    function delete($record_id){
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

    function fetch($record_id){
        $sql = "SELECT * FROM property_units WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM property_units;";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

}



?>