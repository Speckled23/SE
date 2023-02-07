<?php
include 'database.php';

class Properties{
    //Attributes

    public $id;
    public $name;
    public $landlord_id;
    public $address;
    public $city;
    public $country;
    public $zip;
    public $description;
    public $description_feature;
    public $feature;
    public $image;
   

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods
    function add(){
        $sql = "INSERT INTO properties ( name, landlord_id, address,  city, country, zip,
         description, description_feature, feature, image ) VALUES 
         ( :name, :landlord_id, :address, :city, :country, :zip,
         :description, :description_feature, :feature, :image );";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':landlord_id', $this->landlord_id);
        $query->bindParam(':address', $this->address);
        $query->bindParam(':city', $this->city);
        $query->bindParam(':country', $this->country);
        $query->bindParam(':zip', $this->zip);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':description_feature', $this->description_feature);
        $query->bindParam(':feature', $this->feature);
        $query->bindParam(':image', $this->image);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function edit(){
        $sql = "UPDATE properties SET name = :name, landlord_id =:landlord_id, address =:address, city =:city, country =:country, zip =:zip,
        description =:description, description_feature =:description_feature, feature =:feature, image =:image WHERE id = :id;";

$query=$this->db->connect()->prepare($sql);
$query->bindParam(':name', $this->name);
$query->bindParam(':landlord_id', $this->landlord_id);
$query->bindParam(':address', $this->address);
$query->bindParam(':city', $this->city);
$query->bindParam(':country', $this->country);
$query->bindParam(':zip', $this->zip);
$query->bindParam(':description', $this->description);
$query->bindParam(':description_feature', $this->description_feature);
$query->bindParam(':feature', $this->feature);
$query->bindParam(':image', $this->image);
    

        $query->bindParam(':id', $this->id);
    
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function delete($record_id){
        $sql = "DELETE FROM properties WHERE id = :id;";
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
        $sql = "SELECT * FROM properties WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM properties;";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

}



?>