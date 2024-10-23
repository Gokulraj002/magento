<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hardcoded credentials for admin and user
    $admin_credentials = ['username' => 'admin', 'password' => 'admin@123'];
    $user_credentials = ['username' => 'user', 'password' => 'user@123'];

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if admin credentials are correct
    if ($username === $admin_credentials['username'] && $password === $admin_credentials['password']) {
        $_SESSION['role'] = 'admin';
        header("Location: admin/");
        exit();
    }

    // Check if user credentials are correct
    if ($username === $user_credentials['username'] && $password === $user_credentials['password']) {
        $_SESSION['role'] = 'user';
        header("Location: user/");
        exit();
    }

    $error = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto"> <!-- Centering the form with 50% width -->
            <h2 class="text-center">Login</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>

            <!-- Instructions below the form -->
            <div class="mt-3">
                <p><strong>Instructions:</strong></p>
                <ul>
                    <li><strong>User login:</strong> Username: <code>user</code> | Password: <code>user@123</code></li>
                    <li><strong>Admin login:</strong> Username: <code>admin</code> | Password: <code>admin@123</code></li>
                </ul>
            </div>

            <!-- Link to set up database tables -->
            <div class="mt-3">
                <p><strong>Database Setup:</strong></p>
                <p>To set up the database tables, please run the following URL:</p>
                <a href="http://localhost/php/config/create.php" target="_blank" class="text-primary">http://localhost/php/config/create.php</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
