-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 02 2017 г., 07:10
-- Версия сервера: 10.0.27-MariaDB
-- Версия PHP: 5.6.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `airport`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `fio` varchar(256) DEFAULT NULL,
  `login` varchar(64) DEFAULT NULL,
  `pass` varchar(64) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `priv` int(1) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `tel` varchar(32) DEFAULT NULL,
  `last_time` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `pass`, `status`, `priv`, `email`, `tel`, `last_time`) VALUES
(34, 'Администратор', 'admin', '356a192b7913b04c54574d18c28d46e6395428ab', 1, 0, 'sabashlive@gmail.com', '----', '2017-04-06 20:51:50'),
(35, 'Сергеев Артём Николаевич', 'U2', '356a192b7913b04c54574d18c28d46e6395428ab', 1, 2, 'sabashlive@gmail.com', '123', '2016-10-03 11:19:29'),
(36, 'Каплин Сергей Вячеславович', 'U', '356a192b7913b04c54574d18c28d46e6395428ab', 1, 2, 'sabashlive@gmail.com', '123', '2016-09-09 14:37:27'),
(38, 'Координатор', 'K', '356a192b7913b04c54574d18c28d46e6395428ab', 1, 1, 'sabashlive@gmail.com', '123', '2016-09-28 09:57:59'),
(42, 'Гришкова Алла Михайловна', 'U3', '356a192b7913b04c54574d18c28d46e6395428ab', 1, 2, 'sabashlive@gmail.com', '123', '2016-06-08 11:21:52'),
(44, 'Исполнитель', 'I', '0822e8ed92c42f678825aa67e6b1f8e130941230', 1, 2, 'sabashlive@gmail.com', '123', '2016-05-30 11:58:21');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
