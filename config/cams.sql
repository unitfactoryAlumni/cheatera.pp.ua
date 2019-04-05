-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: mysql:3306
-- Время создания: Апр 05 2019 г., 18:37
-- Версия сервера: 5.7.25
-- Версия PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cams`
--
CREATE TABLE `cams` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) DEFAULT NULL,
  `cam_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cams`
--

INSERT INTO `cams` (`area_name`, `cam_address`) VALUES
('Cantina', 'https://marvin.unit.ua/assets/cams/103.jpg'),
('Playground', 'https://marvin.unit.ua/assets/cams/104.jpg'),
('Multiverse', 'https://marvin.unit.ua/assets/cams/209.jpg'),
('Dungeon', 'https://marvin.unit.ua/assets/cams/013.jpg'),
('Backyard', 'https://marvin.unit.ua/assets/cams/144.jpg'),
('Macaques', 'https://zssd-baboon.preview.api.camzonecdn.com/previewimage');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
