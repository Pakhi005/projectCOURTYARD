<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_type = $_POST['service_type'];
    $request_date = $_POST['request_date'];
    $request_time = $_POST['request_time'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO service_requests (user_id, service_type, request_date, request_time) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isss", $user_id, $service_type, $request_date, $request_time);
    
    if (mysqli_stmt_execute($stmt)) {
        $success = "Service request submitted successfully!";
    } else {
        $error = "Failed to submit service request. Please try again.";
    }
}

// Get user's service requests
$user_id = $_SESSION['user_id'];
$requests_sql = "SELECT * FROM service_requests WHERE user_id = ? ORDER BY created_at DESC";
$requests_stmt = mysqli_prepare($conn, $requests_sql);
mysqli_stmt_bind_param($requests_stmt, "i", $user_id);
mysqli_stmt_execute($requests_stmt);
$requests_result = mysqli_stmt_get_result($requests_stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Courtyard Our Homes Society</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Book a Service</h3>
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
                                <label for="service_type" class="form-label">Service Type</label>
                                <select class="form-select" id="service_type" name="service_type" required>
                                    <option value="">Select a service</option>
                                    <option value="Maid">Maid</option>
                                    <option value="Plumber">Plumber</option>
                                    <option value="Electrician">Electrician</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="request_date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="request_date" name="request_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="request_time" class="form-label">Time</label>
                                <input type="time" class="form-control" id="request_time" name="request_time" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Book Service</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Your Service Requests</h3>
                    </div>
                    <div class="card-body">
                        <?php if (mysqli_num_rows($requests_result) > 0): ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($request = mysqli_fetch_assoc($requests_result)): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($request['service_type']); ?></td>
                                                <td><?php echo htmlspecialchars($request['request_date']); ?></td>
                                                <td><?php echo htmlspecialchars($request['request_time']); ?></td>
                                                <td>
                                                    <span class="badge bg-<?php echo $request['status'] == 'Pending' ? 'warning' : 'success'; ?>">
                                                        <?php echo htmlspecialchars($request['status']); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p>No service requests found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 