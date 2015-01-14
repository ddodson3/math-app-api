<?php 
require_once 'API.class.php';

class IosApi extends API {



	protected function answers() {

		switch ($this->method) {
			case 'GET':
				break;
			case 'POST':
				return $this->addAnswer();
				break;
			default:
				return $this->response(Array('error' => 'Invalid Method'), 405);
				break;
		}
	}

	private function addAnswer() {
		$required_fields = array("user", "answer", "correct", "time");

		foreach($required_fields as $field) {
			if (!isset($_POST[$field])) {
				return $this->response(Array('error' => 'Cannot process entity'), 400);
				exit();
			}
		}

		$user = $_POST["user"];
		$answer = $_POST["answer"];
		$correct = $_POST["correct"];
		$time = $_POST["time"];


		$stmt = $this->db->prepare("INSERT INTO answers (user, answer, correct, time) VALUES (?, ?, ?, ?)");
		
		$stmt->bind_param('idid', $user, $answer, $correct, $time);
		$stmt->execute();
		if ($stmt->errno) {
			$stmt->close();
			throw new Exception('Cannot save to database');
		}
		$stmt->close();
		return ($this->response(Array('result' => 'created', 
									'user' => $user, 
									'answer' => $answer, 
									'correct' => $correct, 
									'time' => $time),201));
	}
}