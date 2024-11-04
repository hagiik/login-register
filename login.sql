-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2024 pada 22.38
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `activation_code` varchar(255) DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `phone`, `is_active`, `activation_code`, `reset_token`, `reset_token_expiry`) VALUES
(5, 'hagi', 'hagi', 'hagiihsan007@gmail.com', '$2y$10$y4ukOSkiZyVtL44HFYLXoO5X0u6p9YIzFbN9wCp6vuxKCHGEmJwpe', '0812345678', 1, NULL, 'dd6f27e14357ac504f2a2388b8ff4da3dbbfd36f03fe9905df218aff5901dbf4f8c4fb917f88e8608e81b4cd12806405d5b8', '2024-11-04 22:12:00'),
(6, 'hagi ihsan', 'hagiik', 'Hagiihsank@gmail.com', '$2y$10$vBAaospNXh4gYDlrI2j5hOMqIi6MYpeU06geQYOdA543ekw3ctPwe', '085156566436', 1, NULL, '3a48596deacabf92e2975ee021e66c131a78d6c3e42853c50503fee7ec1ce49c28b1960e022db1075bcbfd9b350f91604897', '2024-11-04 22:10:55'),
(7, 'hagi kelana', 'hagi33', 'hagi1hsan3@gmail.com', '$2y$10$RplEqxynaflhcqETduoZQO.RiQPztctl23h7lhUAspfdDXD/wc1rW', '081244213121', 0, '96c43eac1aac4c7a30f4d2d77f33318d', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
