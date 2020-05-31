<?php

namespace application\lib;
use PDO;
class Db {
	
	protected $db;

	function __construct()
	{
		$config = require_once 'application/config/db.php';
		
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['user'], $config['password']);

		//debug($this->db);
	}

	public function query($sql, $params = []){
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $value) {
				$stmt->bindValue(':'.$key, $value);
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function row($sql, $params = []){
		$result = $this->query($sql, $params);
		//debug($result->fetchAll(PDO::FETCH_ASSOC)); 
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = []){
		$result = $this->query($sql, $params);
		//debug($result->fetchColumn()); 
		return $result->fetchColumn();
	}
}