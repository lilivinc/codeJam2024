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



    </div>

        <div class=" basis-1/2 border-4 border-red-500 border-solid">
            This is a box with a dashed red border : input

            <div class="flex relative border-4 border-green-500 border-solid">
                <button id="menuButton" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Duration</button>
                <div id="dropdownMenu"
                    class="absolute mt-2 w-48 bg-white shadow-lg rounded-lg border overflow-y-auto max-h-48">
                    <ul id="menuItems" class="divide-y divide-gray-200">
                        <li class="px-4 py-2 hover:bg-gray-100" data-value="30">0h30</li>
                        <li class="px-4 py-2 hover:bg-gray-100" data-value="60">1h</li>
                        <li class="px-4 py-2 hover:bg-gray-100" data-value="90">1h30</li>
                        <li class="px-4 py-2 hover:bg-gray-100" data-value="120">2h00</li>
                        <li class="px-4 py-2 hover:bg-gray-100" data-value="150">2h30</li>
                        <li class="px-4 py-2 hover:bg-gray-100" data-value="180">3h00</li>
                </div>
                <div id="selectedDuration" class="pl-10">Selected: </div>
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
            selectedDuration.textContent = `Selected: ${duration}`;
        }
    });

</script>
</html>