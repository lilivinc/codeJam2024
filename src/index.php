<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Daily Planner</title>
    <script src="script.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>

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
    <div class="h-screen flex flex-row bg-stone-50 font-mono">
        <div class=" basis-1/2  p-10"; style="overflow-y:scroll">
            
             <!--Head (name/description)-->
            <header class = "text-center slate-800">
                <h1 class = "font-mono font-bold text-2xl mb-2">This is Your Day</h1>
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
                        

                        /*
                        $activities = [
                            [
                                "type" => 1,
                                "name"=> "Event 1",
                                "startingTime"=> 12,
                                "endingTime"=> 14
                            ],
                            [
                                "type"=> 2,
                                "name"=> "Event 2",
                                "startingTime"=> 15,
                                "endingTime"=> 17
                            ],
                            [
                                "type"=> 1,
                                "name"=> "Event 4",
                                "startingTime"=> 12,
                                "endingTime"=> 32
                            ],
                            [
                                "type"=> 1,
                                "name"=>"Event 4",
                                "startingTime"=> 12,
                                "endingTime"=> 32
                            ]
                            ];
                        */
                        
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
                                                class="absolute top-3 right-6 text-red-400 hover:text-red-700 text-2xl"
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


        <div class="basis-1/2 p-10">
            <div class="border-4 border-slate-500 border-double">
                <div class="text-2xl font-medium text-center p-6">Welcome to Your Daily Planner</div>

                <div class="flex justify-center items-center space-x-3">
                    <div id="toggleSwitch" class="relative w-1/3 h-10 flex items-center bg-violet-400 rounded-lg cursor-pointer transition duration-300">
                        <span id="switchOn" class="absolute left-6 text-sm font-medium text-white opacity-0 transition-opacity duration-300">
                            Movable
                        </span>
                        <span id="switchOff" class="absolute right-6 text-sm font-medium text-white transition-opacity duration-300">
                            Blocked
                        </span>
                        <div id="switchKnob" class="absolute left-0 w-1/2 h-10 bg-white rounded-lg shadow transform transition duration-300"></div>
                    </div>
                </div>

                <div id="eventNameLine" class="flex flex-row relative pl-6 p-4">
                    <div class="p-2 p-1">Name of event:</div>
                    <input id="nameOfEvent" type="text" class=" w-9/12 border-2 border-solid rounded-lg px-2 py-0.5">
                </div>
                <div id="durationLine" class="z-10 flex relative p-6 opacity-25">
                    <div class="p-2">Duration:</div>
                    <button id="menuButton" class="w-4/12 border-2 border-solid rounded-lg px-2 py-0.5 ml-11" disabled></button>
                    <div id="dropdownMenu" class="absolute mt-2 w-48 bg-white shadow-lg rounded-lg border overflow-y-auto max-h-64 hidden">
                        <ul id="menuItems" class="divide-y divide-gray-200">
                            <li class="px-4 py-2 hover:bg-gray-100" data-value="0:30">0h30</li>
                            <li class="px-4 py-2 hover:bg-gray-100" data-value="1:00">1h</li>
                            <li class="px-4 py-2 hover:bg-gray-100" data-value="1:30">1h30</li>
                            <li class="px-4 py-2 hover:bg-gray-100" data-value="2:00">2h00</li>
                            <li class="px-4 py-2 hover:bg-gray-100" data-value="2:30">2h30</li>
                            <li class="px-4 py-2 hover:bg-gray-100" data-value="3:00">3h00</li>
                    </div>
                    
                </div>
                
                <div id="startingTimeLine" class="z-0 flex flex-row relative pl-6 p-6">
                    <div class="p-2">Starting Time:</div>
                    <input id="startingTime" type="text" class=" w-4/12 border-2 border-solid rounded-lg px-2 py-0.5 ml-2">
                </div>

                <div id="endingTimeLine" class="z-2 flex flex-row relative pl-6 p-6">
                    <div class="p-2 ">Ending Time:</div>
                    <input id="endingTime" type="text" class=" w-4/12 border-2 border-solid rounded-lg px-2 py-0.5 ml-4">
                </div>

                <div class="z-2 flex flex-row relative pl-6 p-6 justify-center">
                    <button id="buttonAddEvent" class="px-4 py-2 bg-violet-400 text-white font-semibold rounded-lg">
                        Add Event
                    </button>
                </div>


                
            </div>

        </div>
        

    </div>


</body>
<script>
    const menuButton = document.getElementById('menuButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    var duration;

    menuButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden'); // Toggles the visibility
    });

    // Optional: Close the menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!menuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });

    dropdownMenu.addEventListener('click', (e) => {
        dropdownMenu.classList.add('hidden');
    })

    menuItems.addEventListener('click', (e) => {
        if (e.target.tagName === 'LI') { // Ensure it's a list item
            duration = e.target.dataset.value; // Get value from data attribute
            console.log('Selected Value:', duration); // Log or use the value
            dropdownMenu.classList.add('hidden'); // Optionally hide the menu
            menuButton.classList.add('border-blue-500');
            menuButton.textContent = `${duration}`;
        }
    });

    nameOfEvent.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            // Action when "Enter" key is pressed
            nameOfEvent.blur();
            nameOfEvent.classList.remove('border-pink-500');
            nameOfEvent.classList.add('border-blue-500');
            
            // You can do more here, like submitting the form or changing the UI
        }
    });
    startingTime.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            // Action when "Enter" key is pressed
            startingTime.blur();
            startingTime.classList.remove('border-pink-500');
            startingTime.classList.add('border-blue-500');
            
            // You can do more here, like submitting the form or changing the UI
        }
    });
    endingTime.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            // Action when "Enter" key is pressed
            endingTime.blur();
            endingTime.classList.remove('border-pink-500');
            endingTime.classList.add('border-blue-500');
            
            // You can do more here, like submitting the form or changing the UI
        }
    });

    document.getElementById("toggleSwitch").addEventListener("click", function () {
    const switchKnob = document.getElementById("switchKnob");
    const switchOn = document.getElementById("switchOn");
    const switchOff = document.getElementById("switchOff");
    const isOn = switchKnob.classList.contains("translate-x-full");

    // Toggle the switch
    if (isOn) {
        switchKnob.classList.remove("translate-x-full"); // Move the knob to the left
        this.classList.remove("bg-sky-400"); // Change background color to "Off"
        this.classList.add("bg-violet-400");
        switchOn.style.opacity = "0"; // Hide "On"
        switchOff.style.opacity = "1"; // Show "Off"
        endingTimeLine.classList.remove('opacity-25');
        endingTime.disabled = false;
        startingTimeLine.classList.remove('opacity-25');
        startingTime.disabled = false;
        durationLine.classList.add('opacity-25');
        menuButton.disabled = true;
        buttonAddEvent.classList.remove("bg-sky-400");
        buttonAddEvent.classList.add("bg-violet-400");
    } else {
        switchKnob.classList.add("translate-x-full"); // Move the knob to the right
        this.classList.remove("bg-violet-400"); // Change background color to "On"
        this.classList.add("bg-sky-400");
        switchOn.style.opacity = "1"; // Show "On"
        switchOff.style.opacity = "0"; // Hide "Off"
        endingTimeLine.classList.add('opacity-25');
        endingTime.disabled = true;
        startingTimeLine.classList.add('opacity-25');
        startingTime.disabled = true;
        durationLine.classList.remove('opacity-25');
        menuButton.disabled = false;
        buttonAddEvent.classList.remove("bg-violet-400");
        buttonAddEvent.classList.add("bg-sky-400");
    }
});

</script>
</html>