<?php
	date_default_timezone_set('Asia/Kolkata');
	require '../vendor/autoload.php';
	require 'controllers.php';

	//ForLogging - AccessLogs
	$log = new \Slim\LogWriter(fopen('../logs/access.log', 'a'));

	$app = new \Slim\Slim(array(
		'mode' => 'development',
		'log.writer' => $log,
		'log.level' => \Slim\Log::DEBUG,
		'log.enabled' => true,
		'http.version' => '1.1',
		'contentType' => 'application/json'
	));

	$app->setName('HIND');



	// TEST GET route
    $app->get('/hello', function () use ($app) {
    	echo "API Application is Up and Running :) by ".$app->getName();

    	$request = $app->request;
    	$response = $app->response;

    	$app->log->info('RequestIP: ' . $request->getIp() .',TimeStamp: ' .date('Y-m-d h:i:s').',RequestPath: /api/v1' . $request->getPathInfo() . ',ResponseCode: ' . $response->getStatus());

	});


	//GET ROUTES
	$app->get('/categories', 'getCategories');

    $app->post('/init', function ()use ($app) {
    
  		try {
  			$req=$app->request();
	      	$data= $req->getBody();
    		$data=json_decode($req->getBody());

	      	if(isset($data->ulocation) && isset($data->storeid) && isset($data->userid)){
    	    	$dbhandler = new HND();
      		} else{
         		$response = array('info'=>array("error"=>"true","message"=>"params missing: what is needed : ulocation, storeid, userid"));
      		}
      

	  	} catch(Exception $e){
    		$response = array('info'=>array("error"=>"true","message"=>"There was an error while trying to process your request","trace"=>$e,"code"=>"1002"));
  		}
    
    	sendResponse(200, $response);

	});


	$app->run();

?>