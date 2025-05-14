<?php
session_start();
include 'includes\db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // Changed from 'name' to 'username'
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash password

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        $error = "Email already registered!";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            $_SESSION['login_success'] = "Registered successfully! Please login.";
            header("Location: login.php");
            exit();
        } else {
            $error = "Registration failed. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Pet Haven</title>
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

<!-- Register Form -->
<div class="container flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h3 class="text-center">🐾 Create Your Account</h3>
                <p class="text-center text-muted">Join Pet Haven today!</p>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-glow">Register</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p>Already have an account? <a href="login.php" class="text-danger">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
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
