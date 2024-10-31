<?php
session_start();  
$conn = mysqli_connect('localhost', 'root', '', 'pet_adoption_db') or die('connection failed');






$query = "SELECT * FROM pets WHERE pet_status = 'available' ORDER BY id DESC LIMIT 5 ";
$result = mysqli_query($conn, $query);





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
        <div class="hero-section">
            <h1 class="bg-text">adopt</h1>
            <div class="hero-content">
                <div class="col-1">
                    <h2>add <span>colour</span></h2>
                    <h2>to their</h2>
                    <h2>life</h2>
                </div>
                <div class="col-2">
                 <img src="image/hero-image.png" alt="">
                </div>
                <div class="col-3">
                    <h2>Welcome to TailWag & Purrs</h2>
                    <p>
                         We believe every pet deserves a loving
                          home. Our mission is to connect animals
                           in need with compassionate people looking 
                           to adopt. Whether you're searching for a
                            playful puppy, a curious kitten, or a gentle
                             senior pet, you'll find your new best friend
                              here.</p>
                </div>
              
            </div> 
          
        </div>
        <div class="hero-button">
            <a href="">Adopt Now!</a>
        </div>
    </div>
    <section>
        <div class="popular">
            <h2>New <span>Cat & Dog</span></h2>
            <div class="popular-container">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="popular-box">
            <div class="popular-image">
                <img src="image/pets/<?= $row['image'] ?>" alt="">
            </div>
            <div class="popular-description pet-details">
            <p><?php echo $row['pet_name']; ?></p>
            <p><?php echo $row['pet_breed']; ?></p>
            <p>Age:<?php echo $row['pet_age']; ?></p>
            </div>
           
        </div>
        <?php endwhile; ?>
            </div>
        </div>
    </section>
    <section>
        <div class="section-two" id="why">
           <div class="why-description">
                <h2>Why Adopt a <span>Pet?</span></h2>
                <p>Adopting a pet is a rewarding 
                    experience that not only brings 
                    joy to your life but also saves an
                     animal. When you adopt, you:</p>
           </div>
        
           <div class="why-bullet">
            <div class="why-blob">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#B4D6CD" d="M47.4,-14.9C53,2,43.4,24.3,26.1,37.1C8.8,49.9,-16.2,53.3,-36.1,40.9C-56,28.5,-70.9,0.3,-64,-18.2C-57.1,-36.7,-28.6,-45.6,-3.8,-44.4C20.9,-43.1,41.7,-31.7,47.4,-14.9Z" transform="translate(100 100)" />
                    <image href="image/save.png" x="55" y="70" height="70px" width="70px" clip-path="url(image/save.jpg)" />
                </svg> 
                <p>Save Lives: Give a pet a second chance at happiness.</p>
            </div>
            <div class="why-blob">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#B4D6CD" d="M47.4,-14.9C53,2,43.4,24.3,26.1,37.1C8.8,49.9,-16.2,53.3,-36.1,40.9C-56,28.5,-70.9,0.3,-64,-18.2C-57.1,-36.7,-28.6,-45.6,-3.8,-44.4C20.9,-43.1,41.7,-31.7,47.4,-14.9Z" transform="translate(100 100)" />
                    <image href="image/match.png" x="55" y="70" height="70px" width="70px" clip-path="url(image/save.jpg)" />
                </svg> 
                <p>Find the Right Match: Choose from a wide variety of animals that suit your lifestyle.</p>
            </div>
            <div class="why-blob">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#B4D6CD" d="M47.4,-14.9C53,2,43.4,24.3,26.1,37.1C8.8,49.9,-16.2,53.3,-36.1,40.9C-56,28.5,-70.9,0.3,-64,-18.2C-57.1,-36.7,-28.6,-45.6,-3.8,-44.4C20.9,-43.1,41.7,-31.7,47.4,-14.9Z" transform="translate(100 100)" />
                    <image href="image/save.png" x="55" y="70" height="70px" width="70px" clip-path="url(image/save.jpg)" />
                </svg> 
                <p>Support a Good Cause: Help reduce overcrowding in shelters.</p>
            </div>
          
           </div>
          
        </div>
    </section>
    <section>
        <div class="pets">
            <h2>Meet Our <span>Pets</span></h2>
            <div class="pets-container">
                <div class="pets-row-1">
                    <div class="pets-col-1">
                        <div class="pet-box">
                            <img src="image/gallery1.jpg" alt="">
                        </div>
                        <div class="pet-box">
                            <img src="image/gallery2.jpg" alt="">
                        </div>
                    </div>

                </div>
                <div class="pets-row-2">
                    <div class="pets-col-2">
                        <div class="pet-box">
                            <img src="image/gallery3.jpg" alt="">
                        </div>
                        <div class="pet-box">
                            <img src="image/gallery4.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="how-section" id="how">
            <h2>How It <span>Works</span></h2>
            <div class="how-container">
                <div class="how-box">
                    <h3>Browse Available Pets</h3>
                    <i class="fa-brands fa-chrome"></i>
                    <p> Explore our database of adoptable pets,
                         complete with photos, bios, and details.</p>
                </div>
                <div class="how-box">
                    <h3>Apply to Adopt</h3>
                    <i class="fa-solid fa-file-pen"></i>
                    <p>Once you find your perfect match, fill out our online adoption application.</p>
                </div>
                <div class="how-box">
                
                    <h3>Meet and Greet</h3>
                    <i class="fa-solid fa-handshake"></i>
                    <p>After reviewing your application, we'll arrange a meet and greet with the pet to ensure compatibility.</p>
                </div>
                <div class="how-box">
                    <h3>Bring Them Home</h3>
                    <i class="fa-solid fa-house"></i>
                    <p> Complete the adoption process and take your new family member home!</p>
                </div>
            </div>
        </div>
    </section>

</div>
<section>
    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <h1>TailWag & Purrs</h1>
            </div>
            <div class="footer-col">
                <h4>@Copyright 2024</h4>
            </div>
            <div class="footer-col">
                <h5>Email:tailwag&purrs@gmail.com</h5>
                <h5>Phone:090642354</h5>
                <h5>Visit Us:Cebu City</h5>
            </div>
        </div>
    </footer>
</section>
</body>
</html>