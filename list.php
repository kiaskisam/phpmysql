<?php
session_start(); // 开始会话

// 之后直接使用会话中的数据库连接信息
$servername = $_SESSION['servername'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$dbname = $_SESSION['dbname'];
$table = $_SESSION['table'];

// ...（您的其他代码）
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败： " . $conn->connect_error);
}

$sql = "SELECT * FROM $table";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1' align='center'><tr><th>学号</th><th>姓名</th><th>性别</th><th>专业</th><th>操作</th></tr>";
    while($row = $result->fetch_assoc()) {
        $sno = $row["sno"];
        $sname = $row["sname"];
        $ssex = $row["ssex"];
        $spro = $row["spro"];
        echo "<tr><td>".$sno."</td><td>".$sname."</td><td>".$ssex."</td><td>".$spro."</td><td><a href='edit.php?id=$sno'>修改</a> | <a href='delete.php?id=$sno'>删除</a></td></tr>";
    } 
    echo"<tr><td><a href='addpr.html'>添加学生信息</a></td></tr>";
    echo "</table>";
    
   
} else {
    echo "0 结果";
}
$conn->close();
?>
