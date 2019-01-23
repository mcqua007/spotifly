-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 23, 2019 at 03:35 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotifly`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(2, 'Dedication 5', 2, 1, 'assets/images/artwork/lil-wayne-dedication-5.png'),
(3, 'Dedication 6', 2, 1, 'assets/images/artwork/lil-wayne-dedication-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `artistImagePath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `artistImagePath`) VALUES
(1, 'Red Hot Chili Peppers', 'assets/images/artist-images/red-hot-chilli-peppers.jpg'),
(2, 'Lil Wayne', 'assets/images/artist-images/lilwayne.jpg'),
(3, 'Rolling Stones', 'assets/images/artist-images/rolling-stones.jpg'),
(4, 'Jimi Hendrix', 'assets/images/artist-images/jimihendrix.png');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Hip Hop'),
(2, 'Classical'),
(3, 'Rock and roll'),
(4, 'Electronic Dance Music'),
(5, 'Jazz'),
(6, 'Folk'),
(7, 'Alternative Rock'),
(8, 'Pop');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `owner`, `dateCreated`) VALUES
(4, 'Lil Wayne playlist', 'seandon', '2019-01-11 00:00:00'),
(5, 'Punk Playlist', 'seandon', '2019-01-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `playlistSongs`
--

CREATE TABLE `playlistSongs` (
  `id` int(11) NOT NULL,
  `songId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlistSongs`
--

INSERT INTO `playlistSongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(1, 9, 4, 1),
(2, 13, 4, 2),
(3, 27, 4, 3),
(4, 8, 4, 4),
(9, 19, 4, 5),
(10, 15, 4, 6),
(11, 22, 4, 7),
(12, 18, 4, 8),
(13, 11, 4, 9),
(14, 1, 4, 10),
(15, 10, 4, 11),
(16, 5, 4, 12),
(19, 10, 5, 1),
(20, 6, 5, 2),
(22, 22, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL,
  `numberOfLikes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`, `numberOfLikes`) VALUES
(1, 'Im Good', 2, 2, 1, '2:07', 'assets/music/artist/lil-wayne/albums/dedication-5/01 I\'m Good.mp3', 1, 87, 1),
(2, 'How Dedicated', 2, 2, 1, '0:52', 'assets/music/artist/lil-wayne/albums/dedication-5/02 How Dedicated.mp3', 2, 62, 1),
(3, 'Don\'t Kill', 2, 2, 1, '4:20', 'assets/music/artist/lil-wayne/albums/dedication-5/03 Don\'t Kill.mp3', 3, 55, 1),
(4, 'New Slaves', 2, 2, 1, '2:54', 'assets/music/artist/lil-wayne/albums/dedication-5/04 New Slaves.mp3', 4, 50, 1),
(5, 'Drama & Weezy', 2, 2, 1, '0:15', 'assets/music/artist/lil-wayne/albums/dedication-5/05 Drama & Weezy.mp3', 5, 47, 0),
(6, 'Typa Way', 2, 2, 1, '5:15', 'assets/music/artist/lil-wayne/albums/dedication-5/06 Typa Way.mp3', 6, 48, 0),
(7, 'You Song', 2, 2, 1, '5:32', 'assets/music/artist/lil-wayne/albums/dedication-5/07 You Song.mp3', 7, 63, 0),
(8, 'Ai\'t Worried', 2, 2, 1, '2:33', 'assets/music/artist/lil-wayne/albums/dedication-5/08 Ain\'t Worried.mp3', 8, 53, 0),
(9, 'Before Tune Gets Back', 2, 2, 1, '3:25', 'assets/music/artist/lil-wayne/albums/dedication-5/09 Before Tune Gets Back.mp3', 9, 10, 0),
(10, 'Started', 2, 2, 1, '3:01', 'assets/music/artist/lil-wayne/albums/dedication-5/10 Started.mp3', 10, 10, 0),
(11, 'New Signees To Young Money', 2, 2, 1, '1:39', 'assets/music/artist/lil-wayne/albums/dedication-5/12 Live Life.mp3', 11, 6, 0),
(12, 'Live Life', 2, 2, 1, '4:08', 'assets/music/artist/lil-wayne/albums/dedication-5/12 Live Life.mp3', 12, 5, 0),
(13, 'Itchin\'', 2, 2, 1, '3:33', 'assets/music/artist/lil-wayne/albums/dedication-5/13 Itchin\'.mp3', 13, 8, 0),
(14, 'Way I\'m Ballin\'', 2, 2, 1, '3:53', 'assets/music/artist/lil-wayne/albums/dedication-5/14 Way I\'m Ballin\'.mp3', 14, 7, 0),
(15, 'Fortune Teller Interlude', 2, 2, 1, '1:01', 'assets/music/artist/lil-wayne/albums/dedication-5/15 Fortune Teller Interlude.mp3', 15, 3, 0),
(16, 'Thinkin\' About You', 2, 2, 1, '3:22', 'assets/music/artist/lil-wayne/albums/dedication-5/16 Thinkin\' About You.mp3', 16, 4, 0),
(17, 'Pure Colombia', 2, 2, 1, '3:39', 'assets/music/artist/lil-wayne/albums/dedication-5/17 Pure Colombia.mp3', 17, 3, 0),
(18, 'Bugatti', 2, 2, 1, '3:26', 'assets/music/artist/lil-wayne/albums/dedication-5/18 Bugatti.mp3', 18, 8, 0),
(19, 'Still Got The Rock', 2, 2, 1, '3:24', 'assets/music/artist/lil-wayne/albums/dedication-5/19 Still Got The Rock.mp3', 19, 4, 0),
(20, 'Competition Interlude', 2, 2, 1, '0:21', 'assets/music/artist/lil-wayne/albums/dedication-5/20 Competition Interlude.mp3', 20, 4, 0),
(21, 'FuckWitMeUKnowIGotIt', 2, 2, 1, '3:45', 'assets/music/artist/lil-wayne/albums/dedication-5/21 FuckWitMeUKnowIGotIt.mp3', 21, 7, 0),
(22, 'UOENO', 2, 2, 1, '3:49', 'assets/music/artist/lil-wayne/albums/dedication-5/22 UOENO.mp3', 22, 4, 0),
(23, 'Levels', 2, 2, 1, '3:44', 'assets/music/artist/lil-wayne/albums/dedication-5/23 Levels.mp3', 23, 2, 0),
(24, 'Living Legend Interlude', 2, 2, 1, '0:46', 'assets/music/artist/lil-wayne/albums/dedication-5/24 Living Legend Interlude.mp3', 24, 2, 0),
(25, 'Cream', 2, 2, 1, '3:27', 'assets/music/artist/lil-wayne/albums/dedication-5/25 Cream.mp3', 25, 4, 0),
(26, 'Devastation', 2, 2, 1, '3:20', 'assets/music/artist/lil-wayne/albums/dedication-5/26 Devastation.mp3', 26, 4, 0),
(27, 'Fuckin\' Problems', 2, 2, 1, '4:22', 'assets/music/artist/lil-wayne/albums/dedication-5/27 Fuckin\' Problems.mp3', 27, 2, 0),
(28, 'Feds Watchin\'', 2, 2, 1, '5:26', 'assets/music/artist/lil-wayne/albums/dedication-5/28 Feds Watchin\'.mp3', 28, 2, 0),
(29, 'Luv', 2, 2, 1, '8:29', 'assets/music/artist/lil-wayne/albums/dedication-5/29 Luv.mp3', 29, 2, 0),
(31, 'Fly Away', 2, 3, 1, '4:45', 'assets/music/artist/lil-wayne/albums/dedication-6/01 - Fly Away.mp3', 1, 8, 0),
(32, 'Everyday We Sick', 2, 3, 1, '2:41', 'assets/music/artist/lil-wayne/albums/dedication-6/02 - Everyday We Sick.mp3', 2, 7, 0),
(33, 'Boyz 2 Menace ft Gudda Gudda', 2, 3, 1, '3:53', 'assets/music/artist/lil-wayne/albums/dedication-6/03 - Boyz 2 Menace ft Gudda Gudda.mp3', 3, 7, 0),
(34, 'Eureka ft HoodyBaby', 2, 3, 1, '3:09', 'assets/music/artist/lil-wayne/albums/dedication-6/04 - Eureka ft HoodyBaby.mp3', 4, 4, 0),
(35, '5 Star ft Nicki Minaj', 2, 3, 1, '4:46', 'assets/music/artist/lil-wayne/albums/dedication-6/05 - 5 Star ft Nicki Minaj.mp3', 5, 2, 0),
(36, 'Bank Account', 2, 3, 1, '4:03', 'assets/music/artist/lil-wayne/albums/dedication-6/06 - Bank Account.mp3', 6, 0, 0),
(37, 'XO Tour Life ft Baby E', 2, 3, 1, '3:53', 'assets/music/artist/lil-wayne/albums/dedication-6/07 - XO Tour Life ft Baby E.mp3', 7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userLikedSongs`
--

CREATE TABLE `userLikedSongs` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `songId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userLikedSongs`
--

INSERT INTO `userLikedSongs` (`id`, `userId`, `songId`) VALUES
(2, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(1, 'test-user', 'Test-sean', 'Adsdsadasd', 'Sean-test@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2018-12-19 00:00:00', 'assets/images/profile-pics/head_emerald.png'),
(2, 'bobby', 'Test', 'Test', 'Test@g.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2018-12-19 00:00:00', 'assets/images/profile-pics/head_emerald.png'),
(3, 'seandon', 'Sean', 'Mcquaid', 'sean@g.com', '0cef1fb10f60529028a71f58e54ed07b', '2018-12-21 00:00:00', 'assets/images/profile-pics/head_emerald.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlistSongs`
--
ALTER TABLE `playlistSongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userLikedSongs`
--
ALTER TABLE `userLikedSongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `playlistSongs`
--
ALTER TABLE `playlistSongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `userLikedSongs`
--
ALTER TABLE `userLikedSongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
