//INSCRIPTION

// variables globales
let firstNameInput = document.getElementById("registration_form_firstName");
let lastNameInput = document.getElementById("registration_form_lastName");
let phoneInput = document.getElementById("registration_form_tel");
let emailInput = document.getElementById("registration_form_email");
let passwordInput = document.getElementById("registration_form_plainPassword_first");
let confirmPasswordInput = document.getElementById("registration_form_plainPassword_second");

let nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\-]+$/;
let phoneRegex = /^0[1-9][0-9]{8}$/;
let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

function validateFirstName(firstName) {
  if (!nameRegex.test(firstName)) {
      firstNameInput.classList.add("error");
      document.querySelector(".error-fN").style.display = "block"; 
  } else {
    firstNameInput.classList.remove("error");
    document.querySelector(".error-fN").style.display = "none"; 
  } 
}
function validateLastName(lastName) {
  if (!nameRegex.test(lastName)) {
      lastNameInput.classList.add("error");
      document.querySelector(".error-lN").style.display = "block"; 
  } else {
    lastNameInput.classList.remove("error");
    document.querySelector(".error-lN").style.display = "none"; 
  } 
}

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
  let password = passwordInput.value;

  if (confirmPassword !== password) {
    confirmPasswordInput.classList.add("error");
    document.querySelector(".error-confirmPsw").style.display = "block";
  } else {
    confirmPasswordInput.classList.remove("error");
    document.querySelector(".error-confirmPsw").style.display = "none";
  }
}

function validateForm() {
  let phoneNumber = phoneInput.value;
  let email = emailInput.value;
  let password = passwordInput.value;
  let confirmPassword = confirmPasswordInput.value;

  // Appel des fonctions de validation correspondantes
  validatePhoneNumber(phoneNumber);
  validateEmail(email);
  validatePassword(password);
  validatePasswordConfirmation(confirmPassword);

  if (!phoneRegex.test(phoneNumber) || !emailRegex.test(email) || password.length < 8 || !/[A-Z]/.test(password) || !/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password) || password !== confirmPassword) {

    //le formulaire est invalide!
    let errorMessage = "Le formulaire contient des erreurs. Veuillez corriger les champs en rouge.";
    let errorText = document.getElementById("error-message");
    errorText.textContent = errorMessage;
    errorText.style.color = "red";

    return false;
  }
  
}
