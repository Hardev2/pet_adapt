<?php
session_start();  
include '../database/database.php';

// Fetch all waiting requests


if (!isset($_SESSION['admin_email']) || $_SESSION['admin_role'] !== 'admin') {
    header('Location: admin-log.php');
    exit();
}
$user = 
$sql = "SELECT * FROM users ORDER BY id DESC LIMIT 6";
$result_user = mysqli_query($conn, $sql);


$pet_sql = "SELECT * FROM pets ORDER BY id DESC LIMIT 6 ";
$pet_result = mysqli_query($conn, $pet_sql);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Approve Adoption Requests</title>
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
                            <a href="admin-logout.php"><i class="fa-solid fa-power-off"></i></a>
                        </div>
                    </div>
                </div>
                <div class="dashboard-body">
                    <div class="dashboard-card">
                    <div class="card-col">
                    <i class="fa-solid fa-paw"></i>
                      </div>
                        <div class="card-col">
                                <?php 
                                $sql ="SELECT * FROM pets"; 
                                    $result = mysqli_query($conn, $sql);

                                    if($id = mysqli_num_rows($result)){
                                        echo '<h1>'.$id.'</h1>';
                                    }
                                    else{
                                        echo 'No Data found';
                                    };
                                ?>
                                   <p>Total Pet</p>
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-col">
                        <i class="fa-solid fa-user"></i>
                        </div>
                       <div class="card-col">
                        <h1>
                        <?php 
                                $sql ="SELECT * FROM users"; 
                                    $result = mysqli_query($conn, $sql);

                                    if($id = mysqli_num_rows($result)){
                                        echo '<h1>'.$id.'</h1>';
                                    }
                                    else{
                                        echo 'No Data found';
                                    };
                                ?>
                                   <p>Total User</p>
                        </h1>
                       </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-col">
                            <i class="fa-solid fa-thumbs-up"></i>
                        </div>
                        <div class="card-col">
                            <h1>
                            <?php 
                                $sql ="SELECT * FROM adoption_requests WHERE status = 'approved'"; 
                                    $result = mysqli_query($conn, $sql);

                                    if($id = mysqli_num_rows($result)){
                                        echo '<h1>'.$id.'</h1>';
                                    }
                                    else{
                                        echo 'No Data found';
                                    };
                                ?>
                                   <p>Totol Pet Approved</p>
                            </h1>
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="card-col">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <div class="card-col">
                            <h1>
                            <?php 
                                $sql ="SELECT * FROM adoption_requests WHERE status = 'claimed'"; 
                                    $result = mysqli_query($conn, $sql);

                                    if($id = mysqli_num_rows($result)){
                                        echo '<h1>'.$id.'</h1>';
                                    }
                                    else{
                                        echo 'No Data found';
                                    };
                                ?>
                                   <p>Totol Claimed Pet</p>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="dashboard-list">
                    <div class="list-col">
                        <div class="list-head">
                            <h1>Recent User</h1>
                        </div>
                        <div class="list-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                    </tr>
                                <?php   if(mysqli_num_rows($result_user) > 0 ) :?>
                                    <?php while($row = mysqli_fetch_assoc($result_user)) :?>
                                    
                                    <tr>
                                    <td>
                                        <?= $row['id']; ?>
                                    </td>
                                    <td><?= isset($row['username']) ? $row['username'] : 'No username found'; ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>                
                    </div>
                    <div class="list-col">
                    <div class="list-head">
                            <h1>Recent Pets</h1>
                        </div>
                        <div class="list-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Breed</th>
                                        <th>Type</th>
                                    </tr>
                                <?php   if(mysqli_num_rows($pet_result) > 0 ) :?>
                                    <?php while($row = mysqli_fetch_assoc($pet_result)) :?>
                                    
                                    <tr>
                                    <td>
                                        <?= $row['id']; ?>
                                    </td>
                                    <td><?= $row['pet_name']; ?></td>
                                    <td><?= $row['pet_breed']; ?></td>
                                    <td><?= $row['pet_type']; ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>               
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</body>
</html>
