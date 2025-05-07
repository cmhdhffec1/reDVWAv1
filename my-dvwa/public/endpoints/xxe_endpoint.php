<?php
header('Content-Type: application/json');
$xml = file_get_contents('php://input');
file_put_contents('/tmp/xxe_debug.log', "Input XML: $xml\n", FILE_APPEND);

try {
    
    $doc = new DOMDocument();
    $doc->loadXML($xml, LIBXML_DTDLOAD | LIBXML_DTDATTR | LIBXML_NOENT);
    
    $output = $doc->documentElement->textContent;
    
    $testFile = '/test.txt';
    $fileReadable = is_readable($testFile) ? 'Yes' : 'No';
    $fileContent = file_get_contents($testFile) ?: 'Unable to read file';
    
    file_put_contents('/tmp/xxe_debug.log', "Output: $output\nFile Readable: $fileReadable\nFile Content: $fileContent\n", FILE_APPEND);
    
    echo json_encode([
        'success' => true,
        'output' => $output
    ]);
} catch (Exception $e) {
    
    echo json_encode([
        'success' => false,
        'message' => 'Invalid XML: ' . $e->getMessage()
    ]);
}
?>