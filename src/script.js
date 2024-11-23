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
            if (! invalidTaskBlock) {
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
}