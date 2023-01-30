<?php
include 'database.php';

class P_units{
    //Attributes

    public $id;
    public $name;
    public $main_p;
    public $address;
    public $type;
    public $description_p;
    public $status;
    public $rent_amount;
    public $condition;


    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods
    function add(){
        $sql = "INSERT INTO propert_units ( name, main_p, address,  type, description_p, status,
         rent_amount, condition ) VALUES 
         ( :name, :main_p, :address, :type, :description_p, :status,
         :rent_amount, :condition );";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':main_p', $this->main_p);
        $query->bindParam(':address', $this->address);
        $query->bindParam(':type', $this->type);
        $query->bindParam(':description_p', $this->description_p);
        $query->bindParam(':status', $this->status);
        $query->bindParam(':rent_amount', $this->rent_amount);
        $query->bindParam(':condition', $this->condition);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function edit(){
        $sql = "UPDATE property_units SET name = :name, main_p =:main_p, address =:address, type =:type, description_p =:description_p, status =:status,
        rent_amount =:rent_amount, condition =:condition WHERE id = :id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':main_p', $this->main_p);
        $query->bindParam(':address', $this->address);
        $query->bindParam(':type', $this->type);
        $query->bindParam(':description_p', $this->description_p);
        $query->bindParam(':status', $this->status);
        $query->bindParam(':rent_amount', $this->rent_amount);
        $query->bindParam(':condition', $this->condition);



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