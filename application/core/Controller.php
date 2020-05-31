<?php
namespace application\core;

use application\core\View;


abstract class Controller{
	
	public $route;
	public $view;
	public $acl;


	public function __construct($route){
		$this->route = $route;
		if(!$this->checkAcl()){ //Проверка прав доступа
			View::errorCode(403);
		} 
		$this->view = new View($route);	
		$this->model = $this->loadModel($route['controller']);
	}

	public function loadModel($name){
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}

	}

	/*
	 * Метод проверки прав доступа.
	 * Список ролей и доступных страниц в файле application/acl/account.php
	*/
	public function checkAcl(){
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		if ($this->isAcl('all')) {
			return true;
		}
		elseif (isset($_SESSION['authorize']['id']) && $this->isAcl('authorize')) {
			return true;
		}
		elseif (!isset($_SESSION['authorize']['id']) && $this->isAcl('guest')) {
			return true;
		}
		elseif (isset($_SESSION['admin']) && $this->isAcl('admin')) {
			return true;
		}
		return false;
	}	
	/*
	 * Вспомогательный метод для загрузки массива ролей и доступных страниц
	 * Список ролей и доступных страниц в файле application/acl/account.php
	 */
	public function isAcl($key){
		return in_array($this->route['action'], $this->acl[$key]);
	}
}

?>