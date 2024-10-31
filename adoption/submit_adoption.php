<?php
session_start();

include 'database/database.php';
if (!isset($_SESSION['user_username']) || $_SESSION['user_role'] !== 'user') {
    header('Location: index.php?page=login');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pet_id = mysqli_real_escape_string($conn, $_POST['pet_id']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    
    // Insert adoption request into the database
    $query = "
        INSERT INTO adoption_requests (user_id, pet_id, reason, contact, address, status)
        VALUES ('$user_id', '$pet_id', '$reason', '$contact','$address', 'waiting')
    ";

    if (mysqli_query($conn, $query)) {
        // Send email to admin (optional)
        $to = 'admin@example.com';
        $subject = 'New Adoption Request';
        $message = "A new adoption request has been submitted.\n\nPet ID: $pet_id\nUser ID: $user_id\nReason: $reason\nContact: $contact";
        mail($to, $subject, $message);
        
        echo "Adoption request submitted successfully!";
        header('Location:index.php?page=user-dashboard'); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect back if not POST request
    header('Location: index.php?page=user-dashboard');
    exit();
}

