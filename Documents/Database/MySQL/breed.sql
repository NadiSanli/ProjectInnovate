-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2019 at 03:04 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `breedr`
--

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

CREATE TABLE `breed` (
  `breedID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`breedID`, `name`) VALUES
(0, 'UNDEFINED'),
(1, 'Affenpinscher'),
(2, 'Afghan hound'),
(3, 'Airedale terrier'),
(4, 'Akita'),
(5, 'Alaskan malamute'),
(6, 'American eskimo dog'),
(7, 'American foxhound'),
(8, 'American staffordshire terrier'),
(9, 'American water spaniel'),
(10, 'Anatolian shepherd dog'),
(11, 'Australian cattle dog'),
(12, 'Australian shepherd'),
(13, 'Australian terrier'),
(14, 'Basenji'),
(15, 'Basset hound'),
(16, 'Beagle'),
(17, 'Bearded collie'),
(18, 'Beauceron'),
(19, 'Bedlington terrier'),
(20, 'Belgian malinois'),
(21, 'Belgian sheepdog'),
(22, 'Belgian tervuren'),
(23, 'Bernese mountain dog'),
(24, 'Bichon frise'),
(25, 'Black and tan coonhound'),
(26, 'Black russian terrier'),
(27, 'Bloodhound'),
(28, 'Bluetick coonhound'),
(29, 'Border collie'),
(30, 'Borzoi'),
(31, 'Boston terrier'),
(32, 'Bouvier des flandres'),
(33, 'Boxer'),
(34, 'Boykin spaniel'),
(35, 'Briard'),
(36, 'Brittany'),
(37, 'Brussels griffon'),
(38, 'Bull terrier'),
(39, 'Bulldog'),
(40, 'Bullmastiff'),
(41, 'Cairn terrier'),
(42, 'Canaan dog'),
(43, 'Cane corso'),
(44, 'Cardigan welsh corgi'),
(45, 'Cavalier king charles spaniel'),
(46, 'Chesapeake bay retriever'),
(47, 'Chihuahua'),
(48, 'Chinese crested'),
(49, 'Chinese shar-pei'),
(50, 'Chow chow'),
(51, 'Clumber spaniel'),
(52, 'Cocker spaniel'),
(53, 'Collie'),
(54, 'Curly-coated retriever'),
(55, 'Dachshund'),
(56, 'Dalmatian'),
(57, 'Dandie dinmont terrier'),
(58, 'Doberman pinscher'),
(59, 'Dogue de bordeaux'),
(60, 'English cocker spaniel'),
(61, 'English setter'),
(62, 'English springer spaniel'),
(63, 'English toy spaniel'),
(64, 'Entlebucher mountain dog'),
(65, 'Field spaniel'),
(66, 'Finnish spitz'),
(67, 'Flat-coated retriever'),
(68, 'French bulldog'),
(69, 'German pinscher'),
(70, 'German shepherd dog'),
(71, 'German shothaired pointer'),
(72, 'German wirehaired pointer'),
(73, 'Giant schnauzer'),
(74, 'Glen of imaal terrier'),
(75, 'Golden retriever'),
(76, 'Gordon setter'),
(77, 'Great dane'),
(78, 'Great pyrenees'),
(79, 'Greater swiss mountain dog'),
(80, 'Greyhound'),
(81, 'Havanese'),
(82, 'Ibizan hound'),
(83, 'Icelandic sheepdog'),
(84, 'Irish red and white setter'),
(85, 'Irish setter'),
(86, 'Irish terrier'),
(87, 'Irish water spaniel'),
(88, 'Irish wolfhound'),
(89, 'Italian greyhound'),
(90, 'Japanese chin'),
(91, 'Keeshound'),
(92, 'Kerry blue terrier'),
(93, 'Komondor'),
(94, 'Kuvasz'),
(95, 'Labrador retriever'),
(96, 'Lakeland terrier'),
(97, 'Leonberger'),
(98, 'Lhasa apso'),
(99, 'Lowchen'),
(100, 'Maltese'),
(101, 'Manchester terrier'),
(102, 'Mastiff'),
(103, 'Miniature schnauzer'),
(104, 'Neapolitan mastiff'),
(105, 'Newfoundland'),
(106, 'Norfolk terrier'),
(107, 'Norwegian buhund'),
(108, 'Norwegian elkhound'),
(109, 'Norwegian lundehund'),
(110, 'Norwich terrier'),
(111, 'Nova scotia duck tolling retriever'),
(112, 'Old english sheepdog'),
(113, 'Otterhound'),
(114, 'Papillon'),
(115, 'Parson russel terrier'),
(116, 'Pekingese'),
(117, 'Pembroke welsh corgi'),
(118, 'Petit basset griffon vendeen'),
(119, 'Pharaoh hound'),
(120, 'Plott'),
(121, 'Pointer'),
(122, 'Pomeranian'),
(123, 'Poodle'),
(124, 'Portuguese water dog'),
(125, 'Saint bernard'),
(126, 'Silky terrier'),
(127, 'Smooth fox terrier'),
(128, 'Tibetan mastiff'),
(129, 'Welsh springer spaniel'),
(130, 'Wirehaired pointing griffon'),
(131, 'Xoloitzcuintli'),
(132, 'Yorkshire terrier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`breedID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breed`
--
ALTER TABLE `breed`
  MODIFY `breedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
