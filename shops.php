<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Hardcoded shop information
$shops = [
    [
        'name' => 'Food Plaza',
        'description' => 'A variety of food items and groceries available',
        'contact' => '+91 9876543210',
        'timings' => '8:00 AM - 10:00 PM',
        'status' => 'Open',
        'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
    ],
    [
        'name' => 'Medical Shop',
        'description' => 'All types of medicines and health products available',
        'contact' => '+91 9876543211',
        'timings' => '24 Hours',
        'status' => 'Open',
        'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Society Shops - Courtyard Our Homes Society</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .shop-card {
            transition: transform 0.2s;
        }
        .shop-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Society Shops</h2>
        <div class="row">
            <?php foreach ($shops as $shop): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shop-card h-100">
                        <img src="<?php echo htmlspecialchars($shop['image']); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($shop['name']); ?>"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($shop['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($shop['description']); ?></p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Contact:</strong> <?php echo htmlspecialchars($shop['contact']); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Timings:</strong> <?php echo htmlspecialchars($shop['timings']); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Status:</strong> 
                                    <span class="badge bg-<?php echo $shop['status'] == 'Open' ? 'success' : 'danger'; ?>">
                                        <?php echo htmlspecialchars($shop['status']); ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 