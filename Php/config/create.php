<?php
include_once 'db.php';

// Create a Database object and create tables
$database = new Database();
$database->createDatabase();  // Create database if not exists
$database->createTables();    // Create the required tables
?>
