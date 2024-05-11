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

// Check if article details were found
if (!empty($article_details)) {
    // Display article details
    echo '<h1>' . $article_details['name'] . '</h1>';
    echo '<p>' . $article_details['description'] . '</p>';
    echo '<p>Price: ' . $article_details['price'] . '</p>';
    echo '<p>Size: ' . $article_details['size'] . '</p>';
    echo '<p>Color: ' . $article_details['color'] . '</p>';
    // You can display more details as needed
} else {
    // If article details were not found
    echo 'Article details not found.';
}
?>

