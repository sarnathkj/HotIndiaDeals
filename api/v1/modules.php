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
				$this->sendResponse(400,json_encode('{"error":{"text":'. $e->getMessage() .'}}'),$app);
			}
		}

		function getProfile($username,$app) {
			$sql = "SELECT * FROM user_details WHERE username=:username";
			try {
				$db = $this->con;
				$stmt = $db->prepare($sql); 
				$stmt->bindParam("username",$username);
				$stmt->execute();
				$user_details = $stmt->fetchAll(PDO::FETCH_OBJ);
				$this->sendResponse(200,'{"user_details": ' . json_encode($user_details) . '}',$app);
			} catch(PDOException $e) {
				$this->sendResponse(400,json_encode('{"error":{"text":'. $e->getMessage() .'}}'),$app);
			}
		}


		function postMiscellaneous($app) {
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
				$this->sendResponse(200,json_encode("Miscellaneous Data Inserted Successfully"),$app); 
				return true;
			} catch(PDOException $e) {
				$this->sendResponse(400,json_encode('{"error":{"text":'. $e->getMessage() .'}}'),$app); 
			}
		}

		function postDeal($app) {
			$request = $app->request();

			//RECEIVING POSTED DATA
			$threadTypeId = $request->post('threadTypeId');
			$title = $request->post('title');
			$deal_url = $request->post('deal_url');
			$price = $request->post('price');
			$catid = $request->post('catid');
			$description = $request->post('description');
			$image = $request->post('image');
			$tags = $request->post('tags');
			$start_date = $request->post('start_date');
			$end_date = $request->post('end_date');
			$userid = $request->post('userid');

			if($start_date!="" && $end_date!="") {
				$sql = "INSERT INTO thread_details (thread_type_id, title, deal_url, price, catid, description, image, tags, start_date, end_date, userid) VALUES (:threadTypeId, :title, :deal_url, :price, :catid, :description, :image, :tags, :start_date, :end_date, :userid)";
			} else if($start_date!="") {
				$sql = "INSERT INTO thread_details (thread_type_id, title, deal_url, price, catid, description, image, tags, start_date, userid) VALUES (:threadTypeId, :title, :deal_url, :price, :catid, :description, :image, :tags, :start_date, :userid)";
			} else if($end_date!="") {
				$sql = "INSERT INTO thread_details (thread_type_id, title, deal_url, price, catid, description, image, tags, end_date, userid) VALUES (:threadTypeId, :title, :deal_url, :price, :catid, :description, :image, :tags, :end_date, :userid)";
			} else {
				$sql = "INSERT INTO thread_details (thread_type_id, title, deal_url, price, catid, description, image, tags, userid) VALUES (:threadTypeId, :title, :deal_url, :price, :catid, :description, :image, :tags, :userid)";				
			}

			try {
				$db = $this->con;
				$stmt = $db->prepare($sql);  
				$stmt->bindParam("threadTypeId", $threadTypeId);
				$stmt->bindParam("title", $title);
				$stmt->bindParam("deal_url",$deal_url);
				$stmt->bindParam("price", $price);
				$stmt->bindParam("catid", $catid);
				$stmt->bindParam("description", $description);
				$stmt->bindParam("image", $image);
				$stmt->bindParam("tags", $tags);

				if($start_date!="" && $end_date!="") {
					$stmt->bindParam("start_date", $start_date);
					$stmt->bindParam("end_date", $end_date);
				} else if($start_date!="") {
					$stmt->bindParam("start_date", $start_date);
				} else if($end_date!="") {
					$stmt->bindParam("end_date", $end_date);
				}

				$stmt->bindParam("userid", $userid);
				$stmt->execute();
				$this->sendResponse(200,json_encode("Deal Inserted Successfully"),$app); 
				return true;
			} catch(PDOException $e) {
				$this->sendResponse(400,json_encode('{"error":{"text":'. $e->getMessage() .'}}'),$app); 
			}

		}

		function sendResponse($status_code, $response, $app) {
	    	$app->response->setStatus($status_code);
	    	$app->contentType('application/json');
		   	$app->response->write($response);
		}
	}
?>