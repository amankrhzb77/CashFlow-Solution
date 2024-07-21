<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['psw'];

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "decentralized_finance";

    // Connect to MySQL database
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    // Check connection
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno() .')'. mysqli_connect_error());
    } else {
        $SELECT = "SELECT * FROM user_info WHERE email = ?";
        
        // Prepare the select statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Password is correct, start a session
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                header("Location: dashboard.php");
            } else {
                echo '<script>alert("Invalid Password"); window.location.href="index.php";</script>';            }
        } else {
            echo '<script>alert("No user found with this Email"); window.location.href="index.php";</script>';            
        }
        $stmt->close();
        $conn->close();
    }
}
?>
