-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2025 at 07:27 AM
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
-- Database: `crime report`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','moderator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(9, 'Gulu', '$2y$10$s2ei21au28rfkMxmopAxyeq57ylWQEZ6w7H8BG/Fd8/22YGZKErdW', 'superadmin'),
(10, 'Pratyush', '$2y$10$AvRcvoNFak62jqRYX1KX5.D3OjFG20J.zPD9lstR/S059RUvJ.h8a', 'moderator');

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

CREATE TABLE `contact_submissions` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contact_submissions`
--

INSERT INTO `contact_submissions` (`name`, `email`, `message`, `date`, `id`) VALUES
('Mahesh chetri', 'mahesh454@gmail.com', 'i don\'t know how to use this side, sirplease help me about the things  ', '2025-05-01 21:32:44', 3),
('Ajay sethy', 'ajay12342@gamil.com', 'sir, i saw the crime when the crime was happened in the market so i would like to convence or witnessed against that murderer.', '2025-05-01 21:34:42', 4),
('dev rao', 'dev123223@gmail.com', 'sir how to use this side and how to report a crime on this side ', '2025-05-01 21:35:40', 5),
('guru prasad', 'guru1223@gmail.com', 'sir i am the witness against the murder which was happened at last night in middle of the market', '2025-05-01 21:37:23', 6),
('dipi tripathy', 'dipi1223@gmail.com', 'sir how to use this side ', '2025-05-01 21:38:14', 7),
('keshari prasad ', 'keshari1445@gmail.com', 'sir how to report about a crime on this side i don\'t know ', '2025-05-01 21:39:14', 8),
('rekhashree mohanty', 'rekhashree122331@gmail.com', 'sir i would like to express my experience about this side and this side is helpful and be work on it . i would like to tell my experience ', '2025-05-01 21:41:31', 9),
('shidharth roy', 'sidhu1122@gmail.com', 'sir i saw the crime which was happened at last night in the middle of the street ', '2025-05-01 21:42:53', 10),
('mrunal thakur', 'mrunal112233@gmail.com', 'i would like to express my experience ', '2025-05-01 21:43:46', 11),
('pratap roy', 'pratap12234@gmail.com', 'how to use this side ', '2025-05-01 21:46:16', 12),
('tushar sharma ', 'tushar5544@gmail.com', 'this side is so nice ', '2025-05-01 21:46:51', 13),
('rasmika mandana', 'rasmika2234@gmail.com', 'sir this side is so helpful after i use this side i realise our govt is so strong', '2025-05-01 21:48:05', 14),
('maninder butar', 'maninder665@gmail.com', 'this is amazing', '2025-05-01 21:48:32', 15),
('rita sahoo', 'rita7766@gmail.com', 'this side is amazing', '2025-05-01 21:49:08', 16);

-- --------------------------------------------------------

--
-- Table structure for table `criminals`
--

CREATE TABLE `criminals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `crime` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criminals`
--

INSERT INTO `criminals` (`id`, `name`, `age`, `crime`, `photo`, `created_at`, `video`) VALUES
(1, 'Navven bali', 28, 'MURDER AND ILLEGAL DRUG SMUGLLER', 'navveen.jpg', '2025-05-01 17:25:45', ''),
(3, 'Dhurlav Kasyap', 25, 'Robbery, Illegal weapon dealing', 'Durlav kashyap.jpg', '2025-05-01 22:20:03', ''),
(4, 'Goldi Brar', 35, 'Murder and robbery', 'goldi.jpg', '2025-05-01 22:22:54', ''),
(5, 'Lawrence bishnoi', 29, 'GANGSTER', 'lawrence.jpg', '2025-05-01 22:23:27', ''),
(6, 'Bambiha', 23, 'LOCAL GANGSTER AND MURDER', 'bambiha.jpg', '2025-05-01 22:27:49', ''),
(7, 'Neeraj Bawana', 31, 'ILLEGAL WEPON, GOLD, DRUGS SMUGLLER', 'neraaj.jpg', '2025-05-01 22:28:55', '');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `date_reported` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `crime_type` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `name`, `phone`, `email`, `description`, `Location`, `date_reported`, `crime_type`, `status`) VALUES
(10, 'ROB002', 'RAJAT SAHOO', '9783445664', 'rajat123@gmail.com', 'At around 8:30 PM, while I was returning home from the local market near the Gandhi Chowk area, two unknown individuals on a black motorcycle (possibly a Bajaj Pulsar, without a visible number plate) approached me. One of them, wearing a black hoodie and ', 'Kalahandi', '2025-05-01 20:22:20', 'Robbery', 'pending'),
(11, 'CYB001', 'Ajaya rao', '9783221443', 'ajay123@gmail.com', 'At around 11:45 AM, I received a call from a person claiming to be a representative from my bank. He asked me to update my KYC (Know Your Customer) details to avoid account suspension. Trusting him, I unknowingly shared my bank account details and the OTP', 'Jajpur', '2025-05-01 21:27:39', 'Cyber Crime', 'In Progress'),
(12, 'ASS001', 'Shilpa Roy', '9785774556', 'shilpa123@gmail.com', 'While I was walking home from my tuition classes near the College Road area, an unknown man, approximately 5\'8\" tall, wearing a red t-shirt and jeans, suddenly approached me from behind and pulled at my bag. When I resisted, he pushed me to the ground and', 'Kendrapara', '2025-05-01 21:28:06', 'Assault', 'Resolved'),
(13, 'ASS002', 'Abhilipsa sahoo', '9786445662', 'abhilipsa1234@gmail.com', 'While I was walking home from my tuition classes near the College Road area, an unknown man, approximately 5\'3\" tall, wearing a blue t-shirt and jeans, suddenly approached me from behind and pulled at my bag. When I resisted, he pushed me to the ground an', 'Bhadrak', '2025-05-01 21:28:27', 'Assault', 'In Progress'),
(14, 'FRD001', 'Mahesh Rao', '9785443221', 'mahesh123@gmail.com', 'I had listed an old refrigerator for sale on OLX. On the same day, I received a call from a person identifying himself as a soldier from the Indian Army. He expressed interest in purchasing the refrigerator and offered immediate payment via UPI. He asked ', 'Dhenkanal', '2025-05-01 21:25:26', 'Fraud', 'Resolved'),
(15, 'CYB002', 'Alok patra', '9765442293', 'alok123@gmail.com', 'I received a text message claiming to be from my bank (HDFC Bank) stating that my account would be blocked unless I verified it through a provided link. I clicked on the link and was directed to a website that looked like the official bank portal. I was a', 'Cuttack', '2025-05-01 21:26:18', 'Cyber Crime', 'In Progress'),
(16, 'ROB003', 'Laxman tripathy', '9887654353', 'laxman123@gmail.com', 'At around 9:00 PM, while I was returning home from Rourkela Railway Station, two unidentified men on a white bike (without a visible number plate) stopped me near the Hanuman Mandir lane. One of them pointed what looked like a knife and demanded I hand ov', 'Balasore (Baleswar)', '2025-05-01 21:29:35', 'Robbery', 'Resolved'),
(17, 'FRD002', 'Anjali sethy', '9865223554', 'anjali123@gmail.com', 'I came across an Instagram page named \"Trendy_Wears_India\" that was advertising discounted branded footwear. I contacted the page through DM, and the seller asked me to make a payment of ₹2,999 via UPI for a pair of sports shoes. I made the payment to the', 'Ganjam', '2025-05-01 21:27:17', 'Fraud', 'In Progress'),
(18, 'CYB003', 'Mahyam roy', '9873556224', 'mahyam123@gmail.com', 'I, Mahyam Roy, a resident of Vivekananda Marg, Cuttack, wish to file an official complaint regarding a cyber fraud that occurred on April 30, 2025.\r\n\r\nOn that day, I received a message on WhatsApp from an unknown number claiming to offer part-time data en', 'Cuttack', '2025-05-01 21:25:49', 'Cyber Crime', 'Resolved'),
(19, 'ASS003', 'Priya sharma', '9789445336', 'priya123@gmail.com', 'I, Priya Sharma, a resident of Sudpada, Balangir, wish to lodge a formal complaint regarding an incident of physical assault that occurred on April 28, 2025.\r\n\r\nAt around 7:30 PM, while I was returning home from my coaching class near Gandhi Park, an unkn', 'Balangir', '2025-05-01 21:59:09', 'Assault', 'Resolved'),
(20, 'ASS004', 'Ragini sharma', '9854779335', 'ragini123@gmail.com', 'I, Ragini Sharma, a resident of Kasturi Nagar, Rayagada, am writing to file a complaint regarding a physical assault that occurred on the evening of April 29, 2025.\r\n\r\nAt approximately 6:45 PM, while I was walking home from the local market near Railway C', 'Rayagada', '2025-05-01 20:51:39', 'Assault', 'pending'),
(21, 'CYB004', 'Mahendera baliar', '9876554889', 'mahendra1234@gmail.com', 'I, Mahendra Baliar, a resident of Banapur, Khurda, am writing to file a complaint regarding a cyber fraud that occurred on April 26, 2025.\r\n\r\nI received an email from an address claiming to be “TCS Recruitment Team” offering me a data entry job with a mon', 'Khurda', '2025-05-01 20:54:22', 'Cyber Crime', 'pending'),
(22, 'FRD003', 'Papu kar', '9874665889', 'papu123@gmail.com', 'I, Papu Kar, a resident of MV-79 area, Malkangiri, am writing to report a case of fraud that I recently fell victim to.\r\n\r\nOn April 22, 2025, I downloaded a mobile application called “QuickCash Pro” from a social media ad that claimed to provide instant p', 'Malkangiri', '2025-05-01 21:28:49', 'Fraud', 'Resolved'),
(23, 'ASS005', 'Manisha sharma', '9872558996', 'manisha123@gmail.com', 'I, Manisha Sharma, a resident of Borigumma Road, Koraput, am writing to file a complaint regarding an incident of assault that occurred on the evening of April 30, 2025.\r\n\r\nAt approximately 6:15 PM, while I was returning home from the local grocery shop n', 'Koraput', '2025-05-01 21:00:20', 'Assault', 'pending'),
(24, 'CYB005', 'Raja sahoo', '9873554112', 'raja123@gmail.com', 'I, Raja Sahoo, resident of Bhawanipatna, Kalahandi, am writing to lodge a complaint regarding a cyber fraud incident that occurred on April 27, 2025.\r\n\r\nI received an SMS on my mobile stating that my electricity connection would be disconnected due to non', 'Kalahandi', '2025-05-01 21:29:01', 'Cyber Crime', 'In Progress'),
(25, 'ROB004', 'Shiberam kundu', '9886554726', 'shiberam123@gmail.com', 'when I was coming to home from duty then two men came with a bike and they threatened me with a knife   and they took my purse and chain and my atm card also.', 'Jagatsinghpur', '2025-05-01 21:05:30', 'Robbery', 'pending'),
(26, 'CYB006', 'Jagadish sharma ', '9558744632', 'jagadish123@gmail.com', 'At 9.00 pm when i was going to my uncle\'s home then some messages was sent by some other unknown number and  my account bank balance got zero then i was shocked that time i remembered that was the cyber crime may be so sir i reported here so please help m', 'Puri', '2025-05-01 21:09:36', 'Cyber Crime', 'pending'),
(27, 'ASS006', 'Shrabani behera', '9875644235', 'shrabani123@gmail.com', 'At 10.00 pm when i was coming to home from my duty in my colony there are two random guy who was drunken more and they misbehaving me 1st and forced to came with them and they forced me to physically involved , sir please take some action against that two', 'Sambalpur', '2025-05-01 21:26:58', 'Assault', 'Resolved'),
(28, 'CYB007', 'Mukteswar pradhan', '9856647552', 'mukteswar12345@gmail.com', 'At 7.00 pm I received a message which was sent by a hacker may be when i clicked that message link then my account got empty then i contact the bank and bank manager also then they said it was a cybercrime you should report in police station or through on', 'Kandhamal', '2025-05-01 21:20:39', 'Cyber Crime', 'pending'),
(29, 'FRD004', 'rasmika mandana', '9887566412', 'rasmika2234@gmail.com', 'At 9.00 pm i received a fake call and message that was a fraud message and fraud call then i clicked that link which was sent by hacker then my balance got debited .so please take some action.', 'Puri', '2025-05-01 21:59:33', 'Fraud', 'Resolved'),
(30, 'ROB005', 'bidyut jamwal', '9865478821', 'bidyut77455@gmail.com', 'when i was coming from  jharsuguda airport then two men came with a bike and threatened with a knife and they took my purse and chain also .so sir take some action against those guys', 'Jharsuguda', '2025-05-01 21:54:53', 'Robbery', 'pending'),
(31, 'ASS007', 'Nita ambani', '9885647226', 'nita7734@gmail.com', 'when i was coming to home from office then a gang came and they threatened to came with them and they grab me and forced to physically contact', 'Jagatsinghpur', '2025-05-01 21:58:50', 'Assault', 'Resolved'),
(32, 'ROB006', 'PRATYUSH PAL', '9090805071', 'pratyushpal245@gmail.com', 'At 9.00 pm i received a fake call and message that was a fraud message and fraud call then i clicked that link which was sent by hacker then my balance got debited .so please take some action.', 'Dhenkanal', '2025-05-02 09:59:04', 'Robbery', 'pending'),
(36, 'ROB007', 'gulu pal', '8895670861', 'gulu234@gmail.com', 'A robbery happen with me last night at 8pm.', 'Jharsuguda', '2025-05-02 12:38:29', 'Robbery', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `crime_type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date_reported` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `crime_type`, `location`, `date_reported`) VALUES
('ROB001', 'PRATYUSH PAL', 'pratyushpal25@gmail.com', '9090805071', 'Robbery', 'Jharsuguda', '2025-05-01 20:10:08'),
('ROB002', 'RAJAT SAHOO', 'rajat123@gmail.com', '9783445664', 'Robbery', 'Kalahandi', '2025-05-01 20:22:20'),
('CYB001', 'Ajaya rao', 'ajay123@gmail.com', '9783221443', 'Cyber Crime', 'Jajpur', '2025-05-01 20:26:22'),
('ASS001', 'Shilpa Roy', 'shilpa123@gmail.com', '9785774556', 'Assault', 'Kendrapara', '2025-05-01 20:29:09'),
('ASS002', 'Abhilipsa sahoo', 'abhilipsa1234@gmail.com', '9786445662', 'Assault', 'Bhadrak', '2025-05-01 20:31:51'),
('FRD001', 'Mahesh Rao', 'mahesh123@gmail.com', '9785443221', 'Fraud', 'Dhenkanal', '2025-05-01 20:34:18'),
('CYB002', 'Alok patra', 'alok123@gmail.com', '9765442293', 'Cyber Crime', 'Cuttack', '2025-05-01 20:37:19'),
('ROB003', 'Laxman tripathy', 'laxman123@gmail.com', '9887654353', 'Robbery', 'Balasore (Baleswar)', '2025-05-01 20:40:01'),
('FRD002', 'Anjali sethy', 'anjali123@gmail.com', '9865223554', 'Fraud', 'Ganjam', '2025-05-01 20:42:50'),
('CYB003', 'Mahyam roy', 'mahyam123@gmail.com', '9873556224', 'Cyber Crime', 'Cuttack', '2025-05-01 20:46:23'),
('ASS003', 'Priya sharma', 'priya123@gmail.com', '9789445336', 'Assault', 'Balangir', '2025-05-01 20:48:59'),
('ASS004', 'Ragini sharma', 'ragini123@gmail.com', '9854779335', 'Assault', 'Rayagada', '2025-05-01 20:51:39'),
('CYB004', 'Mahendera baliar', 'mahendra1234@gmail.com', '9876554889', 'Cyber Crime', 'Khurda', '2025-05-01 20:54:22'),
('FRD003', 'Papu kar', 'papu123@gmail.com', '9874665889', 'Fraud', 'Malkangiri', '2025-05-01 20:57:45'),
('ASS005', 'Manisha sharma', 'manisha123@gmail.com', '9872558996', 'Assault', 'Koraput', '2025-05-01 21:00:20'),
('CYB005', 'Raja sahoo', 'raja123@gmail.com', '9873554112', 'Cyber Crime', 'Kalahandi', '2025-05-01 21:02:34'),
('ROB004', 'Shiberam kundu', 'shiberam123@gmail.com', '9886554726', 'Robbery', 'Jagatsinghpur', '2025-05-01 21:05:30'),
('CYB006', 'Jagadish sharma ', 'jagadish123@gmail.com', '9558744632', 'Cyber Crime', 'Puri', '2025-05-01 21:09:36'),
('ASS006', 'Shrabani behera', 'shrabani123@gmail.com', '9875644235', 'Assault', 'Sambalpur', '2025-05-01 21:16:02'),
('CYB007', 'Mukteswar pradhan', 'mukteswar12345@gmail.com', '9856647552', 'Cyber Crime', 'Kandhamal', '2025-05-01 21:20:39'),
('FRD004', 'rasmika mandana', 'rasmika2234@gmail.com', '9887566412', 'Fraud', 'Puri', '2025-05-01 21:51:31'),
('ROB005', 'bidyut jamwal', 'bidyut77455@gmail.com', '9865478821', 'Robbery', 'Jharsuguda', '2025-05-01 21:54:53'),
('ASS007', 'Nita ambani', 'nita7734@gmail.com', '9885647226', 'Assault', 'Jagatsinghpur', '2025-05-01 21:57:37'),
('ROB006', 'PRATYUSH PAL', 'pratyushpal245@gmail.com', '9090805071', 'Robbery', 'Dhenkanal', '2025-05-02 09:59:04'),
('CYB008', 'rasmika mandana', 'rasmika2234@gmail.com', '9887566412', 'Cyber Crime', 'Jharsuguda', '2025-05-02 10:01:27'),
('CYB009', 'rasmika mandana', 'rasmika2234@gmail.com', '9887566412', 'Cyber Crime', 'Jharsuguda', '2025-05-02 10:04:46'),
('CYB010', 'Aswin', 'aswin234@gmail.com', '8895670861', 'Cyber Crime', 'Kendrapara', '2025-05-02 10:05:14'),
('ROB007', 'gulu pal', 'gulu234@gmail.com', '8895670861', 'Robbery', 'Jharsuguda', '2025-05-02 12:38:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criminals`
--
ALTER TABLE `criminals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `criminals`
--
ALTER TABLE `criminals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
