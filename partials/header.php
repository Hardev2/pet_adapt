
<header>
        <div class="header-logo">
            <h1>TailWag & Purrs</h1>
        </div>
        <ul class="nav-link">
            <li class="nav-links">
                <a href="index.php?page=home">Home</a>
            </li>
           
            <li class="nav-links">
                <a href="#why">Why</a>
            </li>
            <li class="nav-links">
                <a href="#how">How</a>
            </li>
            <li class="nav-links">
            <a href="index.php?page=pet-page">Pet Page</a>
            </li>
            <?php if (isset($_SESSION['user_username'])): ?>
            <li class="nav-links logout-btn">
            <span>Welcome, <?= htmlspecialchars($_SESSION['user_username']); ?></span>
            </li>
            <li class="nav-links ">
                <a href="index.php?page=logout">Logout</a>
            </li>
        <?php else: ?>
            <li class="nav-links">
                <a href="index.php?page=login">Login</a>
            </li>
            
        <?php endif; ?>

        </ul>
    </header>