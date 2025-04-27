<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Courtyard Our Homes Society</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-link {
            color: #333;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #0d6efd;
        }
        .hero-section {
            position: relative;
            height: 400px;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: white;
            text-align: center;
            padding: 2rem;
        }
        .hero-overlay h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .hero-overlay p {
            font-size: 1.25rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        .feature-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="hero-section">
        <img 
            src="/COURTYARD OUR HOMES SOCIETY/images/society-building.jpg" 
            alt="Courtyard Our Homes Society" 
            class="hero-image" 
            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60';">
        <div class="hero-overlay">
            <h1>Welcome to Courtyard Our Homes Society</h1>
            <p>Your one-stop solution for all society management needs</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card feature-card">
                    <div class="card-body text-center">
                        <h3>Services</h3>
                        <p>Book maintenance services like plumber, electrician, or maid with ease.</p>
                        <a href="services.php" class="btn btn-primary">Book Services</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card feature-card">
                    <div class="card-body text-center">
                        <h3>Buy & Sell</h3>
                        <p>List your items for sale or find great deals within the society.</p>
                        <a href="products.php" class="btn btn-primary">Explore Market</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card feature-card">
                    <div class="card-body text-center">
                        <h3>Complaints</h3>
                        <p>Submit and track your complaints for quick resolution.</p>
                        <a href="complaints.php" class="btn btn-primary">Submit Complaint</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 