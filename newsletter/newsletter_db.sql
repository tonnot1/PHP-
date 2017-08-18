-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 18, 2017 at 03:24 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsletter_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `login`, `password`, `nom`, `prenom`, `created_at`) VALUES
(1, 'toto@gmail.com', 'tata', '4ea348ebd818e67772cb0086d44dc1b57ba54129', 'ta', 'ram', '2017-06-02 06:00:00'),
(2, 'kiki@hotmail.fr', 'rage', '31aba3fc66af08bf46c7eec0780d45e78f7531e9', '', 'marche', '2017-06-05 11:17:18'),
(3, 'tamouch@hotmail.com', 'fer', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', '', 'om', '2017-06-05 11:21:43'),
(4, 'pica@gmail.com', 'fdd', '84928d66629073e49590c6a6ac7efa903a2d3b2c', '', 'qff', '2017-06-05 11:28:33'),
(5, 'ui@gmail.com', 'ss', '6b2a3b5b3e2ee9ad268a79f6f997768f020dd873', '', 'mla', '2017-06-05 11:38:13'),
(6, 'mui@gmail.com', 'ssj', '000646dd8781c61a868b475c806418de5c853906', '', 'mlaf', '2017-06-05 11:39:48'),
(7, 'kkk@free.fr', 'tue', '4cfd9de5754f313fb1e3190df7e4e067f5c9336d', '', 'sshzz', '2017-06-05 11:40:38'),
(8, 'op@gmail.com', 'oouiy', 'd4cff0e1e48f61376ef3a42d42c305e1d0dcff4e', '', 'wvn', '2017-06-05 11:42:20'),
(9, 'tyuj@gmail.com', 'tyu', '0ba8d9c4ef5e3f09e40b1fded018c9ff347bcb7f', '', 'nbvc', '2017-06-05 11:43:24'),
(10, 'bvfdeze@gmail.com', 'trezaa', '7418c7a9a7379dec376985846db4de0e25a017ff', '', 'sdjhsdhjshd', '2017-06-05 11:44:00'),
(11, 'njksvdjksvd@gmail.com', 'mfjklhdjsg', 'a9fc03931d3e3ae8340f3aef9c9840727314dda4', '', 'gjidshfqg', '2017-06-05 11:46:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
