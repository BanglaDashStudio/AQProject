-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 31 2015 г., 22:24
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `aquest`
--

-- --------------------------------------------------------

--
-- Структура таблицы `code`
--

CREATE TABLE IF NOT EXISTS `code` (
  `IdCode` int(11) NOT NULL AUTO_INCREMENT,
  `IdTask` int(11) NOT NULL,
  `Cod` int(11) NOT NULL,
  `SendCode` tinyint(1) DEFAULT NULL,
  `IdTeam` int(11) NOT NULL,
  PRIMARY KEY (`IdCode`),
  UNIQUE KEY `IdTeam` (`IdTeam`),
  KEY `IdTask` (`IdTask`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `IdGame` int(11) NOT NULL,
  `NameGame` text NOT NULL,
  `DescriptionGame` text NOT NULL,
  `IdTeam` int(11) NOT NULL,
  `IdType` int(11) NOT NULL,
  `StartGame` time NOT NULL,
  `FinishGame` time NOT NULL,
  `Comment` text NOT NULL,
  `AcceptGame` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdGame`),
  UNIQUE KEY `IdTeam` (`IdTeam`,`IdType`),
  UNIQUE KEY `IdType` (`IdType`),
  KEY `IdGame` (`IdGame`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `gameteam`
--

CREATE TABLE IF NOT EXISTS `gameteam` (
  `IdGameteam` int(11) NOT NULL AUTO_INCREMENT,
  `IdGame` int(11) NOT NULL,
  `IdTeam` int(11) NOT NULL,
  PRIMARY KEY (`IdGameteam`),
  UNIQUE KEY `IdGame` (`IdGame`),
  UNIQUE KEY `IdTeam` (`IdTeam`),
  UNIQUE KEY `IdTeam_2` (`IdTeam`),
  UNIQUE KEY `IdTeam_3` (`IdTeam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `grid`
--

CREATE TABLE IF NOT EXISTS `grid` (
  `IdGrid` int(11) NOT NULL AUTO_INCREMENT,
  `IdTeam` int(11) NOT NULL,
  `IdTask` int(11) NOT NULL,
  `OrderGrid` int(11) NOT NULL,
  `IdGame` int(11) NOT NULL,
  `Time` time NOT NULL,
  PRIMARY KEY (`IdGrid`),
  UNIQUE KEY `IdTeam` (`IdTeam`),
  UNIQUE KEY `IdTask` (`IdTask`),
  UNIQUE KEY `IdGame` (`IdGame`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `hint`
--

CREATE TABLE IF NOT EXISTS `hint` (
  `IdHint` int(11) NOT NULL AUTO_INCREMENT,
  `IdTask` int(11) NOT NULL,
  `DescriptionHint` text NOT NULL,
  `Number` int(11) NOT NULL,
  PRIMARY KEY (`IdHint`),
  UNIQUE KEY `IdTask` (`IdTask`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `IdResult` int(11) NOT NULL AUTO_INCREMENT,
  `IdTeam` int(11) NOT NULL,
  `TimeTeam` time NOT NULL,
  `NumberTask` int(11) NOT NULL,
  `PlaceTeam` int(11) NOT NULL,
  `RatingTeam` int(11) NOT NULL,
  `PointgameTeam` int(11) NOT NULL,
  `PointTeam` int(11) NOT NULL,
  PRIMARY KEY (`IdResult`),
  UNIQUE KEY `IdTeam` (`IdTeam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `IdTask` int(11) NOT NULL,
  `NameTask` text NOT NULL,
  `DescriptionTask` text NOT NULL,
  `IdType` int(11) NOT NULL,
  PRIMARY KEY (`IdTask`),
  UNIQUE KEY `IdTask` (`IdTask`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `IdTeam` int(11) NOT NULL,
  `NameTeam` text NOT NULL,
  `DescriptionTeam` text NULL,
  `EmailTeam` text NULL,
  `PasswordTeam` text NOT NULL,
  `PageTeam` text NULL,
  `PhoneTeam` text NOT NULL,
  `IdGame` int(11) NULL,
  PRIMARY KEY (`IdTeam`),
  UNIQUE KEY `IdGame` (`IdGame`),
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `IdType` int(11) NOT NULL AUTO_INCREMENT,
  `NameType` int(11) NOT NULL,
  `FormatType` time NOT NULL,
  PRIMARY KEY (`IdType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
