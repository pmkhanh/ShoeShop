<?php
    session_start();
    require_once './config/database.php';
    require_once './models/Order.php';

    $orderModel = new Order($pdo);
   
    if (isset($_POST['id']) && $_SESSION['user']) {

        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $orderModel->updateOrder($id,$quantity);
        
    }else {
        echo "Không có dữ liệu gửi từ AJAX.";
    }


?>