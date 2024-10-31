-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2024 at 02:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_adoption_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoption_requests`
--

CREATE TABLE `adoption_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `reason` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` enum('waiting','approved','rejected','claimed') DEFAULT 'waiting',
  `approved_at` datetime DEFAULT NULL,
  `claimed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption_requests`
--

INSERT INTO `adoption_requests` (`id`, `user_id`, `pet_id`, `reason`, `contact`, `address`, `status`, `approved_at`, `claimed_at`) VALUES
(16, 10, 8, '', '', '', 'claimed', NULL, NULL),
(17, 10, 4, '', '', '', 'rejected', NULL, NULL),
(18, 10, 9, '', '', '', 'rejected', NULL, NULL),
(19, 10, 12, '', '', '', 'rejected', NULL, NULL),
(20, 13, 11, '', '', '', 'rejected', NULL, NULL),
(21, 13, 10, 'i love cat', '1451254', 'basak', 'approved', NULL, NULL),
(22, 10, 5, 'i love cat and i wanted to adopt one and this cat is cute.', '.9026434', 'Canada', 'approved', NULL, NULL),
(23, 15, 5, 'love the name', '56425154', 'US', 'approved', NULL, NULL),
(24, 15, 12, 'love the cat', '1231231', 'australia', 'waiting', NULL, NULL),
(25, 15, 16, 'The dog that I been looking for.', '6481324', 'Canada', 'rejected', NULL, NULL),
(26, 16, 18, 'I love this dog', '123125123', 'Canada', 'approved', '2024-09-15 13:35:22', NULL),
(27, 13, 19, 'I love his face it\'s so funny how he make that face', '1251123', 'australia', 'claimed', NULL, '2024-09-15 13:31:20'),
(28, 18, 4, 'I love his hair so furry', '1541241', 'New York', 'waiting', NULL, NULL),
(29, 18, 14, 'This dog is also caught my attention', '512312', 'New York', 'rejected', NULL, NULL),
(30, 18, 14, 'This dog has a name that the same of my son\'s name that\'s why I want to adopt this dog', '124123', 'New York', 'claimed', '2024-09-15 13:53:34', '2024-09-15 13:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `pet_name` varchar(50) DEFAULT NULL,
  `pet_type` varchar(255) NOT NULL,
  `pet_breed` varchar(50) DEFAULT NULL,
  `pet_sex` varchar(255) NOT NULL,
  `pet_age` varchar(255) DEFAULT NULL,
  `pet_description` varchar(255) NOT NULL,
  `pet_condition` varchar(255) NOT NULL,
  `pet_status` enum('available','waiting','approved') DEFAULT 'available',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `pet_name`, `pet_type`, `pet_breed`, `pet_sex`, `pet_age`, `pet_description`, `pet_condition`, `pet_status`, `image`) VALUES
(4, 'Buddy', 'Dog', 'Golden Retriever', '', '3', '', '', 'available', 'dog2.png'),
(5, 'Luna', 'Cat', 'Siamese', '', '2', '', 'Good', 'approved', 'cat1.png'),
(6, 'Charlie', 'Dog', 'Beagle', '', '4', '', 'Good', 'waiting', 'dog2.png'),
(8, 'Bella', 'Cat', 'Persian', '', '5', '', 'Very Good', '', 'cat3.png'),
(9, 'Rocky', 'Dog', 'German Shepherd', '', '2', '', 'Excellent', 'available', 'dog1.png'),
(10, 'Milo', 'Cat', 'Maine Coon', '', '3', '', 'Good', 'approved', 'cat2.png'),
(11, 'Daisy', 'Dog', 'Labrador Retriever', '', '6', 'lorem', 'Good', 'available', 'dog1.png'),
(12, 'Lucy', 'Cat', 'British Shorthair', '', '2', 'loreemm', 'Healthy', 'available', 'cat1.png'),
(13, 'Cooper', 'Dog', 'Poodle', '', '4', '', 'Good', 'available', 'dog5.png'),
(14, 'Charlie', 'Dog', 'Labrador Retriever', '', '4', 'Charlie is a fun-loving and loyal Labrador who enjoys swimming and playing catch. He is great with kids and loves to be around people.', 'Very good', '', 'dog4.png'),
(15, 'Stuzzy', 'Dog', 'Cocker Spaniel', '', '5', 'Stuzzy is a sweet and gentle Cocker Spaniel with a soft coat and big, expressive eyes. She loves cuddles and is always eager for a walk in the park.', 'Good', 'available', 'dog2.png'),
(16, 'Bruno Mars', 'Dog', ' Boxer', '', '4', 'Bruno is an energetic and playful Boxer who thrives on exercise and enjoys running. He is strong, protective, and loves to be the center of attention.', 'Good', 'available', 'dog3.png'),
(17, 'Oliver', 'Cat', 'Ragdoll', '', '2', 'Oliver is a laid-back Ragdoll with a silky coat. He loves to follow his humans around and is known for his calm, gentle nature.', 'Good', 'available', 'cat2.png'),
(18, 'Cleo', 'Cat', 'Persian', '', '3', ' Cleo is a beautiful Persian cat with a luxurious coat. She prefers a calm environment where she can relax and be pampered.', 'Good', 'approved', 'cat3.png'),
(19, 'Jasper', 'Cat', 'Bengal', '', '2', ' Jasper is a striking Bengal with a wild look and a playful spirit. He is highly active, loves climbing, and enjoys interactive toys.', 'Good', '', 'cat4.png'),
(20, 'Ranga', 'Dog', 'Goblin', '', '3 months', 'Loving Dog', 'Good', 'available', 'dog5.png'),
(21, 'Sumiya', 'Cat', 'fox cat', 'Male', '4 months old', 'This cat is very clingy and need a lot of attention', 'Healthy', 'available', 'cat1.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(8, 'john', '', '$2y$10$J345roE5Z5TaITzWR1dV.u3D3lDH3jGEE4gTG4fgBfN', 'user'),
(9, 'harvey', '', '$2y$10$.HfV06zS.xdIG/wCbXoUOu0XFmYXVCmV3e7VCjl4hmY', 'user'),
(10, 'sean', '', '1234', 'user'),
(11, 'harvey', '', '12345', 'user'),
(12, 'john', '', '222', 'user'),
(13, 'ambot', '', '333', 'user'),
(14, 'buscato', '', '66', 'user'),
(15, 'Jasmine', '', '254', 'user'),
(16, 'Angel', 'angenl@gmail.com', 'angel', 'user'),
(17, 'admin', 'admin@gmail.com', 'admin123', 'admin'),
(18, 'Diola', 'diola@gmail.com', 'diola', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD CONSTRAINT `adoption_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `adoption_requests_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
