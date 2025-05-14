<?php
// Database Connection
include 'includes/db_connect.php';

// Fetch Pets from Database
$sql = "SELECT * FROM pets";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Listings | Pet Haven</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom styling */
        .pet-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .pet-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .status-available {
            background-color: #28a745;
            color: white;
        }

        .status-adopted {
            background-color: #f39c12; /* Yellow for Adopted */
            color: white;
        }

        .status-not-available {
            background-color: #dc3545;
            color: white;
        }

        .rating {
            color: gold;
        }

        /* Highlight feedback for adopted pets */
        .feedback-highlight {
            background-color: #fff3cd;
            border: 2px solid #ffeeba;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
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

<!-- Hero Section -->
<section class="hero-section text-center text-white py-5" style="background-color: #ff9f43;">
    <div class="container">
        <h1 class="display-4 fw-bold">Find Your Furry Friend ❤️</h1>
        <p class="lead">Explore, Connect, and Give a Home to a Loving Pet!</p>
    </div>
</section>

<!-- Pet Listings Section -->
<section class="pet-listings">
    <div class="container">
        <h1 class="text-center my-4">🐾 Meet Our Adorable Pets 🐾</h1>

        <div class="row">
            <h3>Available Pets</h3>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($pet = $result->fetch_assoc()): ?>
                    <?php if(strtolower($pet['status']) == 'available'): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card pet-card shadow-lg">
                                <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($pet['name']); ?></h5>
                                    <p class="card-text"><strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?> | <strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($pet['description'])); ?></p>

                                    <p class="p-2 rounded status-available">
                                        Status: Available for Adoption 🐾
                                    </p>

                                    <a href="adoption_requests.php?pet_id=<?php echo $pet['id']; ?>" class="btn btn-primary">Adopt Me ❤️</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>

                <h3 class="mt-5">Adopted Pets</h3>
                <?php $result->data_seek(0); // Reset result pointer ?>
                <?php while ($pet = $result->fetch_assoc()): ?>
                    <?php if(in_array(strtolower($pet['status']), ['adopted', 'not available', 'got an owner', 'sold'])): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card pet-card shadow-lg">
                                <img src="images/<?php echo htmlspecialchars($pet['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($pet['name']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($pet['name']); ?></h5>
                                    <p class="card-text"><strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?> | <strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($pet['description'])); ?></p>

                                    <p class="p-2 rounded status-adopted">
                                        Status: Adopted 🏡
                                    </p>

                                    <?php if (!empty($pet['adopted_by'])): ?>
                                        <p class="text-primary fw-bold">Adopted by: <?php echo htmlspecialchars($pet['adopted_by']); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($pet['contact_email'])): ?>
                                        <p>Contact: <a href="mailto:<?php echo htmlspecialchars($pet['contact_email']); ?>" class="text-primary"><?php echo htmlspecialchars($pet['contact_email']); ?></a></p>
                                    <?php else: ?>
                                        <p class="text-muted">Contact: N/A</p>
                                    <?php endif; ?>

                                    <!-- Highlighted Feedback for Adopted Pets -->
                                    <?php if (!empty($pet['feedback'])): ?>
                                        <div class="feedback-highlight">
                                            <strong>Feedback:</strong> <?php echo nl2br(htmlspecialchars($pet['feedback'])); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No pets available at the moment. Check back soon! 🐾</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer bg-dark text-white">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'chat_support.php'; ?>
</body>
</html>
