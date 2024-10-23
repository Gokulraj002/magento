<?php
session_start();

// Get the product ID from the URL
$productId = isset($_GET['id']) ? $_GET['id'] : 0;

if (isset($_SESSION['cart'][$productId])) {
    unset($_SESSION['cart'][$productId]); // Remove the product from the cart
}

// Redirect back to cart
header("Location: cart.php");
exit();
