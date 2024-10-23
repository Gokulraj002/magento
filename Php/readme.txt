# E-commerce Project Setup

This project is an e-commerce website where both admins and users can log in. Below are the simple steps to set it up and start using it.

## 1. Setting Up the Database

To set up the database and create the required tables, visit the following link in your browser:

http://localhost/php/config/create.php

This will create all the necessary database tables for the project.

## 2. Login Details

You can log in as both an admin or a user using the same login information.

- **Username:** `admin`
- **Password:** `admin@123`

## 3. Important Notes

### Admin Role

- After logging in as an admin, you need to **upload product details**.
- I give product image in the images folder upload that one.
- For each product, you must upload **4 images**. Only then will the product be visible on the user dashboard.

### User Role

- Once the admin has uploaded the products with 4 images each, users can see the products on the dashboard, add them to the cart, and make purchases.

### Access Control

- If anyone tries to directly access the dashboard without logging in, they will be redirected to the login page.
- You must log in first to access either the admin or user dashboard.

## 4. Workflow Steps

1. **Clone the Project**: First, clone this project to your local machine:

   ```bash
   git clone https://github.com/your-username/your-repository.git