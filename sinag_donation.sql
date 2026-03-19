-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2026 at 01:20 PM
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
-- Database: `sinag_donation`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `goal_amount` decimal(10,2) DEFAULT NULL,
  `current_amount` decimal(10,2) DEFAULT 0.00,
  `deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `description`, `goal_amount`, `current_amount`, `deadline`, `created_at`, `image`) VALUES
(3, 'Food for the Children in Need', 'These children are hungry and are in need of immediate help.', 20000.00, 300.00, NULL, '2026-03-12 16:11:36', '1773331896_4c7203095b875dc17758.png'),
(4, 'Solar Lamps for Sitio Pag-asa', 'Help us install durable solar lamps for 120 households in Sitio Pag-asa so students can study at night and families can stay safe during power interruptions.', 85000.00, 14500.00, '2026-04-29', '2026-03-15 10:55:07', 'ai-solar-lamps-sitio-pagasa.svg'),
(5, 'School Supplies for Barangay Malaya', 'Provide notebooks, pencils, and hygiene kits for 60 students in Barangay Malaya before the next school quarter starts.', 1800.00, 350.00, '2026-04-04', '2026-03-15 11:00:48', 'ai-school-supplies-malaya.svg'),
(6, 'Medicines for Lola Rosa', 'Support a one-month maintenance medicine pack for Lola Rosa, a senior citizen managing hypertension and diabetes.', 1200.00, 900.00, '2026-03-27', '2026-03-15 11:00:48', 'ai-medicines-lola-rosa.svg'),
(7, 'Rice Packs for 20 Families', 'Fund rice and canned goods for 20 families affected by recent flooding in low-lying areas.', 2000.00, 2000.00, '2026-03-20', '2026-03-15 11:00:48', 'ai-rice-packs-families.svg'),
(8, 'Community First Aid Refill', 'Restock first aid essentials including bandages, antiseptics, and basic emergency medicines for barangay responders.', 1500.00, 250.00, '2026-03-29', '2026-03-15 11:00:48', 'ai-community-first-aid.svg'),
(9, 'Typhoon Shelter Repair Fund', 'Repair damaged roofing panels and walling in an evacuation center used by families during storms.', 25000.00, 8000.00, '2026-03-05', '2026-03-15 11:00:48', 'ai-typhoon-shelter-repair.svg');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `donor_name` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `reference_number` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `proof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `campaign_id`, `donor_name`, `amount`, `payment_method`, `reference_number`, `status`, `created_at`, `proof`) VALUES
(1, 1, 'Norwood', 99999999.99, 'GCash', '234234', 'pending', '2026-03-10 09:52:36', NULL),
(2, 1, 'Test Donor', 500.00, 'GCash', '123ABC', 'approved', '2026-03-11 14:25:01', NULL),
(3, 3, 'Test Donor 2', 300.00, 'GCash', '2342343', 'approved', '2026-03-12 16:22:47', '1773332567_fcd51ce196e6d8151e6e.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verification_token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `verification_token`, `is_verified`, `is_active`) VALUES
(1, 'Admin', 'admin@sinag.com', '123456', 'admin', '2026-03-10 09:12:43', NULL, 0, 1),
(2, 'donator1', 'fafasa1059@hlkes.com', '$2y$10$.KUXlKDbUpKnv1SUpGUPw.6Y47cxGC371X1hzahu2XYA6PsGY4Y5C', '', '2026-03-15 10:29:09', NULL, 1, 1),
(4, 'Melman Dela Cruz', 'vebypimu@forexzig.com', '$2y$10$YVGTQNFmWtp2qDhzbzBf4upnglAZuJUiyznoKcLTLeGT1G.nZ6Gzq', '', '2026-03-15 11:42:16', NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
