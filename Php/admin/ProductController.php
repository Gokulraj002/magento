<?php
include_once 'Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle file uploads
    $imageUrls = [];
    $targetDir = "uploads/";

    // Create the uploads directory if it doesn't exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Loop through all uploaded files
    for ($i = 1; $i <= 4; $i++) {
        $imageField = "image$i";
        if (isset($_FILES[$imageField]) && $_FILES[$imageField]['error'] == 0) {
            $targetFile = $targetDir . basename($_FILES[$imageField]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if the file is an actual image
            $check = getimagesize($_FILES[$imageField]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES[$imageField]["tmp_name"], $targetFile)) {
                    $imageUrls[] = $targetFile;
                } else {
                    echo "Sorry, there was an error uploading " . $_FILES[$imageField]["name"];
                }
            } else {
                echo "File is not an image.";
            }
        }
    }


$product = new Product();
 $product->addProduct($name, $description, $price, $imageUrls);

header("Refresh: 1; url=index.php");



}
?>