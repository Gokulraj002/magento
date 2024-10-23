<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'magento';
    private $conn;

    // Method to connect to the database
    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    // Method to create the database (if not exists)
    public function createDatabase() {
        $this->conn = new mysqli($this->host, $this->username, $this->password);

        $sql = "CREATE DATABASE IF NOT EXISTS $this->db_name";
        if ($this->conn->query($sql) === TRUE) {
            echo "Database created successfully.<br>";
        } else {
            die("Error creating database: " . $this->conn->error);
        }
    }

    // Method to create tables for products and images
    public function createTables() {
        // Use the database
        $this->conn->select_db($this->db_name);

        // Create 'products' table
        $sql = "CREATE TABLE IF NOT EXISTS products (
            product_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            description TEXT,
            price DECIMAL(10, 2) NOT NULL
        )";

        if ($this->conn->query($sql) === TRUE) {
            echo "Table 'products' created successfully.<br>";
        } else {
            die("Error creating table 'products': " . $this->conn->error);
        }

        // Create 'product_images' table
        $sql = "CREATE TABLE IF NOT EXISTS product_images (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT NOT NULL,
            image_url VARCHAR(255) NOT NULL,
            FOREIGN KEY (product_id) REFERENCES products(product_id)
        )";

        if ($this->conn->query($sql) === TRUE) {
            echo "Table 'product_images' created successfully.<br>";
        } else {
            die("Error creating table 'product_images': " . $this->conn->error);
        }
    }
}
?>
