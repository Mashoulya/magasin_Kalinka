function confirmReservation() {
  let confirmDialog = document.getElementById("confirm-dialog");
  confirmDialog.style.display = "block";
}

function cancelReservation() {
  let confirmDialog = document.getElementById("confirm-dialog");
  confirmDialog.style.display = "none";
}

function proceedWithReservation() {
  window.location.href = "{{ path('app_add_order') }}";
}

document.getElementById("cancel-btn").addEventListener("click", function() {
  hideConfirmationDialog();
});
