<?php 

abstract class DatabaseConnection {
	protected $db;

	function __construct() {
		$hostName = 'localhost';
		$userName = 'iosapp';
		$password = 'BtLfjkeXO5KH9J';
		$database = 'mathQuestions';

		$this->db = new mysqli($hostName, $userName, $password, $database);
	

		if ($this->db->connect_error) {
			throw new Exception('Cannot find database');
		}
	}

	function __destruct() {
		if (!$this->db) {
			db->close();
		}
	}

}