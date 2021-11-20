<?php
    class Database {
        private $host = "localhost";
        private $userName = "root";
        private $database = "students";
        private $password = "";

        protected $db;

        public function __construct()
        {
            try {

                // Create database connections
				$this->db = new PDO("mysql:host=". $this->host .";dbname=". $this->database, $this->userName, $this->password);
                
            } catch (PDOException $e) {
                //throw $th;
				echo "Connection problem: ". $e->getMessage();
            }   
        }
    }
?>