<?php
session_start(); // 开始会话

$id = $_GET['id']; // 通过 GET 方法获取要编辑的学生ID
$servername = $_SESSION['servername'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$dbname = $_SESSION['dbname'];
$table = $_SESSION['table'];

// 然后连接到数据库
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败： " . $conn->connect_error);
}

// 查询要编辑的学生信息
$sql = "SELECT * FROM $table WHERE sno = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // 显示一个表单以允许编辑
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>编辑学生信息</title>
    </head>
    <body>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row["sno"]; ?>">
            学号: <input type="text" name="sno" value="<?php echo $row["sno"]; ?>"><br>
            姓名: <input type="text" name="sname" value="<?php echo $row["sname"]; ?>"><br>
            性别: <input type="text" name="ssex" value="<?php echo $row["ssex"]; ?>"><br>
            专业: <input type="text" name="spro" value="<?php echo $row["spro"]; ?>"><br>
            <input type="submit" value="提交">
        </form>
    </body>
    </html>
    <?php
} else {
    echo "未找到结果";
}
$stmt->close();
$conn->close();
?>