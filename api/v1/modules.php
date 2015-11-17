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
		
		function getCategories($app) {
			$sql = "SELECT * FROM deals_category";
			try {
				$db = $this->con;
				$stmt = $db->query($sql); 
				$categories = $stmt->fetchAll(PDO::FETCH_OBJ);
				$this->sendResponse(200,'{"categories": ' . json_encode($categories) . '}',$app);
			} catch(PDOException $e) {
				$this->sendResponse(400,'{"error":{"text":'. $e->getMessage() .'}}',$app);
			}
		}


		function submitMiscellaneous($app) {
			$request = $app->request();

			//RECEIVING POSTED DATA
			$threadTypeId = $request->post('threadTypeId');
			$title = $request->post('title');
			$catid = $request->post('catid');
			$description = $request->post('description');
			$tags = $request->post('tags');
			$userid = $request->post('userid');

			$sql = "INSERT INTO thread_details (thread_type_id, title, catid, description, tags, userid) VALUES (:threadTypeId, :title, :catid, :description, :tags, :userid)";
			try {
				$db = $this->con;
				$stmt = $db->prepare($sql);  
				$stmt->bindParam("threadTypeId", $threadTypeId);
				$stmt->bindParam("title", $title);
				$stmt->bindParam("catid", $catid);
				$stmt->bindParam("description", $description);
				$stmt->bindParam("tags", $tags);
				$stmt->bindParam("userid", $userid);
				$stmt->execute();
				$this->sendResponse(200,json_encode("Data Inserted Successfully"),$app); 
				return true;
			} catch(PDOException $e) {
				$this->sendResponse(400,'{"error":{"text":'. $e->getMessage() .'}}',$app); 
			}
		}

		function sendResponse($status_code, $response, $app) {
	    	$app->response->setStatus($status_code);
	    	$app->contentType('application/json');
		   	$app->response->write($response);
		}
	}
?>