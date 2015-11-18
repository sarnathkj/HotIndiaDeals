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

    function getProfile($username) {
        $app = \Slim\Slim::getInstance();
        $request=$app->request();
        $response=$app->response();
        
        $HIND = new HIND();
        $HIND->getProfile($username,$app);
        
        $app->log->info('RequestIP: ' . $request->getIp() .',TimeStamp: ' .date('Y-m-d h:i:s').',RequestPath: /api/v1' . $request->getPathInfo() . ',ResponseCode: ' . $response->getStatus() . ',Response: '.$response->getBody());
        $app->log->info('-----------------------------------------------------------------------------------------------------------------------');
    }

    function postMiscellaneous() {
        $app = \Slim\Slim::getInstance();
        $request=$app->request();
        $response=$app->response();
        
        $HIND = new HIND();
        $HIND->postMiscellaneous($app);
        
        $app->log->error('RequestIP: ' . $request->getIp() .',TimeStamp: ' .date('Y-m-d h:i:s').',RequestPath: /api/v1' . $request->getPathInfo() . ',ResponseCode: ' . $response->getStatus() . ',Response: '.$response->getBody());
        $app->log->error('-----------------------------------------------------------------------------------------------------------------------');
    }

    function postDeal() {
        $app = \Slim\Slim::getInstance();
        $request=$app->request();
        $response=$app->response();
        
        $HIND = new HIND();
        $HIND->postDeal($app);

        $app->log->error('RequestIP: ' . $request->getIp() .',TimeStamp: ' .date('Y-m-d h:i:s').',RequestPath: /api/v1' . $request->getPathInfo() . ',ResponseCode: ' . $response->getStatus() . ',Response: '.$response->getBody());
        $app->log->error('-----------------------------------------------------------------------------------------------------------------------');
    }
?>