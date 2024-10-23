<?php
session_start();
include_once '../admin/Product.php';

// Create a Product object
$product = new Product();

// Get the product ID from the URL
$productId = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch the product details
$productDetails = $product->getProductById($productId);
$productImages = $product->getProductImages($productId);


$mainImageUrl = count($productImages) > 0 ? $productImages[0]['image_url'] : 'placeholder_image.jpg'; // Placeholder image if no image exists

if (!$productDetails) {
  
    header("Location: product_detail.php?id=$productId&error=ProductNotFound");
    exit();
}


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId]['quantity'] += 1; // Increment quantity if product already exists in cart
} else {
 
    $_SESSION['cart'][$productId] = [
        'product_id' => $productDetails['product_id'],
        'name' => $productDetails['name'],
        'price' => $productDetails['price'],
        'image_url' => $mainImageUrl, // Add image URL
        'quantity' => 1
    ];
}

echo "
<script>
    alert('Product \"{$productDetails['name']}\" has been added to your cart!');
    setTimeout(function() {
        window.location.href = 'index.php';
    }, 200); // Redirect after 1.5 seconds
</script>
";
?>
