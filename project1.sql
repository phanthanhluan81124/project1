-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2024 at 03:10 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`) VALUES
(2, 1),
(4, 2),
(1, 4),
(6, 5),
(8, 35),
(9, 36);

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `cart_detail_id` int NOT NULL,
  `product_detail_id` int NOT NULL,
  `cart_id` int NOT NULL,
  `product_quantity` int NOT NULL,
  `product_size` int NOT NULL,
  `total` int NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`cart_detail_id`, `product_detail_id`, `cart_id`, `product_quantity`, `product_size`, `total`, `status`) VALUES
(46, 3, 2, 5, 42, 16500000, 1),
(60, 5, 2, 12, 41, 57600000, 1),
(61, 8, 2, 26, 42, 83200000, 1),
(66, 11, 6, 1, 42, 4800000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Chưa phân loại'),
(2, 'Giày Nike'),
(3, 'ADIDAS'),
(6, 'Giày Puma ');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `evaluation_id` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `number_stars` tinyint(1) NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `content`, `number_stars`, `product_id`, `user_id`) VALUES
(1, 'Sản phẩm rất đẹp', 4, 1, 4),
(2, 'Giày rất đẹp', 5, 1, 2),
(3, 'ahihi', 5, 1, 4),
(4, 'Sản phẩm không đẹp như tưởng tượng', 5, 1, 4),
(5, 'Sản phẩm tạm ổn', 4, 2, 4),
(6, 'Sản phẩm tốt nhưng cần để ý vẩn chuyển và đóng gói hơn !', 4, 2, 5),
(9, 'sản phẩm rất tốt !', 5, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `tel` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `total` int NOT NULL,
  `total_discount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `payment_method` enum('cod','banking','','') CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `status` enum('pending','processing','shiped','delivered','canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `fullname`, `email`, `tel`, `address`, `total`, `total_discount`, `payment_method`, `status`, `created_at`, `updated_at`, `note`) VALUES
(1, 4, 'Ma Văn Khải', 'khaimv13@gmai.com', '0346315304', '61 ngõ 177 Cầu Diễn, Phúc Diễn, Bắc Từ Liêm, Hà Nội', 3300000, '3000000', 'cod', 'delivered', '2023-11-22 16:59:25', '0000-00-00 00:00:00', ''),
(2, 4, 'Ma Văn Khải ', 'khaimv13@gmail.com', '0865969204', 'Kim Tân, Kim Phượng, Định Hóa, Thái Nguyên', 19800000, '9900000', 'cod', 'pending', '2024-04-25 03:21:20', '2024-04-25 03:21:20', ''),
(10, 4, 'Ma Văn Khải ', 'khaimv13@gmail.com', '0865969204', 'Kim Tân, Kim Phượng, Định Hóa, Thái Nguyên', 19800000, '19800000', 'cod', 'pending', '2024-04-25 09:40:27', '2024-04-25 09:40:27', ''),
(11, 4, 'Ma Văn Khải ', 'khaimv13@gmail.com', '0865969204', 'Kim Tân, Kim Phượng, Định Hóa, Thái Nguyên', 19800000, '19800000', 'cod', 'pending', '2024-04-25 09:40:37', '2024-04-25 09:40:37', ''),
(12, 4, 'Ma Văn Khải ', 'khaimv13@gmail.com', '0865969204', 'Kim Tân, Kim Phượng, Định Hóa, Thái Nguyên', 19800000, '19800000', 'cod', 'pending', '2024-04-25 09:42:06', '2024-04-25 09:42:06', ''),
(13, 4, 'Ma Văn Khải ', 'khaimv13@gmail.com', '0865969204', 'Kim Tân, Kim Phượng, Định Hóa, Thái Nguyên', 19800000, '19800000', 'cod', 'pending', '2024-04-25 09:43:03', '2024-04-25 09:43:03', ''),
(14, 5, 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 13000000, '13000000', 'cod', 'processing', '2024-05-04 08:19:04', '2024-05-04 09:10:41', ''),
(16, 5, 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 3300000, '3300000', 'cod', 'canceled', '2024-05-03 03:40:55', '2024-05-03 03:40:55', ''),
(17, 5, 'Phan Thành Luân  ', 'phanthanhluana8@gmail.com', '0865969204', 'Hà Nội', 44200000, '44200000', 'cod', 'pending', '2024-05-15 09:10:22', '2024-05-15 09:10:22', ''),
(18, 1, 'Phan Thành Luân ', 'luanptph42636@fpt.edu.vn', '0865969204', '17- Nam sông hồng', 19800000, '19800000', 'cod', 'pending', '2024-05-15 09:12:20', '2024-05-15 09:12:20', ''),
(19, 5, 'Phan Thành Luân  ', 'phanthanhluana8@gmail.com', '0865969204', 'Hà Nội', 19800000, '19800000', 'cod', 'pending', '2024-05-15 09:17:33', '2024-05-15 09:17:33', ''),
(20, 5, 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 13200000, '13200000', 'cod', 'canceled', '2024-05-22 09:27:37', '2024-05-22 09:28:09', ''),
(21, 5, 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 35400000, '35400000', 'cod', 'pending', '2024-05-25 14:05:48', '2024-05-25 14:05:48', ''),
(22, 5, 'Phan Thành Luân ', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 11400000, '11300000', 'cod', 'pending', '2024-05-26 09:39:30', '2024-05-26 09:39:30', ''),
(23, 5, 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 19200000, '19200000', 'cod', 'pending', '2024-05-27 07:43:02', '2024-05-27 07:43:02', ''),
(24, 5, 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 19200000, '19200000', 'cod', 'pending', '2024-05-27 07:43:02', '2024-05-27 07:43:02', ''),
(25, 5, 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 24000000, '2400000', 'cod', 'pending', '2024-05-27 09:06:48', '2024-05-27 09:06:48', ''),
(26, 5, 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 24000000, '2400000', 'cod', 'pending', '2024-05-27 09:06:48', '2024-05-27 09:06:48', ''),
(27, 5, 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 9600000, '4800000', 'cod', 'canceled', '2024-05-27 09:39:14', '2024-05-27 09:39:14', ''),
(28, 5, 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '0865969204', '17- Nam sông hồng', 4800000, '2400000', 'cod', 'shiped', '2024-05-27 09:49:44', '2024-05-27 09:49:44', ''),
(29, 36, 'Phan Thành Luân ', 'phanthanhluana81@gmail.com', '0865969204', '17- Nam sông hồng', 7100000, '7100000', 'banking', 'pending', '2024-06-08 15:19:03', '2024-06-08 15:19:03', ''),
(30, 36, 'Phan Thành Luân ', 'phanthanhluana81@gmail.com', '0865969204', '17- Nam sông hồng', 7100000, '7100000', 'banking', 'pending', '2024-06-08 15:19:03', '2024-06-08 15:19:03', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_detail_id` int NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_detail_id`, `price`, `quantity`) VALUES
(1, 1, 1, 3300000, 1),
(2, 1, 4, 4800000, 1),
(11, 13, 1, 3300000, 3),
(12, 14, 3, 3300000, 2),
(13, 14, 7, 3200000, 2),
(14, 16, 2, 3300000, 1),
(15, 17, 1, 3300000, 10),
(16, 17, 4, 4800000, 1),
(17, 17, 6, 3200000, 2),
(18, 19, 2, 3300000, 6),
(19, 20, 3, 3300000, 4),
(20, 21, 10, 4800000, 4),
(21, 22, 12, 3800000, 3),
(22, 23, 5, 4800000, 2),
(23, 24, 8, 3200000, 3),
(24, 25, 10, 4800000, 2),
(25, 26, 5, 4800000, 3),
(26, 27, 10, 4800000, 2),
(27, 28, 10, 4800000, 1),
(28, 29, 3, 3300000, 1),
(29, 30, 12, 3800000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_evaluation`
--

CREATE TABLE `order_evaluation` (
  `evaluation_id` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `number_stars` tinyint(1) NOT NULL,
  `order_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_momo`
--

CREATE TABLE `payment_momo` (
  `id` int NOT NULL,
  `partnerCode` varchar(50) NOT NULL,
  `orderId` varchar(50) NOT NULL,
  `requestId` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `orderInfo` varchar(50) NOT NULL,
  `orderType` varchar(50) NOT NULL,
  `transId` varchar(50) NOT NULL,
  `payType` varchar(50) NOT NULL,
  `signature` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment_momo`
--

INSERT INTO `payment_momo` (`id`, `partnerCode`, `orderId`, `requestId`, `amount`, `orderInfo`, `orderType`, `transId`, `payType`, `signature`, `created_at`) VALUES
(1, 'MOMOBKUN20180529', '1716798092', '1716798092', '10000', 'Thanh toán qua MoMo', 'momo_wallet', '4049123864', 'napas', 'ab40f6699f9a909a0d0852f96a97dab9d6252a1e443c5bd260f699b2e4b87b77', '2024-06-08 14:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci,
  `product_price` int NOT NULL,
  `discounted_price` int DEFAULT NULL,
  `product_describe` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci,
  `category_id` int NOT NULL,
  `view` int DEFAULT NULL,
  `highlight` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_image`, `product_price`, `discounted_price`, `product_describe`, `category_id`, `view`, `highlight`, `status`, `created_at`, `updated_at`) VALUES
(1, 'NIKE AIR FORCE 1', 'AF1.png', 3300000, 3200000, 'Giày Nike Air Force 1\r\n   \r\n            Air Force 1, một biểu tượng trong thế giới giày sneaker, không chỉ là một đôi giày mà còn là biểu tượng văn hóa và phong cách. Được thiết kế bởi Bruce Kilgore và ra mắt lần đầu tiên vào năm 1982, Air Force 1 nhanh chóng trở thành một biểu tượng của sự đẳng cấp và phong cách đường phố.\r\n            Đôi giày Air Force 1 không chỉ thu hút người hâm mộ bởi vẻ ngoại hình đẹp mắt mà còn bởi sự thoải mái và chất lượng vượt trội. Chúng sở hữu đế đệm Air-Sole, mang lại cảm giác êm ái và thoải mái cho đôi chân mỗi bước di chuyển. Chất liệu da cao cấp được sử dụng cho phần upper, tạo nên độ bền vững và đồng thời thêm vào đó là sự sang trọng.\r\n            Mẫu giày này không chỉ là biểu tượng thời trang mà còn là một bảng điều khiển cho sự sáng tạo cá nhân. Với sự đa dạng về màu sắc và kiểu dáng, Air Force 1 phản ánh cá tính và phong cách riêng biệt của người sử dụng. Từ phiên bản trắng kinh điển cho đến những biến thể độc đáo với các họa tiết và chất liệu đặc biệt, mỗi đôi giày Air Force 1 là một tác phẩm nghệ thuật thực sự.\r\n            Ngoài ra, logo dáng cánh bướm nổi tiếng của Nike nằm ở phía lưỡi gà và mũi giày, là điểm nhấn tinh tế thể hiện sự đẳng cấp và chất lượng của thương hiệu.\r\n\r\n            Air Force 1 không chỉ là một đôi giày, mà là biểu tượng thời trang thể hiện sự độc đáo và phong cách cá nhân. Cho dù bạn là người yêu thể thao, người sành điệu hay đơn giản chỉ là người đam mê phong cách, đôi giày Air Force 1 sẽ luôn là sự lựa chọn hoàn hảo để thể hiện cá tính và tinh thần độc lập của bạn.\r\n  ', 2, 200, 1, 1, '2023-11-09 08:31:49', '2024-06-01 15:06:23'),
(2, 'NIKE ACG MOUNTAIN FLY 2 LOW', 'MT5.png', 4800000, 0, NULL, 2, 200, 1, 1, '2023-11-14 03:48:24', '2023-11-14 03:48:24'),
(3, 'NIKE TECH HERA', 'TECH5.png', 3200000, NULL, NULL, 2, 200, 1, 1, '2023-11-14 03:48:24', '2023-11-14 03:51:54'),
(4, 'NIKE AIR MAX 1', 'MAX5.png', 4800000, NULL, NULL, 2, 200, 1, 1, '2023-11-14 03:48:24', '2024-05-13 13:18:25'),
(5, 'NIKE REACT INFINITY RUN FK 3', 'FK5.png', 3800000, NULL, NULL, 2, 0, 0, 1, '2023-11-14 03:48:24', '2024-05-13 13:18:20'),
(6, 'ADIDAS NMD_S1', 'S1.jpg', 2900000, 3600000, NULL, 3, 0, 0, 1, '2023-11-14 03:48:24', '2023-11-14 04:00:44'),
(7, 'ADIDAS DURAMO SL WIDE', 'SL.jpg', 2200000, NULL, NULL, 3, 0, 0, 1, '2023-11-14 03:48:24', '2023-11-14 04:00:44'),
(8, 'ADIDAS NMD_G1', 'G1.jpg', 2900000, NULL, NULL, 3, 0, 0, 1, '2023-11-14 03:48:24', '2023-11-14 04:00:44'),
(9, 'ADIDAS RUN FALCON 2.0', 'FA.jpg', 1800000, NULL, NULL, 3, 0, 0, 1, '2023-11-14 03:48:24', '2023-11-14 04:00:44'),
(10, 'ADIDAS SAMBA CLASSIC', 'SAM.jpg', 3200000, NULL, NULL, 3, 0, 0, 1, '2023-11-14 03:48:24', '2023-11-14 04:00:44'),
(19, 'Giày bóng rổ nam Scoot Zeros Grey Frost', 'Scoot-Zeros-Grey-Frost-Men\'s-Basketball-Shoes (3).avif', 2400000, 2350000, 'Lấy cảm hứng từ phong cách chơi nhanh và đột phá của Scoot trên sân, đôi giày này lấy các yếu tố thiết kế từ thương hiệu Jaws của chúng tôi với lớp bọc cao su giống hàm ở đế ngoài thể hiện sự quyết liệt và bền bỉ của Scoot trên sân. Đây là đôi giày bóng rổ đặc trưng đầu tiên của Scoot Henderson và được thiết kế cho sự nhanh nhẹn, tốc độ và sự quyết tâm của anh nhờ đế giữa EVA có độ đàn hồi cao, mô hình lực kéo chống trượt ở đế ngoài và thân giày nhẹ. Tất cả đều được đánh dấu trong logo đặc trưng của Scoot.\r\nThân giày bằng vải tổng hợp, lưới và dệt mang lại cảm giác nhẹ nhàng\r\nNắp gót tổng hợp có chi tiết thêu\r\nHỗ trợ khóa biểu mẫu\r\nĐế giữa PROFOAM EVA\r\nĐế ngoài cao su bao phủ toàn bộ với mô hình lực kéo chống trượt\r\nLogo thương hiệu Scoot', 6, NULL, 0, 1, '2024-06-01 15:01:48', '2024-06-03 09:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `products_detail`
--

CREATE TABLE `products_detail` (
  `product_detail_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_quantity` int NOT NULL,
  `product_size` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `products_detail`
--

INSERT INTO `products_detail` (`product_detail_id`, `product_id`, `product_quantity`, `product_size`) VALUES
(1, 1, 0, 40),
(2, 1, 0, 41),
(3, 1, -1, 42),
(4, 2, 10, 40),
(5, 2, 3, 41),
(6, 3, 0, 40),
(7, 3, 0, 41),
(8, 3, -3, 42),
(9, 4, 10, 40),
(10, 4, -1, 41),
(11, 4, 0, 42),
(12, 5, -1, 40),
(13, 5, 10, 41),
(14, 5, 15, 42),
(15, 6, 5, 40),
(16, 6, 10, 41),
(17, 6, 12, 42),
(18, 6, 15, 43),
(19, 7, 20, 40),
(20, 7, 11, 41),
(21, 7, 12, 42),
(22, 8, 3, 40),
(23, 8, 12, 41),
(24, 8, 21, 42),
(25, 9, 10, 40),
(26, 9, 5, 41),
(27, 9, 25, 42),
(28, 10, 20, 39),
(29, 10, 15, 40),
(30, 10, 10, 41),
(31, 10, 5, 42),
(32, 19, 20, 41),
(33, 19, 30, 42),
(34, 19, 10, 43);

-- --------------------------------------------------------

--
-- Table structure for table `products_image`
--

CREATE TABLE `products_image` (
  `image_id` int NOT NULL,
  `product_id` int NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `products_image`
--

INSERT INTO `products_image` (`image_id`, `product_id`, `image_name`) VALUES
(2, 1, 'AF1-1.png'),
(3, 1, 'AF1-2.png'),
(4, 1, 'AF1-3.png'),
(5, 1, 'AF1-4.png'),
(7, 2, 'MT1.jpg'),
(8, 2, 'MT2.png'),
(9, 2, 'MT3.png'),
(10, 2, 'MT4.png'),
(12, 3, 'TECH1.png'),
(13, 3, 'TECH2.png'),
(14, 3, 'TECH3.png'),
(15, 3, 'TECH4.png'),
(17, 4, 'MAX1.png'),
(18, 4, 'MAX2.png'),
(19, 4, 'MAX3.png'),
(20, 4, 'MAX4.png'),
(22, 5, 'FK1.png'),
(23, 5, 'FK2.png'),
(24, 5, 'FK3.png'),
(25, 5, 'FK4.png'),
(27, 6, 'S12.jpg'),
(28, 6, 'S13.jpg'),
(29, 6, 'S14.jpg'),
(31, 7, 'SL1.jpg'),
(32, 7, 'SL2.jpg'),
(33, 7, 'SL3.jpg'),
(34, 7, 'SL4.jpg'),
(36, 8, 'G2.jpg'),
(37, 8, 'G13.jpg'),
(38, 8, 'G14.jpg'),
(39, 8, 'G15.jpg'),
(41, 9, 'FA1.jpg'),
(42, 9, 'FA2.jpg'),
(43, 9, 'FA3.jpg'),
(44, 9, 'FA4.jpg'),
(46, 10, 'SAM1.jpg'),
(47, 10, 'SAM2.jpg'),
(48, 10, 'SAM3.jpg'),
(49, 10, 'SAM4.jpg'),
(57, 19, 'Scoot-Zeros-Grey-Frost-Men\'s-Basketball-Shoes (2).avif'),
(58, 19, 'Scoot-Zeros-Grey-Frost-Men\'s-Basketball-Shoes (3).avif'),
(60, 19, 'Scoot-Zeros-Grey-Frost-Men\'s-Basketball-Shoes.avif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `fullname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `tel` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'customer',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `email`, `password`, `tel`, `address`, `avatar`, `role`, `status`) VALUES
(1, 'Admin', 'Phan Thành Luân', 'luanptph42636@fpt.edu.vn', 'hello1234', '0865969204', '17- Nam sông hồng', '2.jpg', 'manager', 'active'),
(2, 'customer', 'customer', 'customer@gmail.com', 'customer', '', '', '', 'customer', 'active'),
(4, 'khaimv13', 'Ma Văn Khải', 'khaimv13@gmail.com', 'khai', '0865969204', 'Kim Tân, Kim Phượng, Định Hóa, Thái Nguyên', 'khainopro.jpg', 'admin', 'active'),
(5, 'luanpt11', 'Phan Thành Luân', 'phanthanhluana8@gmail.com', '1234567890', '0865969204', '', '6.jpg', 'customer', 'active'),
(35, 'luanpt111', NULL, 'luana8@gmail.com', 'luan12341', NULL, NULL, NULL, 'customer', 'active'),
(36, 'luanpt112', 'Phan Thành Luân', 'phanthanhluana81@gmail.com', '$2y$10$Iqe2YJpBycI01jQ8Zcbq5ezfRX5a0aUuZyOGpqW2Ll9.ZVAPDThcu', '0865969204', '17- Nam sông hồng', '550AEACE-8837-4075-B0D2-FD0757175A40 (1).jpeg', 'manager', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_id` int NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `value` int NOT NULL,
  `category_code` tinyint(1) NOT NULL,
  `date_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `code`, `value`, `category_code`, `date_start`, `date_end`, `quantity`) VALUES
(1, 'FDFD#5FD', 100000, 0, '2024-06-14 21:49:00', '2024-06-21 14:49:00', 10),
(2, 'FDFD5FD', 90, 1, '2024-06-14 21:43:00', '2024-06-15 14:43:00', 8),
(3, 'luandz123', 50, 1, '2024-05-26 16:35:05', '2024-05-31 09:34:44', 0),
(4, 'FDFD#5FD3', 12, 1, '2024-06-10 10:48:00', '2024-06-11 03:48:00', 100),
(15, 'FDFD5FD12 ', 100000, 0, '2024-06-13 21:18:00', '2024-06-14 14:18:00', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `FOREIGN KEY` (`user_id`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`cart_detail_id`),
  ADD KEY `FK_cart_detail_1` (`cart_id`),
  ADD KEY `FK_cart_detail_2` (`product_detail_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`evaluation_id`),
  ADD KEY `FK1` (`product_id`),
  ADD KEY `FK2` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK1_order` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `FK_order` (`order_id`);

--
-- Indexes for table `order_evaluation`
--
ALTER TABLE `order_evaluation`
  ADD PRIMARY KEY (`evaluation_id`),
  ADD KEY `FK1_eva` (`order_id`),
  ADD KEY `FK2_eva` (`user_id`);

--
-- Indexes for table `payment_momo`
--
ALTER TABLE `payment_momo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_sanpham` (`category_id`);

--
-- Indexes for table `products_detail`
--
ALTER TABLE `products_detail`
  ADD PRIMARY KEY (`product_detail_id`),
  ADD KEY `FK1_sanpham` (`product_id`);

--
-- Indexes for table `products_image`
--
ALTER TABLE `products_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `FK1_image` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart_detail`
--
ALTER TABLE `cart_detail`
  MODIFY `cart_detail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `evaluation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_evaluation`
--
ALTER TABLE `order_evaluation`
  MODIFY `evaluation_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_momo`
--
ALTER TABLE `payment_momo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products_detail`
--
ALTER TABLE `products_detail`
  MODIFY `product_detail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products_image`
--
ALTER TABLE `products_image`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `FK_cart_detail_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `FK_cart_detail_2` FOREIGN KEY (`product_detail_id`) REFERENCES `products_detail` (`product_detail_id`);

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK1_order` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);

--
-- Constraints for table `order_evaluation`
--
ALTER TABLE `order_evaluation`
  ADD CONSTRAINT `FK1_eva` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `FK2_eva` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_sanpham` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `products_detail`
--
ALTER TABLE `products_detail`
  ADD CONSTRAINT `FK1_sanpham` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products_image`
--
ALTER TABLE `products_image`
  ADD CONSTRAINT `FK1_image` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
