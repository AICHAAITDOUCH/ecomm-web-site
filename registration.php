<?php
session_start();

// Define the path to the CSV file
$csvFilePath = "users.csv";

// Function to read CSV file and return data as array
function readCSV($file) {
    $data = [];
    $handle = fopen($file, "r");
    if ($handle !== FALSE) {
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $data[] = $row;
        }
        fclose($handle);
    }
    return $data;
}

// Function to write data array to CSV file
function writeCSV($file, $data) {
    $handle = fopen($file, "a");
    if ($handle !== FALSE) {
        fputcsv($handle, $data);
        fclose($handle);
    }
}

// Function to generate a unique user ID based on the last user ID in the CSV file
function generateUserID($file) {
    $data = readCSV($file);
    if (!empty($data)) {
        $lastUserID = end($data)[0]; // Get the last user ID from the CSV file
        $nextUserID = intval($lastUserID) + 1; // Increment the last user ID by 1
        return $nextUserID;
    } else {
        return 1; // If the CSV file is empty, start with user ID 1
    }
}

// Check if the form is submitted
if (isset($_POST['sing_up'])) {
    $user_id = generateUserID($csvFilePath); // Generate a unique user ID
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Get password from the form input
    $preferences = implode(",", $_POST['preference']); // Convert array to comma-separated string

    // Prepare data array for CSV insertion
    $userData = [$user_id, $user_name, $email, $password, $preferences];

    // Add new user to CSV file
    writeCSV($csvFilePath, $userData);
// Stocker les préférences de l'utilisateur dans la session
// $_SESSION['preferences'] = $_POST['preference'];
    // Redirect to the login page or any other page as needed
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
<div class="wrapper">
<header>Registration</header>
<form method="post">
<div class="field name">
<div class="input-area">
<input type="text" placeholder="Enter Name" name="user_name" required>
<i style="font-size:24px" class="icon fas fa">&#xf007;</i>
</div>
</div>
<div class="field email">
<div class="input-area">
<input type="text" placeholder="Email Address" name="email" required>
<i class="icon fas fa-envelope"></i>
</div>
</div>
<div class="field password">
<div class="input-area">
<input type="password" placeholder="Password" name="password" required>
<i class="icon fas fa-lock"></i>
</div>
</div>
<div class="field preference">
    <div class="input-area">
        <input type="checkbox" id="jacket" name="preference[]" value="1">
        <label for="jacket">Jacket</label><br>
        <input type="checkbox" id="tshirt" name="preference[]" value="2">
        <label for="tshirt">T-shirt</label><br>
        <input type="checkbox" id="dress" name="preference[]" value="3">
        <label for="dress">Dress</label><br>
        <input type="checkbox" id="sweater" name="preference[]" value="4">
        <label for="sweater">Sweater</label><br>
        <input type="checkbox" id="hoodie" name="preference[]" value="5">
        <label for="hoodie">Hoodie</label><br>
    </div>
</div>
<input type="submit" value="Sing UP" name="sing_up">
</form>
</div>
</body>
</html>
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
  /* background: url(../assets/shopping.jpg); */
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
  margin-top: 80px;
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
/* Checkbox styling */
.field.preference input[type="checkbox"] {
    display: none;
}

.field.preference label {
    display: inline-block;
    position: relative;
    padding-left: 25px;
    cursor: pointer;
}

.field.preference label:before {
    content: "";
    display: inline-block;
    position: absolute;
    left: 0;
    top: 0;
    width: 16px;
    height: 16px;
    border: 2px solid #ccc;
    border-radius: 3px;
    background-color: #fff;
}

.field.preference input[type="checkbox"]:checked + label:before {
    background-color: #5372F0;
    border-color: #5372F0;
}

/* Checkbox label text */
.field.preference label {
    font-size: 16px;
    color: #333;
}

/* Checkbox label hover effect */
.field.preference label:hover {
    color: #5372F0;
}

/* Checkbox label text */
.field.preference label {
    font-size: 16px;
    color: #333;
}
.field.preference{
  
}

</style>