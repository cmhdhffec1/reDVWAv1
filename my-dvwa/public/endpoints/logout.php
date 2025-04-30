<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['login']);
    session_destroy();
}