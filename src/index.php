<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Daily Planner</title>
    <script src="script.js" defer></script>
</head>

<body>
    <div class="h-screen flex flex-row">
        <div class="bg-stone-300 basis-1/2 border-4 border-blue-500 border-dashed">
            This is a box with a dashed blue border : planner
            <header class = "text-center slate-800">
                <h1 class = "font-mono font-bold">Daily Planner</h1>
                <p class = "font-mono">Plan your day in 30 minute intervals!</p>
            </header>

            <!--Container-->
            <div class = "grid grid-cols-1 gap-4">
                <!--Time Slots (00:00 - 00:00)-->
                <div class = "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" >
                    <div class = "space-y-4">
                        
                        <?php for($i = 0; $i <24; $i++){?>
                            <div class="flex items-center space-x-4 border-b pb-4">
                            <div class="w-20 text-lg font-medium text-gray-700"><?php echo $i?>:00</div>
                            </div>

                        <?php } ?> 

                    </div>
                </div>
            </div>


        </div>


        <div class="basis-1/2 p-10">
            <div class="border-4 border-slate-500 border-double">
                <div class="text-2xl font-medium text-center p-6">Welcome to your Daily Planner</div>

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