-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 14 2020 г., 10:48
-- Версия сервера: 5.7.23-24
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u1096922_tmk`
--

-- --------------------------------------------------------

--
-- Структура таблицы `zagolovok`
--

CREATE TABLE `zagolovok` (
  `id` int(11) NOT NULL,
  `number` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `zex` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_start` text NOT NULL,
  `date_finish` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `zagolovok`
--

INSERT INTO `zagolovok` (`id`, `number`, `zex`, `date_start`, `date_finish`, `status`) VALUES
(10, 'ÐÐ¾Ð¼ÐµÑ€ Ð·Ð°ÐºÐ°Ð·Ð°', 'Ð¦ÐµÑ…-Ð¿Ñ€Ð¾Ð¸Ð·Ð²Ð¾Ð´Ð¸Ñ‚ÐµÐ»ÑŒ', 'Ð”Ð°Ñ‚Ð° Ð½Ð°Ñ‡Ð°Ð»Ð°2', 'Ð”Ð°Ñ‚Ð° Ð¾ÐºÐ¾Ð½Ñ‡Ð°Ð½Ð¸Ñ2', 'Ð’ Ñ€Ð°Ð±Ð¾Ñ‚Ðµ');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `zagolovok`
--
ALTER TABLE `zagolovok`
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
