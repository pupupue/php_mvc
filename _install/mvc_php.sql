-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2020 at 03:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `post_user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `post_user_id`, `created_at`) VALUES
(1, 'This is the First Post!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tempor tellus ligula, a sollicitudin mi ultricies nec. Vestibulum bibendum tristique pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam arcu libero, gravida et lorem quis, euismod auctor felis. Duis at quam sit amet risus hendrerit gravida sed vel lectus. Sed efficitur, nibh at blandit ultricies, velit odio cursus velit, id cursus est sapien non justo. Nam porta purus viverra nisi pharetra lacinia. Ut tempus erat libero, nec tincidunt ante semper non. Duis euismod, arcu et interdum pulvinar, ligula dui rutrum sem, nec bibendum enim nulla consequat velit. Quisque pretium ipsum neque.', 1, '2020-05-06 03:05:07'),
(2, 'This is Second Post!', 'Ut interdum lobortis ex, nec suscipit ligula consectetur et. Maecenas a metus sapien. Vivamus pretium ut ante sit amet pharetra. Proin suscipit, arcu at gravida commodo, mauris libero tristique ipsum, a iaculis mauris orci vitae urna. Nam eu diam risus. Duis ac ipsum et lectus ultricies lobortis. Integer faucibus ultricies purus, eget tristique felis feugiat vel. Aenean pulvinar lacus dui, at varius ligula tincidunt scelerisque. Mauris fermentum elementum dui, a laoreet mauris lacinia quis. Suspendisse molestie maximus diam, fringilla tincidunt purus vestibulum quis.', 1, '2020-05-06 03:05:08'),
(3, 'This is Third Post!', 'Pellentesque vitae lobortis metus, ac posuere orci. Suspendisse potenti. Morbi ut risus in orci sodales mollis. Vestibulum elit lacus, interdum quis gravida quis, dapibus eu felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin dui est, porta sed purus id, commodo tempus libero. Fusce odio enim, varius quis iaculis non, lobortis eu orci. Aenean lectus erat, pellentesque vel elementum ut, elementum a dolor. Duis mattis in tortor sit amet placerat. Curabitur tellus arcu, semper eu efficitur a, tempor eget neque. Pellentesque elementum molestie diam. Integer gravida enim gravida eros efficitur, ac commodo orci sollicitudin. Quisque augue nisi, finibus a ipsum non, tempus ornare risus. Nulla facilisi.', 1, '2020-05-06 03:05:32'),
(4, 'Why do we post?', 'Pellentesque vitae lobortis metus, ac posuere orci. Suspendisse potenti. Morbi ut risus in orci sodales mollis. Vestibulum elit lacus, interdum quis gravida quis, dapibus eu felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin dui est, porta sed purus id, commodo tempus libero. Fusce odio enim, varius quis iaculis non, lobortis eu orci. Aenean lectus erat, pellentesque vel elementum ut, elementum a dolor. Duis mattis in tortor sit amet placerat. Curabitur tellus arcu, semper eu efficitur a, tempor eget neque. Pellentesque elementum molestie diam. Integer gravida enim gravida eros efficitur, ac commodo orci sollicitudin. Quisque augue nisi, finibus a ipsum non, tempus ornare risus. Nulla facilisi.', 2, '2020-05-06 03:05:04'),
(5, 'What is a Post?', 'Ut interdum lobortis ex, nec suscipit ligula consectetur et. Maecenas a metus sapien. Vivamus pretium ut ante sit amet pharetra. Proin suscipit, arcu at gravida commodo, mauris libero tristique ipsum, a iaculis mauris orci vitae urna. Nam eu diam risus. Duis ac ipsum et lectus ultricies lobortis. Integer faucibus ultricies purus, eget tristique felis feugiat vel. Aenean pulvinar lacus dui, at varius ligula tincidunt scelerisque. Mauris fermentum elementum dui, a laoreet mauris lacinia quis. Suspendisse molestie maximus diam, fringilla tincidunt purus vestibulum quis.', 2, '2020-05-06 03:05:08'),
(6, 'The posts and what to do about them.', 'Pellentesque vitae lobortis metus, ac posuere orci. Suspendisse potenti. Morbi ut risus in orci sodales mollis. Vestibulum elit lacus, interdum quis gravida quis, dapibus eu felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin dui est, porta sed purus id, commodo tempus libero. Fusce odio enim, varius quis iaculis non, lobortis eu orci. Aenean lectus erat, pellentesque vel elementum ut, elementum a dolor. Duis mattis in tortor sit amet placerat. Curabitur tellus arcu, semper eu efficitur a, tempor eget neque. Pellentesque elementum molestie diam. Integer gravida enim gravida eros efficitur, ac commodo orci sollicitudin. Quisque augue nisi, finibus a ipsum non, tempus ornare risus. Nulla facilisi.', 2, '2020-05-06 03:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `forename` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `forename`, `surname`, `password`) VALUES
(1, 'janslaurs@gmail.com', 'Sully', 'Banks', '$2y$10$Mojw6mroivn8nowRBJayxu.fD1aWr8QWGmpLuuP7l83TOPalTfn2i'),
(2, 'member@gmail.com', 'Armstrong', 'Kellsworth', '$2y$10$rkEQwmjFkOIUGiGkpT8rCOG2ZEbsQaUovd1AaWdjOa2Tm2Q2mk73q');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
