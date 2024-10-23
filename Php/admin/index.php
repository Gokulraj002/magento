<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // If not logged in or not a user, redirect to the main index page
    header("Location: ../index.php");
    exit();
}
include_once 'Product.php';

// Include the admin header
include_once 'admin_header.php';

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
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Add New Product</h2>
            <form method="POST" action="ProductController.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="image1" class="form-label">Image 1</label>
                    <input type="file" class="form-control" id="image1" name="image1" required>
                </div>
                <div class="mb-3">
                    <label for="image2" class="form-label">Image 2</label>
                    <input type="file" class="form-control" id="image2" name="image2" required>
                </div>
                <div class="mb-3">
                    <label for="image3" class="form-label">Image 3</label>
                    <input type="file" class="form-control" id="image3" name="image3" required>
                </div>
                <div class="mb-3">
                    <label for="image4" class="form-label">Image 4</label>
                    <input type="file" class="form-control" id="image4" name="image4" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>


    <!-- data display -->

    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Products List</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($products) > 0): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['product_id']; ?></td>
                                <td><?= $product['name']; ?></td>
                                <td><?= $product['description']; ?></td>
                                <td>$<?= $product['price']; ?></td>
                                <td>
                                    <?php if ($product['image_url']): ?>
                                        <img src="<?= $product['image_url']; ?>" alt="<?= $product['name']; ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                    <?php else: ?>
                                        No image available
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No products found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
