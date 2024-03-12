<?php
try {
	$pdo = new PDO('mysql:host=localhost;dbname=ct467', 'root', 'phamminhkhanh');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	$error_message = 'Không thể kết nối đến CSDL';
	$reason = $e->getMessage();
	exit();
}