<?php
namespace application\core;
use application\lib\Db; //черновик класса БД
//use application\lib\SafeMySQL; //Подключаем класс SafeMySQL

abstract class Model{
	
	public $db;

	public function __construct(){
		$this->db = new Db; //Создание объекта БД для тестов
		//$this->db = new SafeMySQL; //Рабочее создание объекта БД
	}

	
}

?>