<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption | Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
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
<section class="hero">
    <div class="hero-content">
        <h1>Find Your New Best Friend ❤️</h1>
        <p>Adopt, Don't Shop — Give a Loving Home to a Furry Friend.</p>
        <a href="pet_listings.php" class="btn btn-primary btn-glow">Explore Pets</a>
    </div>
</section>

<!-- Featured Pets Slider -->
<section class="featured-pets-slider">
    <div class="container">
        <h2>Featured Pets</h2>
        <div id="petCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000"> <!-- Adjust the interval to 2000ms (2 seconds) -->

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/cat1.jpg" alt="Cat" class="d-block w-100">
                    <h3>Whiskers</h3>
                    <p>Breed: Persian Cat | Age: 2 years</p>
                </div>

                <div class="carousel-item">
                    <img src="images/dog.jpeg" alt="Dog" class="d-block w-100">
                    <h3>Buddy</h3>
                    <p>Breed: Golden Retriever | Age: 3 years</p>
                </div>

                <div class="carousel-item">
                    <img src="images/parrot.jpg" alt="Parrot" class="d-block w-100">
                    <h3>Chirpy</h3>
                    <p>Breed: Macaw | Age: 1 year</p>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#petCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#petCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>

<!-- Video Showcase -->
<section class="video-section">
    <div class="container">
        <h2>Our Happy Adopters</h2>
        <div class="video-container">
            <iframe width="560" height="315" 
                src="https://www.youtube.com/embed/yvJRQCV7zJI" 
                title="YouTube video player" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

<section class="adoption-process">
    <div class="container">
        <h2>Our Easy 3-Step Adoption Process</h2>
        <div class="steps">
            <div class="step">
                <i class="fas fa-paw"></i>
                <span>1</span>
                <p>Browse Available Pets</p>
            </div>
            <div class="step">
                <i class="fas fa-file-alt"></i>
                <span>2</span>
                <p>Submit an Adoption Request</p>
            </div>
            <div class="step">
                <i class="fas fa-home"></i>
                <span>3</span>
                <p>Welcome Your New Friend Home!</p>
            </div>
        </div>
    </div> 
</section>
<!-- Footer -->
<footer>
    <div class="container">
        <p>&copy; 2024 Pet Haven. All Rights Reserved.</p>
    </div>
</footer>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'chat_support.php'; ?>
</body>
</html>
