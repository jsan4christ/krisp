<?php
namespace Classes;

class Conexion {

	private $userdb	= "root";
	private $passdb = "theReal@dmin85!";
	private $hostdb = "localhost";
	private $namedb = "krisp";
	public function __construct(){
		
	}
	
	public function conecta(){
		try{
			$conecta = new \PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb."", "".$this->userdb."", "".$this->passdb."");
			$conecta->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return $conecta;
		}catch(PDOException $e){
			echo 'Connection failed: ' . $e->getMessage();
			exit;
		}
	}

	public function executeSQL($query) {
		$result = $this->conecta()->query($query);
		return $result;
	}
	
	public function getUserDb(){
		return $this->userdb;
	}

	public function getHostDb(){
		return $this->hostdb;
	}

	public function getPassDb(){
		return $this->passdb;
	}

	public function getNameDb(){
		return $this->namedb;
	}
}