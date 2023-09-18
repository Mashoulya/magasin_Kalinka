//INSCRIPTION

// variables globales
var phoneInput = document.getElementById("phone");
var emailInput = document.getElementById("email");
var passwordInput = document.getElementById("password");
var confirmPasswordInput = document.getElementById("confirmPassword");

var phoneRegex = /^0[1-9][0-9]{8}$/;
var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

function validatePhoneNumber(phoneNumber) {  
    if (!phoneRegex.test(phoneNumber)) {
      phoneInput.classList.add("error");
      document.querySelector(".error-phone").style.display = "block"; 
    } else {
      phoneInput.classList.remove("error");
      document.querySelector(".error-phone").style.display = "none"; 
    } 
}

function validateEmail(email) {
  if (!emailRegex.test(email)) {
    emailInput.classList.add("error");
    document.querySelector(".error-email").style.display = "block";
  } else {
    emailInput.classList.remove("error");
    document.querySelector(".error-email").style.display = "none";
  }
}

function validatePassword(password) {
    if (password.length < 8 || !/[A-Z]/.test(password) || !/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
        passwordInput.classList.add("error");
        document.querySelector(".error-psw").style.display = "block";
    } else {
        passwordInput.classList.remove("error");
        document.querySelector(".error-psw").style.display = "none";
    }
}

function validatePasswordConfirmation(confirmPassword) {
  var password = passwordInput.value;

  if (confirmPassword !== password) {
      confirmPasswordInput.classList.add("error");
      document.querySelector(".error-confirmPsw").style.display = "block";
  } else {
      confirmPasswordInput.classList.remove("error");
      document.querySelector(".error-confirmPsw").style.display = "none";
  }
}

function validateForm() {
  var phoneNumber = phoneInput.value;
  var email = emailInput.value;
  var password = passwordInput.value;
  var confirmPassword = confirmPasswordInput.value;

  // Appel des fonctions de validation correspondantes
  validatePhoneNumber(phoneNumber);
  validateEmail(email);
  validatePassword(password);
  validatePasswordConfirmation(confirmPassword);

  if (!phoneRegex.test(phoneNumber) || !emailRegex.test(email) || password.length < 8 || !/[A-Z]/.test(password) || !/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password) || password !== confirmPassword) {

    //le formulaire est invalide!
    var errorMessage = "Le formulaire contient des erreurs. Veuillez corriger les champs en rouge.";
    var errorText = document.getElementById("error-message");
    errorText.textContent = errorMessage;
    errorText.style.color = "red";

    return false;
  }
  
    //Toutes les conditions sont vraies!
    var registerForm = document.querySelector(".login-register-form");
    registerForm.style.display = "none";

    var authMsg = document.querySelector(".auth-msg");
    authMsg.style.display = "none";

    var confirmMsg = document.querySelector(".confirm-msg");
    confirmMsg.style.display = "block";

    return true; 
}


//massage du succès

// document.addEventListener("DOMContentLoaded", function () {
//   const registerForm = document.querySelector(".login-register-form");
//   const confirmMsg = document.querySelector(".confirm-msg");
//   const authMsg =document.querySelector(".auth-msg");

//   registerForm.addEventListener("submit", function (event) {
//       event.preventDefault(); // Empêche l'envoi du formulaire par défaut

//       // Masquer le formulaire
//       registerForm.style.display = "none";
//       authMsg.style.display = "none";

//       // Afficher le message de confirmation
//       confirmMsg.style.display = "block";
//   });
// });