<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'pet_adoption_db') or die('Connection failed');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = 'user'; // Default role

    // Hash the password

    // Insert user into the database
    $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
    if (mysqli_query($conn, $query)) {
        echo "Registration successful!";
        header("Location:index.php?page=login");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="log-container">
    <form method="post" action="">
        <h1>REGISTER</h1>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter username" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"  placeholder="Enter password" required><br>
        <button type="submit">Register</button>
        <div class="register-link">
        <a href="index.php?page=login">Log in<span>Click here!</span></a>
        </div>
    </form>
    </div>
    
</body>
</html>
