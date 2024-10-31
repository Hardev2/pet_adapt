<?php
$conn = mysqli_connect('localhost', 'root', '', 'pet_adoption_db') or die('connection failed');

if (isset($_POST['approve']) || isset($_POST['reject']) || isset($_POST['claimed'])) {
    $request_id = $_POST['request_id'];
    $current_datetime = date('Y-m-d H:i:s'); // Get current date and time
    
    // Check which button was clicked
    if (isset($_POST['approve'])) {
        $status = 'approved';
        // Update adoption request status and set approved_at to the current time
        $query = "UPDATE adoption_requests SET status = '$status', approved_at = '$current_datetime' WHERE id = '$request_id'";
    } elseif (isset($_POST['reject'])) {
        $status = 'rejected';
        $query = "UPDATE adoption_requests SET status = '$status' WHERE id = '$request_id'";
    } elseif (isset($_POST['claimed'])) {
        $status = 'claimed';
        // Update adoption request status and set claimed_at to the current time
        $query = "UPDATE adoption_requests SET status = '$status', claimed_at = '$current_datetime' WHERE id = '$request_id'";
    }
    
    // Execute the query to update the adoption request
    mysqli_query($conn, $query);

    // Update the pet status based on the request status
    if ($status == 'approved') {
        $pet_query = "
            UPDATE pets 
            SET pet_status = 'approved' 
            WHERE id = (SELECT pet_id FROM adoption_requests WHERE id = '$request_id')
        ";
        mysqli_query($conn, $pet_query);
        header('Location: ../admin/approve-page.php');
    } elseif ($status == 'rejected') {
        $pet_query = "
            UPDATE pets 
            SET pet_status = 'available' 
            WHERE id = (SELECT pet_id FROM adoption_requests WHERE id = '$request_id')
        ";
        mysqli_query($conn, $pet_query);
        header('Location: ../admin/approve-page.php');
    } elseif ($status == 'claimed') {
        $pet_query = "
            UPDATE pets 
            SET pet_status = 'claimed' 
            WHERE id = (SELECT pet_id FROM adoption_requests WHERE id = '$request_id')
        ";
        mysqli_query($conn, $pet_query);
        header('Location: ../admin/claimed-page.php');
    }

}
