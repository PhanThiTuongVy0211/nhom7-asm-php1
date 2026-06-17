<?php
// config.php
define('DB_HOST', '103.57.220.210'); 
define('DB_USER', 'gtpixbirhosting');
define('DB_PASS', '3EcR7IdTel*<?<>vkkVL');
define('DB_NAME', 'gtpixbirhosting'); 
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Kết nối CSDL thất bại: " . $e->getMessage());
}