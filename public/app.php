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
	// create the request
	$request = Request::createFromGlobals();
	return $request;
});

// add an alias for the request in the container
$container->add('Symfony\Component\HttpFoundation\Request', function() use ($container) {
	return $container->get('request');
});
