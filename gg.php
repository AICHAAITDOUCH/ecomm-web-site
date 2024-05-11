<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A2Z</title>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css">
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
    <?php

// Retrieve the article ID from the query parameter
$article_id = $_GET['id'];


// Function to retrieve article details from CSV based on ID
function getArticleDetails($id) {
    // Initialize article details array
    $article_details = [];

    // Open the CSV file for reading
    $file = fopen("article.csv", "r");

    // Loop through each line in the CSV file
    while (($data = fgetcsv($file)) !== FALSE) {
        // Check if the ID matches the ID in the current CSV row
        if ($data[0] == $id) {
            // Assign article details from CSV to the $article_details array
            $article_details = [
                'id' => $data[0],
                'name' => $data[1],
                'description' => $data[2],
                'category' => $data[3],
                'price' => $data[4],
                'size' => $data[5],
                'color' => $data[6],
                'imageurl' => $data[7]
            ];
            // Break the loop since we found the matching article
            break;
        }
    }

    // Close the CSV file
    fclose($file);

    // Return the article details array
    return $article_details;
}

// Example usage:

$article_details = getArticleDetails($article_id);

if (!empty($article_details)) {
  // Display article details
  echo '<div class="container">';
  echo '<div class="product-info">';
  echo '<div class="images-wrapper">';
  echo '<img src="assets/' . $article_details['imageurl'] . '" alt="' . $article_details['name'] . '" id="main-image" class="product-image">';
  echo '</div>';
  echo '<h2>' . $article_details['name'] . '</h2>';
  echo '<div class="description">';
  echo '<p><strong>Description:</strong> ' . $article_details['description'] . '</p>';
  echo '<div class="form-group">';
  echo '<label for="size">Size:</label>';
  echo '<select id="size">';
  echo '<option value="">Select Size</option>';
  echo '<option value="small">Small</option>';
  echo '<option value="medium">Medium</option>';
  echo '<option value="large">Large</option>';
  echo '</select>';
  echo '</div>';
  echo '<div class="form-group">';
  echo '<label for="color">Color:</label>';
  echo '<select id="color">';
  echo '<option value="">Select Color</option>';
  echo '<option value="red">Red</option>';
  echo '<option value="blue">Blue</option>';
  echo '<option value="green">Green</option>';
  echo '</select>';
  echo '</div>';
  echo '<div class="price-info">';
  echo '<p><strong>Price:</strong> $' . $article_details['price'] . '</p>';
  echo '</div>';
  echo '</div>';
  echo '<div class="buttons">';
  echo '<button class="btn" id="addToCartBtn">Add to Cart</button>';
  echo '<button class="btn" id="placeOrderBtn">Place Order</button>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
} else {
    // If article details were not found
    echo 'Article details not found.';
}
?>


    
    <div class="musthave__grid2">
        <div class="musthave__card2">
          <img src="assets/musthave-1.png" alt="must have" />
          <h4>Basic long sleeve T-shirt</h4>
          <p><del>$45.00</del> $75.00</p>
        </div>
        <div class="musthave__card2">
          <img src="assets/musthave-2.png" alt="must have" />
          <h4>Ribbed T-shirt with buttons</h4>
          <p><del>$45.00</del> $75.00</p>
        </div>
        <div class="musthave__card2">
          <img src="assets/musthave-3.png" alt="must have" />
          <h4>Jacket withside strips</h4>
          <p><del>$45.00</del> $75.00</p>
        </div>
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

    <script src="javaprice.js"></script>
</body>
</html>
