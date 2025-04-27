<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO complaints (user_id, title, message) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $user_id, $title, $message);
    
    if (mysqli_stmt_execute($stmt)) {
        $success = "Complaint submitted successfully!";
    } else {
        $error = "Failed to submit complaint. Please try again.";
    }
}

// Get user's complaints
$user_id = $_SESSION['user_id'];
$complaints_sql = "SELECT * FROM complaints WHERE user_id = ? ORDER BY created_at DESC";
$complaints_stmt = mysqli_prepare($conn, $complaints_sql);
mysqli_stmt_bind_param($complaints_stmt, "i", $user_id);
mysqli_stmt_execute($complaints_stmt);
$complaints_result = mysqli_stmt_get_result($complaints_stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints - Courtyard Our Homes Society</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>Submit a Complaint</h3>
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
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Complaint</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Your Complaints</h3>
                    </div>
                    <div class="card-body">
                        <?php if (mysqli_num_rows($complaints_result) > 0): ?>
                            <div class="list-group">
                                <?php while ($complaint = mysqli_fetch_assoc($complaints_result)): ?>
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1"><?php echo htmlspecialchars($complaint['title']); ?></h5>
                                            <small class="text-muted">
                                                <?php echo date('M d, Y', strtotime($complaint['created_at'])); ?>
                                            </small>
                                        </div>
                                        <p class="mb-1"><?php echo htmlspecialchars($complaint['message']); ?></p>
                                        <small>
                                            Status: 
                                            <span class="badge bg-<?php echo $complaint['status'] == 'Open' ? 'warning' : 'success'; ?>">
                                                <?php echo htmlspecialchars($complaint['status']); ?>
                                            </span>
                                        </small>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php else: ?>
                            <p>No complaints found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 