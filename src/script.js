// Constants

const lenDay = 48;
var arrayBlockedBlocks = [];
var lenTask = document.getElementById("durationLine2").value;

function convert24To48(timeIn24) {
    var floatTimeIn24 = parseFloat(timeIn24)
    var timeIn48 = floatTimeIn24 * 2
    return timeIn48
};


function convert48To24(timeIn48) {
    var intTimeIn48 = parseInt(timeIn48)
    var timeIn24 = intTimeIn48 / 2
    return timeIn24
};


function convertStrTo48(timeInStr) {
    var time24 = 0;
    const intHour24 = parseFloat(timeInStr.slice(0,2));
    const minutes = timeInStr.slice(3);
    if (minutes == "30") {
        time24 = intHour24 + 0.5;
    }
    else {
        time24 = intHour24;
    }
    var time48 = convert24To48(time24);
    return time48;
};

function convert48ToStr(timeIn48) {
    var timeStr = "";
    var strHour = ""
    var time24 = convert48To24(timeIn48);
    var strTime24 = time24.toString()
    if ((timeIn48 % 2) == 1) {
        const listHourMin = strTime24.split('.');
        strHour = listHourMin[0];
        var add0StrHour = strHour;
        if (parseInt(strHour) < 10) {
            add0StrHour = '0' + strHour;
        };
        timeStr = add0StrHour + ':30'
    }
    else {
        timeStr = strTime24 + ':00'
    };
    return timeStr;
};

//returns start times (base 48) of all unmovable times
function blockedTimes(startTask, endTask, arrayBlockedBlocks) {
    for (let iBlock = startTask; iBlock < endTask; iBlock++) {
        arrayBlockedBlocks.push(iBlock);
    }
};

//returns possible starting times (in base 48) based on length of event
function availableBlocks(lenTask, arrayBlockedBlocks) {
    const arrayValidStartTimes = []
    for (let iBlock = 0; iBlock < lenDay; iBlock++) {
        if (iBlock + lenTask <= lenDay) {
            var invalidTaskBlock = false;
            for (let iBlockCheck = iBlock; iBlockCheck < (iBlock + lenTask); iBlockCheck++) {
                if (arrayBlockedBlocks.includes(iBlockCheck)) {
                    invalidTaskBlock = true;
                    break;
                }

            }
            if (!invalidTaskBlock) {
                arrayValidStartTimes.push(iBlock);
            }
        }
    }
    return arrayValidStartTimes;
}

/* TESTS
if (require.main === module) {

    var conv248 = convert24To48(6.5)
    console.log(conv248)

    var conv224 = convert48To24(13)
    console.log(conv224)

    blockedTimes(13, 16, arrayBlockedBlocks);
    console.log(arrayBlockedBlocks);

    blockedTimes(3, 4, arrayBlockedBlocks);
    console.log(arrayBlockedBlocks);

    var newTaskTimes = availableBlocks(1, arrayBlockedBlocks);
    console.log(newTaskTimes);


}*/

function addBlock(id, type, name, startingTime, endingTime) {
    console.log("test");
    // Create a FormData object to send data to the server
    const formData = new FormData();
    formData.append('id', id);
    formData.append('type', type);
    formData.append('name', name);
    formData.append('startingTime', startingTime);
    formData.append('endingTime', endingTime);

    // Send data to the PHP script using Fetch API
    fetch('addBlock.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json()) // assuming PHP returns a JSON response
        .then(data => {
            console.log('Success:', data);
            console.log('Block added successfully!');
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    location.reload();
}

function updateBlock(id, type, name, startingTime, endingTime) {
    console.log("Attempting to update block");

    // Create a FormData object to send data to the server
    const formData = new FormData();
    formData.append('id', id);
    formData.append('type', type);
    formData.append('name', name);
    formData.append('startingTime', startingTime);
    formData.append('endingTime', endingTime);

    // Send data to the PHP script using Fetch API
    fetch('updateBlock.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json()) // Assuming PHP returns a JSON response
        .then(data => {
            if (data.updated) {
                console.log(`Block with ID ${id} was updated successfully!`);
            } else {
                console.log(`Block with ID ${id} was not found. Update failed.`);
            }
            console.log('Server Response:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    location.reload();
}


function removeBlock(id) {
    console.log("Attempting to remove block");

    // Create a FormData object to send the block ID
    const formData = new FormData();
    formData.append('id', id);

    // Send the request to the PHP script
    fetch('removeBlock.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json()) // Parse response as JSON
        .then(data => {
            if (data.removed) {
                console.log(`Block with ID ${id} was removed successfully!`);
            } else {
                console.log(`Block with ID ${id} was not found. Removal failed.`);
            }
            console.log('Server Response:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    location.reload();
}



// The PHP variable $jsonBlocks is echoed into the JavaScript variable blocks
//var blocks = <? php echo $jsonBlocks; ?>;

function deleteTask(startingTimeToDelete, blocks) {
    for (let eventIndex = 0; eventIndex < blocks.length; eventIndex++) {
        if (blocks[eventIndex]["startingTime"] == startingTimeToDelete) {
            blocks.splice(eventIndex, eventIndex + 1)
        }
    }
}


function randomValidBlock(arrayValidStartTimes) {
    var lenArray = arrayValidStartTimes.length;
    var randIndex = Math.floor(Math.random()*lenArray);
    var randStartTime = arrayValidStartTimes[randIndex];
    return randStartTime;
}

/*
if (require.main === module) {

    var conv248 = convert24To48(6.5)
    console.log(conv248)

    var conv224 = convert48To24(13)
    console.log(conv224)

    blockedTimes(13, 16, arrayBlockedBlocks);
    console.log(arrayBlockedBlocks);

    blockedTimes(3, 4, arrayBlockedBlocks);
    console.log(arrayBlockedBlocks);

    var newTaskTimes = availableBlocks(1, arrayBlockedBlocks);
    console.log(newTaskTimes);

    //deleteTask (15, blocksSchedule)
    //console.log(blocksSchedule)
}
*/

function test(txt) {
    console.log(txt);
}

function addEvent() {
    console.log("test add event")

    var type = document.getElementById("menuButton2").getAttribute("data-value");
    var name = document.getElementById("nameOfEvent").value
    var startingTime = document.getElementById("startingTime").value;
    var endingTime = document.getElementById("endingTime").value;
    var id = Math.floor(Math.random() * (10000 - 0 + 1));
    console.log("name: ", name)
    console.log("tyep: ", type)
    console.log("time: ", startingTime)
    console.log("time: ", endingTime)
    addBlock(id, type, name, startingTime, endingTime);

}