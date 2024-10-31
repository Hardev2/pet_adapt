<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'pet_adoption_db') or die('connection failed');

if (!isset($_SESSION['user_username']) || $_SESSION['user_role'] !== 'user') {
    header('Location: index.php?page=login');
    exit();
}
// Query to get waiting adoption requests for the logged-in user
$user_id = $_SESSION['user_id'];
$query_waiting = "
    SELECT pets.pet_name, pets.pet_type, pets.pet_breed, pets.pet_age, pets.image, adoption_requests.status
    FROM adoption_requests
    JOIN pets ON adoption_requests.pet_id = pets.id
    WHERE adoption_requests.user_id = '$user_id' AND adoption_requests.status = 'waiting'
";

// Query to get approved adoption requests for the logged-in user
$query_approved = "
    SELECT pets.pet_name, pets.pet_type, pets.pet_breed, pets.pet_age, pets.image, adoption_requests.status
    FROM adoption_requests
    JOIN pets ON adoption_requests.pet_id = pets.id
    WHERE adoption_requests.user_id = '$user_id' AND adoption_requests.status = 'approved'
";

$query_claimed = "
    SELECT pets.pet_name, pets.pet_type, pets.pet_breed, pets.pet_age, pets.image, adoption_requests.status
    FROM adoption_requests
    JOIN pets ON adoption_requests.pet_id = pets.id
    WHERE adoption_requests.user_id = '$user_id' AND adoption_requests.status = 'claimed'
";

$result_waiting = mysqli_query($conn, $query_waiting);
$result_approved = mysqli_query($conn, $query_approved);
$result_claimed = mysqli_query($conn, $query_claimed);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Adopted Pets</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php include 'partials/header.php' ?>;
        <div class="hero">
            <!-- Waiting Requests Section -->
            <div class="popular user-home-dashboard">
                <h2>Waiting Requests</h2>
                <div class="popular-container">
                    <?php while ($row = mysqli_fetch_assoc($result_waiting)): ?>
                    <div class="popular-box">
                        <div class="popular-image">
                            <img src="image/pets/<?= htmlspecialchars($row['image']); ?>" alt="">
                        </div>
                        <div class="pet-details popular-description">
                            <p><?php echo htmlspecialchars($row['pet_name']); ?></p>
                            <p>Breed: <?php echo htmlspecialchars($row['pet_breed']); ?></p>
                            <p>Age: <?php echo htmlspecialchars($row['pet_age']); ?></p>
                            <p>Status: <?php echo htmlspecialchars($row['status']); ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <h2>Approved Requests</h2>
                <div class="popular-container">
                    <?php while ($row = mysqli_fetch_assoc($result_approved)): ?>
                    <div class="popular-box">
                        <div class="popular-image">
                            <img src="image/pets/<?= htmlspecialchars($row['image']); ?>" alt="">
                        </div>
                        <div class="popular-description pet-details">
                            <p><?php echo htmlspecialchars($row['pet_name']); ?></p>
                            <p><?php echo htmlspecialchars($row['pet_breed']); ?></p>
                            <p>Age: <?php echo htmlspecialchars($row['pet_age']); ?></p>
                            <p>Status:<?php echo htmlspecialchars($row['status']); ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <h2>Claimed Requests</h2>
                <div class="popular-container">
                    <?php while ($row = mysqli_fetch_assoc($result_claimed)): ?>
                    <div class="popular-box">
                        <div class="popular-image">
                            <img src="image/pets/<?= htmlspecialchars($row['image']); ?>" alt="">
                        </div>
                        <div class="popular-description pet-details">
                            <p><?php echo htmlspecialchars($row['pet_name']); ?></p>
                            <p><?php echo htmlspecialchars($row['pet_breed']); ?></p>
                            <p>Age: <?php echo htmlspecialchars($row['pet_age']); ?></p>
                            <p>Status:<?php echo htmlspecialchars($row['status']); ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

          
        </div>
    </div>
</body>
</html>
