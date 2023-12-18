<?php
session_start(); // 开始会话

// 处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 将值存储到会话中
    $_SESSION['servername'] = $_POST['port'];
    $_SESSION['username'] = $_POST['user'];
    $_SESSION['password'] = $_POST['pass'];
    $_SESSION['dbname'] = $_POST['dbname'];
    $_SESSION['table'] = $_POST['table'];
    
    // 重定向到 list.php
    header("Location: list.php");
    exit;
}
?>