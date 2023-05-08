
function toggleDialog() {
    var addProductDialog = document.getElementById("add-configuration-dialog")
    addProductDialog.classList.toggle('hide')
}

function discountEditable() {
    let discount = document.querySelector('#product-discount');
    discount.disabled = !discount.disabled;
    discount.value = '';
}

function detectInvalidValues(){
    let input = document.querySelector('#product-discount');
    let discount = parseInt(input.value);

    if(discount < 0 || discount > 100) {
        alert("Hodnota musí byť medzi 0 - 100");
        input.value = '';
    }
}