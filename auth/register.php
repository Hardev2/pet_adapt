<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'pet_adoption_db') or die('Connection failed');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $day = mysqli_real_escape_string($conn, $_POST['day']);
    $month = mysqli_real_escape_string($conn, $_POST['month']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $role = 'user'; // Default role

    // Hash the password

    // Insert user into the database
    $query = "INSERT INTO users (name, last_name, username, email, contact, password, day, month, year, role) 
    VALUES ('$name','$last_name', '$username', '$email', '$contact', '$password', '$day','$month','$year', '$role')";
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
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="log-container">
    <form method="post" action="">
        <h1>REGISTER</h1>
     <div class="form-container">
     <h6>Personal Information</h6>
        <div class="form-row">
            <div class="form-col">
                <label for="username">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter name.." required><br>
            </div>
            <div class="form-col">
                <label for="username">Surname:</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter last name.." required><br>
            </div>
        </div>
        <div class="form-row">
            <div class="form-col">
                <label for="username">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter email.." required><br>
            </div>
            <div class="form-col">
                <label for="username">Contact:</label>
                <input type="number" id="number" name="contact" placeholder="Enter contact.." required><br>
            </div>
        </div>
        <h6>Birthday</h6>
        <div class="form-row">
            <div class="form-col">
            <label for="day">Day:</label>
                <select name="day" id="day" required>
                    <option value="">Day</option>
                    <?php
                    for ($d = 1; $d <= 31; $d++) {
                        echo "<option value='$d'>$d</option>";
                    }
                    ?>
                </select>
            </div>
                <div class="form-col">
                    <label for="month">Month:</label>
                    <select name="month" id="month" required>
                        <option value="">Month</option>
                        <?php
                        $months = [
                            1 => "January", 2 => "February", 3 => "March", 4 => "April",
                            5 => "May", 6 => "June", 7 => "July", 8 => "August",
                            9 => "September", 10 => "October", 11 => "November", 12 => "December"
                        ];
                        foreach ($months as $key => $value) {
                            echo "<option value='$key'>$value</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-col">
                    <label for="year">Year:</label>
                    <select name="year" id="year" required>
                        <option value="">Year</option>
                        <?php
                        $currentYear = date("Y");
                        for ($y = $currentYear; $y >= 1900; $y--) {
                            echo "<option value='$y'>$y</option>";
                        }
                        ?>
                    </select>
                </div>
        </div>
        <h6>User Account</h6>
        <div class="form-row">
            <div class="form-col">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter username.." required><br>
            </div>
            <div class="form-col">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"  placeholder="Enter password" required><br>
            </div>
        </div>
        <button type="submit">Register</button>
        <div class="register-link">
        <a href="index.php?page=login">Log in <span>Click here!</span></a>
     </div>
      
        </div>
    </form>
    </div>
    
</body>
</html>
