<?php
include_once '../admin/product.php';
include('header.php');

// Create a Product object
$product = new Product();

// Get the product ID from the URL
$productId = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch the product details and images
$productDetails = $product->getProductById($productId);
$productImages = $product->getProductImages($productId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $productDetails['name']; ?> - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <!-- Left column for thumbnails and main image -->
        <div class="col-md-4 d-flex">
            <div class="d-flex flex-column align-items-center me-3">
                <!-- Thumbnails -->
                <div class="d-flex flex-column align-items-center">
                    <?php foreach ($productImages as $image): ?>
                        <div class="border mb-2">
                            <img src="../admin/<?= $image['image_url']; ?>" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;" data-full="../admin/<?= $image['image_url']; ?>" alt="<?= $productDetails['name']; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Main Image -->
            <div class="ms-3">
                <?php if (count($productImages) > 0): ?>
                    <img src="../admin/<?= $productImages[0]['image_url']; ?>" id="mainImage" class="img-fluid rounded shadow" alt="<?= $productDetails['name']; ?>" style="max-height: 400px; object-fit: contain;">
                <?php else: ?>
                    <p>No images available</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right column for product details -->
        <div class="col-md-7">
            <h2><?= $productDetails['name']; ?></h2>

            <!-- Product Price -->
            <p class="h4 text-primary">₹<?= $productDetails['price']; ?> <span class="text-muted text-decoration-line-through">₹1,999</span></p>

            <!-- Available Offers -->
            <div class="mb-3">
                <p><strong>Available Offers:</strong></p>
                <ul class="list-unstyled text-success">
                    <li>5% Unlimited Cashback on Flipkart Axis Bank Credit Card</li>
                    <li>10% off on SBI Credit Card Transactions of ₹4,990 and above</li>
                </ul>
            </div>

            <!-- Buttons -->
            <div class="d-grid gap-2 d-md-flex mb-4">
                <a href="addToCart.php?id=<?= $productDetails['product_id']; ?>" class="btn btn-primary me-md-2">Add to Cart</a>
                <a href="#" class="btn btn-outline-primary">Buy Now</a>
            </div>

            <!-- Delivery Info -->
            <div class="mb-4">
                <h5>Delivery</h5>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter Pincode">
                    <button class="btn btn-outline-primary">Check</button>
                </div>
                <p class="mt-2">Delivery by 31 Oct, Saturday</p>
            </div>

            <!-- Additional Product Information -->
            <div>
                <h5>Highlights</h5>
                <ul class="list-unstyled">
                    <li>Cotton: Yes</li>
                    <li>Branded</li>
                    <li>Easy Washable</li>
                    <li>Best Quality</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // JavaScript to handle thumbnail clicks and image swapping
    const thumbnails = document.querySelectorAll('.img-thumbnail');
    const mainImage = document.getElementById('mainImage');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            mainImage.src = this.getAttribute('data-full');
        });
    });
</script>
</body>
</html>
