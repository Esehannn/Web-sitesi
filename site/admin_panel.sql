-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3307
-- Üretim Zamanı: 01 Eyl 2025, 12:03:49
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `admin_panel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `adsoyad` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `adsoyad`, `email`, `sifre`, `tarih`) VALUES
(1, 'esehan pekdoğan', 'ese@hotmail.com', '12345', '2025-03-15 00:04:41'),
(2, 'isa pekdoğan', 'isa@hotmail.com', '19071907', '2025-03-15 17:42:56'),
(3, 'okan talha', 'okan@hotmail.com', '123456', '2025-03-17 08:32:53'),
(4, 'yusuf', 'yusuf@hotmail.com', '123456', '2025-03-17 10:12:59'),
(5, 'şeref karabulut', 'seref@hotmail.com', '12345', '2025-04-09 08:07:25'),
(6, 'ahmet salih', 'salih@hotmail.com', '1234', '2025-07-02 21:43:53'),
(7, 'salih mehmet', 'mehmet@hotmail.com', '12345', '2025-07-02 21:44:54'),
(8, 'salih mehmet pekdoğan', 'mehmetpek@hotmail.com', '12345678', '2025-07-02 21:46:16'),
(10, 'samet', 'samet@hotmail.com', '1234567', '2025-07-02 21:48:17'),
(11, 'kudret', 'kudret@hotmail.com', '12345678', '2025-07-02 21:49:19'),
(12, 'erkut', 'erkut@hotmail.com', '123456', '2025-07-02 21:50:27'),
(13, 'tezcann', 'tezcan@hotmail.com', '443311', '2025-07-02 21:53:35'),
(14, 'bahattin', 'bahattin@hotmail.com', '1234567', '2025-07-02 21:54:20'),
(15, 'ercüment', 'ercument@hotmail.com', '123456', '2025-07-02 21:55:26'),
(16, 'esehannnn', 'sss@hotmail.com', '11111', '2025-07-03 10:58:21'),
(17, 'mahmut', 'mahmut@hotmail.com', '3424324', '2025-07-03 13:26:23'),
(18, 'salih', 'kamil@hotmail.com', '44444', '2025-07-03 13:28:54'),
(19, 'eseses', 'kaa@hotmail.com', '12345', '2025-07-03 14:32:43'),
(20, 'ahmet taştan', 'ahmet333@hotmail.com', '12345', '2025-07-03 14:51:04'),
(21, 'serdar', 'serdar@hotmail.com', '123456', '2025-07-03 15:02:59'),
(22, 'sesesee', 'seses@hotmail.com', '4444', '2025-07-03 15:32:31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE `mesajlar` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mesaj` text NOT NULL,
  `tarih` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `mesajlar`
--

INSERT INTO `mesajlar` (`id`, `ad`, `email`, `mesaj`, `tarih`) VALUES
(1, 'esehan pekdogna', 'ese@hotmail.com', 'merhaba', '2025-07-03 18:46:50'),
(2, 'esehan pekdogna', 'ese@hotmail.com', 'merhaba', '2025-07-03 18:47:30'),
(3, 'esehanpek pek', 'kamil@hotmail.com', 'merhabababa', '2025-07-03 18:51:52');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `adet` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sepet`
--

INSERT INTO `sepet` (`id`, `kullanici_id`, `urun_id`, `adet`) VALUES
(4, 2, 1, 3),
(5, 2, 5, 5),
(15, 1, 3, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `toplam_tutar` decimal(10,2) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp(),
  `durum` varchar(32) DEFAULT 'Beklemede'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`id`, `kullanici_id`, `toplam_tutar`, `tarih`, `durum`) VALUES
(1, 4, 21698.00, '2025-05-29 16:09:59', 'Beklemede'),
(2, 4, 297.00, '2025-05-29 16:10:42', 'Beklemede'),
(3, 1, 15995.00, '2025-05-30 07:50:28', 'Beklemede'),
(4, 1, 9000.00, '2025-05-30 08:06:55', 'Beklemede'),
(5, 1, 7500.00, '2025-05-30 08:27:53', 'Beklemede'),
(6, 1, 20198.00, '2025-06-30 20:29:07', 'Beklemede'),
(7, 1, 3000.00, '2025-06-30 20:29:27', 'Beklemede'),
(8, 20, 198.00, '2025-07-03 14:52:57', 'Beklemede');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis_detay`
--

CREATE TABLE `siparis_detay` (
  `id` int(11) NOT NULL,
  `siparis_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `adet` int(11) NOT NULL,
  `birim_fiyat` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `siparis_detay`
--

INSERT INTO `siparis_detay` (`id`, `siparis_id`, `urun_id`, `adet`, `birim_fiyat`) VALUES
(1, 1, 1, 2, 99.00),
(2, 1, 3, 11, 1500.00),
(3, 1, 5, 1, 5000.00),
(4, 2, 1, 3, 99.00),
(5, 3, 1, 5, 99.00),
(6, 3, 3, 7, 1500.00),
(7, 3, 5, 1, 5000.00),
(8, 4, 3, 6, 1500.00),
(9, 5, 3, 5, 1500.00),
(10, 6, 5, 4, 5000.00),
(11, 6, 1, 2, 99.00),
(12, 7, 3, 2, 1500.00),
(13, 8, 1, 2, 99.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `aciklama` text NOT NULL,
  `fiyat` decimal(10,2) NOT NULL,
  `resim` varchar(255) NOT NULL,
  `kategori` enum('erkek','kadin','cocuk','yetiskin') NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `ad`, `aciklama`, `fiyat`, `resim`, `kategori`, `tarih`) VALUES
(1, 'mont', 'güzel mont', 99.00, 'resimler/mont1.jpg', 'erkek', '2025-03-12 22:58:48'),
(3, 'Polo Yaka', 'kaliteli polo yaka', 1500.00, 'resimler/ana sayfa ana görsel.jpg', 'erkek', '2025-03-12 23:17:44'),
(5, 'kazak', 'Kalın kazak', 5000.00, 'resimler/tablo görsel 2.jpg', 'erkek', '2025-03-14 23:39:54'),
(6, 'tişört', 'güzel', 700.00, 'resimler/Tablo görsel 1.jpg', 'cocuk', '2025-03-15 17:45:12'),
(7, 'zara pantolon', 'mavi', 566.00, 'resimler/Tablo görsel 1.jpg', 'cocuk', '2025-03-17 10:07:15'),
(8, 'kıyafet', 'kıyafet', 333.00, 'resimler/mont1.jpg', 'kadin', '2025-07-02 21:57:22');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sepet`
--
ALTER TABLE `sepet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kullanici_id` (`kullanici_id`),
  ADD KEY `urun_id` (`urun_id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Tablo için indeksler `siparis_detay`
--
ALTER TABLE `siparis_detay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siparis_id` (`siparis_id`),
  ADD KEY `urun_id` (`urun_id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `sepet`
--
ALTER TABLE `sepet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `siparis_detay`
--
ALTER TABLE `siparis_detay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `sepet`
--
ALTER TABLE `sepet`
  ADD CONSTRAINT `sepet_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sepet_ibfk_2` FOREIGN KEY (`urun_id`) REFERENCES `urunler` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `siparisler`
--
ALTER TABLE `siparisler`
  ADD CONSTRAINT `siparisler_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`);

--
-- Tablo kısıtlamaları `siparis_detay`
--
ALTER TABLE `siparis_detay`
  ADD CONSTRAINT `siparis_detay_ibfk_1` FOREIGN KEY (`siparis_id`) REFERENCES `siparisler` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `siparis_detay_ibfk_2` FOREIGN KEY (`urun_id`) REFERENCES `urunler` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
