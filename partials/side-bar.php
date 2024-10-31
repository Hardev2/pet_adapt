<div class="side-bar">
    <div class="side-bar-header">
        <div class="image">
            <img src="../image/admin.png" alt="">
        </div>
        <span><?= htmlspecialchars($_SESSION['admin_email']); ?></span>
    </div>
    <div class="navbar">
        <nav>
            <ul class="nav-links">
                <li class="nav-links">
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-links">
                    <a href="#" id="approval-toggle">Approval</a>
                    <ul class="dropdown">
                        <li>
                             <i class="fa-solid fa-thumbs-up"></i>
                            <a href="approve-page.php">Approve</a>
                        </li>
                        <li>
                        <i class="fa-solid fa-star"></i>
                            <a href="claim-page.php">Claim</a>
                        </li>
                        <li>
                        <i class="fa-solid fa-heart"></i>
                            <a href="claimed-page.php">Claimed</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-links">
                    <a href="#" id="pets-toggle">Pets</a>
                    <ul class="dropdown">
                        <li>
                            <i class="fa-solid fa-plus"></i>
                            <a href="admin-pet.php">Add pet</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-list"></i>
                            <a href="pet-list.php">Pet list</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>

        <script src="../js/dropdown.js"></script>
       