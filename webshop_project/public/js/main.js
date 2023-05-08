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
    if(id === 'square-ffffff') {
        document.querySelector(`#${id}`).classList.toggle('border-[#a79c88]')
    }
    else {
        let classes = ['border', 'border-[#a79c88]', 'border-4'];
        classes.forEach(c => document.querySelector(`#${id}`).classList.toggle(c));
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
            document.querySelector(`#label-${starId}`).classList.add('text-yellow-500');
        }
        else {
            document.querySelector(`#label-${starId}`).classList.remove('text-yellow-500');
        }
    }
}

function toggleEditProfile() {
    const profileInputs = document.querySelector("#profile-main").getElementsByTagName("input");

    for (let input of profileInputs) {
        if (input.type == 'submit') {
            continue;
        }
        
        input.disabled = !input.disabled;
    }

    toggleDropdown("profile-change");
    toggleDropdown("profile-back");
}

function changeImage(imageUrl, imageId, numOfImages) {
    document.querySelector('#product_image').src = imageUrl;

    for(let selectId = 0; selectId < Number(numOfImages); selectId++) {
        document.querySelector(`#dot-${selectId}`).classList.remove('bg-slate-500'); 
    }

    document.querySelector(`#dot-${imageId}`).classList.add('bg-slate-500');
}

function increaseAmount(maximum) {
    let amount = Number(document.querySelector('#product-detail-amount').value);

    if (amount < maximum) {
        document.querySelector('#product-detail-amount').value = ++amount;
    }
}

function decreaseAmount() {
    let amount = Number(document.querySelector('#product-detail-amount').value);

    if (amount > 1) {
        document.querySelector('#product-detail-amount').value = --amount;
    }
}