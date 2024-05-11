


 



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
      <a href="#" class="nav__logo"><img src="assets/LOGO.png" style="width: 50%;"> </img> </a>
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
    <!-- <form action="login.php" method="get">
          <button type="submit"><i style="font-size:24px" class="fa">&#xf007;</i></button>
      </form> -->
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

    <!-- <section class="section__container sale__container">
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
    </section> -->

    <section class="section_container musthave_container">
      <h2 class="section__title">Must Have</h2>
      
      <div class="musthave__grid">
      <?php
session_start();

// Fonction pour lire les articles à partir du fichier CSV
function getArticlesFromCSV() {
    $articles = [];
    $file = fopen("article.csv", "r");
    while (($data = fgetcsv($file)) !== FALSE) {
        $articles[] = [
            'id' => $data[0],
            'name' => $data[1],
            'description' => $data[2],
            'categorie' => explode(',', $data[3]), // Convertir la chaîne de catégories en tableau
            'price' => $data[4],
            'size' => $data[5],
            'color' => $data[6],
            'imageurl' => $data[7]
        ];
    }
    fclose($file);
    return $articles;
}

// Obtenir la requête de recherche de l'utilisateur
$query = isset($_GET['query']) ? strtolower($_GET['query']) : '';

// Obtenir tous les articles à partir du fichier CSV
$articles = getArticlesFromCSV();

// Filtrer les articles en fonction de la requête de recherche
$results = [];
foreach ($articles as $article) {
    // Vérifiez si le nom ou la description de l'article contient la requête de recherche
    if (strpos(strtolower($article['name']), $query) !== false ||
        strpos(strtolower($article['description']), $query) !== false) {
        $results[] = $article;
    }
}

// Afficher les résultats de la recherche

foreach ($results as $article) {
    echo '<div class="result__card">';
    echo '<a href="gg.php?id=' . $article['id'] . '"><img src="assets/' . $article['imageurl'] . '" alt="' . $article['name'] . '" /></a>';
    echo '<h4>' . $article['name'] . '</h4>';
    echo '<p>$' . $article['price'] . '</p>';
    echo '</div>';
}
?>

      </div>
    </section>
<br>
<br>
   

    

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
