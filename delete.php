
    <?php
        session_start(); // 开始会话

        $id = $_GET['id'];
        $servername = $_SESSION['servername']; // 使用会话中的数据库连接信息
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $dbname = $_SESSION['dbname'];
        $table = $_SESSION['table'];

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("连接失败： " . $conn->connect_error);
        }

        // 使用预处理语句绑定参数以避免 SQL 注入
        $sql = "DELETE FROM $table WHERE sno=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            echo "数据删除成功";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    ?>