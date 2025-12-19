<?php

// $link = mysql_connect('163.44.197.234', 'api', '6Bo$u0x2'); // 8jD996&ic
// $host = 'localhost';
// $dbname = 'apps_booking'; // ชื่อ Database ของคุณ
// $username = 'root';         // Username ของ Database
// $password = '';             // Password ของ Database

$host = '163.44.197.234';
$dbname = 'api'; // ชื่อ Database ของคุณ
$username = 'api';         // Username ของ Database
$password = '6Bo$u0x2';             // Password ของ Database

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // ตั้งค่าให้แสดง Error หากเกิดปัญหา
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>