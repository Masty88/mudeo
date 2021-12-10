-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2021 at 11:56 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shareposts`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, ' Feature films'),
(2, 'Music Tracks'),
(3, 'Game Art Animation'),
(4, 'Music bases'),
(5, 'Horror'),
(6, 'Romantic'),
(7, 'Sci - Fi & Fantasy'),
(8, 'Sports'),
(9, 'Thrillers'),
(10, 'Interviews'),
(12, 'Teen'),
(13, 'Commercials'),
(14, ' Short films'),
(15, 'Independent'),
(16, 'Foreign'),
(17, 'Music videos'),
(18, 'VFX'),
(19, 'Others'),
(20, 'Documentary');

-- --------------------------------------------------------

--
-- Table structure for table `connections_user`
--

CREATE TABLE `connections_user` (
  `id` int(11) NOT NULL,
  `remembertoken` varchar(250) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `connections_user`
--

INSERT INTO `connections_user` (`id`, `remembertoken`, `userId`) VALUES
(16, '61b231ff57221', 16);

-- --------------------------------------------------------

--
-- Table structure for table `count_views`
--

CREATE TABLE `count_views` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `count_views`
--

INSERT INTO `count_views` (`id`, `entity_id`, `user_id`) VALUES
(61, 84, 15),
(62, 47, 15),
(63, 96, 15);

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE `entities` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `preview` varchar(250) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `full_media` varchar(255) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` (`id`, `name`, `description`, `thumbnail`, `preview`, `categoryId`, `full_media`, `userId`, `view_count`) VALUES
(3, 'The Simpsons', NULL, 'entities/thumbnails/thesimpsons.jpg', 'entities/previews/6.mp4', 20, 'entities/videos/6.mp4', NULL, 4),
(4, 'Toy Story', NULL, 'entities/thumbnails/toystory.jpg', 'entities/previews/1.mp4', 13, 'entities/videos/1.mp4', NULL, 5),
(45, 'Inbetweeners', NULL, 'entities/thumbnails/inbetw.jpg', 'entities/previews/2.mp4', 3, 'entities/videos/2.mp4', NULL, 1),
(46, 'Suits', NULL, 'entities/thumbnails/Suits.jpg', 'entities/previews/3.mp4', 4, 'entities/videos/3.mp4', NULL, 9),
(47, 'Captain Underpants', NULL, 'entities/thumbnails/cu.jpg', 'entities/previews/4.mp4', 13, 'entities/videos/4.mp4', NULL, 9),
(48, 'Brooklyn Nine-Nine', NULL, 'entities/thumbnails/bnn.jpg', 'entities/previews/5.mp4', 3, 'entities/videos/5.mp4', NULL, 5),
(49, 'That 70s Show', NULL, 'entities/thumbnails/tss.jpg', 'entities/previews/6.mp4', 3, 'entities/videos/6.mp4', NULL, 2),
(50, 'Pokemon', NULL, 'entities/thumbnails/pok.jpg', 'entities/previews/2.mp4', 20, 'entities/videos/2.mp4', NULL, 2),
(51, 'Spongebob Squarepants', NULL, 'entities/thumbnails/sbsp.jpg', 'entities/previews/3.mp4', 20, 'entities/videos/3.mp4', NULL, 1),
(52, 'Futurama', NULL, 'entities/thumbnails/fut.jpg', 'entities/previews/1.mp4', 20, 'entities/videos/1.mp4', NULL, 1),
(53, 'Johnny Bravo', NULL, 'entities/thumbnails/jb.jpg', 'entities/previews/4.mp4', 20, 'entities/videos/4.mp4', NULL, 0),
(54, 'Teenage Mutant Ninja Turtles', NULL, 'entities/thumbnails/ninj.jpg', 'entities/previews/5.mp4', 20, 'entities/videos/5.mp4', NULL, 3),
(55, 'Power Puff Girls', NULL, 'entities/thumbnails/ppg.jpg', 'entities/previews/6.mp4', 20, 'entities/videos/6.mp4', NULL, 1),
(56, 'Teen Titans Go', NULL, 'entities/thumbnails/ttg.jpg', 'entities/previews/2.mp4', 20, 'entities/videos/2.mp4', NULL, 0),
(57, 'Jurassic Park', NULL, 'entities/thumbnails/jp.jpg', 'entities/previews/4.mp4', 9, 'entities/videos/4.mp4', NULL, 1),
(58, 'Grease', NULL, 'entities/thumbnails/grease.jpg', 'entities/previews/4.mp4', 17, 'entities/videos/4.mp4', NULL, 0),
(59, 'Paddington Bear', NULL, 'entities/thumbnails/pb.jpg', 'entities/previews/5.mp4', 13, 'entities/videos/5.mp4', NULL, 7),
(60, 'Santa Clause', NULL, 'entities/thumbnails/santa.jpg', 'entities/previews/1.mp4', 18, 'entities/videos/1.mp4', NULL, 11),
(61, 'Monster Family', NULL, 'entities/thumbnails/monsterfamily.jpg', 'entities/previews/6.mp4', 13, 'entities/videos/5.mp4', NULL, 2),
(62, 'Top Gun', NULL, 'entities/thumbnails/tg.jpg', 'entities/previews/2.mp4', 1, 'entities/videos/2.mp4', NULL, 43),
(63, 'Home Alone', NULL, 'entities/thumbnails/ha.jpg', 'entities/previews/3.mp4', 18, 'entities/videos/3.mp4', NULL, 1),
(64, 'The Grinch', NULL, 'entities/thumbnails/gr.jpg', 'entities/previews/4.mp4', 18, 'entities/videos/4.mp4', NULL, 3),
(65, 'National Lampoon\'s Christmas Vacation', NULL, 'entities/thumbnails/la.jpg', 'entities/previews/5.mp4', 18, 'entities/videos/5.mp4', NULL, 0),
(66, 'Elf', NULL, 'entities/thumbnails/elf.jpg', 'entities/previews/6.mp4', 18, 'entities/videos/6.mp4', NULL, 1),
(67, 'Fred Claus', NULL, 'entities/thumbnails/fc.jpg', 'entities/previews/2.mp4', 18, 'entities/videos/2.mp4', NULL, 1),
(68, 'Jaws', NULL, 'entities/thumbnails/jaws.jpg', 'entities/previews/3.mp4', 9, 'entities/videos/3.mp4', NULL, 0),
(69, 'Live Die Repeat', NULL, 'entities/thumbnails/ldr.jpg', 'entities/previews/4.mp4', 9, 'entities/videos/4.mp4', NULL, 1),
(70, 'Into the Storm', NULL, 'entities/thumbnails/its.jpg', 'entities/previews/1.mp4', 9, 'entities/videos/1.mp4', NULL, 1),
(81, 'Mission Impossible', NULL, 'entities/thumbnails/mi.jpg', 'entities/previews/5.mp4', 1, 'entities/videos/1.mp4', NULL, 4),
(82, 'Never Back Down', NULL, 'entities/thumbnails/nbd.jpg', 'entities/previews/6.mp4', 1, 'entities/videos/6.mp4', NULL, 2),
(83, 'Mechanic', NULL, 'entities/thumbnails/mec.jpg', 'entities/previews/2.mp4', 1, 'entities/videos/2.mp4', NULL, 2),
(84, 'Need for Speed', NULL, 'entities/thumbnails/nfs.jpg', 'entities/previews/3.mp4', 1, 'entities/videos/3.mp4', NULL, 7),
(85, 'Gravity', NULL, 'entities/thumbnails/gra.jpg', 'entities/previews/4.mp4', 7, 'entities/videos/4.mp4', NULL, 0),
(86, 'Step Brothers', NULL, 'entities/thumbnails/sb.jpg', 'entities/previews/5.mp4', 3, 'entities/videos/5.mp4', NULL, 2),
(87, 'Game of Thrones', NULL, 'entities/thumbnails/got.jpg', 'entities/previews/1.mp4', 4, 'entities/videos/1.mp4', NULL, 0),
(88, 'Dark Money', NULL, 'entities/thumbnails/dm.jpg', 'entities/previews/6.mp4', 4, 'entities/videos/6.mp4', NULL, 1),
(89, 'Yellowstone', NULL, 'entities/thumbnails/yel.jpg', 'entities/previews/2.mp4', 4, 'entities/videos/2.mp4', NULL, 1),
(90, 'Manifest', NULL, 'entities/thumbnails/man.jpg', 'entities/previews/3.mp4', 4, 'entities/videos/3.mp4', NULL, 0),
(91, 'The Sound of Music', NULL, 'entities/thumbnails/som.jpg', 'entities/previews/4.mp4', 17, 'entities/videos/4.mp4', NULL, 1),
(92, 'Hairspray', NULL, 'entities/thumbnails/hs.jpg', 'entities/previews/1.mp4', 17, 'entities/videos/1.mp4', NULL, 1),
(93, 'Believe', NULL, 'entities/thumbnails/bel.jpg', 'entities/previews/5.mp4', 17, 'entities/videos/5.mp4', NULL, 0),
(94, 'Chris Brown: Till I Die', NULL, 'entities/thumbnails/tid.jpg', 'entities/previews/6.mp4', 17, 'entities/videos/6.mp4', NULL, 0),
(95, 'Men in Black', NULL, 'entities/thumbnails/mib.jpg', 'entities/previews/2.mp4', 7, 'entities/videos/2.mp4', NULL, 1),
(96, 'Interstellar', NULL, 'entities/thumbnails/int.jpg', 'entities/previews/3.mp4', 7, 'entities/videos/3.mp4', NULL, 2),
(97, 'Transformers', NULL, 'entities/thumbnails/tra.jpg', 'entities/previews/1.mp4', 7, 'entities/videos/1.mp4', NULL, 0),
(98, 'Cloudy with a Chance of Meatballs', NULL, 'entities/thumbnails/cwc.jpg', 'entities/previews/4.mp4', 13, 'entities/videos/5.mp4', NULL, 2),
(99, 'District 9', NULL, 'entities/thumbnails/d9.jpg', 'entities/previews/5.mp4', 9, 'entities/videos/5.mp4', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `liked_media`
--

CREATE TABLE `liked_media` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liked_media`
--

INSERT INTO `liked_media` (`id`, `user_id`, `entity_id`) VALUES
(236, 15, 4),
(237, 15, 84),
(238, 16, 84);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_bio` longtext,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_bio`, `email`, `password`, `created_at`) VALUES
(15, 'karolina jasia', NULL, 'karolina.jasiak87@gmail.com', '$2y$10$EBCe3Sw2pxB1bWXqa1L0D.hqXxnMw40277AduGMVbj.QW.gvJOcqa', '2021-12-07 13:10:07'),
(16, 'Emanuele Mastaglia', NULL, 'emanuelemastaglia@gmail.com', '$2y$10$QL7xcmRAn6atwjJWUlypseSPrRE7PG8.FCTqN0jqw/J43tC4QQKUG', '2021-12-09 17:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `users_reset`
--

CREATE TABLE `users_reset` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recover_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_reset`
--

INSERT INTO `users_reset` (`id`, `user_id`, `recover_token`, `created_at`) VALUES
(2, 16, '83c27cffc700d5037d3b699d24554f31', '2021-12-10 11:23:05'),
(3, 16, 'b4a876eefc73dabe7057a7784b5e4e48', '2021-12-10 11:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `users_watch_list`
--

CREATE TABLE `users_watch_list` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `add_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_watch_list`
--

INSERT INTO `users_watch_list` (`id`, `entity_id`, `user_id`, `add_at`) VALUES
(2, 84, 16, '2021-12-10 10:24:19'),
(3, 81, 16, '2021-12-10 10:24:21'),
(4, 3, 16, '2021-12-10 11:16:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `connections_user`
--
ALTER TABLE `connections_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_connection` (`userId`);

--
-- Indexes for table `count_views`
--
ALTER TABLE `count_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ent_count` (`entity_id`),
  ADD KEY `fk_user_count` (`user_id`);

--
-- Indexes for table `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_ent` (`userId`),
  ADD KEY `fk_entities_categorie` (`categoryId`);

--
-- Indexes for table `liked_media`
--
ALTER TABLE `liked_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_liked` (`user_id`),
  ADD KEY `fk_entity_watch_like` (`entity_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_reset`
--
ALTER TABLE `users_reset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_reset` (`user_id`);

--
-- Indexes for table `users_watch_list`
--
ALTER TABLE `users_watch_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entity_watch_list` (`entity_id`),
  ADD KEY `fk_users_watch_list` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `connections_user`
--
ALTER TABLE `connections_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `count_views`
--
ALTER TABLE `count_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `entities`
--
ALTER TABLE `entities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `liked_media`
--
ALTER TABLE `liked_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_reset`
--
ALTER TABLE `users_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_watch_list`
--
ALTER TABLE `users_watch_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `connections_user`
--
ALTER TABLE `connections_user`
  ADD CONSTRAINT `fk_users_connection` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `count_views`
--
ALTER TABLE `count_views`
  ADD CONSTRAINT `fk_ent_count` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_count` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `entities`
--
ALTER TABLE `entities`
  ADD CONSTRAINT `fk_entities_categorie` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_ent` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `liked_media`
--
ALTER TABLE `liked_media`
  ADD CONSTRAINT `fk_entity_watch_like` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_liked` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_reset`
--
ALTER TABLE `users_reset`
  ADD CONSTRAINT `fk_users_reset` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users_watch_list`
--
ALTER TABLE `users_watch_list`
  ADD CONSTRAINT `fk_entity_watch_list` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `ud` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
