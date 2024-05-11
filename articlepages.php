<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A2Z</title>
    <link rel="stylesheet" href="styles.css"> 
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
</head>
<body>
    <nav class="section__container nav__container">
    <a href="index.php" class="nav__logo"><img src="assets/LOGO.png" style="width: 50%;"> </img> </a>
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
        </div>
    </nav>

    <section class="dada">
      <h1>Items with Filter</h1>
      <!-- Filter options -->
      <div class="filtera">
        <form action="articlepages.php" method="GET">
            <label for="category">Category:</label>
            <select name="category" id="category" onchange="this.form.submit()">
            <option value="">choisi one</option>
            <option value="0">All</option>
    <option value="1">Jacket</option>
    <option value="2">T-shirt</option>
    <option value="3">Dress</option>
    <option value="4">Sweater</option>
    <option value="5">Hoodie</option>
</select>


        </form>
        
      </div>
  </section>

     

    <section class="section__container musthave__container">
        <h2 class="section__title">Must Have</h2>
        
        <div class="musthave__grid">
          <?php
// Fonction pour lire un fichier CSV et retourner les données
function readCSV($filename) {
  $data = [];
  if (($handle = fopen($filename, 'r')) !== FALSE) {
      while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
          // Vérifiez si les colonnes de nom et de prix sont non vides
          if (!empty(trim($row[1])) && !empty(trim($row[4]))) { // Modifiez les indices selon vos colonnes
              // Supprimer les espaces inutiles des valeurs de tableau
              $row = array_map('trim', $row);
              $data[] = $row;
          }
      }
      fclose($handle);
  }
  return $data;
}


// Lisez les données des articles à partir du fichier CSV
$articles = readCSV('article.csv'); // Assurez-vous que ce chemin est correct

// Obtenir la catégorie sélectionnée à partir de l'URL
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '0';

// Liste pour stocker tous les articles (si 'All' est sélectionné)
$filteredArticles = [];

// Filtrer les articles en fonction de la catégorie sélectionnée
foreach ($articles as $key => $article) {
  // Vérifiez que les indices de colonne sont corrects selon votre fichier CSV
  $articleCategory = $article[3]; // Colonne de catégorie

  // Si la catégorie sélectionnée est "0" ou vide, affichez tous les articles
  if ($selectedCategory === '0' || $selectedCategory === '') {
      $filteredArticles[] = $article;
  } else {
      // Sinon, filtrez les articles selon la catégorie sélectionnée
      if ($articleCategory == $selectedCategory) {
          $filteredArticles[] = $article;
      }
  }
}

// Afficher les articles filtrés
foreach ($filteredArticles as $key => $article) {
  // Skip the first iteration
  if ($key === 0 && ($selectedCategory === '0' || $selectedCategory === '')) {
      continue;
  }

  // Vérifiez que le nom, le prix et l'URL de l'image ne sont pas vides
  $articleName = isset($article[1]) ? trim($article[1]) : '';
  $articlePrice = isset($article[4]) ? trim($article[4]) : '';
  $articleImageURL = isset($article[7]) ? trim($article[7]) : '';

  // Continuez avec l'article seulement si toutes les données sont non vides
  if ($articleName !== '' && $articlePrice !== '' && $articleImageURL !== '') {
      echo '<div class="musthave__card">';
      // echo '<a href="gg.php?id=' . htmlspecialchars($article[0]) . '">';
      echo '<a href="gg.php?id=' . htmlspecialchars($article[0]) . '"><img src="assets/' . htmlspecialchars($articleImageURL) . '" alt="' . htmlspecialchars($articleName) . '"> </a>';
      echo '<h4>' . htmlspecialchars($articleName) . '</h4>';
      echo '<p>' . htmlspecialchars($articlePrice) . '</p>';
      // echo '</a>';
      echo '</div>';
  }
}
?>
          
        </div>

        <br>
        <br>
        <br>
        <hr>
      </section>
      <section id="new" class="section__container collection__container">
      <img src="assets/collection.jpg" alt="collection" />
      <div class="collection__content">
        <h2 class="section__title">New Collection</h2>
        <p>#35 ITEMS</p>
        <h4>Available on Store</h4>
        <button class="btn">SHOP NOW</button>
      </div>
    </section>
<hr>

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
