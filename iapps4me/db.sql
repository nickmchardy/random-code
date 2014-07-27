-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2010 at 10:45 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iapps4me`
--
CREATE DATABASE `iapps4me` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `iapps4me`;

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE IF NOT EXISTS `ideas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`id`, `email`, `description`, `likes`, `title`) VALUES
(42, 'rob.skelton@gmail.com', 'Often people in cabs are bored and drunk. And they have an opinion of the cab/cab driver. And the cab driver has an ID name/number. It would be fun to write whatever you want about the cab/cabbie, and then see the ratings of others. A free app, but charge cab companies to see all the results. Win-Win!', 0, 'Rate A Cab'),
(14, '1millionthuser@iapps4.me', 'Post offices register to this app and the app will tell the person who is using the app if the post office which is neverest to them is open and how long it is open for. Also i could say diretions to it from were they are.\r\n', 1, 'Post Office Finder'),
(16, 'jones@me.com', 'Iâ€™d love an app that summarizes the FLYLady routines that can be found at www.flylady.net or in the book â€œSink Reflectionsâ€. Iâ€™m currently using the â€œhome routinesâ€ app but would like to see the development of something to the effect of a true FLYLady control Journal.\r\n', 1, 'FlyLady App'),
(17, 'bula@baba.com', 'Choosing freelance writing as a profession is the easy decision; the work begins when it comes to looking for freelance writing jobs and freelance writing gigs.\r\nAs many freelance writers know finding freelance work can be time consuming and require a lot of effort and heartache. Numerous rejection letters, continuous query letters, and at the end of it all nothing is guaranteed of online writing job.\r\nThis is where ghost-writing and writers markets come into play. Ghost writing can allow you to', 0, 'Freelance Writing'),
(18, 'be@be.com', 'An app that allows an incoming call to be answered automatically when a headset is connected. I ride a motorbike with a comms system but I cannot answer calls without touching a button.\r\nThis could also be configured so that when an incoming call is received with either a plug in headset or a bluetooth headset the call would be automatically answered.', 3, 'Auto Answer for Calls'),
(20, 'gula@gula.com', 'The technical team of the company in coordination with the IT staff of the clinic enables the secure HIPAA compliant VPN connectivity, and using a secure password the medical transcribers can login and document the physician narrations read into the centralized voice recording system.\r\nIf the EMR application that is in use by a health care facility allows for Local Area Network (LAN) connectivity, the transcription companies set it up in a similar manner as the VPN. The EMR applications that are', 0, 'EMR VPN App'),
(21, 'dumdum@hooray.com', 'there is currently an app called Viigo for Blackberry, we need to have a app like this for android, something that brings your RSS feeds, socialnetworks, sports, entertainment all into one app, from there you can veiw your articles, and email them to friends, or to your self, you can twitter them , facebook them and so on,,...this app would be great', 0, 'Viigo for Android'),
(22, 'mightyjungle@lionsleeps.com', '\r\nyou have an elephant, yes. And it is a multidimensional resonator whoms trunk can rip open the very fabric of time and space! shake your ipod to make him travel deep into 1 of 1000â€™s of other dimensions, some might be blank boxs of nothingness, one might be a tropical telephone with afro kangaroos on it who have a cat controlling their every move! just for a bit of fun, a random plaything of crazyness. Ill keep the ideas coming and it would be great if I could win once so please, vote on ANY', 0, 'Elephant Game'),
(23, 'guraba@huhu.com', 'Anyone ever heard on garryâ€™s mod. great game, but a few floors. One, you cant play the game on the go, two, theres not enough things that do something, like not just a barrel, but maybe a barrel with a shreddar inside, and three, you cant create movies, speak into it to make a charecter say something, ectâ€¦ well dippido-ado fixes all these, first, its portable, second, it has special affect stuff like an imploding keyboard or a telephone that cows can come out, which brings us to another floo', 0, 'Garry''s Mod'),
(27, 'geek@gamyme.com', 'Millions of people are out of work. This app will allow you to access all help wanted ads in all major newspapers. Included will be links to real estate, reports on quality of life issues like school ratings, crime, taxes etc. Links to major headhunters and employment agencies will be broken down by state, city and county.\r\nA built in resume writer to help you prepare should also be included.\r\nIt will give the person the best leads possible to help find a job and then provide details that the fa', 0, 'Job Finder'),
(28, 'baba@blakksheep.com', 'I would like to have an app on my iPhone that could scan lotto ticket barcodes to see if they are a winner. Much easier than going somewhere or looking it up on the internet or TV. Would work with any phone with a camera and those capabilities ie iPhone, Androids, Blackberryâ€™s etc. Havent found anything through all my searches and I know that I would pay for it but I have no idea how to create apps.', 0, 'Lotto Barcode Scanner'),
(29, 'eiaieiai@ow.com', 'Create a new iPad case, no thicker than the current ones but embed a small camera, similar to that found in iPhone 3GS. Whereas to add no thickness or cost.\r\nSell the case for only slightly more than the average case similar to that.\r\nEnable users once bought to download an app which allows them to either connect wirelessly to the camera, or is connected when plugged into the 30 pin connector case on the dock area. \r\nThis would enable photos to be taken and used throughout applications adding a ', 1, 'iPad Case'),
(30, 'dud@dulono.com', 'We all have RSS Feeds to read. It is very time consuming, if you get the same content from several sources. So I think itâ€™s time for a â€œGeniusâ€. An intelligent smartlist/system for your RSS Reader to find identical content and avoid duplicates.', 0, 'RSS Feed Reader'),
(31, 'mimi@mula.com', 'Remocate is an idea Iâ€™ve had for some time. The idea is simple. 1) You need to remember to to pick up your dry cleaning! You enter the address of where it is and when you are within a certain distance of the dry cleaners, Remocate pushes a message to remind you or an audible alarm. A timed backup could also be used if you ignore it. 2) You need to find a chemist, newsagent, bank etc. You put in what you are looking for and leave it running in the background. When you get within a certain dista', 1, 'Remocate'),
(32, 'heman@sillyflower.com', 'Turn your BOSS into an animal and hear his/ her grunt, bark, growl. Upload a voice file (or text) of someone you HATE (boss) and turn his voice into an animalâ€™s grunt, squeak, bark or growl!\r\n(Can also be a colleague, friend, , politician, actor, in-law). Choose a drop down of animals (pig, dog, wounded lion, dinosaur, beetle, turkey, octopus).\r\nSelect the mood of the boss â€“ Angry, insane, jealous, demanding, foolish, partisan, idioticâ€¦\r\nAnd lo! Your BOSS sounds hilarious.', 4, 'Boss Noise'),
(33, 'dudu@dolodolo.com', 'Now that there is bluetooth keyboard funtionality I would like to see a game like the classic SEGA â€œTyping of the deadâ€ or clone of. Educational in that you learn to type under pressure from Zombies! Each correctly spelt word keeps the zombies at bay! The only way to get through it is by learning to touch type and not taking your eyes off the screen! A game way ahead of its time, good way to promote the use of Bluetooth keyboards now that you can use them with iphone. They could give the App', 0, 'Bluetooth Keyboard'),
(34, 'Richardchen_78@hotmail.com', 'A better multi language translator/dictionary for the iphone with a Real voice pronunciation, for example when you search a chinese word on the iphone you can type it in using pinyin or zhuyin or just draw the character in and the search will come up with the word with the correct pinyin and zhuyin and the meaning and pronunciation.', 0, 'Language Translator'),
(39, 'test@hotmail.com', 'Build an application which can predict the future with a certain degree of accuracy. Make it so that I can ask it questions and the application will be able to respond accordingly.', 1, 'Crystal Ball'),
(37, 'andy@universalsprout.com', 'If I''m stuck in the rain and the bus is late it would be really good to have an app to find out where the bus is. This could be combined with the ability to view the bus timetable and propose alternate routes to my planned destination.', 11, 'Where''s my bus?');

-- --------------------------------------------------------

--
-- Table structure for table `iprovider`
--

CREATE TABLE IF NOT EXISTS `iprovider` (
  `ipid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`ipid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `iprovider`
--

INSERT INTO `iprovider` (`ipid`, `id`, `email`, `price`) VALUES
(1, 18, '0', 0),
(2, 18, '0', 0),
(3, 32, '0', 0),
(4, 18, '0', 0),
(5, 35, '0', 0),
(6, 32, '0', 0),
(7, 31, '0', 0),
(8, 32, '0', 0),
(9, 29, 'heyhey@me.com', 0),
(10, 37, 'minty@minty-ai.net', 5),
(11, 37, 'edisonxh@gmail.com', 2),
(12, 37, 'writeameer@gmail.com', 3),
(13, 37, 'admin@nisch.org', 1),
(14, 37, 'test@test.com', 0),
(15, 32, 'test@nisch.org', 0),
(16, 37, 'test@test.com', 5),
(17, 14, 'test@hotmail.com', 20),
(18, 39, 'msn@nisch.org', 100),
(19, 40, 'eset@asefasf.com', 10),
(20, 40, 'eset@asefasf.com', 10),
(21, 41, 'test@hotmail.com', 4),
(22, 37, 'msn@nisch.org', 1),
(23, 37, 'me@me.com', 5),
(24, 37, 'me@me.com', 2),
(25, 37, 'ndy@gmail.com', 3),
(26, 37, 'me@me.com', 7);

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

CREATE TABLE IF NOT EXISTS `solutions` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `spid` int(11) DEFAULT NULL,
  `solution` varchar(500) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `hash` varchar(32) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `solutions`
--

INSERT INTO `solutions` (`sid`, `id`, `spid`, `solution`, `approved`, `hash`) VALUES
(1, 1, 1, 'Solution 1', 1, ''),
(2, 2, 7, '222222', 1, ''),
(3, 2, 8, 'blah', 1, ''),
(4, 4, 9, 'new solution', 1, ''),
(5, 4, 10, 'another solution', 1, ''),
(6, 3, 11, 'test', 1, ''),
(7, 1, 12, 'blah blah', 1, ''),
(8, 11, 13, 'Life in my Pocket\r\n\r\nIt would be great if I could carry around my life list with me all the time on my iPhone, but the only way I could do that is to buy a â€œto-doâ€ list application and manually put them in one by one. That is such a pain; there must be an easier way?', 1, ''),
(9, 25, 14, 'Millions of people are out of work. This app will allow you to access all help wanted ads in all major newspapers. Included will be links to real estate, reports on quality of life issues like school ratings, crime, taxes etc. Links to major headhunters and employment agencies will be broken down by state, city and county.\r\nA built in resume writer to help you prepare should also be included.\r\nIt will give the person the best leads possible to help find a job and then provide details that the fa', 1, ''),
(10, 30, 15, 'Amoogle!', 1, ''),
(11, 36, 18, 'test', 1, 'o61m90b1nqUzMM8je3kYkwT3trZaL5na'),
(12, 37, 19, 'I can build this application for the iPhone platform.', 0, 'NCEq4ZVV3NmmnhP01znTXtFzCxwpakHY'),
(13, 39, 20, 'I have the solution.', 0, 'CKleG4jDvejIoc6D1uRqA72Y5jjVUrzw'),
(14, 39, 21, 'I have the solution.', 0, 'AdrsbUnbt85Laq8VNMGycuCgyTimqEU0'),
(15, 30, 22, 'Such RSS utility should do the following:\r\n1. create list of RSS feeds to be analyzed\r\n2. prioritize RSS feeds on this list - which one should be read as first, second, etc., thus deciding the main source.\r\n3. define depth of lexical analysis of feeds - full header, first sentence, first line of header.\r\n4. as option decide what to do with duplicated feed - remove (no access to comments) or mark as read.', 0, '8YmyQpkrCQKjbCHk8w8XhsKcH6sO9ebi'),
(16, 14, 23, 'In fact, this app already exists in the form of USPS Mobile:\r\n\r\nhttp://itunes.apple.com/us/app/usps-mobile/id339597578?mt=8\r\n\r\nYou can even track shipments in the app.', 0, 'hvqTSOSZB7bEu0XpBpKe1SVjzHUmRgM9'),
(17, 30, 24, 'Why not simply use feedsifter with combination of feedrinse', 0, 'pRho9o8Bg6eRjs4tVeonxcRaROB5c7EB'),
(18, 14, 26, 'around me app does this', 0, 'Dz8gI89epp1gLZHjgikT3Ihahp71EXLi'),
(19, 37, 27, 'nextbus.com', 0, 'Mm490EtoyBxuTjlOL9oV1YJl4OAdY6DK');

-- --------------------------------------------------------

--
-- Table structure for table `sprovider`
--

CREATE TABLE IF NOT EXISTS `sprovider` (
  `spid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`spid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `sprovider`
--

INSERT INTO `sprovider` (`spid`, `email`) VALUES
(1, 'testsp@iapps4me.com'),
(2, 'test solution'),
(3, 'test@hotmail.com'),
(4, 'test@hotmail.com'),
(5, 'test@hotmail.com'),
(6, 'test2@hotmail.com'),
(7, '2@2.com'),
(8, 'blah@blah.com'),
(9, 'new@new.com'),
(10, 'another@test.com'),
(11, 'test@test.com'),
(12, 'me@me.com'),
(13, 'writeameer@gmail.com'),
(14, 'a@a.com'),
(15, 'david@cloudartisan.com'),
(16, 'me@me.com'),
(17, 'minty@minty-ai.net'),
(18, 'me@me.com'),
(19, 'me@me.com'),
(20, 'soln1@hotmail.com'),
(21, 'test@hotmail.com'),
(22, 'mar3kg@gmail.com'),
(23, 'computerwiz908@gmail.com'),
(24, 'marun2@gmail.com'),
(25, 'peter.evil1@gmail.com'),
(26, 'buddy@buddy.com'),
(27, 'gtdminh@gmail.com');
