<?php
class MyClass {
		
	private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'apartment';
	private $con;
	
    function __construct() {
        $this->con =  $this->connectDB();
	}	
   function connectDB() {
		$con = mysqli_connect($this->host,$this->username,$this->password,$this->database);
		return $con;
	}
    function getData($query) {
        $result = mysqli_query($this->con, $query);
        while($row=mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }		
        if(!empty($resultset))
            return $resultset;
	}
}

?>