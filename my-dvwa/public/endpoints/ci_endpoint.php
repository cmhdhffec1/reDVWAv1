<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ip'])) {
    $ip = $_GET['ip'];
    $output = [];
    $return_var = 0;

    exec("ping -c 5 $ip", $output, $return_var); 

    if ($return_var === 0) {
        echo json_encode([
            'success' => true,
            'code' => $return_var,
            'output' => implode("\n", $output), 
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'output' => implode("\n", $output), 
            'message' => 'Command execution failed',
            'code' => $return_var
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No IP address provided'
   ]);
}