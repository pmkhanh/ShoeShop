<?php
session_start();
include_once('./config/database.php');
if (isset($_POST['login'])) {

    // session_destroy();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql_login = "SELECT * FROM `user` WHERE username=? AND password=?";
    $stmt = $pdo->prepare($sql_login);
    $stmt->execute([$username, $password]);
    $result_login = $stmt->fetch();
    $_SESSION['user'] = $result_login;
    $count = $stmt->rowCount();
    if ($count > 0) {
        $row_data = $result_login;
        $_SESSION['dangnhap'] = $row_data['username'];
        if ($row_data)
            echo '<script>alert("Đăng nhập thành công")</script>';
        echo '<script>window.open("./index.php","_self")</script>';
    } else {
        echo '<script>alert("Tài khoản hoặc mật khẩu không đúng")</script>';
        echo '<script>window.open("./login.php","_self")</script>';
    }
}
if (isset($_POST['Register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = '';
    $password2 = $_POST['password2'];
    if ($password == $password2) {
        $sql_register = "INSERT INTO `user` (`username`, `password`, `phone`, `address`, `email`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql_register);
        $stmt->execute([
            $username,
            $password,
            $phone,
            $address,
            $email
        ]);
        $result_register = $stmt->fetch();
        $_SESSION['user'] = $result_register;
        $count = $stmt->rowCount();
        if ($count > 0) {
            $_SESSION['dangky'] = $username;
            echo '<script>alert("Tạo tài khoản thành công")</script>';
            echo '<script>window.open("./login.php","_self")</script>';
        } else {
            echo '<script>alert("Tên đăng nhập đã được sử dụng hãy sử dụng tên khác")</script>';
            echo '<script>window.open("./index.php","_self")</script>';
        }
    } else {
        echo '<script>alert("Mật khẩu nhập lại không đúng")</script>';
        echo '<script>window.open("./register.php","_self")</script>';
    }
}

if (isset($_GET['delete'])) {
    $id = $_POST['id'];
}