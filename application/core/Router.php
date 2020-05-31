<?php


namespace application\core; //Укажем пространство имен для этого класса (где он находится)

use application\core\View;
/**
 * 
 */
class Router {
	
	protected $routes = [];
	protected $params = [];


	/* 
	* Конструктор класса.  
	* Здесь вызываем метод добавления маршрутов
	*/
	public function __construct(){
		$arr = require_once 'application/config/routes.php';
		foreach ($arr as $key => $value) {
			$this->add($key, $value);
		}
		//debug($this->routes);
	}
	
	/* 
	* Метод добавления маршрута 
	* @route - ключ массива из файла application/config/routes.php
	* @params - массив парамметров маршрута
	*/
	public function add($route, $params){
		$route = '#^'.$route.'$#'; //составляем регулярное выражение для pregmatch
		$this -> routes[$route] = $params;
	}

	/* 
	* Метод проверки существования маршрута 
	* Если маршрут найден возвращает true иначе - false
	*/
	public function match(){
		$url = trim($_SERVER['REQUEST_URI'],'/');
		foreach ($this->routes as $route => $params) {
			if (preg_match($route, $url, $matches)) { //проверим соответствие маршрутов
				$this->params = $params;
				return true; 
			}
		}
		return false;
	}

	public function run(){
		if ($this->match()){
			$controller_path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller'; //Получаем полный путь подключаемого контроллера
			/*Проверка существования класса:*/
			if (class_exists($controller_path)) {
				/*Проверка существования Action:*/
				$action = $this->params['action']."Action";
				if(method_exists($controller_path, $action)){
					$controller = new $controller_path($this->params);
					$controller -> $action();
				} else {
					View::errorCode(404);
				}
			} else {
				View::errorCode(404);
			}

		} else {View::errorCode(404);}

	}


}

?>