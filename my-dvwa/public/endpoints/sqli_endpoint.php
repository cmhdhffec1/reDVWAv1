<?php
session_start();
require_once("db_conn.php");

if (isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $conn = conn();
    
    // Vulnerable to SQL injection by directly concatenating user input into the query
    $sql = "SELECT id FROM users WHERE password = '$password' AND username = '$username'";
    $result = $conn->query($sql);
    
    if ($result) {
        if ($result->num_rows == 1) {
            $_SESSION['login'] = 'login';
            echo json_encode("login");
        } else {
            echo json_encode("false");
        }
    }
    
    $conn->close();
}
?>