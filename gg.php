<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Selection</title>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="section_container nav_container">
    <a href="#" class="nav__logo">Mon'sa</a>
    <ul class="nav__links">
        <li class="link"><a href="#">HOME</a></li>
        <li class="link"><a href="#">SHOP</a></li>
        <li class="link"><a href="#">PAGES</a></li>
        <li class="link"><a href="#">BLOG</a></li>
        <li class="link"><a href="#">LOOKBOOK</a></li>
    </ul>
    <div class="nav__icons">
        <span><i class="ri-shield-user-line"></i></span>
        <span><i class="ri-search-line"></i></span>
        <!-- Change the onclick event to toggleShoppingBag() -->
        <span id="shoppingBagIcon" onclick="toggleShoppingBag()"><i class="ri-shopping-bag-2-line"></i></span>

    </div>
</nav>

<!-- Shopping bag dropdown -->
<div id="shoppingBagDropdown" class="shopp" style="position: absolute;
  top: 50px; /* Adjust as needed */
  right: 20px; /* Adjust as needed */
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
  display: none; /* Initially hidden */
  z-index: 999; /* Ensure it appears above other content */">
  <div id="shoppingCart"></div>
    <!-- Content of the shopping bag dropdown goes here -->
    <div>Total: <span id="totalPrice">$0.00</span></div>
</div>

<?php
session_start();
// Check if the user is authenticated
if (isset($_SESSION['id_user'])) {
    $user_id = $_SESSION['id_user'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}

// Function to write data to CSV
function writeToCSV($user_id, $article_id, $quantity, $total_price) {
    $file = fopen("card.csv", "a"); // Open CSV file in append mode
    fputcsv($file, array($user_id, $article_id, $quantity, $total_price)); // Write data to CSV
    fclose($file); // Close CSV file
}

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
    echo '<div class="form-group">';
    echo '<label for="quantity">Quantity:</label>';
    echo '<input type="number" id="quantity" name="quantity" value="1" min="1">';
    echo '</div>';
    echo '<div class="price-info">';
    echo '<p><strong>Price:</strong> $' . $article_details['price'] . '</p>';
    echo '</div>';
    echo '</div>';
    echo '<div class="buttons">';
    // Added id attribute to the button for easier access
    echo '<button class="btn" id="addToCartBtn">Add to Cart</button>';
    echo '<button class="btn" id="placeOrderBtn">Place Order</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
    // Check if quantity and total_price are provided via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['quantity']) && !empty($_POST['total_price'])) {
            $quantity = $_POST['quantity'];
            $total_price = $_POST['total_price'];
          
            // Call writeToCSV function to save data to card.csv
            writeToCSV($user_id, $article_id, $quantity, $total_price);
        } else {
            // If quantity or total_price is not provided, handle the error accordingly
            echo 'Quantity or total price is missing.';
        }
    }
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

<footer class="section_container footer_container">
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

  <div class="section_container footer_bar">
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

  <script>
// Initialize total price variable
var totalPrice = 0;

// Function to toggle the visibility of the shopping bag dropdown
function toggleShoppingBag() {
    var shoppingBagDropdown = document.getElementById('shoppingBagDropdown');
    // Toggle the display style of the shopping bag dropdown
    if (shoppingBagDropdown.style.display === 'none') {
        shoppingBagDropdown.style.display = 'block';
    } else {
        shoppingBagDropdown.style.display = 'none';
    }
}

function addToCart(name, price, imageUrl) {
    // Disable the button to prevent multiple clicks
    document.getElementById('addToCartBtn').disabled = true;

    // Get quantity value
    var quantity = document.getElementById('quantity').value;

    // Create a new item element
    var item = document.createElement('div');
    item.classList.add('cartItem');
    item.innerHTML = `
        <img src="assets/${imageUrl}" alt="${name}" />
        <div>
            <p>${name}</p>
            <p>$${price}</p>
        </div>
    `;

    // Append the item to the shopping cart
    document.getElementById('shoppingCart').appendChild(item);

    // Update total price
    totalPrice += parseFloat(price) * parseInt(quantity);

    // Show the shopping bag dropdown
    document.getElementById('shoppingBagDropdown').style.display = 'block';

    // Update total price display
    document.getElementById('totalPrice').innerText = '$' + totalPrice.toFixed(2);

    // Send data to PHP script using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "gg.php?id=<?php echo $article_id; ?>", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Data sent to PHP successfully.");
            } else {
                console.error("Error sending data to PHP.");
            }
        }
    };
    var params = "quantity=" + encodeURIComponent(quantity) +
                 "&total_price=" + encodeURIComponent(totalPrice);
    xhr.send(params);
}

// Hide the shopping bag dropdown when clicking outside of it
document.addEventListener('click', function(event) {
    var shoppingBagDropdown = document.getElementById('shoppingBagDropdown');
    var shoppingBagIcon = document.getElementById('shoppingBagIcon');
    if (!shoppingBagDropdown.contains(event.target) && !shoppingBagIcon.contains(event.target)) {
        shoppingBagDropdown.style.display = 'none';
    }
});

// Add event listener to the "Add to Cart" button
document.getElementById('addToCartBtn').addEventListener('click', function() {
    addToCart('<?php echo $article_details['name']; ?>', '<?php echo $article_details['price']; ?>', '<?php echo $article_details['imageurl']; ?>');
});

</script>
</body>
</html>