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
                <div id="eventName" class="flex flex-row relative pl-6">
                    <div class="p-2 p-1">Name of event:</div>
                    <input id="inputNameField" type="text" class=" w-9/12 border-2 border-solid rounded-lg px-2 py-0.5">
                </div>
                <div class="flex relative p-6 ">
                    <div class="p-2 p-1">Duration:</div>
                    <button id="menuButton" class="w-4/12 border-2 border-solid rounded-lg px-2 py-0.5 ml-11"></button>
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
                <div id="eventName" class="flex flex-row relative pl-6">
                    <div class="p-2 p-1">Name of event:</div>
                    <input id="inputNameField" type="text" class=" w-9/12 border-2 border-solid rounded-lg px-2 py-0.5">
                </div>
                <div>
                    <div class="flex items-center space-x-2 p-6 pl-12">
                        <input type="checkbox" id="eventCheckbox" class="w-5 h-5 text-blue-500 focus:ring-blue-300 rounded border-gray-300 pl-6">
                        <label for="eventCheckbox" class="text-gray-700 "> Blocked</label>
                    </div>
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
            
            menuButton.textContent = `${duration}`;
        }
    });

    inputNameField.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            // Action when "Enter" key is pressed
            inputNameField.blur();
            inputNameField.classList.remove('border-pink-500');
            inputNameField.classList.add('border-blue-500');
            
            // You can do more here, like submitting the form or changing the UI
        }
    });
</script>
</html>