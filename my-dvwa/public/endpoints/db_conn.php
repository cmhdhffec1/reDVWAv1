<?php
function conn(){
    $host = 'db';
    $user = 'dvwa';
    $pass = 'dvwa';
    $dbname = 'dvwa';

    $conn = mysqli_connect($host, $user, $pass, $dbname);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	return($conn);
}