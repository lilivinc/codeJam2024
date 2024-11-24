<?php
// Start the session or use a database
session_start();
$filePath = 'blocks.json';

// Load existing blocks from the JSON file
if (file_exists($filePath)) {
    $blocks = json_decode(file_get_contents($filePath), true);  // Read existing data
} else {
    $blocks = [];
}

// Get the POST data
$id = $_POST['id'];

// Initialize response
$response = ['removed' => false];

// Search for and remove the block with the given ID
foreach ($blocks as $key => $block) {
    if ($block['id'] == $id) {
        unset($blocks[$key]); // Remove the block
        $response['removed'] = true;
        break;
    }
}

// Save the updated blocks array back to the JSON file
file_put_contents($filePath, json_encode(array_values($blocks))); // Reindex the array

// Return a JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
