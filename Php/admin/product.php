<?php
include_once '../config/db.php';

class Product {
    private $conn;

    public function __construct() {
        // Initialize the Database class
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Method to add a product and its images
    public function addProduct($name, $description, $price, $imageUrls) {
        // Insert product details into the products table
        $insertProductSql = "INSERT INTO products (name, description, price) 
                             VALUES ('$name', '$description', $price)";

        if ($this->conn->query($insertProductSql) === TRUE) {
            $productId = $this->conn->insert_id; // Get the ID of the inserted product
            echo "Product added successfully.<br>";

            // Insert images for the product
            foreach ($imageUrls as $url) {
                $insertImageSql = "INSERT INTO product_images (product_id, image_url) 
                                   VALUES ($productId, '$url')";
                if ($this->conn->query($insertImageSql) === TRUE) {
                    echo "Image added successfully.<br>";
                } else {
                    echo "Error adding image: " . $this->conn->error;
                }
            }
        } else {
            echo "Error adding product: " . $this->conn->error;
        }
    }

    public function getProducts() {
        // Query to fetch products and one image per product
        $sql = "SELECT p.product_id, p.name, p.description, p.price, 
                       (SELECT pi.image_url 
                        FROM product_images pi 
                        WHERE pi.product_id = p.product_id 
                        LIMIT 1) AS image_url
                FROM products p";
    
        $result = $this->conn->query($sql);
    
        $products = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }
    

    public function getProductById($productId) {
    // Query to fetch a single product by ID
    $sql = "SELECT * FROM products WHERE product_id = $productId";
    $result = $this->conn->query($sql);

    return $result->fetch_assoc();
}

public function getProductImages($productId) {
    // Query to fetch all images for a product
    $sql = "SELECT * FROM product_images WHERE product_id = $productId";
    $result = $this->conn->query($sql);

    $images = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
    }
    return $images;
}

    
}
?>
