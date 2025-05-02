<?php

header('Content-Type: application/json');

$uploadDir = '../files_rce/'; 

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $fileUrl = '/files_rce/' . $fileName; 
        echo json_encode([
            'success' => true,
            'fileUrl' => $fileUrl,
            'message' => 'File uploaded successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to move uploaded file'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No file uploaded or upload error'
    ]);
}
?>