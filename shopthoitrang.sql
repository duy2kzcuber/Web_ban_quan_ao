-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 04:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopthoitrang`
--

-- --------------------------------------------------------

--
-- Table structure for table `anhht`
--

CREATE TABLE `anhht` (
  `idanhht` int(11) NOT NULL,
  `anhhienthi` varchar(200) NOT NULL,
  `mota` varchar(50) NOT NULL,
  `ngaytao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anhht`
--

INSERT INTO `anhht` (`idanhht`, `anhhienthi`, `mota`, `ngaytao`) VALUES
(4, '668d689615b13.webp', 'anhchay1', '2024-07-09'),
(5, 'show2.webp', 'anhchay1', '2024-07-09'),
(6, '6.jpg', 'anhchay1', '2024-07-09'),
(7, '7.jpg', 'anhchay1', '2024-07-09'),
(9, 'anhc2.jpg', 'anhchay2', '2024-07-09'),
(10, 'anhc3.jpg', 'anhchay2', '2024-07-09'),
(11, 'anhc4.jpg', 'anhchay2', '2024-07-09'),
(12, 'anhc5.jpg', 'anhchay2', '2024-07-09'),
(13, 'anhc6.jpg', 'anhchay2', '2024-07-09'),
(14, 'chinhsachdieukhoan.png', 'chinhsachdieukhoan', '2024-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `user_id` int(11) DEFAULT NULL,
  `product_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartitems`
--

INSERT INTO `cartitems` (`user_id`, `product_id`, `quantity`, `size`) VALUES
(1, 'AAAA', 5, 'S'),
(1, 'AAAA', 3, 'L'),
(1, 'NZNZNZ', 1, 'S'),
(2, 'AAAA', 4, 'S'),
(6, 'ARRAEW', 1, 'S'),
(8, 'AAAA', 1, 'XL'),
(7, 'AAAA', 1, 'XL'),
(3, 'AAAA', 10, 'XL'),
(9, 'APL4', 2, 'M'),
(9, 'AAAA', 3, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `madm` int(200) NOT NULL,
  `tendm` varchar(200) NOT NULL,
  `danhmuccha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`madm`, `tendm`, `danhmuccha`) VALUES
(1, 'ÁO POLO NAM', 'NAM'),
(2, 'ÁO SƠ MI NAM', 'NAM'),
(3, 'ÁO VEST NAM', 'NAM'),
(4, 'QUẦN LỬNG', 'NAM'),
(5, 'QUẦN DÀI', 'NAM'),
(6, 'PHỤ KIỆN', 'NAM'),
(7, 'ÁO SƠ MI NỮ', 'NỮ'),
(8, 'QUẦN DÀI NỮ', 'NỮ'),
(9, 'ÁO TRẺ EM', 'TRẺ EM'),
(10, 'QUẦN TRẺ EM', 'TRẺ EM'),
(11, 'SALE 10%', 'SALE'),
(12, 'SALE 30%', 'SALE'),
(13, 'SALE 50%', 'SALE'),
(333, 'Aó Bóng Đá', 'Nam');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manv` int(20) NOT NULL,
  `tennv` varchar(50) NOT NULL,
  `ngaysinh` date NOT NULL DEFAULT current_timestamp(),
  `diachi` varchar(50) NOT NULL,
  `gioitinh` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `sdt` varchar(50) NOT NULL,
  `ngayvaolam` date NOT NULL DEFAULT current_timestamp(),
  `luong` int(30) NOT NULL,
  `ghichu` varchar(100) NOT NULL,
  `matkhau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `tennv`, `ngaysinh`, `diachi`, `gioitinh`, `email`, `sdt`, `ngayvaolam`, `luong`, `ghichu`, `matkhau`) VALUES
(2, 'Nguyễn Hữu Duy', '2024-07-10', 'dc1', 'Nam', 'duy456x@gmail.com', '12345', '2024-07-10', 123456, 'mmm', '67cbe2f9185a4d6f4aee19bf726defab'),
(3, 'Nguyễn Hữu Duy', '2024-07-10', 'dc1', 'Nam', 'duy456v1x@gmail.com', '012345', '2024-07-10', 200000, 'note1', '67cbe2f9185a4d6f4aee19bf726defab'),
(4, 'Nguyễn Hữu Duy', '2024-07-10', 'qqq', 'Nam', 'duy456x@gmail.com', '12344', '2024-07-10', 12344, 'zzz', '67cbe2f9185a4d6f4aee19bf726defab');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `masp` varchar(30) NOT NULL,
  `tensp` varchar(255) NOT NULL,
  `sl` int(11) NOT NULL,
  `dongia` decimal(10,2) NOT NULL,
  `thanhtien` decimal(12,2) NOT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_detail_id`, `order_id`, `masp`, `tensp`, `sl`, `dongia`, `thanhtien`, `size`) VALUES
(100, 85, 'AAAA', 'ÁO SƠ MI THUN', 1, 230000.00, 280000.00, 'XL'),
(101, 86, 'AAAA', 'ÁO SƠ MI THUN', 2, 230000.00, 510000.00, 'XL'),
(102, 87, 'AAAA', 'ÁO SƠ MI THUN', 3, 230000.00, 740000.00, 'XL'),
(103, 88, 'AAAA', 'ÁO SƠ MI THUN', 9, 230000.00, 2120000.00, 'XL'),
(104, 89, 'AAAA', 'ÁO SƠ MI THUN', 10, 230000.00, 2350000.00, 'XL'),
(105, 90, 'APL4', 'ÁO POLO PHỐI KẺ', 1, 237000.00, 287000.00, 'M'),
(106, 91, 'APL4', 'ÁO POLO PHỐI KẺ', 1, 237000.00, 237000.00, 'M'),
(107, 91, 'AAAA', 'ÁO SƠ MI THUN', 1, 230000.00, 230000.00, 'XL'),
(108, 92, '2323', '222', 1, 333.00, 333.00, 'S'),
(109, 92, '2323', '222', 1, 333.00, 333.00, 'L'),
(110, 93, 'AAAA', 'ÁO SƠ MI THUN', 1, 230000.00, 230000.00, 'XL'),
(111, 94, '2323', '222', 1, 333.00, 333.00, 'L'),
(112, 94, 'AAAA', 'ÁO SƠ MI THUN', 1, 230000.00, 230000.00, 'XL'),
(113, 95, 'APL4', 'ÁO POLO PHỐI KẺ', 1, 237000.00, 237000.00, 'M'),
(114, 95, 'AAAA', 'ÁO SƠ MI THUN', 2, 230000.00, 460000.00, 'XL'),
(115, 96, 'APL4', 'ÁO POLO PHỐI KẺ', 2, 237000.00, 474000.00, 'M'),
(116, 96, 'AAAA', 'ÁO SƠ MI THUN', 3, 230000.00, 690000.00, 'XL'),
(117, 97, 'AAAA', 'ÁO SƠ MI THUN', 1, 230000.00, 230000.00, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ten_khach_hang` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `dia_chi` text NOT NULL,
  `tongtien` int(30) NOT NULL,
  `pttt` varchar(50) NOT NULL,
  `ngay_dat_hang` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngay_nhan_hang` date NOT NULL DEFAULT current_timestamp(),
  `trangthai` varchar(50) NOT NULL,
  `processed` tinyint(1) DEFAULT 0,
  `processed1` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `ten_khach_hang`, `so_dien_thoai`, `dia_chi`, `tongtien`, `pttt`, `ngay_dat_hang`, `ngay_nhan_hang`, `trangthai`, `processed`, `processed1`) VALUES
(85, 3, 'cddc', 'cddcd', 'cdcd', 280000, 'cod', '2024-07-09 17:25:21', '2024-07-13', 'Hoàn hàng', 1, 1),
(86, 3, 'dsdss', 'dsdsdds', 'dsdsdsd', 510000, 'online-payment', '2024-07-09 17:29:56', '2024-07-13', 'Hoàn hàng', 1, 1),
(87, 3, 'eerere', '2222', '333', 740000, 'cod', '2024-07-09 17:31:41', '2024-07-13', 'Đã xác nhận', 1, NULL),
(88, 3, 'rrrr', '5555', 'fdff', 2120000, 'online-payment', '2024-07-09 17:35:57', '2024-07-13', 'Hoàn hàng', 1, 1),
(89, 3, 'ssnsnns', 'nsnsns', 'nsnsn', 2350000, 'cod', '2024-07-09 17:41:43', '2024-07-13', 'Hoàn hàng', 1, 1),
(90, 0, 'ng huu duy', '12345', 'zzzz', 337000, 'online-payment', '2024-07-10 01:08:07', '2024-07-13', 'Chờ xác nhận', 0, 0),
(91, 9, 'Nguyen huu Duy', '15792617', '12345', 517000, 'cod', '2024-07-10 01:25:03', '2024-07-13', 'Chưa xác nhận', 0, 0),
(92, NULL, 'ad', '12345', 'zzcxzc', 50666, 'online-payment', '2024-07-10 03:58:12', '2024-07-13', 'Chờ xác nhận', 0, 0),
(93, NULL, 'asasa', 'sassa', 'aaasasas', 280000, 'online-payment', '2024-07-10 06:27:16', '2024-07-13', 'Đã xác nhận', 1, 0),
(94, NULL, 'duy', '123', 'cxzcxzz', 280333, 'online-payment', '2024-07-10 07:06:09', '2024-07-13', 'Chờ xác nhận', 0, 0),
(95, 9, 'Nguyen huu Duy', '15792617', '12345', 747000, 'cod', '2024-07-10 07:11:25', '2024-07-13', 'Chưa xác nhận', 0, 0),
(96, 9, 'Nguyen huu Duy', '15792617', '12345', 1214000, 'cod', '2024-07-10 07:30:51', '2024-07-13', 'Chưa xác nhận', 0, 0),
(97, NULL, 'ssaas', 'ss', 'sss', 280000, 'cod', '2024-07-10 10:50:07', '2024-07-13', 'Đã xác nhận', 0, 0),
(98, NULL, 'Nguyen huu Duy', '44', 'ggf', 510000, 'online-payment', '2024-07-10 11:07:20', '2024-07-13', 'Chờ xác nhận', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `masp` varchar(30) NOT NULL,
  `tensp` varchar(400) NOT NULL,
  `gia` varchar(200) NOT NULL,
  `mausac` varchar(200) NOT NULL,
  `gioithieu` varchar(500) NOT NULL,
  `ctsp` varchar(500) NOT NULL,
  `baoquan` varchar(500) NOT NULL,
  `anh` varchar(300) NOT NULL,
  `anhmt1` varchar(200) NOT NULL,
  `madm` int(200) NOT NULL,
  `ngaytao` date NOT NULL DEFAULT current_timestamp(),
  `anhmt2` varchar(200) NOT NULL,
  `anhmt3` varchar(200) NOT NULL,
  `gianhap` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`masp`, `tensp`, `gia`, `mausac`, `gioithieu`, `ctsp`, `baoquan`, `anh`, `anhmt1`, `madm`, `ngaytao`, `anhmt2`, `anhmt3`, `gianhap`) VALUES
('AAAA', 'ÁO SƠ MI THUN', '230000', 'TRẮNG', '1', '2', '3', 'ASM1.webp', 'ASM1.1.webp', 7, '2024-06-24', 'ASM1.2.webp', 'ASM1.3.webp', 175000),
('ABJJBA', 'ÁO NAM CỔ VIỀN ', '200000', 'ĐEN', '1', '2', '3', '28b6f91cb2f737f3c3c3937f054f2028.webp', '244124735cf9077cebc802d68c7ccc56.webp', 13, '2024-06-24', '503a2cbd178490e8834bce0d817c7f09.webp', '93cd567f7511790496184ad302b59eb3.webp', 120000),
('APL1', 'ÁO THUN', '237000', 'TRẮNG', '1', '2', '3', '1.webp', '1.3.webp', 1, '2024-06-24', '1.2.webp', '1.1.webp', 175000),
('APL4', 'ÁO POLO PHỐI KẺ', '237000', 'XANH DƯƠNG', '1', '2', '3', '4.webp', '4.1.webp', 1, '2024-06-24', '4.2.webp', '4.3.webp', 175000),
('APL5', 'ÁO POLO NAM MÀU ĐEN', '237000', 'ĐEN', '1', '2', '3', '5.webp', '5.1.webp', 1, '2024-06-24', '5.2.webp', '5.3.webp', 150000),
('APL6', 'ÁO POLO VẢI SỢI MODAL', '237000', 'VÀNG', '1', '2', '3', '6.webp', '6.1.webp', 1, '2024-06-24', '6.2.webp', '6.3.webp', 150000),
('APL7', 'ÁO POLO NAM DÂY KÉO KHÓA', '200000', 'TRẮNG', '1', '2', '3', '7.webp', '7.1.webp', 1, '2024-06-24', '7.2.webp', '7.3.webp', 125000),
('APL8', 'ÁO POLO XẺ GẤU 2 BÊN', '230000', 'XANH LÁ', '1', '2', '3', '8.webp', '8.1.webp', 1, '2024-06-24', '8.2.webp', '8.3.webp', 150000),
('ARRAEW', 'ÁO PHỐI CHỮ BÉ GÁI', '300000', 'TRẮNG', '1', '2', '3', 'ATE1.webp', 'ATE2.webp', 9, '2024-06-24', 'ATE3.webp', 'ATE4.webp', 200000),
('ASM1', 'ÁO SƠ MI TRẮNG NGẮN TAY', '200000', 'TRẮNG', '1', '2', '3', 'a.webp', 'a.1.webp', 2, '2024-06-24', 'a.2.webp', 'a.3.webp', 130000),
('ASM2', 'ÁO SƠ MI DENIM', '300000', 'XANH DƯƠNG', '1', '2', '3', 'b.1.webp', 'b.2.webp', 2, '2024-06-24', 'b.3.webp', 'b.webp', 150000),
('ASM3', 'ÁO SƠ MI', '222222', 'ĐỎ', '1', '22', '33', 'c.1.webp', 'c.2.webp', 2, '2024-06-24', 'c.3.webp', 'c.webp', 150000),
('BBBB', 'ÁO SƠ MI NỮ VIỀN', '300000', 'TRẮNG', '1', '2', '3', 'ASM2.webp', 'ASM2.1.webp', 7, '2024-06-24', 'ASM2.2.webp', 'ASM2.3.webp', 175000),
('CCC', 'ÁO SƠ MI COREAN', '222222', 'TRẮNG', '1', '2', '3', 'ASM3.1.webp', 'ASM3.2.webp', 7, '2024-06-24', 'ASM3.3.webp', 'ASM3.webp', 175000),
('CCVCCV', 'QUẦN CATON SIÊU MÁT ', '232323', 'XANH', '1', '2', '3', '0b0b2149d4a5474fab58b60985f8c557.webp', '4c83d6d2a32c4e8daa992679d7c86366.webp', 10, '2024-06-24', '7a28051db29c6fda44dc08ecec21343d.webp', 'bec6d6f2e92227c3760a422e337525d2.webp', 150000),
('DDD', 'QUẦN THUN ASE', '222222', 'VÀNG', '1', '2', '3', 'AAA.webp', 'AAA2.webp', 8, '2024-06-24', 'AAA.webp', 'AAA2.webp', 150000),
('DDDDD', 'QUẦN THUN CỔ VUÔNG', '230000', 'ĐEN', '1', '2', '3', 'D.webp', 'D1.webp', 8, '2024-06-24', 'D2.webp', 'D3.webp', 170000),
('EEE', 'QUẦN VẢI ỐNG LOE', '200000', 'ĐEN', '1', '2', '3', 'C.2.webp', 'C.4.webp', 8, '2024-06-24', 'C.3.webp', 'C.2.webp', 150000),
('EEEREDC', 'ÁO GOLDDLE BÉ GÁI', '230000', 'VÀNG', '1', '2', '3', 'ATE5.webp', 'ATE6.webp', 9, '2024-06-24', 'ATE7.webp', 'ATE8.webp', 170000),
('FCFDD', 'QUẦN PINK PHONG CÁCH', '230000', 'HỒNG', '1', '2', '3', '6a894a6648f5684ca14acd574aa286b1.webp', '6b891c36d46e941bd662d6b6394ab337.webp', 11, '2024-06-24', '9be8693c36bd084ea06907b7f565833f.webp', 'ba47c4e25ee6916ace50af66f6f7656d.webp', 170000),
('JGJGGKGK', 'QUẦN XANH BỘ ĐỘI', '121221', 'XANH LÁ', '1', '2', '3', '8d021d4b178bee740fefbf572d393ec7.webp', '33aff7f59bb2c16c99a304ed4175fa67.webp', 10, '2024-06-24', '9282c848139604742bb9b53ca68d32ba.webp', '33aff7f59bb2c16c99a304ed4175fa67.webp', 75000),
('NZNZNZ', 'SET VÁY THỜI TRANG', '255000', 'TRẮNG', '1', '2', '3', '4409b583676402600691b454908d6723.webp', 'c1a4e2a72584aee356231e48e53ca2f6.webp', 12, '2024-06-24', '4409b583676402600691b454908d6723.webp', 'c1a4e2a72584aee356231e48e53ca2f6.webp', 175000),
('REEERRE', 'ÁO GREEN BÉ TRAI', '333433', 'XANH LÁ', '1', '2', '3', 'ATE9.webp', 'ATE10.webp', 9, '2024-06-24', 'ATE11.webp', 'ATE12.webp', 200000),
('SADAAA', 'ÁO BẠC PHA BÉ TRAI', '121212', 'XÁM', '1', '2', '3', 'ATE13.webp', 'ATE14.webp', 9, '2024-06-24', 'ATE15.webp', 'ATE14.webp', 75000),
('VVHVJH', 'SET TRẺ EM ĐI BIỂN', '230000', 'TRẮNG', '1', '2', '3', '17b8ef1a5fe8f052cb1dbca2933b9148.webp', '4dcf7692ba13f0179380eee90f353a52.webp', 13, '2024-06-24', 'c1b6c6b7eb436e507c488a6c7743771b.webp', 'd65d8ea891a0f24dab1228fe06269291.webp', 150000),
('XCXVD', 'ÁO SƠ MI CỔ VUÔNG', '121211', 'TRẮNG', '1', '2', '3', 'fa8eb3a2956d1d295ca1f7efff93bfb0.webp', 'e579037f85f21f4fceebd8ac37d48d18.webp', 11, '2024-06-24', 'e579037f85f21f4fceebd8ac37d48d18.webp', 'fa8eb3a2956d1d295ca1f7efff93bfb0.webp', 80000),
('XZXXC', 'QUẦN HFSS BÉ GÁI', '232223', 'ĐEN', '1', '2', '3', '15d2be76986a12286858b2f50200ab30.webp', 'f5f9e5116bcc8ddd24ce4c00c6ae26f1.webp', 10, '2024-06-24', 'fea88dbb9ee7077323fe892bc2c4ed2a.webp', '3136eb7bbe0fae233d402bb989b0b24f.webp', 150000);

-- --------------------------------------------------------

--
-- Table structure for table `productsize`
--

CREATE TABLE `productsize` (
  `id` varchar(50) NOT NULL,
  `soluongsize` int(40) NOT NULL,
  `masp` varchar(50) NOT NULL,
  `idprd` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productsize`
--

INSERT INTO `productsize` (`id`, `soluongsize`, `masp`, `idprd`) VALUES
('1', 0, 'AAAA', 11),
('2', 0, 'AAAA', 13),
('3', 0, 'AAAA', 14),
('2', 12, 'APL4', 15),
('4', 81, 'AAAA', 16),
('1', 5000, '2323', 17),
('3', 200, '2323', 19),
('1', 2000, 'XZXXC', 20),
('1', 20000, 'ARRAEW', 21),
('1', 20000, 'ASM1', 22);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `matk` int(11) NOT NULL,
  `tenkh` varchar(50) NOT NULL,
  `sdt` varchar(50) NOT NULL,
  `ns` varchar(50) NOT NULL,
  `gt` varchar(50) NOT NULL,
  `dc` varchar(200) NOT NULL,
  `mk` varchar(200) NOT NULL,
  `tgtao` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`matk`, `tenkh`, `sdt`, `ns`, `gt`, `dc`, `mk`, `tgtao`) VALUES
(1, 'Hùng', '12345', '2024-06-25', 'Nữ', '12aaaa', '$2y$10$qTWcqtcGujGqJUxyl72b5Owgy.WTXO/dYuAwvvgmq40dCuQyMhkiG', '2024-07-09'),
(2, 'vietdeptrai', '122', '2024-06-25', 'Nam', 'sdada', '$2y$10$4OGrUilpq/iU50UTRT.yq.w1zqq.GWbolGH3NEZ5MaIiGegCCoepG', '2024-07-09'),
(3, 'Nguyễn Quốc Việt', '0372751413', '2004-12-06', 'Nữ', 'Thái Bình', '$2y$10$IjO09QPZf763I2NhiwRdC.asi/BIhzXtB.MBgHz38ofSVMhJFYv52', '2024-07-09'),
(4, '<br /><b>Warning</b>:  Undefined variable $user in', '<br /><b>Warning</b>:  Undefined variable $user in', '', 'Nam', '<br /><b>Warning</b>:  Undefined variable $user in <b>C:xampphtdocsThoitrang_VHTDTackendThongTin.php</b> on line <b>193</b><br /><br /><b>Warning</b>:  Trying to access array offset on value of type ', '$2y$10$1S9YJuXYMWqw3F/RmzS1z.1i4Bl9IH8GQOcDBqn1c.oBq12.hWvH2', '2024-07-09'),
(5, 'huy', '999', '2024-06-29', 'Nam', '012345', '$2y$10$SiWBdWpZXR7kxSQBS1xG3OB6X6YHDtjmw/AC2lVDBURlwnbgXJgyS', '2024-07-09'),
(6, 'Lê Đức Hùng', '03456789', '2024-06-26', 'Nam', 'DalLak', '$2y$10$6qLiNdNjkUAdID9aqdD5pOfzVu0XML/LqWfMwWnNoCxGEsenlobwG', '2024-07-09'),
(7, 'Tuệ', '03727514132', '2024-07-09', 'Nữ', '0372751413', '$2y$10$VqZIy.laeLGgimESyAPBYe4pA3DiDkdSbwu//m.2t8u7hWKuXvmmC', '2024-07-09'),
(8, 'cho', '0', '2024-07-19', 'Nữ', 'fg', '$2y$10$dghhdzreM5suvOMKOGeYhO0k7LIVWUXYvi.zCsZbFoq2hWNvoQ0sy', '2024-07-09'),
(9, 'Nguyen huu Duy', '15792617', '2024-07-10', 'Nam', '12345', '$2y$10$S4nu.4z63t4FU15zRuOSc.zcPGaRo2Yqu1qqcONoUndendXE.3ZPi', '2024-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `tensize`
--

CREATE TABLE `tensize` (
  `id` varchar(200) NOT NULL,
  `tensize` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tensize`
--

INSERT INTO `tensize` (`id`, `tensize`) VALUES
('1', 'S'),
('2', 'M'),
('3', 'L'),
('4', 'XL'),
('5', 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `tintuc`
--

CREATE TABLE `tintuc` (
  `tieude` varchar(50) NOT NULL,
  `noidung` varchar(50) NOT NULL,
  `ngaytao` date NOT NULL,
  `hinhanh` varchar(50) NOT NULL,
  `idtintuc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tintuc`
--

INSERT INTO `tintuc` (`tieude`, `noidung`, `ngaytao`, `hinhanh`, `idtintuc`) VALUES
('Giới thiệu cửa hàng', 'Bộ sưu tập mới', '2024-07-09', '668cf03699788.jpg', 2),
('Giới thiệu về bộ sưu tập mới', 'Thiết kế trẻ trung, năng động phù hợp với mọi lứa ', '2024-07-09', '4ac2fae8eb1784e6c23fa846611d6fb9.gif', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anhht`
--
ALTER TABLE `anhht`
  ADD PRIMARY KEY (`idanhht`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`madm`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manv`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`masp`);

--
-- Indexes for table `productsize`
--
ALTER TABLE `productsize`
  ADD PRIMARY KEY (`idprd`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`matk`);

--
-- Indexes for table `tensize`
--
ALTER TABLE `tensize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`idtintuc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anhht`
--
ALTER TABLE `anhht`
  MODIFY `idanhht` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `manv` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `productsize`
--
ALTER TABLE `productsize`
  MODIFY `idprd` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `matk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `idtintuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
