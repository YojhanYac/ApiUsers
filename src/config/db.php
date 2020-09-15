<?php

    class Database {
        
        private $server = 'localhost';
		private $dbname = 'db_apiusers';
		private $user = 'root';
		private $pass = '';

        public function connectDB() {
			try {
				$dbConnecion = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbname, $this->user, $this->pass);
				$dbConnecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $dbConnecion;
			} catch (Exception $e) {
				echo "Database Error: " . $e->getMessage();
			}
		}
    }

?>