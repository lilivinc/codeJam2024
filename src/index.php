<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Daily Planner</title>
    <script src="script.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    // The PHP variable $jsonBlocks is echoed into the JavaScript variable blocks
    <script> var blocks = <?php echo $jsonBlocks; ?>; </script>

    <style>
        .activity-block { 
            width: 80%;
            border: 2px solid rgba(209, 213, 219, 1); /* Border color slightly darker gray */
            position: relative;
        }

        .activity-block:hover {
            background-color: rgba(59, 130, 246, 1); /* Darker blue on hover */
        }

        .activity-block {
        transition: background-color 0.3s ease;
        }

        .activity-block:hover {
            background-color: rgba(59, 130, 246, 1); /* Darker blue */
        }
    </style>
</head>

<body>
    <div class="h-screen flex flex-row">
        <div class="bg-stone-300 basis-1/2 border-4 border-blue-500 border-dashed"; style="overflow-y:scroll">
            This is a box with a dashed blue border : planner
            
             <!--Head (name/description)-->
            <header class = "text-center slate-800">
                <h1 class = "font-mono font-bold text-2xl mb-2">Daily Planner</h1>
                <p class = "font-mono text-lg mb-6">Plan your day in 30 minute intervals!</p>
            </header>

            <!--Container-->
            <div class = "grid grid-cols-1">
                <!--Time Slots (00:00 - 23:50)-->
                <div class = "grid grid-cols-1 gap-4">
                    <div class = "space-y-1">
                    <!--class = "space-y-2" === this + pb removed from below removed spacing between blocks-->
                        
                        <!--Time Intervals-->

                        <!--Examples of code (used to check if code works), have to generalize this somehow-->
                        <?php 
                        $activities = [
                            "08:00" => "Morning Meeting",
                            "12:30" => "Lunch Break",
                            "15:00" => "Project Discussion",
                            "18:30" => "Workout",
                        ];       

                        for($i = 0; $i <24; $i++){
                            for($j = 0; $j <= 3; $j = $j + 3){
                                $hours = $i < 10 ? "0$i" : $i;
                                $minutes = $j === 0 ? "00" : "30";
                                $time = $hours . ":" . $minutes;
                            
                        ?>

                                <!-- Single Row for Time Slot -->
                                <div class="flex items-center border-b border-gray-400">

                                    <!-- Time Interval -->
                                    <div class="w-24 text-right text-lg font-medium text-gray-700 p-2">
                                        <?php echo $time; ?>
                                    </div>
                                
                                    <!-- Activity Block (Clickable) -->

                                    <div class="flex-1 relative p-2">
                                        <?php if (array_key_exists($time, $activities)) { ?>
                                            <div id="activity-<?php echo $time; ?>" 
                                                class="activity-block bg-gray-200 p-7 rounded-lg cursor-pointer hover:bg-gray-300"
                                                onclick="selectActivity('<?php echo $time; ?>')">

                                                <!--Activity text (dpeends on list of activity from above-->
                                                <p id="activity-text-<?php echo $time; ?>" class="text-gray-600 font-medium">
                                                    <?php echo $activities[$time]; ?>
                                                </p>
                                            
                                            <!-- Deleting activity component -->
                                            <button id="delete-btn-<?php echo $time; ?>"
                                                class="absolute top-1 right-1 text-red-400 hover:text-red-700 text-lg"
                                                onclick="deleteActivity('<?php echo $time; ?>'); event.stopPropagation();"> &times;
                                            </button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                        <?php } } ?> 
                    
                    </div>
                </div>
            </div>

        </div>

        <div class=" basis-1/2 border-4 border-red-500 border-solid">
            This is a box with a dashed red border : input
        </div>
    </div>


</body>

</html>