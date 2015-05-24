<?php

// load the autoloader
require_once dirname(__DIR__) . "/vendor/autoload.php";

use League\Container\Container;
use Symfony\Component\HttpFoundation\Request;

// create the IoC container
$container = new Container;

// register the singleton request object in the container
// this function will be called the first time the request
// object is needed and the returned object will be used
// there after
$container->singleton('request', function() {
	// create the request from PHP's global variables
	$request = Request::createFromGlobals();
	return $request;
});

// add an alias for the request in the container
$container->add('Symfony\Component\HttpFoundation\Request', function() use ($container) {
	return $container->get('request');
});


// other bootstrap code will go here


// create the router and add it to the container
$router = new League\Route\RouteCollection($container);
$router->setStrategy(new Wardlem\Routing\Strategy());
$container->add('router', $router);
$container->add('Leauge\Route\RouteCollection', $router);

// load the routes for the application
require dirname(__DIR__) . '/config/routes.php';

// dispatch the request to the router and return the response to the client
$dispatcher = $router->getDispatcher();
$request = $container->get('request');
$response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
$response->send();