<?php

    class Order {

        private $pdo;
        private $id;

        public function getId() {
            return $this->id;
        }
    
        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function create($userId, $productId, $quantity) {
            $sql = "CALL CreateOrder(?, ?, ?)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$userId, $productId, $quantity]);
        }
        public function getOrders($userId, $sort = 'desc') {
            $sql = "";
            if($sort === 'desc') {
                $sql = "call ct467.desc(?)";
            }
            else {
                $sql = "call ct467.asc(?)";
            }
           
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$userId]);
            return $stmt->fetchAll();
        }
        public function getOrderTotals($userId) {
            $sql = "SELECT CalculateTotalPrice(?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$userId]);
            return $stmt->fetchColumn();
        }
        public function deleteOrder($id){
            $sql = "call ct467.delete_order(?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
        }
        public function updateOrder($id,$quantity=1){
            $sql = "UPDATE `ct467`.`order` SET `quantity` = ? WHERE `id` = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$quantity,$id]);
        }
    }
    



?>