<?php
session_start();
abstract class Conectar{
	private $mysqli;
	public function conectar(){
		$this->mysqli = new mysqli('localhost','root','');
		$this->mysqli->select_db('armando');
		return $this->mysqli;
	}
	public function setNames(){
		return $this->mysqli->query("SET NAMES 'utf8'");
	}
}
?>