 



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
    header("Location: login.php");
    exit(); 
}

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
      echo '<p> ' . $article['price'] . '</p>';
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
