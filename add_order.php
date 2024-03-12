
<?php
    session_start();
    require_once './config/database.php';
    require_once './models/Order.php';

    $orderModel = new Order($pdo);
    if (isset($_POST['productId']) && $_SESSION['user']) {
        $productId = $_POST['productId'];
        $userId = $_SESSION['user']['id'];
        $quantity = 1;

        $orderModel->create($userId, $productId, $quantity);


    }
    else {
        echo "Không có dữ liệu gửi từ AJAX.";
    }

?>

