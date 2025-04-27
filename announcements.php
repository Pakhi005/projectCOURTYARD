<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Hardcoded announcements
$announcements = [
    [
        'title' => 'Society Meeting',
        'message' => 'Monthly society meeting will be held on 15th of this month at 6:00 PM in the community hall.',
        'date' => '2024-03-10'
    ],
    [
        'title' => 'Maintenance Notice',
        'message' => 'Water supply will be temporarily shut down on 12th March from 10:00 AM to 4:00 PM for maintenance work.',
        'date' => '2024-03-08'
    ],
    [
        'title' => 'Festival Celebration',
        'message' => 'Join us for the Holi celebration in the society park on 25th March at 4:00 PM.',
        'date' => '2024-03-05'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements - Courtyard Our Homes Society</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Latest Announcements</h2>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <?php foreach ($announcements as $announcement): ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><?php echo htmlspecialchars($announcement['title']); ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo htmlspecialchars($announcement['message']); ?></p>
                            <small class="text-muted">
                                Posted on: <?php echo date('M d, Y', strtotime($announcement['date'])); ?>
                            </small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 