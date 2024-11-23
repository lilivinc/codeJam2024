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
            if (! invalidTaskBlock) {
            arrayValidStartTimes.push(iBlock);
            }
        }
    }
    return arrayValidStartTimes
}

