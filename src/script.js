// Constants

const lenDay = 48;
var arrayBlockedBlocks = [];
// var lenTask = document.getElementById('inputChiffreChoisi').value;
// check with Lili


function convert24To48(timeIn24) {
    intTimeIn24 = parseFloat(timeIn24)
    var timeIn48 = intTimeIn24 * 2
    return timeIn48
}

function convert48To24(timeIn48) {
    intTimeIn48 = parseInt(timeIn48)
    var timeIn24 = intTimeIn48 / 2
    return timeIn24
}


function blockedTimes(startTask, endTask, arrayBlockedBlocks) {
    for (let iBlock = startTask; iBlock < endTask; iBlock++) {
        arrayBlockedBlocks.push(iBlock);
    }
}


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
}function addBlock(type, name, startingTime, endingTime) {
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

// The PHP variable $jsonBlocks is echoed into the JavaScript variable blocks
var blocks = <?php echo $jsonBlocks; ?>;

function deleteTask (startingTimeToDelete, blocks) {
    for (let eventIndex = 0 ; eventIndex < blocks.length; eventIndex++) {
        if (blocks[eventIndex]["startingTime"] == startingTimeToDelete) {
            blocks.splice(eventIndex, eventIndex +1)
        }
    }
}
