<?php

    class Database{

        private $host= 'localhost';
        private $db_name= 'registerpage';
        private $username= 'root';
        private $password= '';
        private $conn;

        public function __construct(){
            $this->conn=null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,$this->username,$this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connection Eroor:' . $e->getMessage();
            }

        }

        public function insertUser($name,$surname,$phone,$email,$adress,$city){

            $query = $this->conn->prepare("INSERT INTO users(`name`,`surname`,`phone`,`email`,`adress`,`city`)
            VALUES (:name, :surname, :phone, :email, :adress, :city)");
            $query->bindParam(':name', $name, PDO::PARAM_STR);
            $query->bindParam(':surname', $surname, PDO::PARAM_STR);
            $query->bindParam(':phone', $phone, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':adress', $adress, PDO::PARAM_STR);
            $query->bindParam(':city', $city, PDO::PARAM_STR);

            $query->execute();
            $user_id = $this->conn->lastInsertId();
            return $user_id;

        }



    }
?>
