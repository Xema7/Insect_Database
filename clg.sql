-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 10:02 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clg`
--

-- --------------------------------------------------------

--
-- Table structure for table `catmaster`
--

CREATE TABLE `catmaster` (
  `cid` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catmaster`
--

INSERT INTO `catmaster` (`cid`, `cname`) VALUES
(106, 'Blattodea'),
(102, 'Coleoptera'),
(105, 'Diptera'),
(109, 'Hemiptera'),
(101, 'Hymenoptera '),
(103, 'Lepidoptera'),
(108, 'Mantodea'),
(110, 'Neuroptera'),
(104, 'Orthoptera'),
(107, 'Phasmatodea');

-- --------------------------------------------------------

--
-- Table structure for table `insectmaster`
--

CREATE TABLE `insectmaster` (
  `id` int(11) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `scientificName` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `insectmaster`
--

INSERT INTO `insectmaster` (`id`, `photo`, `scientificName`, `name`, `description`) VALUES
(1001, 'image/Honeybee.jpg', 'Apis mellifer', 'Honeybee', 'A social insect known for pollination and producing honey and beeswax.\r\n'),
(1002, 'image/ladybug.jpg', 'Coccinella septempunctata', 'Ladybug', 'A beneficial beetle that preys on aphids and other pests.'),
(1003, 'image/Monarch Butterfly.jpg', 'Danaus plexippus', 'Monarch butterfly', 'Famous for its long migrations and bright orange wings with black veins.\r\n'),
(1004, 'image/Field cricket.jpg', 'Gryllus assimilis', 'Field cricket', 'Known for its loud chirping, produced by rubbing its wings together.'),
(1005, 'image/African malaria mosquito.jpg', 'Anopheles gambiae', 'African malaria mosquito', 'A mosquito species that is a primary vector of malaria in humans.'),
(1006, 'image/Black carpenter ant.webp', 'Camponotus pennsylvanicus', ' Black carpenter ant', 'A large ant species that nests in wood and can cause structural damage.'),
(1007, 'image/Tobacco hornworm.webp', 'Manduca sexta', 'Tobacco hornworm', 'A large caterpillar known to feed on tomato and tobacco plants.'),
(1008, 'image/German cockroach.png', 'Blattella germanica', 'German cockroach', 'A common indoor pest that can spread bacteria and allergens.'),
(1009, 'image/Common fruit fly.webp', 'Drosophila melanogaster', 'Common fruit fly', 'Widely used in genetic research due to its short life cycle.'),
(1010, 'image/Leaf-insect.jpg', 'Phyllium philippinicum', 'Leaf insect', ' Masters of camouflage, mimicking leaves to avoid predators.'),
(1011, 'image/House Cricket.jpg', 'Acheta domesticus', 'House cricket', 'Often used as pet food and for scientific studies on behavior.'),
(1012, 'image/Chinese mantis.webp', 'Tenodera sinensis', 'Chinese mantis', 'A large predatory insect that captures prey with spiny forelegs.'),
(1013, 'image/Small white butterfly.webp', 'Pieris rapae', 'Small white butterfly', 'Common in gardens, where the larvae can damage cabbage and related crops.'),
(1014, 'image/Great green bush-cricket.jpg', 'Tettigonia viridissima', 'Great green bush-cricket', 'Noted for its bright green body and loud mating calls at night'),
(1015, 'image/Buff-tailed bumblebee.jpg', 'Bombus terrestris', 'Buff-tailed bumblebee', 'A key pollinator with a fuzzy appearance and a loud buzz.'),
(1016, 'image/Bed bug.jpg', 'Cimex lectularius', 'Bed bug', 'A parasitic insect that feeds on human blood, often hiding in mattresses.'),
(1017, 'image/Superworm beetle.jpg', 'Zophobas mono', 'Superworm beetle', 'Larvae are commonly used as feeder insects for reptiles and birds.'),
(1018, 'image/Green lacewing.jpg', 'Chrysoperla cameo', 'Green lacewing', 'Beneficial for pest control; larvae are fierce predators of aphids.'),
(1019, 'image/Gypsy moth.jpg', 'Lymantria dispar', 'Gypsy moth', 'Known for outbreaks that defoliate large area of forest.');

-- --------------------------------------------------------

--
-- Table structure for table `trans`
--

CREATE TABLE `trans` (
  `id` int(11) NOT NULL,
  `insid` int(11) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trans`
--

INSERT INTO `trans` (`id`, `insid`, `cid`) VALUES
(1, 1001, 101),
(2, 1002, 102),
(3, 1003, 103),
(4, 1004, 104),
(5, 1005, 105),
(6, 1006, 101),
(7, 1007, 103),
(8, 1008, 106),
(9, 1009, 105),
(10, 1010, 107),
(11, 1011, 104),
(12, 1012, 108),
(13, 1013, 103),
(14, 1014, 104),
(15, 1015, 101),
(16, 1016, 109),
(17, 1017, 102),
(18, 1018, 110),
(19, 1019, 103);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catmaster`
--
ALTER TABLE `catmaster`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cname` (`cname`);

--
-- Indexes for table `insectmaster`
--
ALTER TABLE `insectmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans`
--
ALTER TABLE `trans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `insid` (`insid`),
  ADD UNIQUE KEY `insid_2` (`insid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catmaster`
--
ALTER TABLE `catmaster`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `insectmaster`
--
ALTER TABLE `insectmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1020;

--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
