<?php
session_start();
require_once("db_conn.php");

if (isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    $conn = conn();
    $sql_login=$conn->prepare("SELECT id FROM users WHERE password = ? AND username = ?");
    $sql_login->bind_param("ss", $password, $username);
    if($sql_login->execute()){
        $result=$sql_login->get_result();
        if ($result->num_rows == 1) {
            $_SESSION['login'] = 'login';
            echo json_encode("login");
        } else {
            echo json_encode("false");
        }
    }

}