-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2023 at 09:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gleetechsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) DEFAULT 'profile.png',
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(50) DEFAULT NULL,
  `active` bit(1) NOT NULL DEFAULT b'0',
  `updated_by` int(11) NOT NULL,
  `email_add` varchar(100) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `valid_until` varchar(30) DEFAULT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `date_updated` date NOT NULL DEFAULT current_timestamp(),
  `account_activated` bit(1) NOT NULL DEFAULT b'0',
  `contact` varchar(15) DEFAULT NULL,
  `banned` bit(1) DEFAULT b'0',
  `reason_for_banning` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`, `user_type`, `active`, `updated_by`, `email_add`, `token`, `valid_until`, `employee_id`, `date_updated`, `account_activated`, `contact`, `banned`, `reason_for_banning`) VALUES
(1, 'whitebeard', '$2y$10$4.KBRBJ2j9yOIM4y5ys4Vu4jVLJcBhUW8fDJsdBvajXRvTcWLS09q', 'Edward', 'Newgate', 'profile5.png', '2023-03-01', 'Admin', b'1', 1, 'admin@gleetechsolutionsproviderco.com', NULL, '2023-07-27 03:20:22', '0', '2023-04-07', b'1', '090495849', b'0', ''),
(19, 'escanor', '$2y$10$IvmMigJP7a2Nvs9PEhr18e/IlMhn2BMlUVyyVg.3by2iYY9nXhigK', 'Escanor', 'Lion Sin', 'escanor.jpg', '2023-04-09', 'Customer', b'1', 1, 'iamjonatshere@gmail.com', NULL, '2023-06-15 21:00:18', '2023-251349870', '2023-07-31', b'1', '7638897', b'0', ''),
(38, 'whitebeard', '$2y$10$YD1GqGB.UD8F7ud350fKXezfCWjEnQ1nDgShzbnEwDqSrHYZBjxmq', 'edward', 'newgate', 'profile.jpg', '2023-07-29', 'Customer', b'0', 0, 'whitebeard@test.com', '47e3b397d966b0959d4b9b0856704ddc', '2023-07-31 19:50:51 PM', NULL, '2023-07-30', b'0', '0904950495', b'0', ''),
(39, 'lionking', '$2y$10$Mn4KPp1fgqbin2wZdcLcMOSMAtHI4T/iheMewOAJW1GP48Cu5N4p.', 'admn', 'admin', 'profile.jpg', '2023-07-29', 'Customer', b'0', 0, 'admin@test.com', '48d2898cd60dd4f68f4f084e62297c56', '2023-07-31 20:20:52 PM', NULL, '2023-07-30', b'0', '09404', b'0', ''),
(40, 'lionqueen', '$2y$10$cE94jkwwWhi6CheB/cPLpOYBtwsCmhRDREkkAbRVV7gpQ.Na1mKJ6', 'user', 'nam', 'profile.jpg', '2023-07-29', 'Customer', b'0', 0, 'lionqueen@test.com', 'b7deffb34ec25e93032a3047f9a900d0', '2023-07-31 20:24:17 PM', NULL, '2023-07-30', b'0', '40905945', b'0', ''),
(41, 'lionprincess', '$2y$10$M0UPSNjJM/e4GqjJrcEOLuNBoP3kQrlhMhvGKY/jtG8gfXyD/B8fO', 'lion', 'princess', 'profile.jpg', '2023-07-29', 'Customer', b'0', 0, 'lionprincess@test.com', 'baec06178f1e5fca9411a61cb901b897', '2023-07-31 20:25:49 PM', NULL, '2023-07-30', b'0', '05049504', b'0', ''),
(42, 'kinglion', '$2y$10$/LXmIBBgeCYLOKHuTgZS/ep5UYH/kEWmyTXnQ0NDqk04OJrESpb.q', 'lion', 'king', 'profile.jpg', '2023-07-30', 'Customer', b'0', 1, 'lionking@demo.com', 'c1172b90b98e4bd0755b9cfb870af28b', '2023-07-31 20:56:28 PM', NULL, '2023-07-30', b'0', '09409409', b'0', ''),
(43, 'angelaperez', NULL, 'Angela', 'Perez', 'admin.png', '2023-07-30', 'Staff', b'0', 1, 'angel.perez@test.com', '2b18f88c2efabcc253a74d8b3e87734b', '2023-08-01 23:47:02', 'ATL395024781', '2023-07-30', b'0', NULL, b'0', ''),
(44, 'johntoledo', '$2y$10$zyYlq.jLBlxcoQer9SKym.3cOPhd98p/DpFWkYeI1LZT1EwvhfFCe', 'John', 'Toledo', 'admin.png', '2023-07-31', 'Staff', b'1', 1, 'johntoledo1900@gmail.com', NULL, '2023-08-02 01:08:13', '2023-35749', '2023-07-31', b'1', NULL, b'0', '');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `num_hr`) VALUES
(95, 9, '2023-03-02', '07:00:00', 1, '16:00:00', 8),
(98, 9, '2023-02-01', '07:00:00', 1, '16:00:00', 8),
(99, 9, '2023-01-02', '07:00:00', 1, '18:45:00', 8),
(106, 9, '2023-04-01', '08:15:00', 0, '20:00:00', 7.75),
(107, 9, '2023-04-03', '02:28:03', 1, '02:28:19', 4.5166666666667),
(108, 9, '2023-03-31', '07:00:00', 1, '16:00:00', 7),
(109, 18, '2023-04-04', '07:00:00', 1, '16:00:00', 7),
(110, 9, '2023-04-05', '05:13:01', 1, '05:13:20', 2.7666666666667),
(111, 18, '2023-04-05', '06:11:38', 1, '07:09:02', 0.96),
(112, 18, '2023-07-30', '05:16:20', 1, '05:18:17', 0.03),
(113, 18, '2023-07-24', '08:00:00', 1, '18:00:00', 8),
(114, 18, '2023-06-01', '08:00:00', 1, '17:00:00', 8),
(115, 18, '2023-06-14', '08:00:00', 1, '17:00:00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `date_added` date DEFAULT current_timestamp(),
  `active` bit(1) DEFAULT b'1',
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `added_by`, `date_added`, `active`, `category_id`) VALUES
(21, 'Hikvision', 1, '2023-03-28', b'1', 11),
(30, 'Nvision', 1, '2023-03-30', b'1', 13),
(31, 'Hikvision', 1, '2023-03-28', b'1', 14),
(32, 'Hikvision', 1, '2023-03-28', b'1', 15),
(39, 'N/A', 1, '2023-03-28', b'1', 28),
(40, 'Dahua', 1, '2023-04-10', b'1', 11),
(41, 'Dahua', 1, '2023-04-10', b'1', 12),
(43, 'Dahua', 1, '2023-04-10', b'1', 15),
(44, 'Hikvision', 1, '2023-04-10', b'1', 12);

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE `cashadvance` (
  `id` int(11) NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cashadvance`
--

INSERT INTO `cashadvance` (`id`, `date_advance`, `employee_id`, `amount`) VALUES
(7, '2023-04-03', '9', 100);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `date_added` date DEFAULT current_timestamp(),
  `active` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `added_by`, `date_added`, `active`) VALUES
(11, 'CCTV Camera', 1, '2023-03-28', b'1'),
(12, 'CCTV Cable', 1, '2023-03-28', b'1'),
(13, 'CCTV Monitor', 1, '2023-03-28', b'1'),
(14, 'CCTV Router', 1, '2023-03-28', b'1'),
(15, 'CCTV DVR', 1, '2023-03-28', b'1'),
(17, 'Solar Panels', 1, '2023-03-28', b'1'),
(18, 'Solar Power Systems Disconnects', 1, '2023-03-28', b'1'),
(19, 'Solar Inverters', 1, '2023-03-28', b'1'),
(20, 'Racks and Mounts', 1, '2023-03-28', b'1'),
(21, 'Solar Power Meter', 1, '2023-03-28', b'1'),
(22, 'Solar Batteries', 1, '2023-03-28', b'1'),
(23, 'Computer Hardware Components', 1, '2023-03-28', b'1'),
(24, 'TV Components', 1, '2023-03-28', b'1'),
(26, 'Network Router', 1, '2023-03-28', b'1'),
(29, 'Others', 1, '2023-03-28', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `description`, `amount`) VALUES
(1, 'SSS', 100),
(2, 'Pagibig', 150),
(3, 'PhilHealth', 150);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `philhealth` varchar(20) NOT NULL,
  `sss` varchar(20) NOT NULL,
  `pagibig` varchar(20) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `term_date` varchar(10) DEFAULT NULL,
  `email_add` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `position_id`, `schedule_id`, `photo`, `created_on`, `philhealth`, `sss`, `pagibig`, `active`, `term_date`, `email_add`) VALUES
(9, 'ATL395024781', 'Angela', 'Perez', 'Manila', '1990-07-18', '09256526616', 'Female', 5, 6, 'profile.png', '2023-07-30', '349580095859', '5888947487', '985959686900', b'1', '', 'angel.perez@test.com'),
(18, '2023-237960548', 'dell', 'vargas', 'quezon city', '1993-07-10', '09304930490', 'Male', 6, 6, '', '2023-04-03', '749480028282', '3839494057', '384948494894', b'1', NULL, ''),
(19, '2023-974560328', 'jayson', 'scott', 'lucena', '2000-03-29', '09948494898', 'Male', 2, 8, '', '2023-04-05', '343434343343', '3464563456', '564345457567', b'1', NULL, ''),
(20, '2023-251349870', 'jonats', 'here', 'lucena city', '2000-02-01', '09409540540', 'Male', 7, 6, '', '2023-07-30', '044806950840', '3565766774', '767674545445', b'1', '', 'iamjonatshere@gmail.com'),
(21, '2023-35749', 'John', 'Toledo', '33 Kamagong St., Brgy. Iyam, Lucena City, Quezon', '1990-04-12', '09304895485', 'Male', 2, 6, '', '2023-07-31', '059495840998', '8959485948', '568549849584', b'1', NULL, 'johntoledo1900@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` varchar(10) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_region` varchar(50) DEFAULT NULL,
  `customer_province` varchar(50) DEFAULT NULL,
  `customer_city` varchar(50) DEFAULT NULL,
  `customer_barangay` varchar(100) NOT NULL,
  `customer_street` varchar(100) NOT NULL,
  `customer_postal` varchar(10) NOT NULL,
  `request_id` int(11) NOT NULL,
  `service_amount` double NOT NULL DEFAULT 0,
  `service_discount` double NOT NULL DEFAULT 0,
  `payment_type` int(1) NOT NULL,
  `sub_total` double NOT NULL DEFAULT 0,
  `total` double NOT NULL DEFAULT 0,
  `cash_change` double NOT NULL DEFAULT 0,
  `cash` double NOT NULL DEFAULT 0,
  `service_details` varchar(5000) NOT NULL,
  `generated_date` date NOT NULL DEFAULT current_timestamp(),
  `tax_rate` varchar(3) NOT NULL,
  `tax_amount` double NOT NULL DEFAULT 0,
  `issued_by` int(11) NOT NULL,
  `issued_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `customer_id`, `customer_region`, `customer_province`, `customer_city`, `customer_barangay`, `customer_street`, `customer_postal`, `request_id`, `service_amount`, `service_discount`, `payment_type`, `sub_total`, `total`, `cash_change`, `cash`, `service_details`, `generated_date`, `tax_rate`, `tax_amount`, `issued_by`, `issued_date`) VALUES
('00001', 19, 'NATIONAL CAPITAL REGION (NCR)', 'NCR, CITY OF MANILA, FIRST DISTRICT', 'ERMITA', 'Barangay 659-A', '1089 Mabini St.', '1500', 27, 15300, 2000, 0, 15300, 13300, 0, 0, 'Home service repair', '2023-07-27', '12', 1836, 1, '2023-07-27'),
('00002', 21, 'NATIONAL CAPITAL REGION (NCR)', 'NCR, CITY OF MANILA, FIRST DISTRICT', 'ERMITA', 'Barangay 660', '1028 Dela Cruz St.', '1008', 29, 2000, 0, 0, 2000, 2000, 0, 0, 'Ink cartridge replacement', '2023-07-28', '0', 0, 1, '2023-07-28'),
('00003', 21, 'NATIONAL CAPITAL REGION (NCR)', 'NCR, CITY OF MANILA, FIRST DISTRICT', 'ERMITA', 'Barangay 660', '1028 Dela Cruz St.', '1008', 30, 0, 0, 0, 0, 0, 0, 0, 'Parts replacement', '2023-07-28', '0', 0, 1, '2023-07-28'),
('00004', 21, 'NATIONAL CAPITAL REGION (NCR)', 'NCR, CITY OF MANILA, FIRST DISTRICT', 'ERMITA', 'Barangay 660', '1028 Dela Cruz St.', '1008', 30, 2000, 0, 0, 2000, 2000, 0, 0, 'Work in progress', '2023-07-28', '0', 0, 1, '2023-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `date_overtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `description`, `rate`) VALUES
(2, 'Electronics Technician', 50),
(4, 'Manager', 200),
(5, 'CCTV Technician', 100),
(6, 'Solar Power Technician', 150),
(7, 'Admin Staff', 90),
(8, 'Customer Service Support', 80);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `added_by` int(11) DEFAULT 1,
  `date_added` date DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `active` bit(1) DEFAULT b'1',
  `price` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `brand_id`, `category_id`, `description`, `added_by`, `date_added`, `image`, `active`, `price`) VALUES
(1, 'DS-2CE16D0T-IRPF', 21, 11, '2.0 Megapixel high-performance CMOS\r\nAHD output, up to 1080P resolution\r\nTrue Day/Night\r\nSmart IR\r\n\r\nUp to 20m IR distance\r\nIP67\r\nWeatherproof\r\nSwitchable TVI/AHD/CVI/CVB', 1, '2023-03-29', 'DS-2CE16D0T-IRPF.png', b'1', 800),
(10, 'DS-2CE16D0T-IRPF (Outdoor)', 21, 11, '2.0 Megapixel high-performance CMOS\r\nAHD output, up to 1080P resolution\r\nTrue Day/Night\r\nSmart IR\r\n\r\nUp to 20m IR distance\r\nIP67\r\nWeatherproof\r\nSwitchable TVI/AHD/CVI/CVB', 1, '2023-04-10', '2ce16dot.jpg', b'1', 755),
(11, 'Dahua Bullet 2C (Outdoor)', 40, 11, '1080P Wi-Fi Camera Dual Antenna Outdoor IP67 Weatherproof Audio Recording Camera AI Human Detection Camera', 1, '2023-04-10', 'Dahua Bullet 2C.png', b'1', 1755),
(12, 'DH-HAC-HDW1500TRQN-A (Indoor)', 40, 11, 'Max 25 fps@5MP\r\nCVI/CVBS/AHD/TVI switchable\r\nQuick-to-install eyeball saves installation time\r\n3.6 mm or 2.8mm fixed lens (lens type of unit to be delivered depends on available stock)\r\n\r\nMax. IR length 25 m, Smart IR\r\nBuilt-in Mic, Audio over coaxial cable\r\nIP50, 12V DC\r\nNOTE: Audio function is only supported in CVI mode', 1, '2023-04-10', 'DH-HAC-HDW1500TRQN-A.png', b'1', 1340),
(13, 'DS-1LN5E-S', 44, 12, '305 m CAT5E UTP Network Cable (Solid Copper, 0.5 mm, CM)\r\nFull diameter 305 m CAT5E network cable\r\nCore diameter: 0.5mm\r\nExcellent transmission performance using solid copper\r\nQuality verified by Fluke test\r\nGuaranteed long PoE transmission distance\r\nGreat PVC flame resistance.', 1, '2023-04-10', '305 m CAT5E UTP.png', b'1', 5927),
(14, 'PFM920I-5EUN', 41, 12, 'UTP CAT5e Cable\r\n\r\n> 305 m (1000 ft)/carton UTP CAT5e, power over Ethernet, compatible with one cable\r\n\r\n> High-purity oxygen-free copper conductor\r\n\r\n> Customized PVC outer sheath; CE CPR Eca flame retardant class certified', 1, '2023-04-10', 'PFM920I-5EUN.png', b'1', 3200),
(15, 'N190HD', 30, 13, 'Screen Resolution: (N190HD: 1440 X 900) (N185HD: 1366x768) (N200HD: 1600 x 900) (V190H: 1440 x 900)\r\nScreen Size: 18.5” / 19” / 20”\r\nResponse Time: 5ms\r\nRefresh Rate: 60hz\r\n\r\nContrast Ratio: 1000:01:00\r\nPanel Type: TN\r\nBack Light: LED\r\nActive Area: 24mmx255.15mm (HxV)\r\nBrightness: 250cd/m2\r\nConnection Port: HDMI, VGA', 1, '2023-04-10', 'N190HD .png', b'1', 2440),
(16, 'DS-3WR12C', 31, 14, 'Data Rate ≤ 1167 Mbps ; 2.4 GHz: 300 Mbps ; 5 GHz: 867 Mbps\r\nWireless Standard IEEE 802.11/a/n/ac wave 2 @5GHz, IEEE 802.11b/g/n @2.4GHz\r\nTransmitting Power 18 dBm\r\nWireless Performance 4 × 4 MU-MIMO supported ; Beamforming supported\r\nReceiving Sensitivity 58 ± 2 dB@AC80 -MCS9 ; 84 ± 2 dB@AC80 -MCS0\r\n4 high gain antennas\r\n\r\nNetwork Interface 4 × RJ45, 10/100 Mbps auto-negotiation\r\nLED indicator\r\nReset button\r\nPower Supply Method 9 VDC, 1 A power adapter power supply\r\nPower Specifications 9 VDC, 1 A\r\nSecurity Mode WPA-PSK, WPA2-PSK, WPA and WPA2 supported\r\nSecurity Mechanism Hide SSID\r\nManagement Method Web, APP\r\nSKU\'S PH3021720', 1, '2023-04-10', 'DS-3WR12C.png', b'1', 999),
(17, 'DH-XVR1B04', 43, 15, '4 Channel Penta-brid 1080N/720p Cooper 1U 1HDD WizSense Digital Video Recorder', 1, '2023-04-10', 'DH-XVR1B04.png', b'1', 1343.25),
(18, 'DS-7208HGHI-K1(S)', 32, 15, 'Support H.265+/H.265/H.264+/H.264 video compression.\r\nIP Video Input 2-ch (up to 10-ch) Up to 5 MP resolution for IP Cameras Support H.265+/H.265/H.264+/H.264 IP cameras\r\nSupport HDTVI/AHD/CVI/CVBS/IP video input.\r\nEncoding ability up to 1080p lite @ 15 fps.\r\n\r\nMax 800 m for 1080p and 1200 m for 720p HDTVI signal.\r\n(S) Models supports Hikvision Cameras with Built-in-Mic otherwise known as AoC (Audio over Coax).\r\nUp to 6 TB capacity per HDD.', 1, '2023-04-10', 'DS-7208HGHI-K1.png', b'1', 3500),
(19, 'GLEE Tech Point Sale System', 0, 27, 'Features\r\na. Sales  Dashboard (Daily, Monthly, Annual)\r\nb. Inventory Management\r\nc. Billing System\r\nd. Reports generation\r\n\r\nSystem Type : Desktop application\r\nDatabase : SQL Server', 1, '2023-04-10', '', b'1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_notes` varchar(5000) NOT NULL,
  `request_status_id` int(11) DEFAULT 2,
  `request_date` date NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) NOT NULL,
  `modified_date` date NOT NULL DEFAULT current_timestamp(),
  `staff_notes` varchar(5000) NOT NULL DEFAULT 'For Review',
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `postal` varchar(20) NOT NULL,
  `street` varchar(255) NOT NULL,
  `paid` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `service_id`, `customer_id`, `customer_notes`, `request_status_id`, `request_date`, `modified_by`, `modified_date`, `staff_notes`, `region`, `province`, `city`, `barangay`, `postal`, `street`, `paid`) VALUES
(27, 14, 19, 'test', 1, '2023-07-27', 1, '2023-07-27', 'Home service repair', 'NATIONAL CAPITAL REGION (NCR)', 'NCR, CITY OF MANILA, FIRST DISTRICT', 'ERMITA', 'Barangay 659-A', '1500', '1089 Mabini St.', b'0'),
(28, 14, 21, 'im a troller', 3, '2023-07-28', 0, '2023-07-28', 'For Review', 'NATIONAL CAPITAL REGION (NCR)', 'NCR, CITY OF MANILA, FIRST DISTRICT', 'ERMITA', 'Barangay 660', '1008', '1028 Dela Cruz St.', b'0'),
(29, 14, 21, 'Home service repair for HP printer', 7, '2023-07-28', 1, '2023-07-28', 'Paid', 'NATIONAL CAPITAL REGION (NCR)', 'NCR, CITY OF MANILA, FIRST DISTRICT', 'ERMITA', 'Barangay 660', '1008', '1028 Dela Cruz St.', b'1'),
(30, 14, 21, 'Home service repair for HP printer', 6, '2023-07-28', 1, '2023-07-28', 'Work in progress', 'NATIONAL CAPITAL REGION (NCR)', 'NCR, CITY OF MANILA, FIRST DISTRICT', 'ERMITA', 'Barangay 660', '1008', '1028 Dela Cruz St.', b'0'),
(31, 13, 21, 'test', 2, '2023-07-28', 0, '2023-07-28', 'For Review', 'CORDILLERA ADMINISTRATIVE REGION (CAR)', 'APAYAO', 'FLORA', 'Anninipan', 'test', 'test', b'0'),
(32, 16, 42, '', 2, '2023-07-30', 1, '2023-07-30', 'Testing', 'NATIONAL CAPITAL REGION (NCR)', 'CITY OF MANILA', 'ERMITA', 'Barangay 659-A', '4099', '109 Sample St.', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `request_status`
--

CREATE TABLE `request_status` (
  `request_status_id` int(11) NOT NULL,
  `request_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_status`
--

INSERT INTO `request_status` (`request_status_id`, `request_status`) VALUES
(1, 'Approved'),
(2, 'Pending'),
(3, 'Cancelled'),
(6, 'In Progress'),
(7, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `time_in`, `time_out`) VALUES
(6, '08:00:00', '17:00:00'),
(8, '07:00:00', '16:00:00'),
(12, '08:30:00', '17:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `date_added` date DEFAULT current_timestamp(),
  `added_by` varchar(50) DEFAULT NULL,
  `active` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`, `date_added`, `added_by`, `active`) VALUES
(13, 'Computer Repair and Setup', 'Repair: diagnosing hardware issues, troubleshooting software problems, virus and malware removal, data recovery, hardware upgrades,\r\n\r\nSetup: hardware assembly, operating system installation, driver installation, software installation, network setup, user accounts and settings, system updates and security.', '2023-07-23', '19', b'1'),
(14, 'Printer repair', 'Repair: paper jams, print quality problems, connectivity problems, error messages, slow printing or no response.', '2023-03-27', '1', b'1'),
(15, 'Laptop Board Level Repair', 'Also known as component-level repair or motherboard repair, involves diagnosing and fixing issues at the electronic component level on a laptop\'s motherboard. Board level repair focuses on identifying and replacing faulty or damaged individual components, such as capacitors, resistors, integrated circuits (ICs), or connectors.', '2023-03-27', '1', b'1'),
(16, 'LCD/LED/Plasma TV Repair', 'Repair: no power or power cycling, no display or distorted image, sound issues, connectivity problems, remote control or button malfunctions, other TV related problems.', '2023-07-23', '19', b'1'),
(17, 'CCTV Installation and Repair', 'Installation: planning and site survey, camera selection and placement, wiring and connectivity, recording device setup, power supply and surge protection, monitoring and remote access, testing and configuration, warranty.\r\n\r\n\r\nRepair: camera repair, recording device repair, cabling and connectivity, power supply, system configuration and software, professional assistance, regular maintenance.', '2023-07-23', '19', b'1'),
(18, 'Solar Power Installation', 'Inclusions site assessment and planning, solar panel installation, inverter installation, electrical connections and safety measures, system testing and commissioning, warranty.', '2023-03-27', '1', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `request_status`
--
ALTER TABLE `request_status`
  ADD PRIMARY KEY (`request_status_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `request_status`
--
ALTER TABLE `request_status`
  MODIFY `request_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
