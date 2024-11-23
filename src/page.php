<?php
  require ('addBlock.php');
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Calendar</title>
    <script src="script.js" defer></script>
</head>

<body>
    <h1 class="text-3xl font-bold underline" onclick="myFunction()">
        Daily Calendar
    </h1>
    <button onclick="addBlock(1, 'Event 4', 12, 32)">Button</button>
    <input type="text" id="inputChiffreChoisi" placeholder="Enter a number">

    <?php foreach ($blocks as $block){ ?>
        <div class="font-semibold"><?php echo $block["name"]; ?></div>

    <?php } ?>
</body>

</html>