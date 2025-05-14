<?php
include 'includes/db_connect.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must be logged in to adopt a pet.'); window.location.href='login.php';</script>";
    exit;
}

// Fetch pet details first (so we can reuse `$pet` in the form)
if (isset($_GET['pet_id'])) {
    $pet_id = intval($_GET['pet_id']);
    $pet_result = $conn->query("SELECT * FROM pets WHERE id = $pet_id AND status = 'available'");
    $pet = $pet_result->fetch_assoc();
    if (!$pet) {
        echo "<script>alert('Pet not available for adoption.'); window.location.href='pet_listings.php';</script>";
        exit;
    }
} else {
    header("Location: pet_listings.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $applicant_name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $reason = $conn->real_escape_string($_POST['reason']);
    $user_id = intval($_SESSION['user_id']);

    // Insert adoption request
    $sql = "INSERT INTO adoption_requests (user_id, pet_id, name, email, phone, reason)
    VALUES ('$user_id', '$pet_id', '$applicant_name', '$email', '$phone', '$reason')";


    if ($conn->query($sql) === TRUE) {
        // Update pet status to 'pending'
        $update_sql = "UPDATE pets SET status = 'pending' WHERE id = $pet_id";
        $conn->query($update_sql);

        echo "<script>alert('Adoption request submitted successfully!'); window.location.href='pet_listings.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt <?php echo $pet['name']; ?> | Pet Haven</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

<section class="container my-5">
    <h2 class="text-center">Adopt <?php echo $pet['name']; ?> ❤️</h2>
    <div class="card shadow-lg p-4">
        <div class="row">
            <div class="col-md-4">
                <img src="images/<?php echo $pet['image']; ?>" class="img-fluid" alt="<?php echo $pet['name']; ?>">
            </div>
            <div class="col-md-8">
                <h3><?php echo $pet['name']; ?></h3>
                <p><strong>Breed:</strong> <?php echo $pet['breed']; ?></p>
                <p><strong>Age:</strong> <?php echo $pet['age']; ?> years</p>
                <p><?php echo $pet['description']; ?></p>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Reason for Adoption</label>
                        <textarea name="reason" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include 'chat_support.php'; ?>
</body>
</html>
