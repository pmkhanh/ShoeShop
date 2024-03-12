<?php

    class User {

        private $pdo;
        private $id;

        public function getId() {
            return $this->id;
        }
    
        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }
        public function create($username, $email, $password, $phone) {
            $sql = "INSERT INTO `user` (username, email, password, phone) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $phone]);
        }
        public function getById($id) {
            $sql = "SELECT * FROM user WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
    }
    



?>