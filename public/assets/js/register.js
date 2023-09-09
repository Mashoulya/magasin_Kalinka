//INSCRIPTION

function validatePhoneNumber(phoneNumber) {
    var regex = /^0[1-9][0-9]{8}$/;
    var phoneInput = document.getElementById("phone");
    var errorPhone = document.querySelector(".error-phone");
  
    if (!regex.test(phoneNumber)) {
   
      phoneInput.classList.add("error");
      errorPhone.style.display = "block"; 
    } else {
      phoneInput.classList.remove("error");
      errorPhone.style.display = "none"; 
    } 
}

function validateEmail(email) {
  var emailInput = document.getElementById("email");
  var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

  if (!regex.test(email)) {
      
      emailInput.classList.add("error");
      document.querySelector(".error-email").style.display = "block";
  } else {
      emailInput.classList.remove("error");
      document.querySelector(".error-msg").style.display = "none";
  }
}

function validatePassword(password) {
    var passwordInput = document.getElementById("password");

    if (password.length < 8) {
        passwordInput.classList.add("error");
        document.querySelector(".error-psw").style.display = "block";
        return;
    }

    if (!/[A-Z]/.test(password)) {
        passwordInput.classList.add("error");
        document.querySelector(".error-psw").style.display = "block";
        return;
    }

    if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
        passwordInput.classList.add("error");
        document.querySelector(".error-psw").style.display = "block";
        return;
    }

    passwordInput.classList.remove("error");
    document.querySelector(".error-psw").style.display = "none";
}

function validatePasswordConfirmation(confirmPassword) {
  var password = document.getElementById("password").value;
  var confirmPasswordInput = document.getElementById("confirmPassword");

  if (confirmPassword !== password) {
      confirmPasswordInput.classList.add("error");
      document.querySelector(".error-confirmPsw").style.display = "block";
  } else {
      confirmPasswordInput.classList.remove("error");
      document.querySelector(".error-confirmPsw").style.display = "none";
  }
}

function validateForm() {
 
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;

  if (password.length < 8 || !/[A-Z]/.test(password) || !/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password) || password !== confirmPassword) {
      
    return false;
  }
    return true;
}