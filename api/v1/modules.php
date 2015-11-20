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
			$sql = "SELECT * FROM thread_category";
			try {
				$db = $this->con;
				$stmt = $db->query($sql); 
				$categories = $stmt->fetchAll(PDO::FETCH_OBJ);
				$this->sendResponse(200,'{"categories": ' . json_encode($categories) . '}',$app);
			} catch(PDOException $e) {
				$this->sendResponse(400,json_encode('{"error":{"text":'. $e->getMessage() .'}}'),$app);
			}
		}

		function getUsersCount($app) {
			$sql = "SELECT count(*) AS usersCount FROM user_details";
			try {
				$db = $this->con;
				$stmt = $db->query($sql); 
				$usersCount = $stmt->fetch(PDO::FETCH_OBJ);
				$this->sendResponse(200,'{"usersCount": ' . json_encode($usersCount->usersCount) . '}',$app);
			} catch(PDOException $e) {
				$this->sendResponse(400,json_encode('{"error":{"text":'. $e->getMessage() .'}}'),$app);
			}
		}

		function getThreadsCount($app) {
			$sql = "SELECT count(*) AS threadsCount FROM thread_details";
			try {
				$db = $this->con;
				$stmt = $db->query($sql); 
				$threadsCount = $stmt->fetch(PDO::FETCH_OBJ);
				$this->sendResponse(200,'{"threadsCount": ' . json_encode($threadsCount->threadsCount) . '}',$app);
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

		function getThread($thread_category,$thread_type,$thread_state,$app) {
			$thread_type_id = $this->getThreadTypeId($thread_type,$app);
			$thread_state_id = $this->getThreadStateId($thread_state,$app);
			
			if($thread_category=="all") {
				$sql = "SELECT * FROM thread_details WHERE thread_type_id=:thread_type_id AND state=:thread_state_id";
			} else {
				$thread_category_id = $this->getThreadCategoryId($thread_category,$app);
				$sql = "SELECT * FROM thread_details WHERE thread_type_id=:thread_type_id AND state=:thread_state_id AND catid=:thread_category_id";
			}

			try {
				$db = $this->con;
				$stmt = $db->prepare($sql); 
				$stmt->bindParam("thread_type_id",$thread_type_id);
				$stmt->bindParam("thread_state_id",$thread_state_id);
				if($thread_category!="all") {
					$stmt->bindParam("thread_category_id",$thread_category_id);
				}
				$stmt->execute();
				$thread_details = $stmt->fetchAll(PDO::FETCH_OBJ);
				$this->sendResponse(200,'{"thread_details": ' . json_encode($thread_details) . '}',$app);
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

		function getThreadTypeId($thread_type,$app) {
			$sql = "SELECT id FROM thread_type WHERE type=:thread_type";
			try {
				$db = $this->con;
				$stmt = $db->prepare($sql); 
				$stmt->bindParam("thread_type",$thread_type);
				$stmt->execute();
				$thread_details = $stmt->fetch(PDO::FETCH_OBJ);
				return $thread_details->id;
			} catch(PDOException $e) {
				$this->sendResponse(400,json_encode('{"error":{"text":'. $e->getMessage() .'}}'),$app);
			}
		}

		function getThreadCategoryId($thread_category,$app) {
			$sql = "SELECT catid FROM thread_category WHERE name=:thread_category";
			try {
				$db = $this->con;
				$stmt = $db->prepare($sql); 
				$stmt->bindParam("thread_category",$thread_category);
				$stmt->execute();
				$thread_category_details = $stmt->fetch(PDO::FETCH_OBJ);
				return $thread_category_details->catid;
			} catch(PDOException $e) {
				$this->sendResponse(400,json_encode('{"error":{"text":'. $e->getMessage() .'}}'),$app);
			}
		}

		function getThreadStateId($thread_state,$app) {
			$sql = "SELECT id FROM thread_state WHERE state=:thread_state";
			try {
				$db = $this->con;
				$stmt = $db->prepare($sql); 
				$stmt->bindParam("thread_state",$thread_state);
				$stmt->execute();
				$thread_state_details = $stmt->fetch(PDO::FETCH_OBJ);
				return $thread_state_details->id;
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