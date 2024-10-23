<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    // If not logged in or not a user, redirect to the main index page
    header("Location: ../index.php");
    exit();
}


include_once '../admin/product.php';
include('header.php');

// Create a Product object
$product = new Product();

// Fetch the products
$products = $product->getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assest/css/user.css">
    <style>
     
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <!-- Filters Section -->
        <div class="col-md-3">
            <div class="filters">
                <div class="filter-title">Filters</div>

                <!-- Price Range Filter -->
                <div class="filter-item">
                    <label for="priceRange" class="form-label">Price Range</label>
                    <input type="range" class="form-range" min="0" max="5000" step="100" id="priceRange" value="5000">
                    <span id="priceValue">Up to ₹5000</span>
                </div>

                <!-- Name Filter -->
                <div class="filter-item">
                    <label class="form-label">Search by Name</label>
                    <input type="text" id="nameFilter" class="form-control" placeholder="Enter product name">
                </div>

                <button class="btn btn-primary mt-3" id="applyFilters">Apply Filters</button>
            </div>
        </div>

        <!-- Product List Section -->
        <div class="col-md-9">
            <div class="row" id="productList">
                <?php if (count($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 gap-3 product-card mb-4" 
                            data-price="<?= $product['price']; ?>" 
                            data-name="<?= strtolower($product['name']); ?>">
                            
                            <div class="card h-100 shadow border-0">
                                <!-- Product Image -->
                                <?php if ($product['image_url']): ?>
                                    <img src="../admin/<?= $product['image_url']; ?>" alt="<?= $product['name']; ?>" class="card-img-top">
                                <?php else: ?>
                                    <div class="card-img-top" style="height: 200px; background-color: #f0f0f0; text-align: center; line-height: 200px;">
                                        No image available
                                    </div>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product['name']; ?></h5>
                                    <p class="card-text"><?= $product['description']; ?></p>
                                    <p class="card-text">Price: ₹<?= $product['price']; ?></p>
                                    <p class="card-text">Rating: ★★★★☆ (4.0)</p> <!-- Static Rating -->
                                    <div class="d-flex justify-content-between">
                                        <a href="product_detail.php?id=<?= $product['product_id']; ?>" class="btn btn-primary">View</a>
                                        <a href="addToCart.php?id=<?= $product['product_id']; ?>" class="btn btn-success">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="no-products">No products found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // JavaScript for filter functionality
    document.getElementById('applyFilters').addEventListener('click', function() {
        const priceValue = parseInt(document.getElementById('priceRange').value);
        const nameValue = document.getElementById('nameFilter').value.toLowerCase();

        document.querySelectorAll('.product-card').forEach(function(card) {
            const productPrice = parseInt(card.getAttribute('data-price'));
            const productName = card.getAttribute('data-name');

            let isVisible = true;

            // Apply price filter
            if (productPrice > priceValue) {
                isVisible = false;
            }

            // Apply name filter
            if (nameValue && !productName.includes(nameValue)) {
                isVisible = false;
            }

            // Show or hide product card
            card.style.display = isVisible ? 'block' : 'none';
        });
    });

    // Update price range display
    document.getElementById('priceRange').addEventListener('input', function() {
        document.getElementById('priceValue').innerText = 'Up to ₹' + this.value;
    });
</script>

</body>
</html>
