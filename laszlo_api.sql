-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Okt 24. 08:35
-- Kiszolgáló verziója: 10.4.25-MariaDB
-- PHP verzió: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `laszlo_api`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `db_publisher`
--

CREATE TABLE `db_publisher` (
  `id` int(11) NOT NULL,
  `is_test` tinyint(1) DEFAULT 0,
  `name` tinytext DEFAULT NULL,
  `db_public_id` char(10) CHARACTER SET latin1 COLLATE latin1_general_cs DEFAULT NULL,
  `api_token` varchar(280) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `db_publisher`
--

INSERT INTO `db_publisher` (`id`, `is_test`, `name`, `db_public_id`, `api_token`) VALUES
(2, 0, 'Furry company', 'kUQ1A80a3R', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvb29waHAiLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0OjgwODAiLCJpYXQiOjE2NjUxMzYxOTIsImV4cCI6IjIwMjItT2N0LTA3IDEyOjQ5OjUyIn0.IfAmZRQgtfaHH9G-gXrZgnW3RwYTHiTR99pYnMXpKfKWDjdaqWB5TrTdAJYTQE5HwINE38AN0g06hfRtmt2RSA'),
(3, 0, 'Clavford inc', 'j1431K4c95', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvb29waHAiLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0OjgwODAiLCJpYXQiOjE2NjU0ODQ4MzksImV4cCI6MTY2NTQ4ODQzOX0.aoZF04j1JPiisn_UTLRHqaA27KIPy9YVCkRzIUEpG58bOhofCa28f0MsO4GuUfsh1NwBGT3Pxo5tj2u6kIQW1A'),
(4, 0, 'Sample Company', 'EhGXiEDjpe', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvb29waHAiLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0OjgwODAiLCJpYXQiOjE2NjU2NDM4NTMsImV4cCI6MTY2NTY0NzQ1M30.z-pTKu1V4NXpsYx3c0AviCcuipaKNA0iNmkM8lxX9ZldHgyixmulUrmRF9mEoP27ClXx5WT_dor4Pm0eazqW6w'),
(30, 0, 'Demo Ltd.', 'gI8Ee12umb', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvb29waHAiLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0OjgwODAiLCJpYXQiOjE2NjU0ODQ5MDQsImV4cCI6MTY2NTQ4ODUwNH0.9oKekjE1gUgddAt7R05L4BM2y_hIMT1RbIoLpZgkd-Q88nsLFR950O4WIW4t6ABWr8H8aoGeB7QLyWDATZQL1g');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `token`
--

CREATE TABLE `token` (
  `token_id` int(11) NOT NULL,
  `token_token` varchar(290) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `valid_to` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `token`
--

INSERT INTO `token` (`token_id`, `token_token`, `user_id`, `publisher_id`, `valid_to`) VALUES
(1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvb29waHAiLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0OjgwODAiLCJpYXQiOjE2NjU0ODQ5MDQsImV4cCI6MTY2NTQ4ODUwNH0.9oKekjE1gUgddAt7R05L4BM2y_hIMT1RbIoLpZgkd-Q88nsLFR950O4WIW4t6ABWr8H8aoGeB7QLyWDATZQL1g', 3, 30, '2022-10-27 07:29:16'),
(2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvb29waHAiLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0OjgwODAiLCJpYXQiOjE2NjU0ODQ4MzksImV4cCI6MTY2NTQ4ODQzOX0.aoZF04j1JPiisn_UTLRHqaA27KIPy9YVCkRzIUEpG58bOhofCa28f0MsO4GuUfsh1NwBGT3Pxo5tj2u6kIQW1A', 1, 3, '2022-10-17 10:54:02'),
(3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvb29waHAiLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0OjgwODAiLCJpYXQiOjE2NjU2NDM4NTMsImV4cCI6MTY2NTY0NzQ1M30.z-pTKu1V4NXpsYx3c0AviCcuipaKNA0iNmkM8lxX9ZldHgyixmulUrmRF9mEoP27ClXx5WT_dor4Pm0eazqW6w', 4, 4, '2022-10-16 06:40:56'),
(4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvb29waHAiLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0OjgwODAiLCJpYXQiOjE2NjU0ODQ5MDQsImV4cCI6MTY2NTQ4ODUwNH0.9oKekjE1gUgddAt7R05L4BM2y_hIMT1RbIoLpZgkd-Q88nsLFR950O4WIW4t6ABWr8H8aoGeB7QLyWDATZQL1g', 6, 30, '2022-10-19 07:29:57'),
(5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvb29waHAiLCJhdWQiOiJodHRwOi8vbG9jYWxob3N0OjgwODAiLCJpYXQiOjE2NjU0ODQ5MDQsImV4cCI6MTY2NTQ4ODUwNH0.9oKekjE1gUgddAt7R05L4BM2y_hIMT1RbIoLpZgkd-Q88nsLFR950O4WIW4t6ABWr8H8aoGeB7QLyWDATZQL1g', 3, 4, '2022-10-19 07:29:57');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `token_permissions`
--

CREATE TABLE `token_permissions` (
  `token_id` int(11) NOT NULL,
  `module_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `read` tinyint(1) NOT NULL,
  `write` tinyint(1) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `token_permissions`
--

INSERT INTO `token_permissions` (`token_id`, `module_name`, `read`, `write`, `delete`) VALUES
(1, 'users', 1, 1, 1),
(4, 'subscriptions', 1, 0, 0),
(5, 'orders', 1, 0, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `db_publisher_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `language_id` varchar(5) DEFAULT NULL,
  `is_newsletter_subscribed` tinyint(1) UNSIGNED DEFAULT 0,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `name_last` tinytext DEFAULT NULL,
  `name` tinytext NOT NULL,
  `business_title` tinytext DEFAULT NULL,
  `phone` tinytext DEFAULT NULL,
  `mobil` tinytext DEFAULT NULL,
  `address_db_country_id` int(11) UNSIGNED DEFAULT NULL,
  `address_db_country_name` tinytext DEFAULT NULL,
  `address_zip` tinytext DEFAULT NULL,
  `address_city` tinytext DEFAULT NULL,
  `address_street` tinytext DEFAULT NULL,
  `address_street_number` tinytext DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `activation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `db_publisher_id`, `email`, `username`, `password`, `language_id`, `is_newsletter_subscribed`, `active`, `name_last`, `name`, `business_title`, `phone`, `mobil`, `address_db_country_id`, `address_db_country_name`, `address_zip`, `address_city`, `address_street`, `address_street_number`, `date_birth`, `registration_date`, `activation_date`) VALUES
(1, 30, 'user1@sample.invalid', 'user1@sample.invalid', 'JAWRfqw2sdzew', 'en', 0, 1, 'Wolf', 'Jürgen ', NULL, NULL, NULL, 276, 'Germany', '81925', 'Munich', 'Normannenplatz ', '8', NULL, '2021-08-22 04:58:23', NULL),
(2, 4, 'user2@sample.invalid', 'user2@sample.invalid', 'JAWRfqw2sdzew', 'en', 0, 1, 'Seebach', 'Florian', NULL, NULL, NULL, 40, 'Austria', '5020', 'Salzburg', 'Rupertgrasse', '11', NULL, '2021-12-16 15:35:07', NULL),
(3, 4, 'user3@sample.invalid', 'user3@sample.invalid', 'JAWRfqw2sdzew', 'en', 0, 1, 'Auer', 'Vera ', NULL, NULL, NULL, 276, 'Germany', '80804', 'Munich', 'Kölner Platz', '2', NULL, '2022-02-24 06:39:44', NULL),
(4, 30, 'user4@sample.invalid', 'user4@sample.invalid', 'JAWRfqw2sdzew', 'en', 0, 1, 'Dietrich', 'Vicki', NULL, NULL, NULL, 276, 'Germany', '80797', 'Munich', 'Saarstrasse', '4', NULL, '2021-05-16 06:41:37', NULL),
(5, 4, 'user5@sample.invalid', 'user5@sample.invalid', 'JAWRfqw2sdzew', 'en', 0, 1, 'Altenberg', 'Peter', NULL, NULL, NULL, 40, 'Austria', '8010', 'Graz', 'Burgasse', '5', NULL, '2021-08-24 19:47:11', NULL),
(6, 30, 'user6@sample.invalid', 'user6@sample.invalid', 'JAWRfqw2sdzew', 'en', 0, 1, 'Carl', 'Ludwig', NULL, NULL, NULL, 40, 'Austria', '8020', 'Graz', 'Ungergasse', '46', NULL, '2021-12-05 13:40:26', NULL);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `db_publisher`
--
ALTER TABLE `db_publisher`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token_id`);

--
-- A tábla indexei `token_permissions`
--
ALTER TABLE `token_permissions`
  ADD PRIMARY KEY (`token_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FELHASZNALONEV` (`username`,`db_publisher_id`),
  ADD UNIQUE KEY `EMAIL` (`email`,`db_publisher_id`),
  ADD KEY `JELSZO` (`password`),
  ADD KEY `ACTIVE` (`active`),
  ADD KEY `db_publisher_id` (`db_publisher_id`),
  ADD KEY `address_db_country_id` (`address_db_country_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `db_publisher`
--
ALTER TABLE `db_publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT a táblához `token`
--
ALTER TABLE `token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `token_permissions`
--
ALTER TABLE `token_permissions`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34753;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
