<?php
require_once 'application/lib/dev.php';
use application\core\Router; //Используем пространство имен (укажем какой класс подключаем)



/**
 Автоподключение класса. В нашем случае класс Router в application\core\Router.php
 */
spl_autoload_register(function($class){
	$path = str_replace('\\', '/', $class.'.php');
	if (file_exists($path)) {
		require_once $path;	
	}		
});


session_start();

$router = new Router;

$router -> run();




?>