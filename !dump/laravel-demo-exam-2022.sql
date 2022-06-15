-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 15 2022 г., 19:28
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Лазерный принтер', '2022-06-15 13:45:44', '2022-06-15 13:45:44'),
(2, 'Струйный принтер', '2022-06-15 13:45:51', '2022-06-15 13:45:51'),
(3, 'Термопринтер', '2022-06-15 13:45:58', '2022-06-15 13:45:58');

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

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `status`, `amount`, `reason`, `created_at`, `updated_at`) VALUES
(6, 2, 0, 'Подтверждённый', 4, NULL, '2022-06-15 16:10:34', '2022-06-15 16:12:55'),
(8, 2, 0, 'Отменённый', 1, 'Отменяю', '2022-06-15 16:13:40', '2022-06-15 16:14:30');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `name`, `path`, `count`, `year`, `price`, `category`, `country`, `model`, `created_at`, `update_at`) VALUES
(2, 'MПринтер', 'images/image.png', '14', 2022, 100, 'Лазерный принтер', 'Япония', 'Обычная', '2022-06-15 12:36:56', '2022-06-15 15:58:21'),
(4, 'BПринтер', 'images/image.png', '33', 2022, 400, 'Лазерный принтер', 'Польша', 'Обычная', '2022-06-15 12:36:56', '2022-06-15 16:10:00'),
(5, 'CПринтер', 'images/image.png', '45', 2023, 500, 'Струйный принтер', 'Япония', 'Обычная', '2022-06-15 12:36:56', '2022-06-15 12:36:56'),
(6, 'DПринтер', 'images/image.png', '54', 2024, 600, 'Лазерный принтер', 'Россия', 'Обычная', '2022-06-15 12:36:56', '2022-06-15 16:09:55'),
(7, 'EПринтер', 'images/image.png', '65', 2025, 700, 'Струйный принтер', 'Польша', 'Обычная', '2022-06-15 12:36:56', '2022-06-15 12:36:56'),
(8, 'FПринтер', 'images/image.png', '75', 2026, 800, 'Лазерный принтер', 'Япония', 'Обычная', '2022-06-15 12:36:56', '2022-06-15 12:36:56'),
(9, 'GПринтер', 'images/image.png', '85', 2027, 900, 'Термопринтер', 'Россия', 'Обычная', '2022-06-15 12:36:56', '2022-06-15 12:36:56'),
(10, 'HПринтер', 'images/image.png', '95', 2028, 1000, 'Термопринтер', 'Польша', 'Обычная', '2022-06-15 12:36:56', '2022-06-15 12:36:56'),
(11, 'JПринтер', 'images/image.png', '105', 2029, 1100, 'Термопринтер', 'Япония', 'Обычная', '2022-06-15 12:36:56', '2022-06-15 12:36:56');

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
(2, 'Администратор', 'Администратор', NULL, 'admin', '2@2', '$2y$10$jCXO.IUJTc.Fd3G8WtTsgOUjK00fQAbl/cEUxLVKkqFr3kWlVqHQi', 'g8msoiANCsdr8rGampD1GpgVZQmHj02nubgaHaMFaSTYR0ddv6tbkn8O23Ih', 'admin', '2022-06-15 14:10:49', '2022-06-15 14:22:58');

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
