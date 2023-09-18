function validateForm() {
    var phoneValue = document.getElementById("phone").value;
    var emailValue = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    var phoneRegex = /^0[1-9][0-9]{8}$/;
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    var phoneInput = document.getElementById("phone");
    var errorPhone = document.querySelector(".error-phone");
    var emailInput = document.getElementById("email");

    if (!phoneRegex.test(phoneValue)) {
        phoneInput.classList.add("error");
        errorPhone.style.display = "block"; 
    } else {
        phoneInput.classList.remove("error");
        errorPhone.style.display = "none"; 
    } 

    if (!emailRegex.test(emailValue)) {
        emailInput.classList.add("error");
        document.querySelector(".error-email").style.display = "block";
    } else {
        emailInput.classList.remove("error");
        document.querySelector(".error-email").style.display = "none";
    }

    if (password.length < 8 || !/[A-Z]/.test(password) || !/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password) || password !== confirmPassword) {
        return false;
    }
    
    return true;
}