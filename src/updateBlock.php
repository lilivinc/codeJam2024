<?php
// Start the session or connect to a database
session_start();
$filePath = 'blocks.json';

if (file_exists($filePath)) {
    $blocks = json_decode(file_get_contents($filePath), true);  // Read existing data
} else {
    $blocks = [
        [
            "id" => 1,
            "type" => 1,
            "name" => "Event 1",
            "startingTime" => 12,
            "endingTime" => 14,
        ],
        [
            "id" => 2,
            "type" => 2,
            "name" => "Event 2",
            "startingTime" => 15,
            "endingTime" => 17,
        ],
    ];
}



// Get the POST data
$id = $_POST['id'];
$type = $_POST['type'];
$name = $_POST['name'];
$startingTime = $_POST['startingTime'];
$endingTime = $_POST['endingTime'];

// Initialize response
$response = ['updated' => false];

// Search for a block with the same ID
foreach ($blocks as &$block) {
    if ($block['id'] == $id) {
        // Update the block
        $block['type'] = $type;
        $block['name'] = $name;
        $block['startingTime'] = $startingTime;
        $block['endingTime'] = $endingTime;
        $response['updated'] = true;
        break;
    }
}

/*
// Save the updated blocks back to the session or database
$_SESSION['blocks'] = $blocks;
*/
// Return a JSON response
header('Content-Type: application/json');
echo json_encode($response); 

file_put_contents($filePath, json_encode($blocks));
?>