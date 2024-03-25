-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 07:51 PM
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
-- Database: `movies_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `theatre_id` int(11) DEFAULT NULL,
  `movie_time_slot_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `num_tickets` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `price`) VALUES
(1, 'GOLD', 2500),
(2, 'PLATINUM', 1500),
(3, 'BOX', 500);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` year(4) NOT NULL,
  `category` varchar(1000) NOT NULL,
  `rating` int(11) NOT NULL,
  `pictures` varchar(1000) NOT NULL,
  `trailers` varchar(1000) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `year`, `category`, `rating`, `pictures`, `trailers`, `description`) VALUES
(57, 'Snowden', '2016', 'Action', 8, '../pictures/Snowden.jpg', 'QlSAiI3xMh4', 'After discovering that the NSA is illegally spying on ordinary US citizens, Edward Snowden, an employee of the agency, grapples with the decision to leak their classified documents to the press.'),
(58, 'The Dark Knight', '2008', 'Action', 9, '../pictures/The Dark Knight.jpg', 'EXeTwQWrcwY', 'Batman has a new foe, the Joker, who is an accomplished criminal hell-bent on decimating Gotham City. Together with Gordon and Harvey Dent, Batman struggles to thwart the Joker before it is too late.'),
(59, 'Inception', '2010', 'Action', 8, '../pictures/Inception.jpg', 'YoHD9XEInc0', 'Cobb steals information from his targets by entering their dreams. He is wanted for his alleged role in his wife\'s murder and his only chance at redemption is to perform a nearly impossible task.'),
(60, 'Avengers: Endgame', '2019', 'Action', 8, '../pictures/Avengers Endgame.jpg', 'TcMBFSGVi1c', 'After Thanos, an intergalactic warlord, disintegrates half of the universe, the Avengers must reunite and assemble again to reinvigorate their trounced allies and restore balance.'),
(61, 'Get Out', '2017', 'Horror', 7, '../pictures/Get Out.jpg', 'DzfpyUB60YY', 'Chris, an African-American man, decides to visit his Caucasian girlfriend\'s parents during a weekend getaway. Although they seem normal at first, he is not prepared to experience the horrors ahead.'),
(62, 'The Conjuring', '2013', 'Horror', 7, '../pictures/The Conjuring.jpg', 'ejMMn0t58Lc', 'Rod and Carolyn find their pet dog dead under mysterious circumstances and experience a spirit that harms their daughter Andrea. They finally call investigators who can help them get out of the mess.'),
(63, 'Us', '2019', 'Horror', 7, '../pictures/Us.jpg', 'hNCmb-4oXJA', 'Adelaide Wilson and her family are attacked by mysterious figures dressed in red. Upon closer inspection, the Wilsons realise that the intruders are exact lookalikes of them.'),
(64, 'The Hangover', '2009', 'Comedy', 7, '../pictures/The Hangover.jpg', 'tcdUhdOlz9M', 'A few days before his wedding, Doug Billings and his best men go to Las Vegas for a bachelor party. However, the next day, the friends realise that they have no recollection of the previous night.'),
(65, 'Bridesmaids', '2011', 'Comedy', 7, '../pictures/Bridesmaids.jpg', 'JgacDwgKiZg', 'When lovesick and jobless Annie\'s life falls apart, she becomes the bridesmaid for Lillian, her long-time best pal. She is determined to make Lillian\'s wedding ideal along with the other bridesmaids.'),
(66, 'Superbad', '2007', 'Comedy', 8, '../pictures/Superbad.jpg', '4eaZ_48ZYog', 'Two high school best friends decide to have a memorable party before bidding farewell and going to different colleges. But things go haywire and they land in major trouble.');

-- --------------------------------------------------------

--
-- Table structure for table `movie_schedule`
--

CREATE TABLE `movie_schedule` (
  `id` int(11) NOT NULL,
  `theatre_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_schedule`
--

INSERT INTO `movie_schedule` (`id`, `theatre_id`, `movie_id`, `slot_id`) VALUES
(3, 19, 57, 1),
(4, 20, 58, 2),
(5, 21, 59, 3),
(6, 22, 60, 10),
(7, 23, 61, 11),
(8, 24, 62, 1),
(9, 25, 63, 2),
(10, 26, 64, 3),
(11, 27, 65, 10),
(12, 19, 66, 11);

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `slot` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `slot`) VALUES
(1, '1:00 pm - 4:00 pm'),
(2, '3:00 pm - 5:00 pm\r\n'),
(3, '5:00 pm - 7:00 pm'),
(10, '7:00 pm - 9:00 pm'),
(11, '1:00 pm - 3:00 pm');

-- --------------------------------------------------------

--
-- Table structure for table `theatres`
--

CREATE TABLE `theatres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(1000) NOT NULL,
  `picture` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theatres`
--

INSERT INTO `theatres` (`id`, `name`, `location`, `picture`) VALUES
(19, 'GRAND CINEMAS', 'Downtown City', 'https://images.pexels.com/photos/5691279/pexels-photo-5691279.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(20, 'Sunset Cinemas', 'Westside Plaza', 'https://images.pexels.com/photos/7991476/pexels-photo-7991476.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(21, 'Metroplex Cinemas', 'Central Square', 'https://images.pexels.com/photos/13936294/pexels-photo-13936294.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(22, 'Starlight Theatres', 'Riverside Mall', 'https://images.pexels.com/photos/14746411/pexels-photo-14746411.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(23, 'City Center Cinemas', 'Uptown District', 'https://images.pexels.com/photos/7991182/pexels-photo-7991182.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(24, 'Lakeside Cinemas', 'Lakeside Avenue', 'https://images.pexels.com/photos/18772963/pexels-photo-18772963/free-photo-of-seats-upholstered-with-brown-imitation-leather-in-a-cinema-hall.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(25, 'Plaza Cinemas', 'City Center', 'https://images.pexels.com/photos/8159242/pexels-photo-8159242.jpeg'),
(26, 'Galaxy Theatres', 'Eastside Mall', 'https://images.pexels.com/photos/7234219/pexels-photo-7234219.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(27, 'Regal Cinemas', 'Midtown Plaza', 'https://images.pexels.com/photos/3709369/pexels-photo-3709369.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(8) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(2, 'Daniyal', 'abc@gmail.com', '12345', 'admin'),
(4, 'Mahad', 'mahad@gmail.com', '12345', 'admin'),
(5, 'Daniyal', 'mahad@gmail.com', '12345', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theatre_id` (`theatre_id`),
  ADD KEY `movie_time_slot_id` (`movie_time_slot_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_schedule`
--
ALTER TABLE `movie_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theatre` (`theatre_id`),
  ADD KEY `movie` (`movie_id`),
  ADD KEY `slot` (`slot_id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theatres`
--
ALTER TABLE `theatres`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `movie_schedule`
--
ALTER TABLE `movie_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `theatres`
--
ALTER TABLE `theatres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`theatre_id`) REFERENCES `theatres` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`movie_time_slot_id`) REFERENCES `movie_schedule` (`id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `movie_schedule`
--
ALTER TABLE `movie_schedule`
  ADD CONSTRAINT `movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `slot` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `theatre` FOREIGN KEY (`theatre_id`) REFERENCES `theatres` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
