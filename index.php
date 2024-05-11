 



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css" />
    <title>A2Z</title>
  </head>
  <body>
   
    <nav class="section__container nav__container">
      <a href="index.php" class="nav__logo"><img src="assets/LOGO.png" > </img> </a>
      <ul class="nav__links">
        <li class="link"><a href="index.php">HOME</a></li>
        <li class="link"><a href="articlepages.php">SHOP</a></li>
        <li class="link"><a href="#F">BLOG</a></li> 
    <li class="link"><a href="#new">LOOKBOOK</a></li>
       
      
      </ul>
      
      <div class="nav__icons">
        
        
      <form action="search.php" method="get" id="searchForm">
        <input type="text" name="query" id="searchInput" placeholder="Search..." />
        <button type="submit"><i class="ri-search-line"></i></button>
    </form>
    <span><i class="ri-shopping-bag-2-line"></i></span>
        <form action="login.php" method="get">
          <button type="submit"><i style="font-size:24px" class="fa">&#xf007;</i></button>
      </form>
      </div>
      
    </nav>

    <header>
      <div class="section__container header__container">
        <div class="header__content">
          <p>EXTRA 55% OFF IN SPRING SALE</p>
          <h1>Discover & Shop<br />The Trend Ss19</h1>
          <button class="btn">SHOP NOW</button>
        </div>
        <div class="header__image">
          <img src="assets/header.png" alt="header" />
        </div>
      </div>
    </header>

    <section id="new" class="section__container collection__container">
      <img src="assets/collection.jpg" alt="collection" />
      <div class="collection__content">
        <h2 class="section__title">New Collection</h2>
        <p>#35 ITEMS</p>
        <h4>Available on Store</h4>
        <button class="btn">SHOP NOW</button>
      </div>
    </section>

    <section class="section__container sale__container">
      <h2 class="section__title">On Sale</h2>
      <div class="sale__grid">
        <div class="sale__card">
          <img src="assets/sale-1.jpg" alt="sale" />
          <div class="sale__content">
            <p class="sale__subtitle">MAN OUTERWEAR</p>
            <h4 class="sale__title">sale <span>40%</span> off</h4>
            <p class="sale__subtitle">- DON'T MISS -</p>
            <button class="btn sale__btn">SHOP NOW</button>
          </div>
        </div>
        <div class="sale__card">
          <img src="assets/sale-2.jpg" alt="sale" />
          <div class="sale__content">
            <p class="sale__subtitle">WOMAN T-SHIRT</p>
            <h4 class="sale__title">sale <span>25%</span> off</h4>
            <p class="sale__subtitle">- DON'T MISS -</p>
            <button class="btn sale__btn">SHOP NOW</button>
          </div>
        </div>
        <div class="sale__card">
          <img src="assets/sale-3.jpg" alt="sale" />
          <div class="sale__content">
            <p class="sale__subtitle">JACKETS</p>
            <h4 class="sale__title">sale <span>20%</span> off</h4>
            <p class="sale__subtitle">- DON'T MISS -</p>
            <button class="btn sale__btn">SHOP NOW</button>
          </div>
        </div>
      </div>
    </section>

    <section class="section_container musthave_container">
      <h2 class="section__title">Must Have</h2>
      
      <div class="musthave__grid">
     <?php

session_start();

// Function to read user data from CSV file
function getUsersFromCSV() {
    $users = [];
    $file = fopen("users.csv", "r");
    while (($data = fgetcsv($file)) !== FALSE) {
        $users[] = [
            'id' => $data[0],
            'email' => $data[1],
            'password' => $data[2],
            'preferences' => explode(',', $data[4]) // Convert preferences string to array
        ];
    }
    fclose($file);
    return $users;
}

// Function to read articles data from CSV file
function getArticlesFromCSV() {
    $articles = [];
    $file = fopen("article.csv", "r");
    while (($data = fgetcsv($file)) !== FALSE) {
        $articles[] = [
            'id' => $data[0],
            'name' => $data[1],
            'description' => $data[2],
            'categorie' => explode(',', $data[3]), // Convert categories string to array
            'price' => $data[4],
            'size' => $data[5],
            'color' => $data[6],
            'imageurl' => $data[7]
        ];
    }
    fclose($file);
    return $articles;
}

// Check if the user is logged in and retrieve user preferences
$userPreferences = [];

if (isset($_SESSION['id_user'])) {
    $users = getUsersFromCSV();
    foreach ($users as $user) {
        if ($user['id'] == $_SESSION['id_user']) {
            $userPreferences = $user['preferences'];
            break;
        }
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}

// Get articles from CSV file
$articles = getArticlesFromCSV();

// Display articles based on user preferences
foreach ($articles as $article) {
  // Check if any category of the article matches user preferences
  $shouldDisplayArticle = false;
  foreach ($userPreferences as $preference) {
      if (in_array($preference, $article['categorie'])) {
          $shouldDisplayArticle = true;
          break;
      }
  }
  // Display the article if it matches user preferences
  if ($shouldDisplayArticle) {
      echo '<div class="musthave__card">';
      echo '<a href="gg.php?id=' . $article['id'] . '"><img src="assets/' . $article['imageurl'] . '" alt="' . $article['name'] . '" /></a>';
      echo '<h4>' . $article['name'] . '</h4>';
      echo '<p><del>$' . $article['price'] . '</del> $' . $article['size'] . '</p>';
      echo '</div>';
  }
}


?>

      </div>
    </section>

   

    

    <hr />

    <footer id="F" class="section__container footer__container">
      <div class="footer__col">
        <h4 class="footer__heading">CONTACT INFO</h4>
        <p>
          <i class="ri-map-pin-2-fill"></i> 123, London Bridge Street, London
        </p>
        <p><i class="ri-mail-fill"></i> support@monsa.com</p>
        <p><i class="ri-phone-fill"></i> (+012) 3456 789</p>
      </div>
      <div class="footer__col">
        <h4 class="footer__heading">COMPANY</h4>
        <p>Home</p>
        <p>About Us</p>
        <p>Work With Us</p>
        <p>Our Blog</p>
        <p>Terms & Conditions</p>
      </div>
      <div class="footer__col">
        <h4 class="footer__heading">USEFUL LINK</h4>
        <p>Help</p>
        <p>Track My Order</p>
        <p>Men</p>
        <p>Women</p>
        <p>Shoes</p>
      </div>
      <div class="footer__col">
        <h4 class="footer__heading">INSTAGRAM</h4>
        <div class="instagram__grid">
          <img src="assets/instagram-1.jpg" alt="instagram" />
          <img src="assets/instagram-2.jpg" alt="instagram" />
          <img src="assets/instagram-3.jpg" alt="instagram" />
          <img src="assets/instagram-4.jpg" alt="instagram" />
          <img src="assets/instagram-5.jpg" alt="instagram" />
          <img src="assets/instagram-6.jpg" alt="instagram" />
        </div>
      </div>
    </footer>


    <hr />

    <div class="section__container footer__bar">
      <div class="copyright">
        Copyright © 2023 Web Design Mastery. All rights reserved.
      </div>
      <div class="footer__form">
        <form>
          <input type="text" placeholder="ENTER YOUR EMAIL" />
          <button class="btn" type="submit">SUBSCRIBE</button>
        </form>
      </div>
    </div>
    
  </body>
  
</html>
<!-- <style>
  @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap");

:root {
  --primary-color: #f1faff;
  --text-dark: #030712;
  --text-light: #6b7280;
  --extra-light: #fbfbfb;
  --white: #ffffff;
  --max-width: 1200px;
}

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

.section__container {
  max-width: var(--max-width);
  margin: auto;
  padding: 5rem 1rem;
}

.section__title {
  padding-bottom: 0.5rem;
  margin-bottom: 4rem;
  text-align: center;
  font-size: 2rem;
  font-weight: 600;
  color: var(--text-dark);
  position: relative;
}

.section__title::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: 0;
  transform: translateX(-50%);
  height: 3px;
  width: 75px;
  background-color: var(--text-dark);
}

.btn {
  padding: 0.75rem 2rem;
  font-size: 0.8rem;
  outline: none;
  border: none;
  cursor: pointer;
  transition: 0.3s;
}

a {
  text-decoration: none;
}

img {
  width: 100%;
  display: block;
}

body {
  font-family: "Montserrat", sans-serif;
}

.header__bar {
  padding: 0.5rem;
  font-size: 0.8rem;
  text-align: center;
  background-color: var(--text-dark);
  color: var(--white);
}

.nav__container {
  padding: 2rem 1rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.nav__logo {
  font-size: 1.5rem;
  font-weight: 300;
  color: var(--text-dark);
}
.nav__logo img {
  width: 50%;
}

.nav__links {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 1rem;
}

.link a {
  padding: 0 0.5rem;
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--text-light);
  transition: 0.3s;
}

.link a:hover {
  color: var(--text-dark);
}

 .nav__icons {
  display: flex;
  gap: 1rem;
} 

.nav__icons span {
  font-size: 1.25rem;
  cursor: pointer;
}
.nav__icons #searchForm{
  display: flex;
flex-direction: row;
gap: 1px;
}
.nav__icons #searchInput{
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: rgb(228, 226, 226);
  background-position: 10px 10px; 
 
}
.nav__icons #searchForm button {
  border: none; 
  padding: 5px; 
  cursor: pointer;
} 



header {
  margin-top: 10rem;
  background-color: var(--primary-color);
}

.header__container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 2rem;
}

.header__content p {
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--text-light);
  margin-bottom: 0.5rem;
}

.header__content h1 {
  font-size: 3rem;
  font-weight: 400;
  margin-bottom: 2rem;
  color: var(--text-dark);
}

.header__content .btn {
  background-color: var(--text-dark);
  color: var(--white);
}

.header__image {
  position: relative;
}

.header__image img {
  max-width: 400px;
  position: absolute;
  bottom: -5rem;
}

.collection__container {
  position: relative;
}

.collection__container img {
  max-width: 400px;
  margin: auto;
}

.collection__content {
  position: absolute;
  top: 50%;
  left: 2rem;
  transform: translateY(-50%);
}

.collection__content .section__title {
  margin-bottom: 2rem;
}

.collection__content p {
  font-size: 0.9rem;
  color: var(--text-light);
  margin-bottom: 0.5rem;
}

.collection__content h4 {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 1rem;
}

.collection__content .btn {
  border: 1px solid var(--text-dark);
  color: var(--text-dark);
  background-color: var(--white);
}

.collection__content .btn:hover {
  background-color: var(--text-dark);
  color: var(--white);
}

.sale__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
}

.sale__card {
  position: relative;
  overflow: hidden;
}

.sale__content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  color: var(--white);
  text-align: center;
}

.sale__title {
  font-size: 2rem;
  font-weight: 600;
}

.sale__title span {
  font-size: 2.5rem;
}

.sale__subtitle {
  font-size: 1rem;
}

.sale__btn {
  margin-top: 2rem;
  color: var(--white);
  background-color: var(--text-dark);
}

.sale__card::before {
  position: absolute;
  content: "";
  height: 100%;
  width: 100%;
  top: -100%;
  left: 0;
  background-color: rgba(0, 0, 0, 0.5);
  transition: 0.5s;
}

.sale__card:hover::before {
  top: 0;
}

.sale__card:hover .sale__btn {
  color: var(--text-dark);
  background-color: var(--white);
}

.musthave__nav {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 2rem;
  flex-wrap: wrap;
  margin-bottom: 2rem;
}

.musthave__nav a {
  font-size: 1rem;
  font-weight: 600;
  color: var(--text-light);
  transition: 0.3s;
}

.musthave__nav a:hover {
  color: var(--text-dark);
}

.musthave__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
}
.musthave__grid img{
  width: 100%;
  height: 300px;
}
.musthave__card {
  display: grid;
  gap: 0.5rem;
  color: var(--text-dark);
}

.musthave__card h4 {
  font-size: 1rem;
  font-weight: 600;
}

.musthave__card p {
  font-size: 0.9rem;
  font-weight: 500;
  margin-bottom: 1rem;
}

.musthave__card p del {
  font-weight: 400;
  color: var(--text-light);
}

.news {
  background-color: var(--extra-light);
}

.news__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
}

.news__details {
  padding: 1rem;
  display: grid;
  gap: 1rem;
  text-align: center;
}

.news__details p {
  font-size: 0.8rem;
  color: var(--text-light);
}

.news__details p i {
  font-size: 0.5rem;
  color: var(--text-light);
  padding: 0.5rem;
}

.news__details p span {
  font-weight: 600;
}

.news__details h4 {
  font-size: 1.2rem;
  font-weight: 600;
  color: var(--text-dark);
}

.news__details a i {
  font-size: 1.2rem;
  color: var(--text-light);
  transition: 0.3s;
}

.news__details a:hover i {
  color: var(--text-dark);
}

.brands__container {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 2rem;
}

.brand__image {
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0.5;
  cursor: pointer;
  transition: 0.3s;
}

.brand__image img {
  max-width: 120px;
}

.brand__image:hover {
  opacity: 1;
}

.footer__container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
}

.footer__heading {
  color: var(--text-light);
  font-size: 1rem;
  font-weight: 600;
  padding-bottom: 1rem;
  margin-bottom: 2rem;
  position: relative;
}

.footer__heading::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 2px;
  width: 50px;
  background-color: var(--text-light);
}

.footer__col p {
  font-size: 0.9rem;
  font-weight: 500;
  margin-bottom: 1rem;
  color: var(--text-light);
  cursor: pointer;
  transition: 0.3s;
}

.footer__col p:hover {
  color: var(--text-dark);
}

.footer__col p i {
  font-size: 1rem;
  margin-right: 0.5rem;
}

.instagram__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
}

.footer__bar {
  padding: 2rem 1rem;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  align-items: center;
  gap: 2rem;
}

.copyright {
  font-size: 0.9rem;
  font-weight: 500;
  color: var(--text-light);
}

.footer__form {
  display: flex;
  align-items: center;
  justify-content: flex-end;
}

.footer__form form {
  width: 100%;
  max-width: 400px;
  display: flex;
  align-items: center;
}

.footer__form input {
  width: 100%;
  padding: 0.75rem 1rem;
  outline: none;
  border: none;
  border-bottom: 1px solid var(--text-dark);
  font-size: 0.8rem;
}

.footer__form .btn {
  background-color: var(--text-dark);
  color: var(--white);
}

/* hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh */


.container {
  max-width: 800px;
  margin: 50px auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  display: flex;
}

.product-info {
  flex: 1;
}

.images-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 20px;
}

.product-image {
  max-width: 60%;
  height: auto;
  border-radius: 8px;
  margin-bottom: 20px;
}

.side-images {
  display: flex;
  justify-content: space-between;
  width: 80%;
}

.side-image {
  width: 30%;
  cursor: pointer;
  border-radius: 8px;
  overflow: hidden;
}

.side-image img {
  width: 80%;
  height: auto;
  transition: transform 0.3s ease;
}

.side-image:hover img {
  transform: scale(1.1);
}

.description {
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 10px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

select {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-color: #f9f9f9;
}

.buttons {
  display: flex;
  justify-content: space-between;
}

button.btn {
  padding: 10px 20px;
  font-size: 16px;
  border: 1px solid #000; /* Black border */
  cursor: pointer;
  transition: background-color 0.3s ease;
  background-color: #fff; /* White background */
  color: #000; /* Black text color */
}

button.btn:hover {
  background-color: black;
  color: #fff; /* Change text color on hover */
}

.musthave__grid2 {
  display: flex;
  justify-content: space-around; /* Add space on the left and right */
  gap: 20px; /* Adjust the gap value as needed */
}

.musthave__card2 {
  width: calc(50% - 5px); /* Reduce div size by 50% and consider gap */
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.musthave__card2 img {
  max-width: 100%;
  height: auto;
}

.musthave__card2 h4 {
  margin-top: 10px;
  margin-bottom: 5px;
}

.musthave__card2 p {
  margin-top: 5px;
  margin-bottom: 10px;
}

/* hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh */
.dada {
  background-color: #f1f1f1;
  padding: 20px;
  text-align: center;
}

.dada h1 {
  margin-bottom: 10px;
  font-size: 24px;
  color: #333;
}

.dada .filtera {
  margin-bottom: 20px;
}

.dada label {
  font-size: 16px;
  font-weight: bold;
}

.dada select {
  padding: 8px 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-color: #fff;
  cursor: pointer;
}

/* Optional: Style the select dropdown arrow */
.dada select::-ms-expand {
  display: none;
}

.dada select::after {
  content: '\25BC';
  position: absolute;
  top: 50%;
  right: 12px;
  transform: translateY(-50%);
  pointer-events: none;
}


@media (width < 900px) {
  header {
    margin-top: 5rem;
  }

  .sale__grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .musthave__grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
  }

  .news__grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .brands__container {
    grid-template-columns: repeat(3, 1fr);
  }

  .instagram__grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .footer__bar {
    grid-template-columns: repeat(1, 1fr);
  }

  .copyright {
    text-align: center;
  }

  .footer__form {
    justify-content: center;
  }
}

@media (width < 600px) {
 
  .nav__logo img{
    display: block;
    width: 50px;
    margin-left:-20px;

  }

  header {
    margin-top: 0;
  }

  .header__container {
    grid-template-columns: repeat(1, 1fr);
  }
/* ++ */
  .header__image {
    display: block;
    width: 150px;
    margin-left: 260px;
  }
  


.link a {
  padding: 0 2px;
  font-size: 10px;
  
}

.nav__links {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 1px;
}

.nav__icons {
  display: flex;
  gap: 5px;
}



.nav__icons #searchInput{

  font-size: 10px;
  
 
}


/* ++ */



  .sale__grid {
    grid-template-columns: repeat(1, 1fr);
  }

  .musthave__grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .news__grid {
    grid-template-columns: repeat(1, 1fr);
  }

  .brands__container {
    grid-template-columns: repeat(2, 1fr);
  }

  .footer__container {
    grid-template-columns: repeat(2, 1fr);
  }
}


</style> -->