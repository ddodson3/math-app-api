<?php 

class downloadCSV {

	private $db;

	function __construct() {

		$hostName = 'localhost';
		$userName = 'iosapp';
		$password = 'BtLfjkeXO5KH9J';
		$database = 'mathQuestions';

		$this->db = new mysqli($hostName, $userName, $password, $database);
	}

	function __destruct() {
		$this->db->close();
	}

	function download() {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');		

		$result = $this->db->query("SELECT * FROM answers");

		$output = fopen('php://output', 'w');

		$headings = array();

		foreach (mysqli_fetch_fields($result) as $col) {
			array_push($headings, $col->name);
		}

		fputcsv($output, $headings);

		while ($row = mysqli_fetch_assoc($result)) {
			fputcsv($output, $row);
		}
	}

}

    $site = new downloadCSV;
	$site->download();




 ?>