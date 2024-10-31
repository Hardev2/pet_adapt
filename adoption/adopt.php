<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'pet_adoption_db') or die('Connection failed');

if (!isset($_SESSION['user_username']) || $_SESSION['user_role'] !== 'user') {
    header('Location: index.php?page=login');
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pet_id = mysqli_real_escape_string($conn, $_POST['pet_id']);
    $user_id = $_SESSION['user_id'];
    
    // Fetch pet details
    $query = "SELECT * FROM pets WHERE id = '$pet_id'";
    $result = mysqli_query($conn, $query);
    $pet = mysqli_fetch_assoc($result);
} else {
    // Redirect back if not POST request
    header('Location: index.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt Pet</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function validateForm() {
            const termsCheckbox = document.getElementById('terms');
            if (!termsCheckbox.checked) {
                alert("You must accept the Terms and Conditions before submitting.");
                return false;  // Prevent form submission
            }
            return true;  // Allow form submission
        }
    </script>
</head>
<body>
    <div class="container">
        <?php include 'partials/header.php'; ?>
        <div class="hero">
            <div class="hero-container">
                <div class="request-form-container">
                    <h2>Pet Name: <?= htmlspecialchars($pet['pet_name']); ?></h2>
                    <form method="POST" action="index.php?page=submit-adoption" onsubmit="return validateForm();">
                        <input type="hidden" name="pet_id" value="<?= htmlspecialchars($pet['id']); ?>">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id); ?>">
                        
                        <label for="reason">Reason for Adoption:</label><br>
                        <textarea id="reason" name="reason" rows="4" cols="50" placeholder="Enter reason" required></textarea><br><br>
                        
                        <label for="contact">Contact Information:</label><br>
                        <input type="text" id="contact" name="contact" placeholder="Enter contact" required><br><br>

                        <label for="address">Address Information:</label><br>
                        <input type="text" id="address" name="address" placeholder="Enter address..." required><br><br>
                        
                        <!-- Terms and Conditions Checkbox -->
                        <label for="">Terms and Conditions</label>
                        <input type="checkbox" id="terms" name="terms" required>
                        I accept the <a href="index.php?page=terms" target="_blank">Terms and Conditions</a>
                        
                        <button type="submit" name="submit_adoption">Submit Adoption Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
