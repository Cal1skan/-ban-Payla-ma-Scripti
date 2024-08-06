-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Ağu 2024, 16:04:35
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `iban`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iban_info`
--

CREATE TABLE `iban_info` (
  `id` int(11) NOT NULL,
  `iban` varchar(34) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `iban_info`
--

INSERT INTO `iban_info` (`id`, `iban`, `name`, `bank_name`, `photo`) VALUES
(6, 'TR66 0082 4200 0949 2107 6404 87', 'Hamza Çalışkan', 'Papara', 'uploads/resim_2024-08-06_170147545.png');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `iban_info`
--
ALTER TABLE `iban_info`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `iban_info`
--
ALTER TABLE `iban_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
