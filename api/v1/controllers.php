<?php
	require 'modules.php';

	function getCategories() {
		$app = \Slim\Slim::getInstance();
		$request=$app->request();
		$response=$app->response();
    	
    
    	$HIND = new HIND();
    	$responseData=$HIND->getCategories();
    	
    	sendResponse(200,$responseData);

    	$app->log->info('RequestIP: ' . $request->getIp() .',TimeStamp: ' .date('Y-m-d h:i:s').',RequestPath: /api/v1' . $request->getPathInfo() . ',ResponseCode: ' . $response->getStatus() . ',Response: '.$response->getBody());
    	$app->log->info('-----------------------------------------------------------------------------------------------------------------------');
	}

	function sendResponse($status_code, $response) {
    	$app = \Slim\Slim::getInstance();
    	$app->response->setStatus($status_code);
    	$app->contentType('application/json');
	   	$app->response->write($response);
	}
?>