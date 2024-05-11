<?php
session_start();

// Fonction de lecture des utilisateurs depuis le fichier CSV
function getUsersFromCSV() {
    $users = [];
    $file = fopen("users.csv", "r");
    if ($file) {
        while (($data = fgetcsv($file)) !== FALSE) {
            // Crée un tableau associatif pour chaque utilisateur
            $users[] = [
                'id' => $data[0],
                'email' => $data[2],
                'password' => $data[3],
                'preferences' => isset($data[4]) ? explode(",", $data[4]) : []
            ];
        }
        fclose($file);
    }
    return $users;
}

// Traite la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Nettoie les données d'entrée
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($password);

    // Lit les utilisateurs depuis le CSV
    $users = getUsersFromCSV();

    // Vérifie les identifiants
    $authenticated = false;
    foreach ($users as $user) {
        if ($user['email'] == $email && $user['password'] == $password) {
            // Authentification réussie
            $_SESSION['id_user'] = $user['id'];
            $authenticated = true;
            break;
        }
    }

    // Si l'authentification réussit, redirige vers index.php
    if ($authenticated) {
        header("Location: index.php");
        exit();
    } else {
        // Affiche un message d'erreur ou redirige vers la page de connexion avec un message d'erreur
        header("Location: login.php?error=invalid_credentials");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="wrapper">
<header>Login</header>
<form method="POST" action="login.php">
    <div class="field email">
        <div class="input-area">
            <input type="email" id="email" placeholder="Email Address" name="email" required>
            <i class="icon fas fa-envelope"></i>
        </div>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
        <div class="error error-txt">Invalid email or password.</div>
        <?php endif; ?>
    </div>
    <div class="field password">
        <div class="input-area">
            <input type="password" id="password" placeholder="Password" name="password" required>
            <i class="icon fas fa-lock"></i>
        </div>
    </div>
    <input type="submit" value="Login" name="submit">
</form>
</div>
</body>
</html>

<!-- 
    <script>
        // Sélection des éléments du formulaire
const form = document.querySelector("#loginForm");
const emailField = form.querySelector(".email");
const emailInput = emailField.querySelector("input");
const passwordField = form.querySelector(".password");
const passwordInput = passwordField.querySelector("input");

// Gestionnaire d'événements de soumission du formulaire
form.onsubmit = (e) => {
    e.preventDefault(); // Empêche l'envoi du formulaire par défaut
   
    const emailValid = checkEmail();
    const passwordValid = checkPassword();

    // Vérifie si les deux champs sont valides avant de rediriger
    if (emailValid && passwordValid) {
        // Redirige l'utilisateur vers l'URL spécifiée dans l'attribut action du formulaire
        window.location.href = form.getAttribute("action");
    }
};

// Gestionnaire d'événements pour les champs d'email et de mot de passe
emailInput.onkeyup = checkEmail;
passwordInput.onkeyup = checkPassword;

// Fonction pour ajouter les classes "shake" et "error"
function addShakeAndErrorClass(field) {
    field.classList.add("shake", "error");
    setTimeout(() => {
        field.classList.remove("shake");
    }, 500);
}

// Fonction pour valider l'email
function checkEmail() {
    // Pattern pour valider les emails
    const pattern = /^[^@ ]+@[^@ ]+\.[a-z]{2,}$/i; 
    const errorText = emailField.querySelector(".error-txt");
    
    // Vérification de la correspondance avec le pattern
    if (!pattern.test(emailInput.value)) {
        addShakeAndErrorClass(emailField);
        errorText.innerText = "Enter a valid email address";
        return false;
    } else {
        emailField.classList.remove("error");
        emailField.classList.add("valid");
        errorText.innerText = ""; // Réinitialise le message d'erreur
        return true;
    }
}

// Fonction pour valider le mot de passe
function checkPassword() {
    const errorText = passwordField.querySelector(".error-txt");
    
    // Vérification si le champ de mot de passe est vide
    if (passwordInput.value.trim() === "") {
        addShakeAndErrorClass(passwordField);
        errorText.innerText = "Password cannot be blank";
        return false;
    } else {
        passwordField.classList.remove("error");
        passwordField.classList.add("valid");
        errorText.innerText = ""; // Réinitialise le message d'erreur
        return true;
    }
}

    </script> -->


<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body{
  width: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgb(140, 0, 255);
  /* background: url(../assets/MAbag.jpg); */
}
::selection{
  color: #fff;
  background: #5372F0;
}
.wrapper{
  width: 380px;
  padding: 40px 30px 50px 30px;
  background: #fff;
  border-radius: 5px;
  text-align: center;
  box-shadow: 10px 10px 15px rgba(0,0,0,0.1);
}
.wrapper header{
  font-size: 35px;
  font-weight: 600;
}
.wrapper form{
  margin: 40px 0;
}
form .field{
  width: 100%;
  margin-bottom: 20px;
}
form .field.shake{
  animation: shake 0.3s ease-in-out;
}
@keyframes shake {
  0%, 100%{
    margin-left: 0px;
  }
  20%, 80%{
    margin-left: -12px;
  }
  40%, 60%{
    margin-left: 12px;
  }
}
form .field .input-area{
  height: 50px;
  width: 100%;
  position: relative;
}
form input{
  width: 100%;
  height: 100%;
  outline: none;
  padding: 0 45px;
  font-size: 18px;
  background: none;
  caret-color: #5372F0;
  border-radius: 5px;
  border: 1px solid #bfbfbf;
  border-bottom-width: 2px;
  transition: all 0.2s ease;
}
form .field input:focus,
form .field.valid input{
  border-color: #5372F0;
}
form .field.shake input,
form .field.error input{
  border-color: #dc3545;
}
.field .input-area i{
  position: absolute;
  top: 50%;
  font-size: 18px;
  pointer-events: none;
  transform: translateY(-50%);
}
.input-area .icon{
  left: 15px;
  color: #bfbfbf;
  transition: color 0.2s ease;
}
.input-area .error-icon{
  right: 15px;
  color: #dc3545;
}
form input:focus ~ .icon,
form .field.valid .icon{
  color: #5372F0;
}
form .field.shake input:focus ~ .icon,
form .field.error input:focus ~ .icon{
  color: #bfbfbf;
}
form input::placeholder{
  color: #bfbfbf;
  font-size: 17px;
}
form .field .error-txt{
  color: #dc3545;
  text-align: left;
  margin-top: 5px;
}
form .field .error{
  display: none;
}
form .field.shake .error,
form .field.error .error{
  display: block;
}
form .pass-txt{
  text-align: left;
  margin-top: -10px;
}
.wrapper a{
  color: #5372F0;
  text-decoration: none;
}
.wrapper a:hover{
  text-decoration: underline;
}
form input[type="submit"]{
  height: 50px;
  margin-top: 30px;
  color: #fff;
  padding: 0;
  border: none;
  background: #5372F0;
  cursor: pointer;
  border-bottom: 2px solid rgba(0,0,0,0.1);
  transition: all 0.3s ease;
}
form input[type="submit"]:hover{
  background: #2c52ed;
}
</style>