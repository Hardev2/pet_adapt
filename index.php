<?php


$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Map pages to files
$pages = [
    'home' => 'pages/home.php',
    'pet-page' => 'pages/pet-page.php',
    'adopt' => 'adoption/adopt.php',
    'submit-adoption' => 'adoption/submit_adoption.php',
    'terms' => 'adoption/terms-and-conditions.php',
    'user-dashboard' => 'pages/user-dashboard.php',
    'login' => 'auth/login.php',
    'register' => 'auth/register.php',
    'logout' => 'auth/logout.php',
    'view' => 'pages/view-page.php',
    'admin-pet' => 'admin/admin-pet.php',
    'add-pet' => 'function/add-pet.php',

  
];

// Include the requested file or show a 404
if (array_key_exists($page, $pages)) {
    include $pages[$page];
} else {
    echo "404 Not Found";
}

?>
