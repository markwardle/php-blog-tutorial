<?php

// This code is borrowed from the Laravel project

$uri = urldecode (
	parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
	return false;
}
require_once __DIR__.'/public/app.php';