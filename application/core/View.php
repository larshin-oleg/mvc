<?php
namespace application\core;


class View{
	
	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route){
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}


	/**
	* функция сбора вьюхи. 
	* @title - заголовок страницы
	* array vars - массив переменных, передаваемых в отображение страницы
	*/
	public function render($title, $vars = []){
		extract($vars);//пасспаковываем массив переменных в переменные
		$path = 'application/views/'.$this->path.'.php';
		if (file_exists($path)) {
			ob_start();
			require_once $path;
			$content = ob_get_clean();
			require_once 'application/views/layouts/'.$this->layout.'.php';
		} else {
			echo "Вид не найден: ". $this->layout;
		}
	}

	/**
	* функция редиректа. 
	* @url - страница, куда будем редиректить
	*/
	public function redirect($url){
		header('location: '.$url);
		exit();
	}

	/**
	* Метод для отображения кодов ошибок
	* @code - код ошибки. Покажет страницу с названием кода ошибки.
	* Страницы с ошибками находятся в application/views/errors/
	* Для создания страницы ошибок называем ее кодом ошибки (404.php)
	*/
	public static function errorCode($code){
		http_response_code($code);
		$path = 'application/views/errors/'.$code.'.php';
		if (file_exists($path)) {
			require_once $path;
		} else {
			echo "Вид не найден: ". $this->layout;
		}
		exit();
	}

	/**
	* Метод для отображения системных сообщений
	* @status - статус, выводящийся в сообщении
	* @message - текст сообщения
	*/
	public function message($status, $message){
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	/**
	* Редирект для JS (public/js/form.js)
	* @url - url, куда будем редиректить в случае ошибки
	*/
	public function location($url){
		exit(json_encode(['url' => $url]));
	}

}

?>