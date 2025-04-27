<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $image_url = $_POST['image_url'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO products (user_id, name, image_url, price) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issd", $user_id, $name, $image_url, $price);
    
    if (mysqli_stmt_execute($stmt)) {
        $success = "Product listed successfully!";
    } else {
        $error = "Failed to list product. Please try again.";
    }
}

// Get all available products
$products_sql = "SELECT p.*, u.name as seller_name, u.phone as seller_phone 
                 FROM products p 
                 JOIN users u ON p.user_id = u.id 
                 WHERE p.status = 'Available' 
                 ORDER BY p.created_at DESC";
$products_result = mysqli_query($conn, $products_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy/Sell - Courtyard Our Homes Society</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>List Your Product</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="image_url" class="form-label">Image URL</label>
                                <input type="url" class="form-control" id="image_url" name="image_url" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price (₹)</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-primary">List Product</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h3 class="mb-4">Available Products</h3>
                <div class="row">
                    <?php if (mysqli_num_rows($products_result) > 0): ?>
                        <?php while ($product = mysqli_fetch_assoc($products_result)): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card product-card h-100">
                                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" 
                                         class="card-img-top" 
                                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                        <p class="card-text">
                                            <strong>Price:</strong> ₹<?php echo number_format($product['price'], 2); ?><br>
                                            <strong>Seller:</strong> <?php echo htmlspecialchars($product['seller_name']); ?><br>
                                            <strong>Contact:</strong> <?php echo htmlspecialchars($product['seller_phone']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info">No products available at the moment.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 