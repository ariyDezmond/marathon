-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 24 2015 г., 21:42
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `marathon`
--
CREATE DATABASE IF NOT EXISTS `marathon` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `marathon`;

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `cValue` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`ID`, `cValue`) VALUES
(1, 'Кыргызстан'),
(2, 'Россия'),
(3, 'Казахстан'),
(4, 'Япония'),
(5, 'Франция');

-- --------------------------------------------------------

--
-- Структура таблицы `distance`
--

DROP TABLE IF EXISTS `distance`;
CREATE TABLE IF NOT EXISTS `distance` (
  `ID` int(11) NOT NULL,
  `dValue` varchar(255) NOT NULL,
  `counter` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `distance`
--

INSERT INTO `distance` (`ID`, `dValue`, `counter`) VALUES
(1, 'Марафон', 31),
(2, 'Полумарафон', 4),
(3, 'Quart Marathon', 9),
(4, 'Детский марафон', 1),
(5, 'None Marathon', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `gender`
--

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `gValue` varchar(8) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `gender`
--

INSERT INTO `gender` (`ID`, `gValue`) VALUES
(1, 'женский'),
(2, 'мужской');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `bDate` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `distance` int(11) NOT NULL,
  `country` int(255) NOT NULL,
  `runner_id` int(11) NOT NULL,
  `tag` text NOT NULL,
  `cDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `name`, `surname`, `bDate`, `email`, `gender`, `tel`, `distance`, `country`, `runner_id`, `tag`, `cDate`) VALUES
(1, 'Lol', 'Makarych', '1975-01-05', 'Lol@Makarych.com', '2', '595686', 1, 3, 1019, 'Lol,Makarych,1975-01-05,595686,Lol@Makarych.com,Казахстан,Марафон,мужской,1019,', '2015-03-24 17:31:57'),
(2, 'Elena', 'Fignyaeva', '1965-11-25', 'Elena@Fignyaeva.com', '1', '622076', 2, 2, 2001, 'Elena,Fignyaeva,1965-11-25,622076,Elena@Fignyaeva.com,Россия,Полумарафон,женский,2001,', '2015-03-24 17:32:00'),
(3, 'Dmitriy', 'Lolov', '1991-05-23', 'Dmitriy@Lolov.com', '2', '253419', 3, 3, 3001, 'Dmitriy,Lolov,1991-05-23,253419,Dmitriy@Lolov.com,Казахстан,Quart Marathon,мужской,3001,', '2015-03-24 17:38:55'),
(4, 'Eugeniy', 'Olegov', '1984-06-03', 'Eugeniy@Olegov.com', '2', '932742', 4, 3, 4001, 'Eugeniy,Olegov,1984-06-03,932742,Eugeniy@Olegov.com,Казахстан,Детский марафон,мужской,4001,', '2015-03-24 17:54:21'),
(5, 'Aleksandr', 'Olegov', '1975-01-05', 'Aleksandr@Olegov.com', '2', '231898', 1, 1, 1020, 'Aleksandr,Olegov,1975-01-05,231898,Aleksandr@Olegov.com,Кыргызстан,Марафон,мужской,1020,', '2015-03-24 17:55:19'),
(6, 'Lol', 'Aleksandrov', '1991-05-23', 'Lol@Aleksandrov.com', '2', '276456', 2, 3, 2002, 'Lol,Aleksandrov,1991-05-23,276456,Lol@Aleksandrov.com,Казахстан,Полумарафон,мужской,2002,', '2015-03-24 17:55:53'),
(7, 'Dmitriy', 'Aleksandrov', '1965-11-25', 'Dmitriy@Aleksandrov.com', '2', '511047', 2, 3, 2003, 'Dmitriy,Aleksandrov,1965-11-25,511047,Dmitriy@Aleksandrov.com,Казахстан,Полумарафон,мужской,2003,', '2015-03-24 17:57:36'),
(8, 'Elena', 'Lolova', '1965-11-25', 'Elena@Lolova.com', '1', '360667', 2, 2, 2004, 'Elena,Lolova,1965-11-25,360667,Elena@Lolova.com,Россия,Полумарафон,женский,2004,', '2015-03-24 17:58:12'),
(9, 'Elena', 'Aleksandrova', '1975-01-05', 'Elena@Aleksandrova.com', '1', '139811', 1, 1, 1021, 'Elena,Aleksandrova,1975-01-05,139811,Elena@Aleksandrova.com,Кыргызстан,Марафон,женский,1021,', '2015-03-24 17:59:54'),
(10, 'Fignya', 'Lolov', '1965-11-25', 'Fignya@Lolov.com', '2', '797032', 3, 2, 3002, 'Fignya,Lolov,1965-11-25,797032,Fignya@Lolov.com,Россия,Quart Marathon,мужской,3002,', '2015-03-24 18:00:44'),
(11, 'Fignya', 'Lolov', '1965-11-25', 'Fignya@Lolov.com', '2', '797032', 3, 2, 3003, 'Fignya,Lolov,1965-11-25,797032,Fignya@Lolov.com,Россия,Quart Marathon,мужской,3003,', '2015-03-24 18:00:46'),
(12, 'Fignya', 'Lolov', '1965-11-25', 'Fignya@Lolov.com', '2', '797032', 3, 2, 3004, 'Fignya,Lolov,1965-11-25,797032,Fignya@Lolov.com,Россия,Quart Marathon,мужской,3004,', '2015-03-24 18:00:48'),
(13, 'Fignya', 'Lolov', '1965-11-25', 'Fignya@Lolov.com', '2', '797032', 3, 2, 3005, 'Fignya,Lolov,1965-11-25,797032,Fignya@Lolov.com,Россия,Quart Marathon,мужской,3005,', '2015-03-24 18:00:50'),
(14, 'Fignya', 'Lolov', '1965-11-25', 'Fignya@Lolov.com', '2', '797032', 3, 2, 3006, 'Fignya,Lolov,1965-11-25,797032,Fignya@Lolov.com,Россия,Quart Marathon,мужской,3006,', '2015-03-24 18:00:52'),
(15, 'Fignya', 'Lolov', '1965-11-25', 'Fignya@Lolov.com', '2', '797032', 3, 2, 3007, 'Fignya,Lolov,1965-11-25,797032,Fignya@Lolov.com,Россия,Quart Marathon,мужской,3007,', '2015-03-24 18:00:54'),
(16, 'Fignya', 'Lolov', '1965-11-25', 'Fignya@Lolov.com', '2', '797032', 3, 2, 3008, 'Fignya,Lolov,1965-11-25,797032,Fignya@Lolov.com,Россия,Quart Marathon,мужской,3008,', '2015-03-24 18:00:56'),
(17, 'Fignya', 'Lolov', '1965-11-25', 'Fignya@Lolov.com', '2', '797032', 3, 2, 3009, 'Fignya,Lolov,1965-11-25,797032,Fignya@Lolov.com,Россия,Quart Marathon,мужской,3009,', '2015-03-24 18:00:59'),
(18, 'Dmitriy', 'Makarych', '1985-11-25', 'Dmitriy@Makarych.com', '2', '493495', 1, 1, 1022, 'Dmitriy,Makarych,1985-11-25,493495,Dmitriy@Makarych.com,Кыргызстан,Марафон,мужской,1022,', '2015-03-24 18:06:35'),
(19, 'Dmitriy', 'Makarych', '1985-11-25', 'Dmitriy@Makarych.com', '2', '493495', 1, 1, 1023, 'Dmitriy,Makarych,1985-11-25,493495,Dmitriy@Makarych.com,Кыргызстан,Марафон,мужской,1023,', '2015-03-24 18:06:37'),
(20, 'Dmitriy', 'Makarych', '1985-11-25', 'Dmitriy@Makarych.com', '2', '493495', 1, 1, 1024, 'Dmitriy,Makarych,1985-11-25,493495,Dmitriy@Makarych.com,Кыргызстан,Марафон,мужской,1024,', '2015-03-24 18:06:39'),
(21, 'Dmitriy', 'Makarych', '1985-11-25', 'Dmitriy@Makarych.com', '2', '493495', 1, 1, 1025, 'Dmitriy,Makarych,1985-11-25,493495,Dmitriy@Makarych.com,Кыргызстан,Марафон,мужской,1025,', '2015-03-24 18:06:41'),
(22, 'Dmitriy', 'Makarych', '1985-11-25', 'Dmitriy@Makarych.com', '2', '493495', 1, 1, 1026, 'Dmitriy,Makarych,1985-11-25,493495,Dmitriy@Makarych.com,Кыргызстан,Марафон,мужской,1026,', '2015-03-24 18:06:43'),
(23, 'Dmitriy', 'Makarych', '1985-11-25', 'Dmitriy@Makarych.com', '2', '493495', 1, 1, 1027, 'Dmitriy,Makarych,1985-11-25,493495,Dmitriy@Makarych.com,Кыргызстан,Марафон,мужской,1027,', '2015-03-24 18:06:45'),
(24, 'Dmitriy', 'Makarych', '1985-11-25', 'Dmitriy@Makarych.com', '2', '493495', 1, 1, 1028, 'Dmitriy,Makarych,1985-11-25,493495,Dmitriy@Makarych.com,Кыргызстан,Марафон,мужской,1028,', '2015-03-24 18:06:47'),
(25, 'Dmitriy', 'Makarych', '1985-11-25', 'Dmitriy@Makarych.com', '2', '493495', 1, 1, 1029, 'Dmitriy,Makarych,1985-11-25,493495,Dmitriy@Makarych.com,Кыргызстан,Марафон,мужской,1029,', '2015-03-24 18:06:49'),
(26, 'Dmitriy', 'Makarych', '1985-11-25', 'Dmitriy@Makarych.com', '2', '493495', 1, 1, 1030, 'Dmitriy,Makarych,1985-11-25,493495,Dmitriy@Makarych.com,Кыргызстан,Марафон,мужской,1030,', '2015-03-24 18:06:51'),
(27, 'Petr', 'Lolov', '1984-10-15', 'Petr@Lolov.com', '2', '936666', 1, 1, 1031, 'Petr,Lolov,1984-10-15,936666,Petr@Lolov.com,Кыргызстан,Марафон,мужской,1031,', '2015-03-24 18:12:13');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
