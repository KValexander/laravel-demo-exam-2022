-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 03 2022 г., 15:01
-- Версия сервера: 10.3.29-MariaDB
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laravel-demo-exam-2022`
--
CREATE DATABASE IF NOT EXISTS `laravel-demo-exam-2022` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `laravel-demo-exam-2022`;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `category`, `updated_at`, `created_at`) VALUES
(1, 'Лазерный принтер', '2022-06-03 11:43:57', '2022-06-03 11:43:57'),
(2, 'Струйный принтер', '2022-06-03 11:43:57', '2022-06-03 11:43:57'),
(3, 'Термопринтер', '2022-06-03 11:43:57', '2022-06-03 11:43:57');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `country`, `year`, `model`, `category`, `count`, `path`, `created_at`, `updated_at`) VALUES
(1, 'Принтер', 100, 'Россия', 2022, 'Модель', 'Лазерный принтер', 0, 'logo/logo.png', '2022-06-02 11:17:17', '2022-06-03 07:57:13'),
(2, 'Обычный Принтер', 100, 'Россия', 2022, 'Модель', 'Лазерный принтер', 0, 'logo/logo.png', '2022-06-02 11:20:23', '2022-06-03 08:17:04'),
(3, 'Чуть Принтер', 200, 'Япония', 2021, 'Модель', 'Струйный принтер', 15, 'logo/logo.png', '2022-06-02 11:20:23', '2022-06-02 11:20:24'),
(4, 'Ничуть Принтер', 300, 'Германия', 2020, 'Модель', 'Термопринтер', 21, 'logo/logo.png', '2022-06-02 11:20:23', '2022-06-03 08:17:19'),
(5, 'Приставка Принтер', 400, 'Россия', 2022, 'Модель', 'Струйный принтер', 35, 'logo/logo.png', '2022-06-02 11:20:23', '2022-06-02 11:20:26'),
(6, 'Пол Принтер', 500, 'Япония', 2021, 'Модель', 'Термопринтер', 41, 'logo/logo.png', '2022-06-02 11:20:23', '2022-06-03 08:08:44'),
(7, 'Умный Принтер', 600, 'Германия', 2020, 'Модель', 'Лазерный принтер', 55, 'logo/logo.png', '2022-06-02 11:20:23', '2022-06-02 11:20:28'),
(8, 'Уникальный Принтер', 700, 'Япония', 2021, 'Модель', 'Струйный принтер', 65, 'logo/logo.png', '2022-06-02 11:20:23', '2022-06-02 11:20:29'),
(9, 'Много стоит Принтер', 800, 'Германия', 2020, 'Модель', 'Термопринтер', 75, 'logo/logo.png', '2022-06-02 11:20:23', '2022-06-03 06:59:12'),
(10, 'Он самый принтер', 900, 'Япония', 2022, 'Модель', 'Струйный принтер', 85, 'logo/logo.png', '2022-06-02 11:20:23', '2022-06-02 11:20:31'),
(11, 'Просто Принтер', 1000, 'Германия', 2021, 'Модель', 'Термопринтер', 95, 'logo/logo.png', '2022-06-02 11:20:23', '2022-06-02 11:20:32');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Администратор', 'А', NULL, 'admin', '1@1', '$2y$10$RYA5cjhnSF/ouzA6uSWPf.LYaHjxI1Ft2k.N55FiREHMduza6sCkm', '7t3VFGfBjsM2oH2FKf65OqcmzBBIyme42qG5C8HGe0mzuZbPdg8KVg1Ps6ta', 'admin', '2022-06-01 11:47:01', '2022-06-03 11:59:33'),
(2, 'Пользователь', 'п', 'п', 'user', '2@2', '$2y$10$H.fPcQodbHyLVBhXWnUZUeJC5nw2UBORiZcziylwgr0RKgQAdHoYq', 'JSdp2dyOGQMQMXe0AAG5pXTnP4zvCalgaRkJ4ZVJn2aLfbxFzui2qk5FLo6Z', 'user', '2022-06-03 08:08:24', '2022-06-03 11:59:42');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
