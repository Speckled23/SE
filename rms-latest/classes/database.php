<?php

class Database{
/*     private $host = 'localhost';
    private $username = 'u588864141_rms';
    private $password = '3qRb#cIS]4q';
    private $database = 'u588864141_rms';
    protected $connection; */

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'test';

    function connect(){
        try 
			{
				$this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", 
											$this->username, $this->password);
			} 
			catch (PDOException $e) 
			{
				echo "Connection error " . $e->getMessage();
			}
        return $this->connection;
    }


    
}

?>