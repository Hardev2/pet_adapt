<?php
session_start();
unset($_SESSION['admin_email']);
unset($_SESSION['admin_role']);
header('Location: admin-log.php');
exit();
?>