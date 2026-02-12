document.addEventListener('DOMContentLoaded', function() {
    const minInput = document.querySelector('input.min');
    const maxInput = document.querySelector('input.max');
    const minDisplay = document.querySelector('input[name="min"]');
    const maxDisplay = document.querySelector('input[name="max"]');
    const rangeSelected = document.querySelector('.range-selected');
    const rangeLeft = document.getElementById('rangeLeft');
    const rangeRight = document.getElementById('rangeRight');

    function formatarMoeda(valor) {
        return parseFloat(valor).toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
    }
    
    function updateDisplay() {
        const minVal = parseInt(minInput.value);
        const maxVal = parseInt(maxInput.value);
        
        if(minDisplay) minDisplay.value = formatarMoeda(minVal);
        if(maxDisplay) maxDisplay.value = formatarMoeda(maxVal);
        
        if(minVal > maxVal) {
            minInput.value = maxVal;
        }
        if(maxVal < minVal) {
            maxInput.value = minVal;
        }
        
        const min = parseInt(minInput.min);
        const max = parseInt(minInput.max);
        const leftPercent = ((parseInt(minInput.value) - min) / (max - min)) * 100;
        const rightPercent = ((max - parseInt(maxInput.value)) / (max - min)) * 100;
        
        if(rangeSelected) {
            rangeSelected.style.left = leftPercent + '%';
            rangeSelected.style.right = rightPercent + '%';
        }
        
        if(rangeLeft) rangeLeft.value = 'left:' + leftPercent + '%;';
        if(rangeRight) rangeRight.value = 'right:' + rightPercent + '%;';
    }
    
    if(minInput && maxInput) {
        minInput.addEventListener('input', updateDisplay);
        maxInput.addEventListener('input', updateDisplay);
        
        updateDisplay();
    }
});
