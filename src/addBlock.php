<?php
session_start();
// File path where blocks are stored
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




// Example to add a new block (using POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $type = $_POST['type'] ?? null;
    $name = $_POST['name'] ?? null;
    $startingTime = $_POST['startingTime'] ?? null;
    $endingTime = $_POST['endingTime'] ?? null;

    if ($id && $type && $name && $startingTime && $endingTime) {
        $newBlock = [
            "id" => $id,
            "type" => $type,
            "name" => $name,
            "startingTime" => $startingTime,
            "endingTime" => $endingTime,
        ];

        // Add the new block to the blocks array
        $blocks[] = $newBlock;

        file_put_contents($filePath, json_encode($blocks));
    }
}
    ?>