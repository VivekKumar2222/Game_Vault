-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 08:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamevault`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `ID` int(11) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `ItemDescription` text DEFAULT NULL,
  `ItemPrice` int(11) NOT NULL,
  `ItemCategory` varchar(300) NOT NULL,
  `UserID` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`ID`, `ItemName`, `ItemID`, `ItemDescription`, `ItemPrice`, `ItemCategory`, `UserID`) VALUES
(40, 'Dead Space', 9, 'Dead Space plunges you into a chilling, isolated nightmare aboard the USG Ishimura, a derelict mining ship haunted by unspeakable horrors. As Isaac Clarke, an engineer who was sent to investigate the ships distress signal, you quickly discover that the crew has been transformed into grotesque, terr', 18, 'horror,adventure', 'vivekladhani2@gmail.com'),
(45, 'Arkham Horror', 1, 'Step into the eerie streets of Arkham, a city plagued by supernatural horrors and ancient mysteries. In this gripping horror-adventure game, you’ll join a team of unlikely heroes as they unravel sinister secrets, battle nightmarish creatures, and confront the dark forces threatening humanity.', 10, 'horror,adventure', 'usmanbaig305@gmail.com'),
(46, 'Valorant', 2, 'Enter the high-stakes world of \"Valorant,\" a cutting-edge shooting and action game that puts your skills, strategy, and precision to the ultimate test. In this adrenaline-pumping experience, you’ll join elite agents from around the globe, each armed with unique abilities and weapons, to compete in i', 15, 'shooting,action', 'usmanbaig305@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `ID` int(50) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Price` double NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Users` int(100) NOT NULL,
  `Cover_Image` varchar(50) NOT NULL,
  `Logo` varchar(50) NOT NULL,
  `Key_Art` varchar(50) NOT NULL,
  `Discount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`ID`, `Name`, `Price`, `Description`, `Category`, `Users`, `Cover_Image`, `Logo`, `Key_Art`, `Discount`) VALUES
(1, 'Arkham Horror', 10.49, 'Step into the eerie streets of Arkham, a city plagued by supernatural horrors and ancient mysteries. In this gripping horror-adventure game, you’ll join a team of unlikely heroes as they unravel sinister secrets, battle nightmarish creatures, and confront the dark forces threatening humanity.', 'horror,adventure', 30000, 'arkham_horror_cover_art.jpg', 'ahb01_logo.png', 'arkham_horror_key_art.png', 0),
(2, 'Valorant', 14.99, 'Enter the high-stakes world of \"Valorant,\" a cutting-edge shooting and action game that puts your skills, strategy, and precision to the ultimate test. In this adrenaline-pumping experience, you’ll join elite agents from around the globe, each armed with unique abilities and weapons, to compete in i', 'shooting,action', 70000, 'valorant_cover_art.jpg', 'Valorant_logo_-_pink_color_version.svg.png', 'valorant_key_art.jpg', 0),
(3, 'Shadow Of Morder', 8.29, 'Step into the dark and treacherous lands of Mordor in Shadow of Mordor, an epic adventure-action game that blurs the line between hero and anti-hero. You play as Talion, a ranger resurrected by a mysterious wraith, bound together by a thirst for vengeance against the forces of Sauron.', 'adventure,action', 35000, 'sahdow_cover_art.jpg', 'dd8a3f5d0f62b085adecae10a3cde2e8.png', 'shaadow_key_art.jpg', 17),
(4, 'Minecraft', 14.99, ' Minecraft is an open-world adventure game where your creativity knows no bounds! Dive into a blocky, endless universe filled with unique biomes, towering mountains, vast oceans, and hidden caves. Whether youre crafting tools, building magnificent structures, or exploring the depths for rare treasur', 'adventure,fun', 68000, 'minecraft_keyart.jpg', 'Minecraft-Logo-2019.png', 'minecraft_key_art.png', 2),
(5, 'Horizon zero dawn (remastered)', 29.49, 'Embark on an epic journey in Horizon, where the boundaries of reality and myth collide in a world full of hidden treasures, ancient secrets, and fierce battles. As an intrepid explorer, you must navigate treacherous landscapes, scale towering mountains, and dive into deep, uncharted caverns, all whi', 'adventure,action', 46000, 'horizon_cover_image.jpg', '084b5978e8199595c9b293153746ce91.png', 'horizon_key_art.jpg', 0),
(6, 'Halo 4', 25.99, 'The fight for humanity’s survival escalates in Halo 4, the next chapter in the legendary Halo saga. As Master Chief, you are thrust into a new war against a mysterious alien force, the Prometheans, and a deadly, ancient technology that could spell the end of the galaxy.', 'shooting,action', 75000, 'halo_cover_art.jpg', 'Halo_4_Logo.png', 'halo_key_art.png', 8),
(7, 'Fortnite', 4.49, 'Fortnite revolutionizes the battle royale genre, combining fast-paced shooting action with creative building mechanics in an ever-evolving world. Drop into a vibrant, chaotic island where 100 players fight for survival in a massive, shrinking battlefield.', 'shooting,action,battle', 90000, 'fortnite_cover_art.jpg', 'fortnite-logo-white-png-900x257.png', 'fortnite_key_art.jpg', 0),
(8, 'Doom', 12.79, 'Doom delivers a relentless, high-octane mix of horror, adventure, and action in a nightmarish fight for survival. As the Doom Slayer, you are humanity’s last hope against the forces of Hell, unleashed on Earth. Prepare for an unflinching, brutal journey through hellish landscapes filled with demonic', 'horror,action,adventure', 55000, 'doom_cover_art.jpg', 'pngimg.com - doom_PNG9.png', 'doom_cover_art.jpg', 4),
(9, 'Dead Space', 24.49, 'Dead Space plunges you into a chilling, isolated nightmare aboard the USG Ishimura, a derelict mining ship haunted by unspeakable horrors. As Isaac Clarke, an engineer who was sent to investigate the ships distress signal, you quickly discover that the crew has been transformed into grotesque, terr', 'horror,adventure', 25000, 'dead_space_cover_art.jpg', '33c0802ccd55c286e13ce5ea9598d710.png', 'dead_space_key_art.png', 27),
(10, 'God Of War', 49.99, 'God of War is an action-adventure game series developed by Santa Monica Studio and published by Sony Interactive Entertainment. It follows the story of Kratos, a Spartan warrior who becomes the God of War after seeking vengeance against the Olympian gods. The series is known for its immersive storyt', 'adventure,action,fantasy', 75000, 'GOW_cover_art.jpg', 'God-of-War-Logo-PNG-Photos.png', 'GOW_key_art.png', 42),
(11, 'NBA2K24', 29.99, 'NBA 2K24 is a basketball simulation game developed by Visual Concepts and published by 2K Sports. It is part of the renowned NBA 2K series, offering realistic gameplay, stunning graphics, and various game modes, including MyCareer, MyTeam, and MyNBA. The game features updated rosters, enhanced mecha', 'sports', 45000, 'nba_cover_art.jpg', 'e7810ff82a02494da13967aec9f1e414.png', 'nba_key_art.png', 8),
(12, 'Last Of Us', 34.29, 'The Last of Us is a critically acclaimed action-adventure game developed by Naughty Dog. The game is set in a post-apocalyptic world ravaged by a deadly fungal infection that has turned much of humanity into zombie-like creatures.', 'horror,action,adventure', 58000, 'lou_cover_art.png', 'lou_logo.png', 'lou_key_art.png', 0),
(13, 'Resident Evil 4', 14.99, 'Resident Evil 4 is a revolutionary entry in the iconic Resident Evil series. It follows Leon S. Kennedy, a U.S. government agent, as he is sent on a mission to rescue the president\'s daughter, Ashley Graham, who has been kidnapped by a mysterious cult in a rural Spanish village.', 'horror,action,adventure', 62000, 're4_cover_art.png', 're4_logo.png', 're4_key_art.png', 2),
(14, 'FC25', 29.79, 'FC25 is an exciting football game that brings the thrill of the sport to life. Players can control teams, strategize on the field, and compete in dynamic matches that showcase skill, speed, and precision. The game offers a realistic football experience with smooth gameplay and a range of modes for b', 'sports', 75000, 'fc25_cover_image.png', 'fc25_logo.png', 'fc25_key_art.png', 10),
(15, 'Rocket League', 9.29, 'Rocket League is a high-energy, vehicular soccer game where players control rocket-powered cars to hit a giant ball into the opposing team\'s goal. It combines the excitement of football with fast-paced driving mechanics, offering both solo and team-based modes with aerial stunts and strategic gamepl', 'sports,action', 100000, 'rl_cover_art.png', 'rocket-league-logo-png-transparent.png', 'rl_key_art.png', 0),
(16, 'Silent Hill 2', 14.99, 'Silent Hill 2 is a psychological horror game that follows James Sunderland as he searches for his deceased wife in the eerie and fog-covered town of Silent Hill. As he uncovers disturbing secrets, players encounter nightmarish creatures, challenging puzzles, and a haunting atmosphere that explores t', 'horror,action,adventure', 40000, 'sl2_cover_art.png', 'Silent-Hill-2-Logo-No-Background.png', 'sl2_key_art.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(50) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `UserID` varchar(100) NOT NULL,
  `Age` int(50) NOT NULL,
  `Password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `UserID`, `Age`, `Password`) VALUES
(1, 'vivek', 'vivekladhani2@gmail.com', 20, 'vivek'),
(5, 'MIrza Usman Baig', 'usmanbaig305@gmail.com', 22, 'usman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `game` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
