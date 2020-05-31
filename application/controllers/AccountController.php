<?php

namespace application\controllers;
use application\core\Controller;


class AccountController extends Controller{
	
	public function loginAction(){
		$this->view->layout = 'logout'; //применяем шаблон logout из папки application/views/layouts
		if (!empty($_POST)) {
			//$this->view->message("success", "Ok!");
			$this->view->location("/"); //При успешной авторизации перенаправляем на главную страницу
		}

		$this->view->render('Вход');
	}

	public function registerAction(){
		$this->view->layout = 'logout'; //применяем шаблон logout из папки application/views/layouts
		$this->view->render('Регистрация');
	}

	public function testAction(){
		$this->view->path = 'test/test'; //переопределяем путь к вьюхе
		$this->view->render('Test');
	}
}

?>