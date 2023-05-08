function toggleConfirmationDialog(productId){
    var confirmDeleteDialog = document.getElementById('confirm-delete-dialog')
    var confirmDeleteLink= document.getElementById('confirm-delete-link');
    confirmDeleteLink.href = "/admin/product/delete/" + productId;
    confirmDeleteDialog.classList.toggle('hide')
}