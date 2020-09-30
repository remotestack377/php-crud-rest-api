<?php 
    class DB {
        private $host = "localhost";
        private $db = "demo";
        private $username = "test";
        private $password = "4Mu99BhzK8dr4vF1";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database not connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>