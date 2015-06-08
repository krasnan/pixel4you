-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Pi 24.Apr 2015, 14:20
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='vsetky albumy pouzivatelov' AUTO_INCREMENT=7 ;

--
-- Sťahujem dáta pre tabuľku `albums`
--

INSERT INTO `albums` (`id`, `author`, `name`, `date`, `public`, `describtion`, `likes`) VALUES
(1, 1, 'Martin', '2015-01-07', 1, 'Obrzky profilu', 0),
(2, 2, 'Jan', '2015-01-07', 1, 'Obrzky profilu', 0),
(3, 3, 'jojo', '2015-01-26', 1, 'Obrzky profilu', 0),
(4, 4, 'jojo', '2015-01-26', 1, 'Obrzky profilu', 0),
(5, 5, 'jojo', '2015-01-26', 1, 'Obrzky profilu', 0),
(6, 6, 'Kamil', '2015-02-10', 1, 'Obrzky profilu', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='tabulka obsahujuca vsetky nahravane obrazky' AUTO_INCREMENT=34 ;

--
-- Sťahujem dáta pre tabuľku `uploads`
--

INSERT INTO `uploads` (`id`, `name`, `path`, `thumb`, `owner`, `author`, `date`, `type`, `size`, `describtion`, `category`, `likes`, `downloads`, `comments`) VALUES
(1, '', './uploads/54ad7dd4a0431.jpg', './uploads/thumbs/54ad7dd4a0431.jpg', 1, 'ventill', '2015-01-07', 'jpg', 1272055, 'Obrázok profilu', '1', 11, 1, 0),
(2, 'tree', './uploads/54ad7e5810f9c.jpg', './uploads/thumbs/54ad7e5810f9c.jpg', 1, 'ventill', '2015-01-07', 'jpg', 544974, '', '1', 5, 18, 0),
(3, '2011-eleanor', './uploads/54ad7e717d471.jpg', './uploads/thumbs/54ad7e717d471.jpg', 1, 'ventill', '2015-01-07', 'jpg', 114389, '', '2', 3, 1, 0),
(4, 'dark house', './uploads/54ad801ed8869.jpg', './uploads/thumbs/54ad801ed8869.jpg', 1, 'ventill', '2015-01-07', 'jpg', 103446, '', '1', 58, 1, 0),
(5, '', './uploads/54ad99115d0cd.jpg', './uploads/thumbs/54ad99115d0cd.jpg', 1, 'janci', '2015-01-07', 'jpg', 1402570, 'Obrázok profilu', '1', 0, 0, 0),
(6, 'girl', './uploads/54ad992556ca7.jpg', './uploads/thumbs/54ad992556ca7.jpg', 2, 'janci', '2015-01-07', 'jpg', 471104, '', '1', 17, 1, 0),
(7, 'ANDROID', './uploads/54ad99354b0c6.jpg', './uploads/thumbs/54ad99354b0c6.jpg', 2, 'janci', '2015-01-07', 'jpg', 573741, '', '1', 0, 0, 0),
(8, 'jumping_dolphin-wallpaper-2400x1350', './uploads/54b2e3b623a3b.jpg', './uploads/thumbs/54b2e3b623a3b.jpg', 1, 'ventill', '2015-01-11', 'jpg', 615536, '', '1', 4, 0, 0),
(13, 'android wallpaper', './uploads/54c6a087aafe2.jpg', './uploads/thumbs/54c6a087aafe2.jpg', 1, 'ventill', '2015-01-26', 'jpg', 1385755, '', '1', 1, 0, 0),
(16, '', './uploads/54c6a35036a2f.jpg', './uploads/thumbs/54c6a35036a2f.jpg', 5, 'dezko', '2015-01-26', 'jpg', 250432, 'Obrázok profilu', '1', 0, 0, 0),
(17, '1920x1080-motocross-hd-wallpapers', './uploads/54d99d5a03769.jpg', './uploads/thumbs/54d99d5a03769.jpg', 1, 'ventill', '2015-02-10', 'jpg', 383920, '', '2', 6, 1, 0),
(18, '', './uploads/54da267cdec96.jpg', './uploads/thumbs/54da267cdec96.jpg', 6, 'kamil', '2015-02-10', 'jpg', 544974, 'Obrázok profilu', '1', 0, 0, 0),
(19, 'unix', './uploads/54da27bcdf49f.jpg', './uploads/thumbs/54da27bcdf49f.jpg', 6, 'kamil', '2015-02-10', 'jpg', 580980, '', '10', 0, 0, 0),
(20, '4b566dac80219blue-earth-wallpaper', './uploads/54dc910329907.jpg', './uploads/thumbs/54dc910329907.jpg', 6, 'kamil', '2015-02-12', 'jpg', 1390725, '', '1', 0, 0, 0),
(21, 'bike', './uploads/5536ce1b1d23c.jpg', './uploads/thumbs/5536ce1b1d23c.jpg', 7, 'dezko', '2015-04-21', 'jpg', 44276, 'evil undead', '2', 0, 0, 0),
(22, 'CS:S', './uploads/5537f63001c81.jpg', './uploads/thumbs/5537f63001c81.jpg', 1, 'ventill', '2015-04-22', 'jpg', 20013, 'counter strike source wallpaper', '3', 0, 0, 0),
(23, 'Obrázok profilu', './uploads/55383bacd84f1.jpg', './uploads/thumbs/55383bacd84f1.jpg', 1, 'ventill', '2015-04-23', 'jpg', 605126, 'Obrázok profilu', '1', 0, 0, 0),
(24, 'Obrázok profilu', './uploads/55383bdd79f56.jpg', './uploads/thumbs/55383bdd79f56.jpg', 1, 'ventill', '2015-04-23', 'jpg', 1278167, 'Obrázok profilu', '1', 0, 0, 0),
(25, 'ANDROID_KITKATa', './uploads/5539416295276.jpg', './uploads/thumbs/5539416295276.jpg', 1, 'ventill', '2015-04-23', 'jpg', 826293, 'a', '1', 0, 0, 0),
(26, 'htc wallpaper m8', './uploads/553947555d569.jpg', './uploads/thumbs/553947555d569.jpg', 1, 'ventill', '2015-04-23', 'jpg', 1578185, '', '5', 0, 0, 0),
(27, 'htc m8 wallpaper', './uploads/553947711c99d.jpg', './uploads/thumbs/553947711c99d.jpg', 1, 'ventill', '2015-04-23', 'jpg', 1260877, '', '5', 0, 0, 0),
(28, 'htc m8 wallpaper ', './uploads/5539478881c0f.jpg', './uploads/thumbs/5539478881c0f.jpg', 1, 'ventill', '2015-04-23', 'jpg', 1047844, '', '5', 0, 0, 0),
(29, 'htc m8 wallpaper ', './uploads/553948c29dc4f.jpg', './uploads/thumbs/553948c29dc4f.jpg', 1, 'ventill', '2015-04-23', 'jpg', 1521141, '', '5', 0, 0, 0),
(30, 'htc m8 wallpaper', './uploads/553948d2950e7.jpg', './uploads/thumbs/553948d2950e7.jpg', 1, 'ventill', '2015-04-23', 'jpg', 1152259, '', '5', 0, 0, 0),
(31, 'more oblaky ', './uploads/55394972132da.jpg', './uploads/thumbs/55394972132da.jpg', 1, 'ventill', '2015-04-23', 'jpg', 1690162, '', '15', 0, 0, 0),
(32, 'Obrázok profilu', './uploads/55394a7155585.jpg', './uploads/thumbs/55394a7155585.jpg', 1, 'ventill', '2015-04-23', 'jpg', 1059348, 'Obrázok profilu', '1', 0, 0, 0),
(33, 'dnb wallpaper', './uploads/55394a83c6b5d.jpg', './uploads/thumbs/55394a83c6b5d.jpg', 1, 'ventill', '2015-04-23', 'jpg', 132170, '', '5', 0, 0, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `passwd` varchar(130) COLLATE utf8_slovak_ci NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci COMMENT='tabulka vsetkych uzivatelov' AUTO_INCREMENT=8 ;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `login`, `passwd`, `email`, `name`, `surname`, `bio`, `websites`, `birthdate`, `regdate`, `image`) VALUES
(1, 'ventill', '4147601c8885ea48fda551c13ca45afcfa8e722c967f8f9172bb5130aeca79a7a37908c0617de57e6c475f00e66a23ce256cd09a6e7eb5a942d2d23027f829d1', 'martin.krasnan@gmail.com', 'Martin', 'Krasňan', 'volajake to info o mne ', 'www.pixel4ypu.sk', '2015-01-07', '2015-01-07', './uploads/55394a7155585.jpg'),
(2, 'janci', '4147601c8885ea48fda551c13ca45afcfa8e722c967f8f9172bb5130aeca79a7a37908c0617de57e6c475f00e66a23ce256cd09a6e7eb5a942d2d23027f829d1', 'jan.zitnak@gmail.com', 'Jan', 'Zitnak', '', 'www.pixel4ypu.sk', '2015-01-07', '2015-01-07', './uploads/54ad99115d0cd.jpg'),
(6, 'kamil', '4147601c8885ea48fda551c13ca45afcfa8e722c967f8f9172bb5130aeca79a7a37908c0617de57e6c475f00e66a23ce256cd09a6e7eb5a942d2d23027f829d1', 'kamil.maraz@gmail.com', 'Kamil', 'Maraz', 'info', 'www.pixel4ypu.sk', '2015-02-10', '2015-02-10', './uploads/54da267cdec96.jpg'),
(7, 'dezko', '4147601c8885ea48fda551c13ca45afcfa8e722c967f8f9172bb5130aeca79a7a37908c0617de57e6c475f00e66a23ce256cd09a6e7eb5a942d2d23027f829d1', 'dezko40@gmail.com', 'jojo', 'celko', '', 'www.pixel4ypu.sk', '2015-04-21', '2015-04-21', './img/default_profile_image.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
