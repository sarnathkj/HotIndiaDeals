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
    	
    	$request = $app->request;
    	$response = $app->response;

    	$response->write(json_encode("API Application is Up and Running :) by ".$app->getName()));

    	$app->log->info('RequestIP: ' . $request->getIp() .',TimeStamp: ' .date('Y-m-d h:i:s').',RequestPath: /api/v1' . $request->getPathInfo() . ',ResponseCode: ' . $response->getStatus().',Response: '.$response->getBody());
    	$app->log->info('-----------------------------------------------------------------------------------------------------------------------');

	});


	//GET ROUTES
	$app->get('/categories', 'getCategories');

	$app->get('/users/count','getUsersCount');

	$app->get('/threads/count','getThreadsCount');

	$app->get('/view/profile/:username', function($username) {
		getProfile($username);
	});

	$app->get('/view/:deal_category/:thread_type/:thread_state', function($deal_category, $thread_type, $thread_state) {
		getThread($deal_category,$thread_type,$thread_state);
	});


	//POST ROUTES
	$app->post('/submit/misc', 'postMiscellaneous');
	$app->post('/submit/deal','postDeal');


	$app->run();

?>