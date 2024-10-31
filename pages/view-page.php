<?php

session_start();  
include 'database/database.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
     // Ensure $id is numeric to prevent SQL injection
    
    $sql = "SELECT * FROM pets WHERE id = $id";
    $result = mysqli_query($conn, $sql);


    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }else{
        echo "No pet in this ID!";
        exit();
    };
}else{
    echo "NO ID provided!";
    exit();
};

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
       <?php include 'partials/header.php'; ?>
        <div class="hero">
            <div class="hero-container">
                <div class="pet-view-details">
                    <div class="view-details-row">
                        <h4>PET DETAIL</h4>
                        <div class="pet-view-description">
                            <p>Name: <span><?= $row['pet_name']; ?></span></p>
                            <p>Breed: <strong><?= $row['pet_breed']; ?></strong></p>
                            <p>Sex: <strong><?= $row['pet_sex']; ?></strong></p>
                            <p>Age: <strong><?= $row['pet_age']; ?></strong></p>
                            <p>Condition: <strong><?= $row['pet_condition']; ?></strong></p>
                            <p>Description: <strong><?= $row['pet_description']; ?></strong>
                            </p>
                            <p>Status: <strong><?= $row['pet_status']; ?></strong></p>
                            <div class="adapt-button">
                            <form method="POST" action="index.php?page=adopt">
                                        <input type="hidden" name="pet_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <button type="submit" name="adopt">Adopt</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="view-details-row">
                        <img src="image/pets/<?= $row['image']; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>