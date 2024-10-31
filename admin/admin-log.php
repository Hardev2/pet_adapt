<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'pet_adoption_db') or die('Connection failed');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
       
        // Verify password
        if ($password === $user['password'] && $user['role'] === 'admin') {  // Check if the user is an admin
            $_SESSION['admin_email'] = $user['email'];
            $_SESSION['admin_role'] = $user['role'];
            header('Location:dashboard.php');  
            exit();
        } else {
            echo "Invalid password or insufficient privileges!";
        }
    } else {
        echo "User does not exist!";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="log-container">
    <form method="post" action="">
        <h1>LOG IN</h1>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email"  placeholder="Enter email" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"  placeholder="Enter password" required><br>
        <button type="submit">Login</button>
        <div class="register-link">
        <a href="index.php?page=register">Don't have an account? <span>Click here!</span></a>
        </div>
    </form>
    </div>
</body>
</html>