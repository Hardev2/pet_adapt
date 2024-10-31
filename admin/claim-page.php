<?php
session_start();  
include '../database/database.php';

if (!isset($_SESSION['admin_email']) || $_SESSION['admin_role'] !== 'admin') {
    header('Location: admin-log.php');
    exit();
}


$query_approved = "
    SELECT adoption_requests.id as request_id, users.username, pets.pet_name, adoption_requests.reason,adoption_requests.approved_at, adoption_requests.contact, adoption_requests.address, adoption_requests.status
    FROM adoption_requests
    JOIN users ON adoption_requests.user_id = users.id
    JOIN pets ON adoption_requests.pet_id = pets.id
    WHERE adoption_requests.status = 'approved' ORDER BY adoption_requests.id DESC
";



$result_approved = mysqli_query($conn, $query_approved);

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
              
                    <h1>Approved Pet</h1>
                    <div class="container-approved-list">
                      
                        <table>
                            <tr>
                                <th>User</th>
                                <th>Pet</th>
                                <th>Reason</th>
                                <th>Contact</th>
                                <th>Approved At</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                            <?php if(mysqli_num_rows($result_approved) > 0) :?>
                            <?php while($row = mysqli_fetch_assoc($result_approved)): ?>
                            <tr>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['pet_name']; ?></td>
                                <td><?= $row['reason']; ?></td>
                                <td><?= $row['contact']; ?></td>
                                <td>
                                    <?php 
                                    if (!empty($row['approved_at'])) {
                                        $date = new DateTime($row['approved_at']);
                                        echo $date->format('F j, Y');  // Example: August 14, 2024, 2:30 pm
                                    } 
                                    ?>
                                </td>
                                <td><?= $row['address']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                <form method="POST" action="../function/approve.php">
                                        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                                        <div class="approved-btn">
                                            <div class="claim-btn">
                                            <button type="submit" name="claimed">Claimed</button>
                                            </div>
                                            <div class="not-claim-btn">
                                            <button type="submit" name="reject">Not claim</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php else :?>
                                <p>No data found</p>
                                <?php endif;?>
                        </table>    
                    </div> 
                  
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>