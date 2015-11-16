<?php

	class HIND {
		private $con;

    	function __construct() {
    		$host="localhost";
 	       	$name="hind_dev";
 	       	$uname="root";
 	       	$pass="";
  	       	$con='';
  	      	try {
	  	      	$con= new PDO("mysql:host=$host;dbname=$name", $uname, $pass,  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    	        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	} catch(PDOException $e) {
          		echo json_encode($e->getMessage());
          	}

       	  	$this->con = $con;
    	}
		
		function getCategories() {
			$sql = "SELECT * FROM deals_category";
			try {
				$db = $this->con;
				$stmt = $db->query($sql); 
				$categories = $stmt->fetchAll(PDO::FETCH_OBJ);
				return '{"categories": ' . json_encode($categories) . '}';
			} catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
				return '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}

	}
?>