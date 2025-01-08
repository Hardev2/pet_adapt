<?php
session_start();  
include '../database/database.php';

// Fetch all waiting requests


if (!isset($_SESSION['admin_email']) || $_SESSION['admin_role'] !== 'admin') {
    header('Location: admin-log.php');
    exit();
}



$editPet = null;

if(isset($_GET['edit_id'])){
    $edit_id = $_GET['edit_id'];

    $edit_sql = "SELECT * FROM pets WHERE id = $edit_id";
    $edit_result = mysqli_query($conn, $edit_sql);

    if(mysqli_num_rows($edit_result)){
        $editPet = mysqli_fetch_assoc($edit_result);
    }
};

if(isset($_POST['update_pet'])){
    $edit_pet_id = $_POST['id'];
    $edit_pet_name = $_POST['pet_name'];
    $edit_pet_type = $_POST['pet_type'];
    $edit_pet_breed = $_POST['pet_breed'];
    $edit_pet_sex = $_POST['pet_sex'];
    $edit_pet_age = $_POST['pet_age'];
    $edit_pet_description = $_POST['pet_description'];
    $edit_pet_condition = $_POST['pet_condition'];
    $edit_pet_status = $_POST['pet_status'];
    $edit_pet_image = $_FILES['image']['name'];
    $edit_pet_image_tmp = $_FILES['image']['tmp_name'];
    $edit_image_folder = '../image/pets/' .$edit_pet_image;

    if($edit_pet_image){
        move_uploaded_file($edit_pet_image_tmp, $edit_image_folder);
    }
    else {
        // If no new image is uploaded, keep the existing one
        $edit_pet_image = $_POST['existing_image'];
    }

    $update_sql = "UPDATE pets SET pet_name='$edit_pet_name', pet_type='$edit_pet_type', pet_breed='$edit_pet_breed', pet_sex='$edit_pet_sex',
    pet_age='$edit_pet_age', pet_description='$edit_pet_description', pet_condition='$edit_pet_condition', pet_status='$edit_pet_status', image='$edit_pet_image' WHERE id = $edit_pet_id ";
    
    if(mysqli_query($conn, $update_sql)){
        echo "Pet Updated Successfully!";
        header("Location:pet-list.php");
        exit();
    }else{
        echo "Can't Update Pet" . mysqli_error($conn);
    }
};


$sql = "SELECT * FROM pets WHERE pet_status ='available' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

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
                    <div class="form-container">
                        <div class="pet-form">
                        <form action="<?= isset($editPet) ? 'admin-pet.php' : '../function/add-pet.php'; ?>" method="post" enctype="multipart/form-data">
                                <h1>Add Pet</h1>
                                <input type="hidden" name="id" value="<?= isset($editPet) ? $editPet['id']: ''; ?>">
                                <label for="name">Pet Name:</label>
                                <input type="text" name="pet_name" value="<?= isset($editPet) ? $editPet['pet_name']: '';?>" placeholder="Enter pet name" required><br>
                                <div class="form-row">
                                    <div class="form-col">
                                    <label for="pet_type">Type</label>
                                    <select name="pet_type" id="pet_type" required>
                                        <option value="Dog" <?= isset($editPet) && $editPet['pet_type'] == 'Dog' ? 'selected' : ''; ?>>Dog</option>
                                        <option value="Cat" <?= isset($editPet) && $editPet['pet_type'] == 'Cat' ? 'selected' : ''; ?>>Cat</option>
                                    </select><br>
                                    </div>
                                    <div class="form-col">
                                    <label for="pet_type">Sex</label>
                                    <select name="pet_sex" id="pet_sex" required>
                                        <option value="Male" <?= isset($editPet) && $editPet['pet_sex'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                        <option value="Female" <?= isset($editPet) && $editPet['pet_sex'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                    </select><br>
                                    </div>
                                </div>
                                <label for="pet_breed">Breed</label>
                                <input type="text" name="pet_breed" value="<?= isset($editPet) ? $editPet['pet_breed']: ''; ?>" placeholder="Enter pet breed" required><br>
                                
                                <label for="pet_age">Age</label>
                                <input type="number" name="pet_age"  value="<?= isset($editPet) ? $editPet['pet_age']: ''; ?>" placeholder="Enter pet age" required><br>
                                <label for="pet_condition">Condition</label>
                                <input type="text" name="pet_condition" value="<?= isset($editPet) ? $editPet['pet_condition']:''; ?>" placeholder="Enter pet condition" required><br>
                                <label for="pet_description">Description</label>
                                <textarea name="pet_description" id="#" rows="6" placeholder="Pet description" required><?= isset($editPet) ? $editPet['pet_description']: ''; ?></textarea><br>
                                <input type="hidden" name="pet_status" value="available">
                                <?php if(isset($editPet)) :?>
                                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editPet['image']); ?>">
                                <img src="../image/pets/<?php echo htmlspecialchars($editPet['image']); ?>"  width="100">
                                <?php endif; ?>
                                <label for="image">Pet Image</label>
                                <input type="file"  name="image"  >
                                <?php if(isset($editPet)) :?>
                                <input type="submit" name="update_pet" value="Update Pet">
                                <?php else :?>
                                <input type="submit" value="Add Pet">
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                    
                </div>
</body>
</html>
