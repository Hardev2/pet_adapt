<?php
session_start();  
include '../database/database.php';

if (!isset($_SESSION['admin_email']) || $_SESSION['admin_role'] !== 'admin') {
    header('Location: admin-log.php');
    exit();
}

$query_claimed = "
    SELECT adoption_requests.id as request_id, users.username, pets.pet_name, adoption_requests.claimed_at, adoption_requests.contact, adoption_requests.address, adoption_requests.status
    FROM adoption_requests
    JOIN users ON adoption_requests.user_id = users.id
    JOIN pets ON adoption_requests.pet_id = pets.id
    WHERE adoption_requests.status = 'claimed' ORDER BY adoption_requests.id DESC
";



$result_claimed = mysqli_query($conn, $query_claimed);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin-css/admin-css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container">
        <?php include '../partials/side-bar.php'?>
        <div class="hero">
            <div class="hero-container">
                <div class="hero-header">
                    <h1>Dashboard</h1>
                    <div class="header-right-side">
                        <div class="logout-btn">
                            <a href=""><i class="fa-solid fa-power-off"></i></a>
                        </div>
                    </div>
                </div>
                <div class="container-body">
              
                <h1>Claimed Pet</h1>
                    <div class="container-approved-list">
                      
                        <table>
                            <tr>
                                <th>User</th>
                                <th>Pet</th>
                                <th>Claimed At</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th colspan="2">Status</th>
                                
                               
                                
                            </tr>
                            <?php while($row = mysqli_fetch_assoc($result_claimed)): ?>
                            <tr>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['pet_name']; ?></td>
                                <td>
                                    <?php 
                                    if (!empty($row['claimed_at'])) {
                                        $date = new DateTime($row['claimed_at']);
                                        echo $date->format('F j, Y');  // Example: August 14, 2024, 2:30 pm
                                    }
                                    ?>
                                </td>
                                <td><?= $row['contact']; ?></td>
                                <td><?= $row['address']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                              
                            </tr>
                            <?php endwhile; ?>
                        </table>    
                    </div> 
                  
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>