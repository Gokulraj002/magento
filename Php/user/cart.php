<?php
session_start();
include('header.php');


// Check if cart exists in session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assest/css/user.css">
    <style>
       
    </style>
</head>
<body>
<div class="container cart-container">
    <h2>Your Shopping Cart</h2>

    <?php if (count($cart) > 0): ?>
        <div class="row">
            <?php foreach ($cart as $item): ?>
                <div class="col-md-12 cart-item d-flex align-items-center">
                    <!-- Display product image -->
                    <img src='../admin/<?= $item["image_url"]; ?>' alt='<?= $item['name']; ?>' class='cart-image'>
                    <div class="cart-item-details">
                        <h5><?= $item['name']; ?></h5>
                        <p>Price: $<?= $item['price']; ?></p>
                        <p>Quantity: <?= $item['quantity']; ?></p>
                        <div class="cart-actions">
                            <a href='removeFromCart.php?id=<?= $item['product_id']; ?>' class="btn btn-danger">Remove</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-total">
            Total: $
            <?php
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            echo $total;
            ?>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
