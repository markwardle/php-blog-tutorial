<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router->addRoute('GET', '/', function() {
	return 'This is the home page!';
});

$router->addRoute('GET', '/hello/{name}', function(Request $request, $name) {
	$response = 'Hello there ' . $name . '.<br>';
	$response .= 'The current path is ' . $request->getPathInfo();
	return new Response($response);
});