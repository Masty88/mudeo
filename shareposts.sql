-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 18 nov. 2021 à 19:51
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `shareposts`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Action & adventure'),
(2, 'Classic'),
(3, 'Comedies'),
(4, 'Dramas'),
(5, 'Horror'),
(6, 'Romantic'),
(7, 'Sci - Fi & Fantasy'),
(8, 'Sports'),
(9, 'Thrillers'),
(10, 'Documentaries'),
(12, 'Teen'),
(13, 'Children & family'),
(14, 'Anime'),
(15, 'Independent'),
(16, 'Foreign'),
(17, 'Music'),
(18, 'Christmas'),
(19, 'Others'),
(20, 'Cartoon');

-- --------------------------------------------------------

--
-- Structure de la table `connections_user`
--

CREATE TABLE `connections_user` (
  `id` int(11) NOT NULL,
  `remembertoken` varchar(250) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `connections_user`
--

INSERT INTO `connections_user` (`id`, `remembertoken`, `userId`) VALUES
(1, '618a7a29aec1b', 9),
(2, '618a7a5f90c96', 9),
(3, '618a8000a1580', 9),
(4, '618a87f8be66b', 9),
(5, '618a89d703171', 9),
(7, '618b75b78a93b', 9),
(9, '618be2983e0b1', 9),
(12, '6193707975c7c', 9),
(14, '619370e655add', 9),
(16, '619372b2b9f77', 9),
(17, '6194dce6267c6', 9),
(18, '6194dd15793f2', 11),
(19, '6194f718a00e7', 9),
(20, '6196821c19168', 9);

-- --------------------------------------------------------

--
-- Structure de la table `entities`
--

CREATE TABLE `entities` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `preview` varchar(250) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entities`
--

INSERT INTO `entities` (`id`, `name`, `description`, `thumbnail`, `preview`, `categoryId`, `userId`) VALUES
(3, 'The Simpsons', NULL, 'entities/thumbnails/thesimpsons.jpg', 'entities/previews/6.mp4', 20, NULL),
(4, 'Toy Story', NULL, 'entities/thumbnails/toystory.jpg', 'entities/previews/1.mp4', 13, NULL),
(45, 'Inbetweeners', NULL, 'entities/thumbnails/inbetw.jpg', 'entities/previews/2.mp4', 3, NULL),
(46, 'Suits', NULL, 'entities/thumbnails/Suits.jpg', 'entities/previews/3.mp4', 4, NULL),
(47, 'Captain Underpants', NULL, 'entities/thumbnails/cu.jpg', 'entities/previews/4.mp4', 13, NULL),
(48, 'Brooklyn Nine-Nine', NULL, 'entities/thumbnails/bnn.jpg', 'entities/previews/5.mp4', 3, NULL),
(49, 'That 70s Show', NULL, 'entities/thumbnails/tss.jpg', 'entities/previews/6.mp4', 3, NULL),
(50, 'Pokemon', NULL, 'entities/thumbnails/pok.jpg', 'entities/previews/2.mp4', 20, NULL),
(51, 'Spongebob Squarepants', NULL, 'entities/thumbnails/sbsp.jpg', 'entities/previews/3.mp4', 20, NULL),
(52, 'Futurama', NULL, 'entities/thumbnails/fut.jpg', 'entities/previews/1.mp4', 20, NULL),
(53, 'Johnny Bravo', NULL, 'entities/thumbnails/jb.jpg', 'entities/previews/4.mp4', 20, NULL),
(54, 'Teenage Mutant Ninja Turtles', NULL, 'entities/thumbnails/ninj.jpg', 'entities/previews/5.mp4', 20, NULL),
(55, 'Power Puff Girls', NULL, 'entities/thumbnails/ppg.jpg', 'entities/previews/6.mp4', 20, NULL),
(56, 'Teen Titans Go', NULL, 'entities/thumbnails/ttg.jpg', 'entities/previews/2.mp4', 20, NULL),
(57, 'Jurassic Park', NULL, 'entities/thumbnails/jp.jpg', 'entities/previews/3.mp4', 9, NULL),
(58, 'Grease', NULL, 'entities/thumbnails/grease.jpg', 'entities/previews/4.mp4', 17, NULL),
(59, 'Paddington Bear', NULL, 'entities/thumbnails/pb.jpg', 'entities/previews/5.mp4', 13, NULL),
(60, 'Santa Clause', NULL, 'entities/thumbnails/santa.jpg', 'entities/previews/1.mp4', 18, NULL),
(61, 'Monster Family', NULL, 'entities/thumbnails/monsterfamily.jpg', 'entities/previews/6.mp4', 13, NULL),
(62, 'Top Gun', NULL, 'entities/thumbnails/tg.jpg', 'entities/previews/2.mp4', 1, NULL),
(63, 'Home Alone', NULL, 'entities/thumbnails/ha.jpg', 'entities/previews/3.mp4', 18, NULL),
(64, 'The Grinch', NULL, 'entities/thumbnails/gr.jpg', 'entities/previews/4.mp4', 18, NULL),
(65, 'National Lampoon\'s Christmas Vacation', NULL, 'entities/thumbnails/la.jpg', 'entities/previews/5.mp4', 18, NULL),
(66, 'Elf', NULL, 'entities/thumbnails/elf.jpg', 'entities/previews/6.mp4', 18, NULL),
(67, 'Fred Claus', NULL, 'entities/thumbnails/fc.jpg', 'entities/previews/2.mp4', 18, NULL),
(68, 'Jaws', NULL, 'entities/thumbnails/jaws.jpg', 'entities/previews/3.mp4', 9, NULL),
(69, 'Live Die Repeat', NULL, 'entities/thumbnails/ldr.jpg', 'entities/previews/4.mp4', 9, NULL),
(70, 'Into the Storm', NULL, 'entities/thumbnails/its.jpg', 'entities/previews/1.mp4', 9, NULL),
(81, 'Mission Impossible', NULL, 'entities/thumbnails/mi.jpg', 'entities/previews/5.mp4', 1, NULL),
(82, 'Never Back Down', NULL, 'entities/thumbnails/nbd.jpg', 'entities/previews/6.mp4', 1, NULL),
(83, 'Mechanic', NULL, 'entities/thumbnails/mec.jpg', 'entities/previews/2.mp4', 1, NULL),
(84, 'Need for Speed', NULL, 'entities/thumbnails/nfs.jpg', 'entities/previews/3.mp4', 1, NULL),
(85, 'Gravity', NULL, 'entities/thumbnails/gra.jpg', 'entities/previews/4.mp4', 7, NULL),
(86, 'Step Brothers', NULL, 'entities/thumbnails/sb.jpg', 'entities/previews/5.mp4', 3, NULL),
(87, 'Game of Thrones', NULL, 'entities/thumbnails/got.jpg', 'entities/previews/1.mp4', 4, NULL),
(88, 'Dark Money', NULL, 'entities/thumbnails/dm.jpg', 'entities/previews/6.mp4', 4, NULL),
(89, 'Yellowstone', NULL, 'entities/thumbnails/yel.jpg', 'entities/previews/2.mp4', 4, NULL),
(90, 'Manifest', NULL, 'entities/thumbnails/man.jpg', 'entities/previews/3.mp4', 4, NULL),
(91, 'The Sound of Music', NULL, 'entities/thumbnails/som.jpg', 'entities/previews/4.mp4', 17, NULL),
(92, 'Hairspray', NULL, 'entities/thumbnails/hs.jpg', 'entities/previews/1.mp4', 17, NULL),
(93, 'Believe', NULL, 'entities/thumbnails/bel.jpg', 'entities/previews/5.mp4', 17, NULL),
(94, 'Chris Brown: Till I Die', NULL, 'entities/thumbnails/tid.jpg', 'entities/previews/6.mp4', 17, NULL),
(95, 'Men in Black', NULL, 'entities/thumbnails/mib.jpg', 'entities/previews/2.mp4', 7, NULL),
(96, 'Interstellar', NULL, 'entities/thumbnails/int.jpg', 'entities/previews/3.mp4', 7, NULL),
(97, 'Transformers', NULL, 'entities/thumbnails/tra.jpg', 'entities/previews/1.mp4', 7, NULL),
(98, 'Cloudy with a Chance of Meatballs', NULL, 'entities/thumbnails/cwc.jpg', 'entities/previews/4.mp4', 13, NULL),
(99, 'District 9', NULL, 'entities/thumbnails/d9.jpg', 'entities/previews/5.mp4', 9, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `liked_media`
--

CREATE TABLE `liked_media` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `liked_media`
--

INSERT INTO `liked_media` (`id`, `user_id`, `entity_id`) VALUES
(178, 11, 84),
(179, 11, 81),
(181, 11, 62),
(185, 11, 3),
(186, 11, 83),
(187, 11, 86),
(188, 11, 58),
(189, 11, 4),
(190, 11, 60),
(191, 11, 59),
(192, 11, 56);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`) VALUES
(3, 8, 'Post One', 'Test one', '2021-11-04 11:06:47'),
(4, 8, '2', 'sqsqsqsq', '2021-11-04 11:08:24'),
(5, 8, '', '', '2021-11-04 12:36:44');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(9, 'karolina jasiak', 'karolina.jasiak87@gmail.com', '$2y$10$k2HSr/FntnH43UC3NPGBve2jHZgRDrkzR6BGPqTY6xdRKuLHBgM7O', '2021-10-20 09:49:05'),
(11, 'Ema', 'emanuelemastaglia@gmail.com', '$2y$10$ExEjYkmxiwtoFD.0t/2Ti.VvjRXl9PSoAq9VvzN1bZG1LkzlltsgK', '2021-11-17 11:44:31');

-- --------------------------------------------------------

--
-- Structure de la table `users_watch_list`
--

CREATE TABLE `users_watch_list` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `add_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users_watch_list`
--

INSERT INTO `users_watch_list` (`id`, `entity_id`, `user_id`, `add_at`) VALUES
(246, 82, 9, '2021-11-17 17:19:45'),
(255, 65, 11, '2021-11-18 15:34:41'),
(256, 48, 11, '2021-11-18 15:34:42'),
(258, 62, 11, '2021-11-18 16:16:35'),
(259, 83, 11, '2021-11-18 16:16:57'),
(261, 58, 11, '2021-11-18 16:19:01'),
(262, 56, 11, '2021-11-18 16:21:55'),
(263, 92, 11, '2021-11-18 16:24:10'),
(264, 3, 11, '2021-11-18 16:28:00'),
(266, 4, 11, '2021-11-18 16:30:34'),
(267, 59, 11, '2021-11-18 19:45:48');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `connections_user`
--
ALTER TABLE `connections_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_connection` (`userId`);

--
-- Index pour la table `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entities_ibfk_1` (`userId`);

--
-- Index pour la table `liked_media`
--
ALTER TABLE `liked_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_liked` (`user_id`),
  ADD KEY `fk_entity_watch_like` (`entity_id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_watch_list`
--
ALTER TABLE `users_watch_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entity_watch_list` (`entity_id`),
  ADD KEY `fk_users_watch_list` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `connections_user`
--
ALTER TABLE `connections_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `entities`
--
ALTER TABLE `entities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT pour la table `liked_media`
--
ALTER TABLE `liked_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users_watch_list`
--
ALTER TABLE `users_watch_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `connections_user`
--
ALTER TABLE `connections_user`
  ADD CONSTRAINT `fk_users_connection` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `entities`
--
ALTER TABLE `entities`
  ADD CONSTRAINT `entities_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `liked_media`
--
ALTER TABLE `liked_media`
  ADD CONSTRAINT `fk_entity_watch_like` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_liked` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users_watch_list`
--
ALTER TABLE `users_watch_list`
  ADD CONSTRAINT `fk_entity_watch_list` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_watch_list` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
