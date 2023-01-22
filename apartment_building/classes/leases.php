<?php

require_once 'database.php';

Class Leases{
    //attributes

    public $id;
    public $p_unit_id;
    public $tenants_id;
    public $startdate;
    public $enddate;
    public $rent;
    public $deposit;
    public $advance;
    public $leasedoc;
    public $water;
    public $electricity;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add(){
        $sql = "INSERT INTO lease (p_unit_id, tenants_id, startdate, enddate, rent, deposit, advance, leasedoc, water, electricity) VALUES 
        (:p_unit_id, :tenants_id, :startdate, :enddate, :rent, :deposit, :advance, :leasedoc, :water, :electricity);";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':p_unit_id', $this->p_unit_id);
        $query->bindParam(':tenants_id', $this->tenants_id);
        $query->bindParam(':startdate', $this->startdate);
        $query->bindParam(':enddate', $this->enddate);
        $query->bindParam(':rent', $this->rent);
        $query->bindParam(':deposit', $this->deposit);
        $query->bindParam(':advance', $this->advance);
        $query->bindParam(':leasedoc', $this->leasedoc);
        $query->bindParam(':water', $this->water);
        $query->bindParam(':electricity', $this->electricity);


        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function edit(){
        $sql = "UPDATE programs SET code=:code, description=:description, years=:years, level=:level, cet=:cet, status=:status WHERE id = :id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':code', $this->code);
        $query->bindParam(':years', $this->years);
        $query->bindParam(':level', $this->level);
        $query->bindParam(':cet', $this->cet);
        $query->bindParam(':status', $this->status);
        $query->bindParam(':id', $this->id);

        $sql = "UPDATE lease SET p_unit_id=:p_unit_id, tenants_id=:tenants_id, startdate=:startdate, enddate=:enddate, rent=:rent, deposit=:deposit , advance=:advance, leasedoc=:leasedoc, water=:water , electricity=:electricity WHERE id = :id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':p_unit_id', $this->p_unit_id);
        $query->bindParam(':tenants_id', $this->tenants_id);
        $query->bindParam(':startdate', $this->startdate);
        $query->bindParam(':enddate', $this->enddate);
        $query->bindParam(':rent', $this->rent);
        $query->bindParam(':deposit', $this->deposit);
        $query->bindParam(':advance', $this->advance);
        $query->bindParam(':leasedoc', $this->leasedoc);
        $query->bindParam(':water', $this->water);
        $query->bindParam(':electricity', $this->electricity);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function fetch($record_id){
        $sql = "SELECT * FROM lease WHERE id = :id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function delete($record_id){
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

    function show(){
        $sql = "SELECT * FROM lease ORDER BY code ASC;";
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }
}

?>