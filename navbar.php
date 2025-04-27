<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="home.php">Courtyard Our Homes Society</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Buy/Sell</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shops.php">Society Shops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="complaints.php">Complaints</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="announcements.php">Announcements</a>
                </li>
            </ul>
            <div class="d-flex">
                <span class="navbar-text me-3">
                    Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>
                </span>
                <a href="logout.php" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
    </div>
</nav> 