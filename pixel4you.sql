-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Ne 11.Jan 2015, 13:33
-- Verzia serveru: 5.6.13
-- Verzia PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `pixel4you`
--
CREATE DATABASE IF NOT EXISTS `pixel4you` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovak_ci;
USE `pixel4you`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL COMMENT 'id of author of album',
  `name` varchar(70) COLLATE utf8_slovak_ci NOT NULL COMMENT 'name of album',
  `date` date NOT NULL COMMENT 'date of album creation ',
  `public` tinyint(1) NOT NULL COMMENT 'album publicity',
  `describtion` text COLLATE utf8_slovak_ci NOT NULL,
  `likes` int(11) NOT NULL COMMENT 'number of likes ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='vsetky albumy pouzivatelov' AUTO_INCREMENT=3 ;

--
-- Sťahujem dáta pre tabuľku `albums`
--

INSERT INTO `albums` (`id`, `author`, `name`, `date`, `public`, `describtion`, `likes`) VALUES
(1, 1, 'Martin', '2015-01-07', 1, 'Obrzky profilu', 0),
(2, 2, 'Jan', '2015-01-07', 1, 'Obrzky profilu', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) COLLATE utf8_slovak_ci NOT NULL,
  `subcategory` varchar(70) COLLATE utf8_slovak_ci NOT NULL,
  `describtion` text COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=17 ;

--
-- Sťahujem dáta pre tabuľku `category`
--

INSERT INTO `category` (`id`, `name`, `subcategory`, `describtion`) VALUES
(1, 'Ostatné', 'Ostatné', ''),
(2, 'Auto-moto', 'Tech', ''),
(3, 'PC', 'Tech', ''),
(4, 'Mobile', 'Tech', ''),
(5, 'Wallpapery', 'Tech', ''),
(6, '3D', 'Digital Art', ''),
(7, 'Animácie', 'Digital Art', ''),
(8, 'Kreslenie', 'Digital Art', ''),
(10, 'Text Art', 'Digital Art', ''),
(11, 'Vector', 'Digital Art', ''),
(12, 'Typography', 'Digital Art', ''),
(13, 'Ľudia a Portréty', 'Fotografia', ''),
(14, 'Macro', 'Fotografia', ''),
(15, 'Príroda', 'Fotografia', ''),
(16, 'Architektúra', 'Fotografia', '');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id of image',
  `name` varchar(40) COLLATE utf8_slovak_ci NOT NULL COMMENT 'name of image',
  `path` varchar(70) COLLATE utf8_slovak_ci NOT NULL COMMENT 'image path in server filesystem ',
  `thumb` varchar(70) COLLATE utf8_slovak_ci NOT NULL,
  `owner` int(11) NOT NULL COMMENT 'id of owner',
  `author` varchar(70) COLLATE utf8_slovak_ci NOT NULL,
  `date` date NOT NULL COMMENT 'datum pridania polozky ',
  `type` varchar(30) COLLATE utf8_slovak_ci NOT NULL COMMENT 'type of image',
  `size` int(11) NOT NULL COMMENT 'size of image',
  `describtion` text COLLATE utf8_slovak_ci NOT NULL COMMENT 'describtion of image',
  `category` varchar(70) COLLATE utf8_slovak_ci NOT NULL,
  `likes` int(11) NOT NULL COMMENT 'number of likes by other users',
  `downloads` int(11) NOT NULL,
  `comments` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='tabulka obsahujuca vsetky nahravane obrazky' AUTO_INCREMENT=8 ;

--
-- Sťahujem dáta pre tabuľku `uploads`
--

INSERT INTO `uploads` (`id`, `name`, `path`, `thumb`, `owner`, `author`, `date`, `type`, `size`, `describtion`, `category`, `likes`, `downloads`, `comments`) VALUES
(1, '', './uploads/54ad7dd4a0431.jpg', './uploads/thumbs/54ad7dd4a0431.jpg', 1, 'ventill', '2015-01-07', 'jpg', 1272055, 'Obrázok profilu', '1', 0, 0, 0),
(2, 'tree', './uploads/54ad7e5810f9c.jpg', './uploads/thumbs/54ad7e5810f9c.jpg', 1, 'ventill', '2015-01-07', 'jpg', 544974, '', '1', 0, 0, 0),
(3, '2011-eleanor', './uploads/54ad7e717d471.jpg', './uploads/thumbs/54ad7e717d471.jpg', 1, 'ventill', '2015-01-07', 'jpg', 114389, '', '2', 0, 0, 0),
(4, 'dark house', './uploads/54ad801ed8869.jpg', './uploads/thumbs/54ad801ed8869.jpg', 1, 'ventill', '2015-01-07', 'jpg', 103446, '', '1', 0, 0, 0),
(5, '', './uploads/54ad99115d0cd.jpg', './uploads/thumbs/54ad99115d0cd.jpg', 1, 'janci', '2015-01-07', 'jpg', 1402570, 'Obrázok profilu', '1', 0, 0, 0),
(6, 'girl', './uploads/54ad992556ca7.jpg', './uploads/thumbs/54ad992556ca7.jpg', 2, 'janci', '2015-01-07', 'jpg', 471104, '', '1', 0, 0, 0),
(7, 'ANDROID', './uploads/54ad99354b0c6.jpg', './uploads/thumbs/54ad99354b0c6.jpg', 2, 'janci', '2015-01-07', 'jpg', 573741, '', '1', 0, 0, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `passwd` varchar(32) COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `surname` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `bio` text COLLATE utf8_slovak_ci NOT NULL,
  `websites` text COLLATE utf8_slovak_ci NOT NULL,
  `birthdate` date NOT NULL,
  `regdate` date NOT NULL COMMENT 'date of user registration',
  `image` varchar(70) COLLATE utf8_slovak_ci NOT NULL DEFAULT '/img/default_profile_image.png' COMMENT 'profile image path',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='tabulka vsetkych uzivatelov' AUTO_INCREMENT=3 ;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `login`, `passwd`, `email`, `name`, `surname`, `bio`, `websites`, `birthdate`, `regdate`, `image`) VALUES
(1, 'ventill', '4c6cab20c8f4b314af40bb9c30803c45', 'martin.krasnan@gmail.com', 'Martin', 'Krasňan', '', 'www.pixel4ypu.sk', '2015-01-07', '2015-01-07', './uploads/54ad7dd4a0431.jpg'),
(2, 'janci', '6a204bd89f3c8348afd5c77c717a097a', 'jan.zitnak@gmail.com', 'Jan', 'Zitnak', '', 'www.pixel4ypu.sk', '2015-01-07', '2015-01-07', './uploads/54ad99115d0cd.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
