// Constants

const lenDay = 24;
const arrayBlockedBlocks = [];
var lenTask = document.getElementById('inputChiffreChoisi').value;
// check with Lili

startTask = // Lili
    endTask = //Lili


    function blockTimes(startTask, endTask) {
        for (let iBlock = startTask; iBlock < endTask; iBlock = iBlock + 0.5) {
            arrayBlockedBlocks.push(iBlock);
        }
    }


function availableBlocks(lenTask, arrayBlockedBlocks) {
    const arrayValidStartTimes = []
    for (let iBlock = 0; iBlock < lenDay; iBlock = iBlock + 0.5) {
        if (iBlock + lenTask <= lenDay) {
            var invalidTaskBlock = false
            for (let iBlockCheck = iBlock; iBlockCheck < (iBlock + lenTask); iBlockCheck = iBlockCheck + 0.5) {
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
    return arrayValidStartTimes
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