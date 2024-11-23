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
        </div>
    </div>


</body>

</html>