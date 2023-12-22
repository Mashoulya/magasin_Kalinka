document.addEventListener("DOMContentLoaded", function () {
    let profileIcon = document.querySelector(".user");
    let logReg = document.querySelector(".log-reg");
  
    function hideHints() {
      logReg.style.display = "none";
    }
  
    profileIcon.addEventListener("click", function (event) {
      event.stopPropagation(); // Empêche la propagation de l'événement au document
      logReg.style.display = "flex"; // Affiche le bloc avant la connexion
    });
  
    document.addEventListener("click", function () {
      hideHints();
    });
  
    // Gérer le clic sur les tooltips pour éviter leur fermeture lorsqu'ils sont cliqués
    logReg.addEventListener("click", function (event) {
      event.stopPropagation(); // Empêche la propagation de l'événement au document
    });
  });