<?php
session_start();  
include '../database/database.php';

// Fetch all waiting requests


if (!isset($_SESSION['admin_email']) || $_SESSION['admin_role'] !== 'admin') {
    header('Location: admin-log.php');
    exit();
}

$sql = "SELECT * FROM pets WHERE pet_status ='available' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);



if(isset($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];

    $delete_sql = "DELETE FROM pets WHERE id = $delete_id";
    if(mysqli_query($conn, $delete_sql)){
        echo "Pet Deleted Successfully!";
        header("Location:pet-list.php");
        exit();
    }else{
        echo "Can't Delete Pet" . mysqli_error($conn);
    }

}

mysqli_close($conn);

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
                    <h1>Pet List</h1>
                    <div class="pet-list">
                      
                        <table>
                        <tr>         <th>ID</th>
                                    <th>Image</th>
                                    <th>Pet Name</th>
                                    <th>Type</th>
                                    <th>Breed</th>
                                    <th>Sex</th>
                                    <th>Age</th>
                                    <th>Condition</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            <tbody>
                              <?php  if(mysqli_num_rows($result) > 0) :?>
                                <?php while($row = mysqli_fetch_assoc($result)) :?>
                                <tr>
                                     <td><?= $row['id']; ?></td>
                                    <td>
                                        
                                    <img src="../image/pets/<?=$row['image'] ?>" alt="" style="width: 100px">
                                    </td>
                                  
                                    <td><?= $row['pet_name']; ?></td>
                                    <td><?= $row['pet_type']; ?></td>
                                    <td><?= $row['pet_breed']; ?></td>
                                    <td><?= $row['pet_sex']; ?></td>
                                    <td><?= $row['pet_age']; ?></td>
                                    <td><?= $row['pet_condition']; ?></td>
                                    <td><?= $row['pet_description']; ?></td>
                                    <td><?= $row['pet_status']; ?></td>
                                    <td>
                                        <div class="action-btn">
                                            <div class="edit-btn">
                                                <a href="admin-pet.php?edit_id=<?= $row['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </div>
                                            <div class="delete-btn">
                                                <a href="pet-list.php?delete_id=<?= $row['id']; ?>" 
                                                onclick="return confirm('Are you sure you want to delete this pet?')"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                  

                                </tr>
                                <?php endwhile; ?>
                                <?php else:?>
                                    <p>No data found</p>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
</body>
</html>
