// Constants

const lenDay = 48;
var arrayBlockedBlocks = [];
var lenTask = document.getElementById('inputChiffreChoisi').value;
var blocksSchedule = document.getElementById('blocks');


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


function blockedTimes(startTask, endTask, arrayBlockedBlocks) {
    for (let iBlock = startTask; iBlock < endTask; iBlock++) {
        arrayBlockedBlocks.push(iBlock);
    }
};


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


function addBlock(type, name, startingTime, endingTime) {
    alert("test");
    // Create a FormData object to send data to the server
    const formData = new FormData();
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
            alert('Block added successfully!');
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    location.reload();
}


function deleteTask (startingTimeToDelete, blocks) {
    for (let eventIndex = 0 ; eventIndex < blocks.length; eventIndex++) {
        if (blocks[eventIndex]["startingTime"] == startingTimeToDelete) {
            blocks.splice(eventIndex, eventIndex +1)
        }
    }
}


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