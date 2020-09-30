<?php
    class User{

        // conn
        private $conn;

        // table
        private $dbTable = 'User';

        // col
        public $id;
        public $name;
        public $email;
        public $age;
        public $profile;
        public $created;

        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        // GET Users
        public function getUsers(){
            $sqlQuery = "SELECT id, name, email, age, profile, created FROM " . $this->dbTable . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE User
        public function createUser(){
            $sqlQuery = "INSERT INTO
                        ". $this->dbTable ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        profile = :profile, 
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->profile=htmlspecialchars(strip_tags($this->profile));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":profile", $this->profile);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // GET User
        public function getSingleUser(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        email, 
                        age, 
                        profile, 
                        created
                      FROM
                        ". $this->dbTable ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->age = $dataRow['age'];
            $this->profile = $dataRow['profile'];
            $this->created = $dataRow['created'];
        }        

        // UPDATE User
        public function updateUser(){
            $sqlQuery = "UPDATE
                        ". $this->dbTable ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        profile = :profile, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->profile=htmlspecialchars(strip_tags($this->profile));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":profile", $this->profile);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE User
        function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->dbTable . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

