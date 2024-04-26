-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 26, 2024 lúc 07:09 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `employee`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`id`, `name`, `age`, `email`) VALUES
(3, 'Michael Johnson', 35, 'michael.johnson@example.com'),
(4, 'Emily Brown', 28, 'emily.brown@example.com'),
(6, 'Jessica Lee', 27, 'jessica.lee@example.com'),
(7, 'Christopher Martinez', 33, 'christopher.martinez@example.com'),
(8, 'Sarah Taylor', 29, 'sarah.taylor@example.com'),
(9, 'Kevin Anderson', 45, 'kevin.anderson@example.com'),
(10, 'Amanda Thomas', 32, 'amanda.thomas@example.com'),
(11, 'Daniel Jackson', 31, 'daniel.jackson@example.com'),
(12, 'Jennifer White', 26, 'jennifer.white@example.com'),
(13, 'Matthew Harris', 38, 'matthew.harris@example.com'),
(14, 'Elizabeth Young', 34, 'elizabeth.young@example.com'),
(15, 'Andrew Brown', 37, 'andrew.brown@example.com'),
(16, 'Nicole Garcia', 36, 'nicole.garcia@example.com'),
(17, 'Ryan Martinez', 31, 'ryan.martinez@example.com'),
(18, 'Stephanie Rodriguez', 29, 'stephanie.rodriguez@example.com'),
(19, 'Justin Lewis', 27, 'justin.lewis@example.com'),
(20, 'Lauren Clark', 35, 'lauren.clark@example.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
