<?php

session_start();  

include 'database/database.php';

// Rest of the code...
if (!isset($_SESSION['user_username']) || $_SESSION['user_role'] !== 'user') {
    header('Location: index.php?page=login');
    exit();
}

$category = isset($_GET['category']) ? $_GET['category'] : 'all';



if($category == 'dog'){
    $sql = "SELECT * FROM pets WHERE pet_type = 'Dog' AND pet_status = 'available'";
} else if($category == 'cat'){
    // Fix the missing closing quote
    $sql = "SELECT * FROM pets WHERE pet_type = 'Cat' AND pet_status = 'available'";
} else {
    // Ensure the 'all' category shows only available pets as well
    $sql = "SELECT * FROM pets WHERE pet_status = 'available' ORDER BY id DESC";
}

$result = mysqli_query($conn,$sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
       <?php include 'partials/header.php'; ?>
        <div class="hero">
            <div class="pet-section">
                <h1>Choose your partner <i class="fa-solid fa-heart"></i> in crime</h1>
                <div class="pet-container">
                    <div class="pet-row category">
                        <h4><i class="fa-solid fa-filter"></i>Filter</h4>
                        <ul class="category-choices">
                            <li>
                                <a href="index.php?page=pet-page&category=all"><i class="fa-solid fa-paw"></i>All</a>
                            </li>
                            <li>
                                <a href="index.php?page=pet-page&category=cat"><i class="fa-solid fa-cat"></i>Cat</a>
                            </li>
                            <li>
                                <a href="index.php?page=pet-page&category=dog"><i class="fa-solid fa-dog"></i>Dog</a>
                            </li>
                        </ul>
                        <div class="user-dashboard">
                        <a href="index.php?page=user-dashboard"><i class="fa-solid fa-house"></i>My Dashboard</a>
                        </div>
                    </div>
                    <div class="pet-row pet-list">
                        <?php if(mysqli_num_rows($result) > 0 ):?>
                        <div class="pet-list-container">
                         <?php while($row = mysqli_fetch_assoc($result)) :?>
                            <div class="pet-card-list">
                                <div class="view-link">
                                    <a href="index.php?page=view&id=<?= $row['id']; ?>"><i class="fa-solid fa-eye"></i></a>
                                </div>
                                <div class="pet-image">
                                    <img src="image/pets/<?= $row['image']; ?>" alt="">
                                </div>
                                <div class="pet-details">
                                    <p><?= $row['pet_name']; ?></p>
                                    <p><?= $row['pet_breed']; ?></p>
                                    <p><?= $row['pet_sex']; ?></p>
                                    <div class="adapt-button">
                                    <form method="POST" action="index.php?page=adopt">
                                        <input type="hidden" name="pet_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <div class="adapt-btn">
                                        <button type="submit" name="adopt"><i class="fa-solid fa-hand-holding-heart"></i>Adopt</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                          <?php endwhile; ?>
                            </div>
                            <?php else :?>
                                <p>No data found!</p>
                                <?php endif; ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>