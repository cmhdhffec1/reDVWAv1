<?php
require_once("db_conn.php");
session_start();
if (!isset($_SESSION["login"])){
    echo json_encode("you need login");
}

if (isset($_POST["text"]) && isset($_SESSION["login"])){
    $post = $_POST['text'];
    $post=htmlspecialchars($post);
    $conn=conn();
    $sql_post=$conn->prepare('INSERT INTO posts (content) VALUES (?)');
    $sql_post->bind_param("s", $post);
    if($sql_post->execute()){
        echo json_encode('Text saved in bd');
    } else{
       echo json_encode("unknown error");
    }
    $conn->close();
}
?>