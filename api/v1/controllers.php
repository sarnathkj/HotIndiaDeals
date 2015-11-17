<?php
	require 'modules.php';

    function getCategories() {
        $app = \Slim\Slim::getInstance();
		$request=$app->request();
		$response=$app->response();
    	
        $HIND = new HIND();
        $HIND->getCategories($app);
    	
    	$app->log->info('RequestIP: ' . $request->getIp() .',TimeStamp: ' .date('Y-m-d h:i:s').',RequestPath: /api/v1' . $request->getPathInfo() . ',ResponseCode: ' . $response->getStatus() . ',Response: '.$response->getBody());
    	$app->log->info('-----------------------------------------------------------------------------------------------------------------------');
	}

    function submitMiscellaneous() {
        $app = \Slim\Slim::getInstance();
        $request=$app->request();
        $response=$app->response();
        
        $HIND = new HIND();
        $HIND->submitMiscellaneous($app);
        
        $app->log->error('RequestIP: ' . $request->getIp() .',TimeStamp: ' .date('Y-m-d h:i:s').',RequestPath: /api/v1' . $request->getPathInfo() . ',ResponseCode: ' . $response->getStatus() . ',Response: '.$response->getBody());
        $app->log->error('-----------------------------------------------------------------------------------------------------------------------');
    }
?>