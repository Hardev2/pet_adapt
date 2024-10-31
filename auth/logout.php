<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_username']);
unset($_SESSION['user_role']);
header('Location: index.php?page=home'); // Redirect to login page
exit();
?>