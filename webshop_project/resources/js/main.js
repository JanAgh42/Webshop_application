function toggleDropdown(id) {
    document.querySelector(`#${id}`).classList.toggle("block");
    document.querySelector(`#${id}`).classList.toggle("hidden");
}

function maxPriceText(){
    const slider = document.querySelector("#slider-price-input");
    slider.value = document.querySelector("#txt-price-input").value;
}

function maxPriceSlider(){
    const slider = document.querySelector("#slider-price-input");
    document.querySelector("#txt-price-input").value = slider.value;
}

window.onload=function(){
    const numberInput = document.querySelector('#txt-price-input');
    const rangeInput = document.querySelector('input[type="range"]');
    numberInput.addEventListener('input', handleInputChange);
    rangeInput.addEventListener('input', handleInputChange);
}

function handleInputChange(e) {
    const rangeInput = document.querySelector('input[type="range"]');
    const min = rangeInput.min;
    const max = rangeInput.max;
    const val = rangeInput.value;
    
    rangeInput.style.backgroundSize = (val - min) * 100 / (max - min) + '% 100%';
}

function selectColorFilter(id) {
    if(id === 'white-square') {
        document.querySelector(`#${id}`).classList.toggle('border-[#a79c88]')
    }
    else {
        classes = ['border', 'border-[#a79c88]', 'border-4'];
        classes.map(c => document.querySelector(`#${id}`).classList.toggle(c));
    }
}

function toggleHeaderDropdown(outerMenuId, innerMenuId) {
    const isInnerMenuOpen = document.querySelector(`#${innerMenuId}`).classList.contains('block');

    if (isInnerMenuOpen) {
        toggleDropdown(innerMenuId);
    }
    
    toggleDropdown(outerMenuId);
}

function starRating(starOrder) {
    for (let starId = 1; starId <= 5; starId++) {
        if (starId <= starOrder) {
            document.querySelector(`#dôfkmf-${starId}`).classList.add('text-yellow-500');
        }
        else {
            document.querySelector(`#dksd-${starId}`).classList.remove('text-yellow-500');
        }
    }
}

function toggleEditProfile() {
    const profileInputs = document.querySelector("#profile-main").getElementsByTagName("input");
    console.log(profileInputs);

    for (let input of profileInputs) {
        input.disabled = !input.disabled;
    }

    toggleDropdown("profile-change");
    toggleDropdown("profile-save");
}
