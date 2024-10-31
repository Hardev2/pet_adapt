<?php
include '../database/database.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pet_id = $_POST['id'];
    $pet_name = $_POST['pet_name'];
    $pet_type = $_POST['pet_type'];
    $pet_breed = $_POST['pet_breed'];
    $pet_sex = $_POST['pet_sex'];
    $pet_age = $_POST['pet_age'];
    $pet_description = $_POST['pet_description'];
    $pet_condition = $_POST['pet_condition'];
    $pet_status = $_POST['pet_status'];
    $pet_image = $_FILES['image']['name'];
    $pet_image_tmp = $_FILES['image']['tmp_name'];
    $pet_image_folder = '../image/pets/' . $pet_image;


    if($pet_image){
        move_uploaded_file($pet_image_tmp, $pet_image_folder);
    }

    $sql = "INSERT INTO pets(pet_name, pet_type, pet_breed, pet_sex, pet_age, pet_description, pet_condition, pet_status, image)
    VALUES ('$pet_name', '$pet_type', '$pet_breed', '$pet_sex', '$pet_age', '$pet_description', '$pet_condition', '$pet_status', '$pet_image')";

    if(mysqli_query($conn, $sql)){
        echo "Pet added Successfully!";
        header("Location:../admin/admin-pet.php");
        exit();
    }else{
        echo "Can't add pet" . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>