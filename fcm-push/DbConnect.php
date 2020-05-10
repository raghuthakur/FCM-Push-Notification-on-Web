<?php 
	class DbConnect {
		private $host = 'localhost';
		private $dbName = 'fcm-push';
		private $user = 'root';
		private $pass = 'SJ3ID934FDud8';

		public function connect() {
			try {
				$conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
				//print_r($conn);die;

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch( PDOException $e) {
				echo 'Database Error: ' . $e->getMessage();
			}
		}
	}
 ?>