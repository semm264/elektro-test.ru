-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 18 2020 г., 17:33
-- Версия сервера: 5.6.43
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `elektro-test_bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `article_id` int(10) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_context` varchar(255) NOT NULL,
  `article_preview` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`article_id`, `article_title`, `article_context`, `article_preview`) VALUES
(1, 'Как работает и зачем необходим стабилизатор напряжения1', 'Стабилизаторы ЭНЕРГОТЕХ - это устройства, которые разработаны с учетом реальных условий отечественных сетей электропитания, и способны удовлетворить требования самого изысканного потребителя.1', '/images/articles-img.jpg'),
(2, 'Как работает и зачем необходим стабилизатор напряжения2', 'Стабилизаторы ЭНЕРГОТЕХ - это устройства, которые разработаны с учетом реальных условий отечественных сетей электропитания, и способны удовлетворить требования самого изысканного потребителя.2', '/images/articles-img.jpg'),
(3, 'Заголовок3', 'Краткое описание3', '/images/articles-img.jpg'),
(4, 'Заголовок4', 'Краткое описание4', '/images/articles-img.jpg'),
(5, 'Заголовок', 'Краткое описание', '/images/articles-img.jpg'),
(6, 'Заголовок', 'Краткое описание', '/images/articles-img.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
