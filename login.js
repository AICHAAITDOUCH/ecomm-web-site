const form = document.querySelector("form");
const nameField = form.querySelector(".name");
const nameInput = nameField.querySelector("input");
const emailField = form.querySelector(".email");
const emailInput = emailField.querySelector("input");
const passwordField = form.querySelector(".password");
const passwordInput = passwordField.querySelector("input");

form.onsubmit = (e) => {
    e.preventDefault(); // Empêche la soumission du formulaire

    // Vérification des champs Name, Email et Password
    const nameValid = checkName();
    const emailValid = checkEmail();
    const passwordValid = checkPassword();

    // Si tous les champs sont valides, redirige vers l'URL spécifiée dans l'attribut action du formulaire
    if (nameValid && emailValid && passwordValid) {
        window.location.href = form.getAttribute("action");
    }
};

nameInput.onkeyup = checkName;
emailInput.onkeyup = checkEmail;
passwordInput.onkeyup = checkPassword;

function addShakeAndErrorClass(field) {
    field.classList.add("shake", "error");
    setTimeout(() => {
        field.classList.remove("shake");
    }, 500);
}

function checkName() {
    const pattern = /^[A-Za-z ]+$/; // Pattern pour valider les noms (uniquement les lettres et les espaces)
    const errorText = nameField.querySelector(".error-txt");
    
    if (!pattern.test(nameInput.value)) {
        addShakeAndErrorClass(nameField);
        errorText.innerText = "Enter a valid name (letters and spaces only)";
        return false;
    } else {
        nameField.classList.remove("error");
        nameField.classList.add("valid");
        errorText.innerText = ""; // Réinitialiser le message d'erreur
        return true;
    }
}

function checkEmail() {
    const pattern = /^[^@ ]+@[^@ ]+\.[a-z]{2,}$/i; // Pattern pour valider les emails
    const errorText = emailField.querySelector(".error-txt");
    
    if (!pattern.test(emailInput.value)) {
        addShakeAndErrorClass(emailField);
        errorText.innerText = "Enter a valid email address";
        return false;
    } else {
        emailField.classList.remove("error");
        emailField.classList.add("valid");
        errorText.innerText = ""; // Réinitialiser le message d'erreur
        return true;
    }
}

function checkPassword() {
    const errorText = passwordField.querySelector(".error-txt");
    
    if (passwordInput.value.trim() === "") {
        addShakeAndErrorClass(passwordField);
        errorText.innerText = "Password cannot be blank";
        return false;
    } else {
        passwordField.classList.remove("error");
        passwordField.classList.add("valid");
        errorText.innerText = ""; // Réinitialiser le message d'erreur
        return true;
    }
}
