<?php
session_start();
include 'includes/db_connect.php'; // Ensure this file connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // Fixed: Removed the extra space
    $password = $_POST['password'];

    // Check if username exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['login_success'] = "Logged in successfully!";
            header("Location: login.php"); // Reload to display success message
            exit();
        } else {
            $error = "Incorrect password. Please try again!";
        }
    } else {
        $error = "User not found. Please register!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Pet Haven</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #ff6f61, #ff9478);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 80px;
        }
        .btn-glow {
            background-color: #ff6f61;
            color: white;
            transition: 0.3s;
        }
        .btn-glow:hover {
            background-color: #ff5245;
        }
        .footer {
            margin-top: auto;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color: #ff6f61;">
    <div class="container">
        <a class="navbar-brand text-white" href="#">🐾 Pet Haven</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="pet_listings.php">Pets</a></li>
                <li class="nav-item"><a class="nav-link btn btn-primary text-white" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link btn btn-primary text-white" href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Login Form -->
<div class="container flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h3 class="text-center">🐾 Welcome Back!</h3>
                <p class="text-center text-muted">Login to continue</p>

                <!-- Success Message -->
                <?php if (isset($_SESSION['login_success'])): ?>
                    <div class="alert alert-success text-center">
                        <?php 
                        echo $_SESSION['login_success']; 
                        unset($_SESSION['login_success']); // Remove after displaying
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Error Message -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i>Username</label> <!-- Fixed: Removed space after username -->
                        <input type="text" name="username" class="form-control" required> <!-- Fixed: Removed space after username -->
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-glow">Login</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="register.php" class="text-danger">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer at Bottom -->
<footer class="footer bg-dark text-white mt-auto">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; 2024 Pet Haven. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="#" class="text-white mx-2"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>
<?php include 'chat_support.php'; ?>
</body>
</html>
