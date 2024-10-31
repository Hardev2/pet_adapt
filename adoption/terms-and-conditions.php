<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'pet_adoption_db') or die('Connection failed');

if (!isset($_SESSION['user_username']) || $_SESSION['user_role'] !== 'user') {
    header('Location: index.php?page=login');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php include 'partials/header.php'; ?>
        
        <div class="hero">
            <div class="content-section">
            <div class="content">
            <h1>Terms and Conditions</h1>
            <p>Welcome to our Pet Adoption Platform. Before proceeding with the adoption request, please read and accept the following terms and conditions.</p>
            
            <h2>1. General Terms</h2>
            <p>
                By submitting an adoption request, you agree to be legally bound by the following terms and conditions. These terms apply to all users of the platform, including those who are merely browsing the site and those who are making adoption requests.
            </p>
            
            <h2>2. Adoption Eligibility</h2>
            <p>
                You confirm that the information you provide in the adoption request form is accurate and truthful. You also agree that the pet being adopted will be treated with the utmost care and responsibility.
            </p>

            <h2>3. Contact and Address Information</h2>
            <p>
                You agree to provide accurate contact and address information. This information will be used for communication regarding the adoption process and may be verified by our team.
            </p>
            
            <h2>4. Pet Care</h2>
            <p>
                By adopting a pet from our platform, you acknowledge that you will provide appropriate food, shelter, and medical care for the adopted pet. You agree to ensure the well-being of the pet at all times.
            </p>

            <h2>5. Fees and Costs</h2>
            <p>
                Any fees associated with the adoption, such as transportation or medical costs, must be clearly communicated before the adoption is finalized. The adopter agrees to pay any applicable fees before the pet is transferred.
            </p>
            
            <h2>6. Return Policy</h2>
            <p>
                In the event that you are unable to care for the pet, you agree to contact us and allow the pet to be returned or rehomed. Abandonment or mistreatment of the pet will not be tolerated.
            </p>

            <h2>7. Data Privacy</h2>
            <p>
                We are committed to protecting your personal information. Your details will only be used for the adoption process and will not be shared with any third parties without your consent.
            </p>

            <h2>8. Modifications</h2>
            <p>
                We reserve the right to modify these terms and conditions at any time. Any changes will be posted on this page, and your continued use of the site signifies your acceptance of those changes.
            </p>

            <h2>9. Acceptance</h2>
            <p>
                By clicking the "I Accept" checkbox in the adoption request form, you acknowledge that you have read, understood, and agree to these terms and conditions.
            </p>
            
            <p>Thank you for choosing to adopt a pet! If you have any questions regarding these terms, feel free to <a href="contact.php">contact us</a>.</p>
        </div>
            </div>
        </div>
    </div>
</body>
</html>
