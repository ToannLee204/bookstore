-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 02, 2025 lúc 10:39 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `ma_sach` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `gia` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id`, `order_id`, `ma_sach`, `so_luong`, `gia`) VALUES
(61, 47, 100006, 1, 120000),
(62, 47, 100007, 1, 220000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gia_tong` decimal(10,0) NOT NULL,
  `ngay_dat_hang` timestamp NOT NULL DEFAULT current_timestamp(),
  `trang_thai` enum('Chưa đặt','Đã đặt') DEFAULT 'Chưa đặt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`id`, `username`, `gia_tong`, `ngay_dat_hang`, `trang_thai`) VALUES
(47, 'lttoan', 340000, '2025-07-02 08:38:39', 'Chưa đặt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

CREATE TABLE `sach` (
  `ma_sach` int(11) NOT NULL,
  `ten_sach` varchar(255) NOT NULL,
  `tac_gia` varchar(255) NOT NULL,
  `gia` decimal(10,0) NOT NULL,
  `so_luong_ton` int(11) NOT NULL,
  `anh_bia` varchar(255) NOT NULL,
  `the_loai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`ma_sach`, `ten_sach`, `tac_gia`, `gia`, `so_luong_ton`, `anh_bia`, `the_loai`) VALUES
(100006, 'Đắc Nhân Tâm', 'Dale Carnegie', 120000, 50, './imgs/url_anh_6.jpg', 'Phát triển bản thân'),
(100007, 'Sapiens: Lược sử loài người', 'Yuval Noah Harari', 220000, 60, './imgs/url_anh_7.jpg', 'Kinh doanh'),
(100008, 'Kỹ năng lãnh đạo', 'John C. Maxwell', 160000, 90, './imgs/url_anh_8.jpg', 'Lãnh đạo'),
(100010, 'Cách mạng công nghiệp lần thứ tư', 'Klaus Schwab', 200000, 70, './imgs/url_anh_10.jpg', 'Kinh tế'),
(100012, 'Vũ trụ trong hạt dẻ', 'Stephen Hawking', 250000, 30, './imgs/url_anh_12.jpg', 'Khoa học'),
(100013, 'Nhà giả kim', 'Paulo Coelho', 180000, 100, './imgs/url_anh_13.jpg', 'Tiểu thuyết'),
(100014, 'Mắt Biếc', 'Nguyễn Nhật Ánh', 130000, 0, './imgs/url_anh_14.jpg', 'Tiểu thuyết'),
(100016, 'Tôi tài giỏi bạn cũng thế', 'Adam Khoo', 200000, 90, './imgs/url_anh_16.jpg', 'Phát triển bản thân'),
(100019, 'Nghệ thuật quản lý thời gian', 'Brian Tracy', 160000, 60, './imgs/url_anh_19.jpg', 'Phát triển bản thân'),
(100021, 'Quản trị trong thời khủng hoảng', 'Peter Drucker', 180000, 75, './imgs/url_anh_21.jpg', 'Kinh doanh'),
(100023, '7 chiến lược thịnh vượng', 'Jim Rohn', 140000, 110, './imgs/url_anh_23.jpg', 'Kinh doanh'),
(100025, 'Sức mạnh của thói quen', 'Charles Duhigg', 180000, 50, './imgs/url_anh_25.jpg', 'Phát triển bản thân'),
(100026, 'Lập trình Python cơ bản', 'John Zelle', 210000, 60, './imgs/url_anh_26.jpg', 'Lập trình'),
(100029, 'Thế giới phẳng', 'Thomas L. Friedman', 250000, 45, './imgs/url_anh_29.jpg', 'Kinh tế'),
(100032, '7 thói quen hiệu quả', 'Stephen Covey', 170000, 120, './imgs/url_anh_32.jpg', 'Phát triển bản thân'),
(100034, 'Tình cờ gặp hạnh phúc', 'Dan Gilbert', 140000, 80, './imgs/url_anh_34.jpg', 'Tâm lý học'),
(100035, 'Những nguyên tắc thành công', 'Jack Canfield', 160000, 90, './imgs/url_anh_35.jpg', 'Kỹ năng sống'),
(100037, 'Kỷ luật tự giác', 'Brian Tracy', 150000, 75, './imgs/url_anh_37.jpg', 'Phát triển bản thân'),
(100045, 'Xuyên qua nỗi sợ', 'Susan Jeffers', 160000, 85, './imgs/url_anh_45.jpg', 'Phát triển bản thân'),
(100046, 'Nghệ thuật lắng nghe ', 'Dale Carnegie', 140000, 95, './imgs/url_anh_46.jpg', 'Kỹ năng giao tiếp'),
(100049, '7 thói quen tạo gia đình hạnh phúc', 'Stephen Covey', 140000, 90, './imgs/url_anh_49.jpg', 'Phát triển bản thân'),
(100052, 'Đời thay đổi khi chúng ta thay đổi', 'Marianne Williamson', 190000, 70, './imgs/url_anh_52.jpg', 'Phát triển bản thân'),
(100054, 'Từ tốt đến vĩ đại', 'Jim Collins', 200000, 80, './imgs/url_anh_54.jpg', 'Kinh doanh'),
(100058, 'Làm chủ suy nghĩ bản thân', 'Napoleon Hill', 150000, 85, './imgs/url_anh_58.jpg', 'Phát triển bản thân');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `name`, `address`, `phone_number`, `created_at`) VALUES
('admin', 'admin', 'lttoan291204@gmail.com', 'Lê Thế Toànnnn', 'Bắc Ninh', '012345678', '2024-12-14 06:09:53'),
('lttoan', '12345678', 'toan2004@gmail.com', 'Lê Thế Toàn', 'Bắc Ninh', '0123456789', '2024-12-15 02:10:26');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ma_sach` (`ma_sach`),
  ADD KEY `fk_order_id` (`order_id`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`ma_sach`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `don_hang` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`ma_sach`) REFERENCES `sach` (`ma_sach`),
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `don_hang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
