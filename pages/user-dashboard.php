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
                <div class="pet-tutorial-video">
                    <h1>Video tutorial on how to take care a pet.</h1>
                    <video width="640" height="360" controls>
                    <source src="image/video.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                   <h3>Step</h3>
                   <h3>1.Choose the Right Pet for Your Lifestyle</h3>
                    <ul>
                        <li>Research the breed or species (dog or cat) to ensure it fits your lifestyle, space, and energy level.</li>
                        <li>Consider age, size, and temperament when adopting.</li>
                    </ul>
                    <h3>2. Prepare Your Home</h3>
                        <ul>
                            <li>For dogs: Provide a safe, enclosed yard or leash-walk areas. Have a comfortable bed or crate.</li>
                            <li>For cats: Set up a litter box in a quiet area, scratching posts, and cozy resting spots.</li>
                            <li>Remove hazards like toxic plants, wires, or small items they could swallow.</li>
                        </ul>

                        <h3>3. Provide Proper Nutrition</h3>
                        <ul>
                            <li>Feed them high-quality food formulated for their species, age, size, and health.</li>
                            <li>Ensure fresh, clean water is always available.</li>
                            <li>Avoid giving them human food like chocolate, onions, or grapes, as these can be toxic.</li>
                        </ul>

                        <h3>4. Establish a Routine</h3>
                        <ul>
                            <li>Dogs: Walk them at least twice a day and schedule regular playtime. Potty train them early.</li>
                            <li>Cats: Clean the litter box daily and provide toys for mental stimulation.</li>
                        </ul>

                        <h3>5. Visit the Vet Regularly</h3>
                        <ul>
                            <li>Vaccinate your pet against common diseases.</li>
                            <li>Spay or neuter them if necessary.</li>
                            <li>Schedule routine checkups and monitor for signs of illness (e.g., loss of appetite, lethargy).</li>
                        </ul>

                        <h3>6. Grooming and Hygiene</h3>
                        <ul>
                            <li>Dogs: Brush their coat weekly, bathe them as needed, and trim their nails.</li>
                            <li>Cats: Brush long-haired breeds regularly. Cats groom themselves, but occasional brushing helps.</li>
                            <li>Brush their teeth or provide dental treats to maintain oral health.</li>
                        </ul>

                        <h3>7. Provide Mental and Physical Stimulation</h3>
                        <ul>
                            <li>Dogs: Teach them commands and tricks. Take them to parks and provide chew toys.</li>
                            <li>Cats: Offer interactive toys like laser pointers or feather wands. Provide climbing spaces or perches.</li>
                        </ul>

                        <h3>8. Give Them Love and Attention</h3>
                        <ul>
                            <li>Spend quality time bonding with your pet daily.</li>
                            <li>Recognize their body language to understand their needs and emotions.</li>
                            <li>Avoid shouting or harsh punishment; instead, use positive reinforcement.</li>
                        </ul>

                        <h3>9. Socialize Them</h3>
                        <ul>
                            <li>Expose them to new people, pets, and environments to reduce anxiety and fear.</li>
                            <li>Dogs: Enroll in obedience classes or take them to dog-friendly areas.</li>
                            <li>Cats: Gradually introduce them to new pets or changes in the home.</li>
                        </ul>

                        <h3>10. Monitor Their Safety</h3>
                        <ul>
                            <li>Keep them indoors or supervise outdoor activities.</li>
                            <li>Microchip them and ensure they have proper ID tags.</li>
                            <li>Provide a secure leash and harness for dogs, and a carrier for cats during travel.</li>
                        </ul>
                </div>
                <div class="pet-waiting-list-wrapper">
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
    </div>
</body>
</html>
