<?php
session_start(); // 开始会话

$servername = $_SESSION['servername'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$dbname = $_SESSION['dbname'];
$table = $_SESSION['table'];

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败： " . $conn->connect_error);
}

// 获取和验证提交的学生信息
$sno = $_POST['sno'];
$sname = $_POST['sname'];
$ssex = $_POST['ssex'];
$spro = $_POST['spro'];

// 在插入之前确认字段值不为空
if (empty($sno) || empty($sname) || empty($ssex) || empty($spro)) {
    die("所有字段均为必填字段，请填写完整信息。");
}

// 准备 SQL 语句并执行插入操作
$sql = "INSERT INTO $table (sno, sname, ssex, spro) VALUES ('$sno', '$sname', '$ssex', '$spro')";
if ($conn->query($sql) === TRUE) {
    header("Location: list.php"); // 成功插入后重定向到列表页面
    exit; // 确保在重定向后立即退出脚本
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>