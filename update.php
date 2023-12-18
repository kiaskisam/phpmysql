<?php
session_start(); // 开始会话

$id = $_POST['id']; // 从表单提交中获取学生ID
$servername = $_SESSION['servername']; // 使用会话中的数据库连接信息
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$dbname = $_SESSION['dbname'];
$table = $_SESSION['table'];
$sno = $_POST['sno'];
$sname = $_POST['sname'];
$ssex = $_POST['ssex'];
$spro = $_POST['spro'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败： " . $conn->connect_error);
}

$sql = "UPDATE $table SET sno=?, sname=?, ssex=?, spro=? WHERE sno=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $sno, $sname, $ssex, $spro, $id); // 绑定参数以避免 SQL 注入
if ($stmt->execute()) {
    header("Location: list.php");
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>