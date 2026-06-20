-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2026 at 11:23 AM
-- Server version: 10.6.27-MariaDB
-- PHP Version: 8.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stelaran_tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-05-11 11:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `BookingId` int(11) NOT NULL,
  `PackageId` int(11) DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `FromDate` varchar(100) DEFAULT NULL,
  `ToDate` varchar(100) DEFAULT NULL,
  `Comment` mediumtext DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL,
  `CancelledBy` varchar(5) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`BookingId`, `PackageId`, `UserEmail`, `FromDate`, `ToDate`, `Comment`, `RegDate`, `status`, `CancelledBy`, `UpdationDate`) VALUES
(1, 1, 'test@gmail.com', '2020-07-11', '2020-07-18', 'I want this package.', '2020-07-08 06:38:36', 2, 'u', '2020-07-08 06:53:45'),
(2, 2, 'test@gmail.com', '2020-07-10', '2020-07-13', 'There is some discount', '2020-07-08 06:43:25', 1, NULL, '2020-07-08 06:52:44'),
(3, 4, 'abir@gmail.com', '2020-07-11', '2020-07-15', 'When I get conformation', '2020-07-08 06:44:39', 2, 'a', '2020-07-08 06:49:55'),
(4, 1, 'anuj@gmail.com', '2024-08-13', '2024-08-14', 'zxfc', '2024-08-12 03:32:44', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbldestimages`
--

CREATE TABLE `tbldestimages` (
  `destimgId` int(11) NOT NULL,
  `PackageImage1` varchar(150) DEFAULT NULL,
  `PackageImage2` varchar(150) DEFAULT NULL,
  `Topic` varchar(250) DEFAULT NULL,
  `Details` text DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbldestimages`
--

INSERT INTO `tbldestimages` (`destimgId`, `PackageImage1`, `PackageImage2`, `Topic`, `Details`, `Creationdate`, `UpdationDate`) VALUES
(11, 'anuradhapura_1.jpg', 'anuradhapura_2.jpg', 'Anuradhapura', 'Anuradhapura is an ancient city that served as the first capital of Sri Lanka. This UNESCO World Heritage Site is renowned for its well-preserved ruins of magnificent palaces, monasteries, and stupas, including the iconic Ruwanwelisaya.', '2024-08-19 12:33:17', '2025-01-20 05:37:16'),
(12, 'kandy_1.jpg', 'kandy_2.jpg', 'Kandy', 'Nestled in the lush hills of central Sri Lanka, Kandy is a cultural treasure trove, home to the sacred Temple of the Tooth Relic, vibrant traditional arts, and the serene Kandy Lake. The city\'s colonial charm blends seamlessly with its rich Buddhist heritage.', '2024-08-19 12:36:16', NULL),
(13, 'polonnaruwa_1.jpg', 'polonnaruwa_2.jpg', 'Polonnaruwa', 'Polonnaruwa, also referred as Pulathisipura and Vijayarajapura in ancient times, is the main town of Polonnaruwa District in North Central Province, Sri Lanka. The modern town of Polonnaruwa is also known as New Town, and the other part of Polonnaruwa remains as the royal ancient city of the Kingdom of Polonnaruwa.', '2024-08-19 12:37:51', '2025-01-20 05:40:36'),
(14, 'sigiriya_1.jpg', 'sigiriya_2.jpg', 'Sigiriya', 'Known as the \"Lion Rock,\" Sigiriya is an ancient fortress and palace ruin perched on a massive rock pillar. This UNESCO World Heritage Site is famous for its stunning frescoes, landscaped gardens, and panoramic views from the summit.', '2024-08-19 12:56:22', NULL),
(15, 'dambulla_1.jpg', 'dambulla_2.jpg', 'Dambulla', 'Dambulla is home to the largest and best-preserved cave temple complex in Sri Lanka. The Dambulla Cave Temple, a UNESCO World Heritage Site, features stunning Buddhist murals, statues, and a panoramic view of the surrounding countryside.', '2024-08-19 12:56:23', NULL),
(16, 'ella_1.jpg', 'ella_2.jpg', 'Ella', 'A picturesque town in Sri Lanka\'s hill country, Ella is known for its breathtaking landscapes, tea plantations, and outdoor adventures. Popular attractions include the Nine Arches Bridge, Little Adam\'s Peak, and the dramatic Ravana Falls.', '2025-01-20 05:44:00', NULL),
(17, 'yala_1.jpg', 'yala_2.jpg', 'Yala', 'Yala National Park is a wildlife sanctuary famous for its rich biodiversity and the chance to spot elusive leopards. The park\'s diverse ecosystems range from dense forests to sandy beaches, offering a thrilling safari experience.', '2025-01-20 05:45:25', NULL),
(18, 'mirissa_1.jpg', 'mirissa_2.jpg', 'Mirissa', 'Mirissa is a tranquil beach town on Sri Lanka\'s southern coast, famous for its palm-fringed shores and vibrant marine life. It\'s an ideal spot for whale watching, surfing, and enjoying the laid-back coastal atmosphere.', '2025-01-20 05:46:15', NULL),
(19, 'unawatuna_1.jpg', 'unawatuna_2.jpg', 'Unawatuna', 'Unawatuna is a popular beach destination known for its golden sands, turquoise waters, and lively beach bars. The town also offers opportunities for snorkeling, diving, and exploring nearby historical sites like Galle Fort.\r\n\r\n', '2025-01-20 05:47:28', NULL),
(20, 'trincomalee_1.jpg', 'trincomalee_2.jpg', 'Trincomalee', 'Located on the northeast coast, Trincomalee is known for its pristine beaches, crystal-clear waters, and historical significance. The city is home to the ancient Koneswaram Temple and offers excellent opportunities for snorkeling, diving, and whale watching.', '2025-01-20 05:48:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblenquiry`
--

CREATE TABLE `tblenquiry` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblenquiry`
--

INSERT INTO `tblenquiry` (`id`, `FullName`, `EmailId`, `MobileNumber`, `Subject`, `Description`, `PostingDate`, `Status`) VALUES
(1, 'Jone Paaire', 'jone@gmail.com', '4646464646', 'Enquiry for Manali Trip', 'Kindly provide me more offer.', '2020-07-08 06:30:32', 1),
(2, 'Kishan Twaerea', 'kishan@gmail.com', '6797947987', 'Enquiry', 'Any Offer for North Trip', '2020-07-08 06:31:38', 1),
(3, 'Jacaob', 'Jai@gmail.com', '1646689721', 'Any offer for North', 'Any Offer for north', '2020-07-08 06:32:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblgallery`
--

CREATE TABLE `tblgallery` (
  `id` int(11) NOT NULL,
  `imgname` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblgallery`
--

INSERT INTO `tblgallery` (`id`, `imgname`, `location`, `uploaded_at`) VALUES
(5, 'gallery_7_1.jpg', 'Sigiriya', '2025-06-14 06:08:46'),
(6, 'gallery_7_2.jpg', 'Sigiriya', '2025-06-14 06:09:02'),
(7, 'gallery_7_3.jpg', 'Galle', '2025-06-14 06:10:35'),
(9, 'gallery_7_4.jpg', 'Sigiriya', '2025-06-14 06:12:51'),
(12, 'gallery_7_5.jpg', 'Ella', '2025-06-14 06:14:41'),
(13, 'gallery_7_6.jpg', 'Pidurangala', '2025-06-14 06:16:08'),
(14, 'gallery_7_7.jpg', 'Yapahuwa', '2025-06-14 06:16:40'),
(15, 'gallery_7_8.jpg', 'Ella', '2025-06-14 06:17:18'),
(16, 'gallery_7_9.jpg', 'Galle', '2025-06-14 06:17:45'),
(17, 'gallery_7_10.jpg', 'Nuwara-Eliya', '2025-06-14 06:18:51'),
(18, 'gallery_7_11.jpg', 'Galle', '2025-06-14 06:19:22'),
(19, 'gallery_7_12.jpg', 'Galle', '2025-06-14 06:19:49'),
(20, 'gallery_7_13.jpg', 'Kandy', '2025-06-14 06:20:16'),
(21, 'gallery_7_14.jpg', 'Anuradhapura', '2025-06-14 06:21:02'),
(22, 'gallery_7_15.jpg', 'Minneriya', '2025-06-14 06:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `tblissues`
--

CREATE TABLE `tblissues` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `Issue` varchar(100) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminremarkDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblissues`
--

INSERT INTO `tblissues` (`id`, `UserEmail`, `Issue`, `Description`, `PostingDate`, `AdminRemark`, `AdminremarkDate`) VALUES
(1, NULL, NULL, NULL, '2020-07-08 06:33:20', NULL, NULL),
(2, NULL, NULL, NULL, '2020-07-08 06:33:56', NULL, NULL),
(3, NULL, NULL, NULL, '2020-07-08 06:34:20', NULL, NULL),
(4, NULL, NULL, NULL, '2020-07-08 06:34:38', NULL, NULL),
(5, NULL, NULL, NULL, '2020-07-08 06:35:06', NULL, NULL),
(6, 'test@gmail.com', 'Booking Issues', 'I am not able to book package', '2020-07-08 06:36:03', 'Ok, We will fix the issue asap', '2020-07-08 06:55:22'),
(7, 'test@gmail.com', 'Refund', 'I want my refund', '2020-07-08 06:56:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT '',
  `detail` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `type`, `detail`) VALUES
(1, 'terms', '																				<span style=\"font-weight: bold;\">Terms and conditions of booking your holiday are as follows:</span><br><span style=\"font-weight: bold;\"><span style=\"text-decoration: underline;\">Booking and Payment</span>:</span><br>1. A booking is accepted only after we receive written confirmation from you along with full payment<br>OR a non-refundable deposit of 20% of the value of the Travel Arrangements. (This may be waived solely at our discretion).<br>2. Peak Season Bookings require a 50% advance payment of the total value.<br>3. If the booking is made within 30 days of arrival in Sri Lanka, then full payment is required at the time of confirmation.<br>4. Full payment OR the payment of a deposit and your written confirmation will indicate an<br>acceptance of these terms and conditions by you.<br>5. The balance payment (if any) due for Your Travel Arrangements must be paid by you not later than 30 days before arrival in Sri Lanka; If not, we may treat the booking as cancelled by you.<br><span style=\"font-weight: bold; text-decoration: underline;\">Price Policy:</span><br>1. Rates and Price Variations: We reserve the right to vary prices and rates in the event of changes in exchange rates or price rises made by wholesalers or other suppliers.<br>2. If the cost of any service increases due to exchange rate fluctuations, price increases, tax changes, or any other reason, you are required to pay the increase when notified by us or you may cancel the booking which may result in cancellation fees. We are not liable in any way if any increase occurs.<br>3. Rates quoted are appropriate to the particular product at the time of quoting and these rates may change prior to the travel date.<br>4. All prices are subject to availability and can be withdrawn or varied without notice.<br>5. All prices are provided in United States dollars.<br><span style=\"font-weight: bold; text-decoration: underline;\">Amendments and Cancellations:</span><br>1. Any alteration or cancellation of services after your holiday has commenced can incur penalties. There is no refund for cancellations after the commencement of Your Travel Arrangements or on any services not used for any reason.<br>2. Reasonable changes in the Travel Arrangements may be made without notice to You if deemed necessary or advisable by Us at Our discretion.<br>3. Standard Cancellation Policy:<br>4. We must receive written notification by you of any cancellation of your travel arrangements, and it will take effect the day we receive it. The following penalties will apply:<br>i. Between 31 and 60 days - forfeit of deposit<br>ii. Between 15 and 30 days – 25% of total ground arrangement cost<br>iii. Between 08 and 14 days - 50% of total ground arrangement cost<br>iv. 7 or Less than 07 days – no refund of total ground arrangement cost<br><span style=\"text-decoration: underline; font-weight: bold;\">Special Cancellation Conditions</span>: Certain accommodation and tour products will apply additional cancellation charges. These cancellation conditions and costs will be clearly advised to you in writing at the time of booking.<br><br>\r\n										\r\n										'),
(2, 'privacy', '										<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>\r\n										'),
(3, 'aboutus', '										<!--[if gte mso 9]><xml>\r\n <o:OfficeDocumentSettings>\r\n  <o:AllowPNG/>\r\n </o:OfficeDocumentSettings>\r\n</xml><![endif]--><!--[if gte mso 9]><xml>\r\n <w:WordDocument>\r\n  <w:View>Normal</w:View>\r\n  <w:Zoom>0</w:Zoom>\r\n  <w:TrackMoves/>\r\n  <w:TrackFormatting/>\r\n  <w:PunctuationKerning/>\r\n  <w:ValidateAgainstSchemas/>\r\n  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>\r\n  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>\r\n  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>\r\n  <w:DoNotPromoteQF/>\r\n  <w:LidThemeOther>EN-US</w:LidThemeOther>\r\n  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>\r\n  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>\r\n  <w:Compatibility>\r\n   <w:BreakWrappedTables/>\r\n   <w:SnapToGridInCell/>\r\n   <w:WrapTextWithPunct/>\r\n   <w:UseAsianBreakRules/>\r\n   <w:DontGrowAutofit/>\r\n   <w:SplitPgBreakAndParaMark/>\r\n   <w:EnableOpenTypeKerning/>\r\n   <w:DontFlipMirrorIndents/>\r\n   <w:OverrideTableStyleHps/>\r\n  </w:Compatibility>\r\n  <m:mathPr>\r\n   <m:mathFont m:val=\"Cambria Math\"/>\r\n   <m:brkBin m:val=\"before\"/>\r\n   <m:brkBinSub m:val=\"&#45;-\"/>\r\n   <m:smallFrac m:val=\"off\"/>\r\n   <m:dispDef/>\r\n   <m:lMargin m:val=\"0\"/>\r\n   <m:rMargin m:val=\"0\"/>\r\n   <m:defJc m:val=\"centerGroup\"/>\r\n   <m:wrapIndent m:val=\"1440\"/>\r\n   <m:intLim m:val=\"subSup\"/>\r\n   <m:naryLim m:val=\"undOvr\"/>\r\n  </m:mathPr></w:WordDocument>\r\n</xml><![endif]--><!--[if gte mso 9]><xml>\r\n <w:LatentStyles DefLockedState=\"false\" DefUnhideWhenUsed=\"false\"\r\n  DefSemiHidden=\"false\" DefQFormat=\"false\" DefPriority=\"99\"\r\n  LatentStyleCount=\"371\">\r\n  <w:LsdException Locked=\"false\" Priority=\"0\" QFormat=\"true\" Name=\"Normal\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" QFormat=\"true\" Name=\"heading 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 7\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 8\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"9\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"heading 9\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 6\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 7\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 8\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index 9\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 7\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 8\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"toc 9\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal Indent\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footnote text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"header\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footer\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"index heading\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"35\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"caption\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"table of figures\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"envelope address\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"envelope return\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"footnote reference\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation reference\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"line number\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"page number\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"endnote reference\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"endnote text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"table of authorities\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"macro\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"toa heading\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Bullet 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Number 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"10\" QFormat=\"true\" Name=\"Title\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Closing\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Signature\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"1\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"Default Paragraph Font\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"List Continue 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Message Header\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"11\" QFormat=\"true\" Name=\"Subtitle\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Salutation\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Date\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text First Indent\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text First Indent 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Note Heading\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Body Text Indent 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Block Text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Hyperlink\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"FollowedHyperlink\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"22\" QFormat=\"true\" Name=\"Strong\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"20\" QFormat=\"true\" Name=\"Emphasis\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Document Map\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Plain Text\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"E-mail Signature\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Top of Form\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Bottom of Form\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal (Web)\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Acronym\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Address\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Cite\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Code\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Definition\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Keyboard\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Preformatted\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Sample\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Typewriter\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"HTML Variable\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Normal Table\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"annotation subject\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"No List\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Outline List 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Simple 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Classic 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Colorful 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Columns 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 6\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 7\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Grid 8\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 4\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 5\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 6\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 7\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table List 8\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table 3D effects 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Contemporary\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Elegant\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Professional\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Subtle 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Subtle 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 2\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Web 3\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Balloon Text\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" Name=\"Table Grid\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" UnhideWhenUsed=\"true\"\r\n   Name=\"Table Theme\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" Name=\"Placeholder Text\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"1\" QFormat=\"true\" Name=\"No Spacing\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" SemiHidden=\"true\" Name=\"Revision\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"34\" QFormat=\"true\"\r\n   Name=\"List Paragraph\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"29\" QFormat=\"true\" Name=\"Quote\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"30\" QFormat=\"true\"\r\n   Name=\"Intense Quote\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"60\" Name=\"Light Shading Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"61\" Name=\"Light List Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"62\" Name=\"Light Grid Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"63\" Name=\"Medium Shading 1 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"64\" Name=\"Medium Shading 2 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"65\" Name=\"Medium List 1 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"66\" Name=\"Medium List 2 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"67\" Name=\"Medium Grid 1 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"68\" Name=\"Medium Grid 2 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"69\" Name=\"Medium Grid 3 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"70\" Name=\"Dark List Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"71\" Name=\"Colorful Shading Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"72\" Name=\"Colorful List Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"73\" Name=\"Colorful Grid Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"19\" QFormat=\"true\"\r\n   Name=\"Subtle Emphasis\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"21\" QFormat=\"true\"\r\n   Name=\"Intense Emphasis\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"31\" QFormat=\"true\"\r\n   Name=\"Subtle Reference\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"32\" QFormat=\"true\"\r\n   Name=\"Intense Reference\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"33\" QFormat=\"true\" Name=\"Book Title\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"37\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" Name=\"Bibliography\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"39\" SemiHidden=\"true\"\r\n   UnhideWhenUsed=\"true\" QFormat=\"true\" Name=\"TOC Heading\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"41\" Name=\"Plain Table 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"42\" Name=\"Plain Table 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"43\" Name=\"Plain Table 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"44\" Name=\"Plain Table 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"45\" Name=\"Plain Table 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"40\" Name=\"Grid Table Light\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\" Name=\"Grid Table 1 Light\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\" Name=\"Grid Table 6 Colorful\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\" Name=\"Grid Table 7 Colorful\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"Grid Table 1 Light Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"Grid Table 2 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"Grid Table 3 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"Grid Table 4 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"Grid Table 5 Dark Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"Grid Table 6 Colorful Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"Grid Table 7 Colorful Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\" Name=\"List Table 1 Light\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\" Name=\"List Table 6 Colorful\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\" Name=\"List Table 7 Colorful\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 1\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 2\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 3\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 4\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 5\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"46\"\r\n   Name=\"List Table 1 Light Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"47\" Name=\"List Table 2 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"48\" Name=\"List Table 3 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"49\" Name=\"List Table 4 Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"50\" Name=\"List Table 5 Dark Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"51\"\r\n   Name=\"List Table 6 Colorful Accent 6\"/>\r\n  <w:LsdException Locked=\"false\" Priority=\"52\"\r\n   Name=\"List Table 7 Colorful Accent 6\"/>\r\n </w:LatentStyles>\r\n</xml><![endif]--><!--[if gte mso 10]>\r\n<style>\r\n /* Style Definitions */\r\n table.MsoNormalTable\r\n	{mso-style-name:\"Table Normal\";\r\n	mso-tstyle-rowband-size:0;\r\n	mso-tstyle-colband-size:0;\r\n	mso-style-noshow:yes;\r\n	mso-style-priority:99;\r\n	mso-style-parent:\"\";\r\n	mso-padding-alt:0in 5.4pt 0in 5.4pt;\r\n	mso-para-margin-top:0in;\r\n	mso-para-margin-right:0in;\r\n	mso-para-margin-bottom:8.0pt;\r\n	mso-para-margin-left:0in;\r\n	line-height:107%;\r\n	mso-pagination:widow-orphan;\r\n	font-size:11.0pt;\r\n	font-family:\"Calibri\",sans-serif;\r\n	mso-ascii-font-family:Calibri;\r\n	mso-ascii-theme-font:minor-latin;\r\n	mso-hansi-font-family:Calibri;\r\n	mso-hansi-theme-font:minor-latin;\r\n	mso-bidi-font-family:\"Times New Roman\";\r\n	mso-bidi-theme-font:minor-bidi;}\r\n</style>\r\n<![endif]-->\r\n\r\n<p class=\"MsoNormal\"><span style=\"font-size:10.0pt;line-height:107%;font-family:\r\n&quot;Lucida Calligraphy&quot;\">Welcome to Stelaranholidays </span></p>\r\n\r\n<p class=\"MsoNormal\"><span style=\"font-size:20.0pt;line-height:107%;font-family:\r\n&quot;Lucida Calligraphy&quot;;mso-bidi-font-weight:bold\">We are world reputeted travel\r\nagency</span></p>\r\n\r\n<p class=\"MsoNormal\"><span style=\"font-size:10.0pt;line-height:107%;font-family:\r\n&quot;Lucida Calligraphy&quot;;mso-bidi-font-weight:bold\">About Stelaran Holidays</span></p>\r\n\r\n<p class=\"MsoNormal\"><span style=\"font-size:10.0pt;line-height:107%;font-family:\r\n&quot;Century Gothic&quot;,sans-serif;mso-bidi-font-weight:bold\">Welcome to Stelaran\r\nHolidays (Pvt) Ltd, your trusted and fully licensed travel agency in Sri Lanka.\r\nWith over 20 years of collective experience, our team of dedicated travel\r\nprofessionals is here to ensure that your journey with us is of exceptional.<br>\r\nStelaran Holidays, we believe in providing stress-free, comfortable, and\r\nenjoyable trips for all our clients. Our website showcases a variety of carefully\r\ncurated travel programs, designed to cater to your specific interests and\r\npreferences.<br>\r\nWith a growing base of international travelers, we have successfully handled\r\nbookings for thousands of clients each year. We take pride in our strong\r\nrelationships with reliable tour administrators from countries such as the UK,\r\nGermany, Australia, Denmark, Romania, UAE, Austria, and more. This network\r\nenables us to offer you a safe and memorable trip, along with hassle-free\r\ntravel planning and the best possible offers.<br>\r\nAt Stelaran Holidays, we understand that your journey is unique, and we are\r\nhere to make it extraordinary. Contact us today and allow us to turn your\r\ntravel dreams into reality. Experience the wonders of Sri Lanka with us and\r\ncreate memories that will last a lifetime.</span></p>\r\n\r\n\r\n										\r\n										'),
(11, 'contact', '																				<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Address------J-890 Dwarka House New Delhi-110096</span>');

-- --------------------------------------------------------

--
-- Table structure for table `tbltouractivities`
--

CREATE TABLE `tbltouractivities` (
  `ActivityId` int(11) NOT NULL,
  `PackageId` int(11) NOT NULL,
  `DateId` int(3) NOT NULL,
  `ActivityName` varchar(200) DEFAULT NULL,
  `ActivityImage` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbltouractivities`
--

INSERT INTO `tbltouractivities` (`ActivityId`, `PackageId`, `DateId`, `ActivityName`, `ActivityImage`, `Creationdate`, `UpdationDate`) VALUES
(11, 1, 1, 'Airport pick-up and transfer to Pinnawala Elephant Orphanage', '', '2024-08-11 03:26:33', NULL),
(12, 1, 1, 'Visit to Royal Botanical Garden.', '', '2024-08-11 03:26:33', NULL),
(13, 1, 1, 'Visit the sacred Temple of the Tooth Relic, one of the most revered Buddhist temples in Sri Lanka.', '', '2024-08-11 03:26:33', NULL),
(14, 1, 1, 'Spice Garden Visit to experience the diversity of Sri Lanka\'s spices and medicinal plants.', '', '2024-08-11 03:26:33', NULL),
(15, 1, 1, 'Overnight stay at the hotel.', '', '2024-08-11 05:20:03', NULL),
(16, 1, 2, 'Visit waterfalls (Ramboda, Hunas, Rathna Ella, Huluganga)', '', '2024-08-11 05:20:03', NULL),
(17, 1, 2, 'Visit Tea Factory and Plantation', '', '2024-08-11 05:20:03', NULL),
(18, 1, 2, 'Scenic stroll around Kandy Lake.', '', '2024-08-11 05:20:03', NULL),
(19, 1, 2, 'Kandyan Dance Show and City Tour.', '', '2024-08-11 05:20:03', NULL),
(20, 1, 2, 'Visit Gem Shop', '', '2024-08-11 05:20:03', NULL),
(21, 1, 2, 'Overnight stay at the hotel', '', '2024-08-11 05:20:03', NULL),
(22, 1, 3, 'Depart from the hotel after breakfast and head towards Colombo.', '', '2024-08-11 05:20:03', NULL),
(23, 1, 3, 'Reach Colombo Airport for a smooth transfer based on your flight schedule.', '', '2024-08-11 05:20:03', NULL),
(24, 1, 3, 'End of Tour.', '', '2024-08-11 05:21:25', NULL),
(25, 2, 1, 'Arrive at Colombo International Airport.', 'mountain_hike.jpg', '2024-08-11 05:21:25', NULL),
(26, 2, 1, 'Meet with the representative and transfer to Sigiriya for hotel check-in and relaxation.', '', '2024-08-11 05:21:25', NULL),
(27, 2, 1, 'Visit Dambulla Cave Temple, a UNESCO World Heritage Site adorned with murals depicting Lord Buddha’s life.', '', '2024-08-11 05:21:38', NULL),
(28, 2, 1, 'After lunch, transfer to Sigiriya Rock Fortress, a masterpiece of ancient architecture and another UNESCO World Heritage Site.', '', '2024-08-11 05:21:38', NULL),
(29, 2, 2, 'Early morning transfer to Minneriya National Park.', '', '2024-08-11 05:21:38', NULL),
(30, 2, 2, 'Enjoy a half-day safari exploring the park’s diverse wildlife, including elephants, leopards, and bird species.', NULL, '2025-01-25 05:25:14', NULL),
(31, 2, 2, 'Return to Colombo and proceed to the airport for departure.', NULL, '2025-01-25 05:25:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbltourcategories`
--

CREATE TABLE `tbltourcategories` (
  `cat_id` int(11) NOT NULL,
  `category_full` varchar(100) DEFAULT NULL,
  `category_part` varchar(100) DEFAULT NULL,
  `image_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbltourcategories`
--

INSERT INTO `tbltourcategories` (`cat_id`, `category_full`, `category_part`, `image_id`) VALUES
(1, 'Wildlife Tours', 'Wildlife', 'category_10.jpg'),
(2, 'Beach & Coastal Tours', 'Beach & Coastal', 'category_20.jpg'),
(3, 'Cultural & Heritage Tours', 'Cultural & Heritage', 'category_30.jpg'),
(4, 'Wellness & Ayurveda Retreats', 'Wellness & Ayurveda Retreats', 'category_40.jpg'),
(5, 'Adventure & Trekking Tours', 'Adventure & Trekking', 'category_50.jpg'),
(6, 'Scenic Train Journeys', 'Scenic Train Journeys', 'category_60.jpg'),
(7, 'Family Tours', 'Family', 'category_70.jpg'),
(8, 'Honeymoon Tours', 'Honeymoon', 'category_80.jpg'),
(9, 'Rural Life Tours', 'Rural Life', 'category_90.jpg'),
(10, 'Budget Tours', 'Budget', 'category_100.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbltourpackages`
--

CREATE TABLE `tbltourpackages` (
  `PackageId` int(11) NOT NULL,
  `TR_id` int(8) NOT NULL,
  `PackageName` varchar(200) DEFAULT NULL,
  `PackageType` int(3) DEFAULT NULL,
  `PackageLocation` varchar(100) DEFAULT NULL,
  `PackagePrice` int(11) DEFAULT NULL,
  `PackageDetails` mediumtext DEFAULT NULL,
  `PackageFetures` mediumtext DEFAULT NULL,
  `PackageImage` varchar(100) DEFAULT NULL,
  `PackageRate` float NOT NULL,
  `PackagePickup` varchar(50) NOT NULL,
  `PackageLanguage` varchar(30) NOT NULL,
  `PackagePhysicalRating` varchar(30) NOT NULL,
  `PackageGroupSize` varchar(10) NOT NULL,
  `PackageAgeRange` varchar(10) NOT NULL,
  `TR_rate` int(5) NOT NULL,
  `PackageDate` int(3) NOT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbltourpackages`
--

INSERT INTO `tbltourpackages` (`PackageId`, `TR_id`, `PackageName`, `PackageType`, `PackageLocation`, `PackagePrice`, `PackageDetails`, `PackageFetures`, `PackageImage`, `PackageRate`, `PackagePickup`, `PackageLanguage`, `PackagePhysicalRating`, `PackageGroupSize`, `PackageAgeRange`, `TR_rate`, `PackageDate`, `Creationdate`, `UpdationDate`) VALUES
(1, 152841, 'Kandy Excursion', 1, 'Colombo, Pinnawala and Kandy', 500, 'Embark on a journey from Colombo airport to the historical city of Kandy, passing by the famous Pinnawala Elephant Orphanage, and return to Colombo in the evening. During the trip, you\'ll also explore the renowned Royal Botanical Gardens in Peradeniya, making this a must-do day trip for anyone visiting Sri Lanka.', 'Day trip from Colombo to Kandy, including visits to Pinnawala, Royal Botanical Gardens, and local attractions. This tour is designed for a group size of a minimum of 2 to a maximum of 6 participants. Comfortable vehicle for the tour, with airport pick-up and drop-off.', '152841_33472dc5.jpg', 2, 'Airport, Colombo.', 'English', 'Easy', '06 Max', '5 - 90', 55, 3, '2020-07-08 05:21:58', '2025-06-08 05:07:50'),
(2, 185458, 'Kingdom of Sigiriya - 2 Days', 1, 'Colombo, Dambulla and Minneriya National Park', 500, 'Sigiriya and Dambulla are world-renowned UNESCO World Heritage Sites, celebrated for their historical, cultural, and ecological significance. Sigiriya, often referred to as the 8th Wonder of the World, is an ancient rock fortress built during the 5th century by King Kashyapa. Its grandeur rivals other international wonders like the Grand Canyon and the Pyramids of Egypt. Dambulla, home to the famous Golden Temple, showcases intricate murals depicting Lord Buddha’s life, dating back to the 2nd century. Together, these destinations make for an enriching cultural and eco-tourism experience.', 'Guided day tours with cultural and wildlife experiences, Year-round, but preferably during the dry season for outdoor activities.', '185458_87802734.jpg', 5, 'Airport, Colombo', 'English', '5.0', '2 - 8', '5 - 90', 55, 2, '2020-07-08 05:37:40', '2025-06-08 05:07:50'),
(3, 150118, 'Ayurveda Sri Lanka - 7 Days', 1, 'Colombo, Negombo and Dambulla', 1800, 'Embark on a serene journey through Sri Lanka with this tailor-made Ayurveda and Yoga retreat. This rejuvenating itinerary is designed to provide travelers a holistic escape from daily stress, offering healing treatments, yoga sessions, and tranquil stays at handpicked resorts. Experience the ancient art of Ayurveda, unwind in luxurious surroundings, and discover Sri Lanka’s captivating heritage.', 'Free Pickup and drop facility, Free Wi-fi , Free professional guide', '150118_05527b71.jpg', 0, 'Airport, Colombo', 'English', '5.0', '2 - 10', '15 - 90', 55, 7, '2020-07-08 05:41:07', '2025-06-08 05:07:50'),
(13, 138440, 'Ayurveda Wellness Tour - 15 Day', 1, NULL, 4400, NULL, NULL, '138440_5d25d9b2.jpg', 0, '', '', '', '', '', 55, 15, '2025-02-15 07:35:18', '2025-06-08 05:07:50'),
(14, 138445, 'Sri Lanka Beach & Safari - 8 Days', 1, NULL, 1700, NULL, NULL, '138445_2ee2a877.jpg', 0, '', '', '', '', '', 55, 8, '2025-02-15 07:35:18', '2025-06-08 05:07:50'),
(15, 138447, 'Sri Lanka Wildlife & Nature - 18 Days', 1, NULL, 3500, NULL, NULL, '138447_5e203e10c55b6.jpg', 0, '', '', '', '', '', 85, 18, '2025-02-15 07:35:18', '2025-06-08 05:07:50'),
(16, 140400, 'Sri Lankan in Style - 5 Days', 1, NULL, 1000, NULL, NULL, '140400_0e638f09.jpg', 0, '', '', '', '', '', 65, 5, '2025-02-15 07:35:18', '2025-06-08 05:07:50'),
(17, 140471, 'The Sri Lankan Experience - 7 Days', 1, NULL, 1400, NULL, NULL, '140471_43b66f56.jpg', 0, '', '', '', '', '', 85, 7, '2025-02-15 07:35:18', '2025-06-08 05:07:50'),
(18, 140473, 'Adam\'s Peak Excursion - 3 Days', 1, NULL, 500, NULL, NULL, '140473_449385c7.jpg', 0, '', '', '', '', '', 55, 3, '2025-02-15 07:35:18', '2025-06-08 05:07:50'),
(19, 140502, 'Sigiriya Excursion - 3 Days', 2, NULL, 550, NULL, NULL, '140502_3246e408.jpg', 0, '', '', '', '', '', 55, 3, '2025-02-15 07:35:18', '2025-06-08 05:08:33'),
(20, 140509, 'Sri Lanka for Families - 10 Days', 2, NULL, 1700, NULL, NULL, '140509_65fa11b47619f.jpg', 0, '', '', '', '', '', 65, 10, '2025-02-15 07:35:18', '2025-06-08 05:08:33'),
(21, 140511, 'Sri Lanka for Families - 18 Days', 2, NULL, 3200, NULL, NULL, '140511_5bd7c764.jpg', 0, '', '', '', '', '', 55, 18, '2025-02-15 07:35:18', '2025-06-08 05:08:33'),
(22, 141301, 'BAWA\'S LEGACY ARCHITECTURAL EXPEDITION', 2, NULL, 2600, NULL, NULL, '141301_18136de7.jpg', 0, '', '', '', '', '', 55, 11, '2025-02-15 07:35:18', '2025-06-08 05:08:33'),
(23, 141322, 'Sri Lanka Honeymoon One - 10 Days', 2, NULL, 2500, NULL, NULL, '141322_65fda8e1c45d3.jpg', 0, '', '', '', '', '', 55, 11, '2025-02-15 07:35:18', '2025-06-08 05:08:33'),
(24, 141328, 'Sri Lanka lover Train Trail - 11 Days', 3, NULL, 1500, NULL, NULL, '141328_0e3c9ed5.jpg', 0, '', '', '', '', '', 75, 11, '2025-02-15 07:35:18', '2025-06-08 05:09:35'),
(25, 143713, 'Trekking Knuckles - 8 Days', 3, NULL, 1600, NULL, NULL, '143713_fb3b1d5e.jpg', 0, '', '', '', '', '', 55, 8, '2025-02-15 07:35:18', '2025-06-08 05:09:35'),
(26, 146817, 'Sri Lankan Safari Excursion - 6 Days', 3, NULL, 1450, NULL, NULL, '146817_d3988c33.jpg', 0, '', '', '', '', '', 65, 6, '2025-02-15 07:35:18', '2025-06-08 05:09:35'),
(27, 147155, 'Sri Lanka\'s Cool Plants - 7 Days', 3, NULL, 1450, NULL, NULL, '147155_6e57ed9b.jpg', 0, '', '', '', '', '', 55, 7, '2025-02-15 07:35:18', '2025-06-08 05:09:35'),
(28, 150329, 'Agro Sri Lanka - 5 Days', 3, NULL, 800, NULL, NULL, '150329_8d7a9b1a.jpg', 0, '', '', '', '', '', 55, 5, '2025-02-15 07:35:18', '2025-06-08 05:09:35'),
(29, 152931, 'Trekking Sri Lanka - 5 Days', 3, NULL, 1300, NULL, NULL, '152931_616a8a24.jpg', 0, '', '', '', '', '', 55, 5, '2025-02-15 07:35:18', '2025-06-08 05:09:35'),
(30, 156373, 'Sri Lanka Solo holidays - 15 Days', 3, NULL, 3000, NULL, NULL, '156373_2758aefd.jpg', 0, '', '', '', '', '', 60, 15, '2025-02-15 07:35:18', '2025-06-08 05:09:35'),
(31, 157428, 'Sri Lanka Sun & Sand - 12 Days', 3, NULL, 2200, NULL, NULL, '157428_6643729f32451.jpg', 0, '', '', '', '', '', 65, 12, '2025-02-15 07:35:18', '2025-06-08 05:09:35'),
(32, 158227, 'Sri Lanka Ramayana - 12 Days', 3, NULL, 2700, NULL, NULL, '158227_17bd7b72.jpg', 0, '', '', '', '', '', 55, 12, '2025-02-15 07:35:18', '2025-06-08 05:09:35'),
(33, 158228, 'Southern Beaches of Sri Lanka - 5 Days', 3, NULL, 1100, NULL, NULL, '158228_78c662e4.jpg', 0, '', '', '', '', '', 85, 5, '2025-02-15 07:35:18', '2025-06-08 05:09:35'),
(34, 159357, 'Sri Lankan Heritage - 11 Days', 4, NULL, 2100, NULL, NULL, '159357_65fda18f7ff7b.jpg', 0, '', '', '', '', '', 55, 11, '2025-02-15 07:35:18', '2025-06-08 05:10:10'),
(35, 159358, 'Cool Sri Lanka - 12 Days', 4, NULL, 1700, NULL, NULL, '159358_9f943b5d.jpg', 0, '', '', '', '', '', 55, 12, '2025-02-15 07:35:18', '2025-06-08 05:10:10'),
(36, 164438, 'Sri Lankan Safari - 14 Days', 5, NULL, 2000, NULL, NULL, '164438_01eb98c9.jpg', 0, '', '', '', '', '', 65, 14, '2025-02-15 07:35:18', '2025-06-08 05:11:01'),
(37, 164927, 'Sri Lanka on a Budget - 10 Days', 5, NULL, 1500, NULL, NULL, '164927_664419a3ea9ad.jpg', 0, '', '', '', '', '', 50, 10, '2025-02-15 07:35:18', '2025-06-08 05:11:01'),
(38, 164929, 'Discover Sri Lanka - 11 Days', 5, NULL, 1400, NULL, NULL, '164929_146058cb.jpg', 0, '', '', '', '', '', 55, 11, '2025-02-15 07:35:18', '2025-06-08 05:11:01'),
(39, 165084, 'Tropical Sri Lanka - 10 Days', 5, NULL, 1700, NULL, NULL, '165084_65fd9566c0002.jpg', 0, '', '', '', '', '', 55, 10, '2025-02-15 07:35:18', '2025-06-08 05:11:01'),
(40, 166451, 'Bird Watching in Sri Lanka - 17 Days', 5, NULL, 2800, NULL, NULL, '166451_fa9483c5.jpg', 0, '', '', '', '', '', 55, 17, '2025-02-15 07:35:18', '2025-06-08 05:11:01'),
(41, 166483, 'Life is an Adventure - 11 Days', 6, NULL, 2200, NULL, NULL, '166483_354b321f.jpg', 0, '', '', '', '', '', 50, 11, '2025-02-15 07:35:18', '2025-06-08 05:11:30'),
(42, 168662, 'Sri Lankan Civilization Culture 15 Days', 6, NULL, 2400, NULL, NULL, '168662_898f53ff.jpg', 0, '', '', '', '', '', 55, 15, '2025-02-15 07:35:18', '2025-06-08 05:11:30'),
(43, 169879, 'Sri Lanka\'s Hidden Beauty - 10 Days', 7, NULL, 1350, NULL, NULL, '169879_65eb396107152.jpg', 0, '', '', '', '', '', 55, 10, '2025-02-15 07:35:18', '2025-06-08 05:12:03'),
(44, 169894, 'Sri Lankan Village Life - 7 Days', 7, NULL, 1350, NULL, NULL, '169894_2b94d135.jpg', 0, '', '', '', '', '', 55, 7, '2025-02-15 07:35:18', '2025-06-08 05:12:03'),
(45, 176232, 'Exclusive Sri Lanka - 16 Days', 7, NULL, 2900, NULL, NULL, '176232_664955d45104a.jpg', 0, '', '', '', '', '', 65, 16, '2025-02-15 07:35:18', '2025-06-08 05:12:03'),
(46, 176238, 'Nature\'s Secret Sri Lanka - 21 Days', 7, NULL, 3500, NULL, NULL, '176238_4d6ba8ae.jpg', 0, '', '', '', '', '', 75, 21, '2025-02-15 07:35:18', '2025-06-08 05:12:03'),
(47, 176240, 'History of Sri Lanka - 15 Days', 7, NULL, 2400, NULL, NULL, '176240_9287caec.jpg', 0, '', '', '', '', '', 55, 15, '2025-02-15 07:35:18', '2025-06-08 05:12:03'),
(48, 176242, 'Gamey Gadara Lifestyle - 12 Days', 9, NULL, 2250, NULL, NULL, '176242_6648ac98e8937.jpg', 0, '', '', '', '', '', 55, 12, '2025-02-15 07:35:18', '2025-06-08 05:12:49'),
(49, 176244, 'Sri Lanka\'s Dream Nature - 12 Days', 9, NULL, 2200, NULL, NULL, '176244_65ea62cc56826.jpg', 0, '', '', '', '', '', 55, 12, '2025-02-15 07:35:18', '2025-06-08 05:12:49'),
(50, 181997, 'Sri Lanka Paradise - 11 Days', 9, NULL, 1800, NULL, NULL, '181997_7e6c7ab1.jpg', 0, '', '', '', '', '', 55, 11, '2025-02-15 07:35:18', '2025-06-08 05:12:49'),
(51, 181998, 'Elephants of Sri Lanka - 15 Days', NULL, NULL, 3000, NULL, NULL, '181998_bd1e0e85.jpg', 0, '', '', '', '', '', 75, 15, '2025-02-15 07:35:18', '2025-02-15 07:58:18'),
(52, 181999, 'Luxury Honeymoon - 10 Days', NULL, NULL, 2300, NULL, NULL, '181999_51f6af77.jpg', 0, '', '', '', '', '', 65, 10, '2025-02-15 07:35:18', '2025-02-15 07:58:53'),
(53, 185451, 'Kingdom of Kandy - 2 Days', 10, NULL, 500, NULL, NULL, '185451_77eb7d94.jpg', 0, '', '', '', '', '', 55, 2, '2025-02-15 07:35:18', '2025-06-08 05:13:38'),
(54, 188833, 'Adventure Trekking tour Trip', NULL, NULL, 1200, NULL, NULL, '188833_9da41605.jpg', 0, '', '', '', '', '', 55, 5, '2025-02-15 07:35:18', '2025-02-15 08:00:08'),
(55, 188834, 'Galle Dutch Fort in Sri Lanka', 10, NULL, 500, NULL, NULL, '188834_addb0271.jpg', 0, '', '', '', '', '', 65, 2, '2025-02-15 07:35:18', '2025-06-08 05:13:38'),
(56, 188879, 'Little England of NuwaraEliya', 10, NULL, 450, NULL, NULL, '188879_5e36321812c6c.jpg', 0, '', '', '', '', '', 65, 3, '2025-02-15 07:35:18', '2025-06-08 05:13:38'),
(57, 189334, 'Yala Safari', NULL, NULL, 1500, NULL, NULL, '189334_5e36315635d6a.jpg', 0, '', '', '', '', '', 65, 5, '2025-02-15 07:35:18', '2025-02-15 08:01:30'),
(58, 189698, 'Arugam Bay surf', NULL, NULL, 1850, NULL, NULL, '189698_5dff2bbcc9c66.jpg', 0, '', '', '', '', '', 55, 10, '2025-02-15 07:35:18', '2025-02-15 08:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbltourpkghiglight`
--

CREATE TABLE `tbltourpkghiglight` (
  `HighlightId` int(11) NOT NULL,
  `PackageId` int(11) NOT NULL,
  `HighlightItem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltourpkghiglight`
--

INSERT INTO `tbltourpkghiglight` (`HighlightId`, `PackageId`, `HighlightItem`) VALUES
(1, 1, 'Bask in the architectural masterpiece of the Temple of the Tooth.'),
(2, 1, 'Gaze upon rolling hills smothered in emerald-green tea plantations.'),
(3, 1, 'Say hello to the baby elephants of Pinnawala Elephant Orphanage.'),
(4, 2, 'Sigiriya Rock Fortress (UNESCO World Heritage Site)'),
(5, 2, 'Dambulla Cave Temple (UNESCO World Heritage Site)'),
(6, 2, 'Minneriya National Park Safari');

-- --------------------------------------------------------

--
-- Table structure for table `tbltourpkgimages`
--

CREATE TABLE `tbltourpkgimages` (
  `pkgimgId` int(11) NOT NULL,
  `PackageId` int(11) NOT NULL,
  `imgtype` tinyint(1) NOT NULL,
  `PackageImage` varchar(150) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbltourpkgimages`
--

INSERT INTO `tbltourpkgimages` (`pkgimgId`, `PackageId`, `imgtype`, `PackageImage`, `Creationdate`, `UpdationDate`) VALUES
(11, 1, 0, 'gallery_1_3.jpg', '2024-11-16 07:57:31', NULL),
(12, 1, 0, 'gallery_1_3.jpg', '2024-11-16 07:58:27', NULL),
(13, 1, 0, 'gallery_1_2.jpg', '2024-11-16 07:58:27', NULL),
(14, 1, 0, 'gallery_1_1.jpg', '2024-11-16 07:58:27', NULL),
(15, 1, 1, 'gallery_1_3.jpg', '2024-11-16 07:59:25', NULL),
(16, 1, 1, 'gallery_1_2.jpg', '2024-11-16 07:59:25', NULL),
(17, 1, 1, 'gallery_1_1.jpg', '2024-11-16 07:59:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbltourpkginexclude`
--

CREATE TABLE `tbltourpkginexclude` (
  `PackageId` int(11) NOT NULL,
  `Accommodation` tinyint(1) NOT NULL DEFAULT 0,
  `Guide` tinyint(1) NOT NULL DEFAULT 0,
  `Insurance` tinyint(1) NOT NULL DEFAULT 0,
  `Meals` tinyint(1) NOT NULL DEFAULT 0,
  `Transport` tinyint(1) NOT NULL DEFAULT 0,
  `Flights` tinyint(1) NOT NULL DEFAULT 0,
  `Safari Jeep` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltourpkginexclude`
--

INSERT INTO `tbltourpkginexclude` (`PackageId`, `Accommodation`, `Guide`, `Insurance`, `Meals`, `Transport`, `Flights`, `Safari Jeep`) VALUES
(1, 1, 1, 0, 1, 1, 0, 0),
(2, 0, 1, 1, 1, 0, 0, 1),
(3, 1, 0, 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `EmailId` varchar(70) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `MobileNumber`, `EmailId`, `Password`, `RegDate`, `UpdationDate`) VALUES
(1, 'Manju Srivatav', '4456464654', 'manju@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-07-08 06:33:20', NULL),
(2, 'Kishan', '9871987979', 'kishan@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-07-08 06:33:56', NULL),
(3, 'Salvi Chandra', '1398756416', 'salvi@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-07-08 06:34:20', NULL),
(4, 'Abir', '4789756456', 'abir@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-07-08 06:34:38', NULL),
(5, 'Test', '1987894654', 'anuj@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2020-07-08 06:35:06', '2021-05-11 04:37:41'),
(6, 'Admin', NULL, 'linda.nayana96@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2026-06-20 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`BookingId`);

--
-- Indexes for table `tbldestimages`
--
ALTER TABLE `tbldestimages`
  ADD PRIMARY KEY (`destimgId`);

--
-- Indexes for table `tblenquiry`
--
ALTER TABLE `tblenquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgallery`
--
ALTER TABLE `tblgallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissues`
--
ALTER TABLE `tblissues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltouractivities`
--
ALTER TABLE `tbltouractivities`
  ADD PRIMARY KEY (`ActivityId`);

--
-- Indexes for table `tbltourcategories`
--
ALTER TABLE `tbltourcategories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbltourpackages`
--
ALTER TABLE `tbltourpackages`
  ADD PRIMARY KEY (`PackageId`);

--
-- Indexes for table `tbltourpkghiglight`
--
ALTER TABLE `tbltourpkghiglight`
  ADD PRIMARY KEY (`HighlightId`);

--
-- Indexes for table `tbltourpkgimages`
--
ALTER TABLE `tbltourpkgimages`
  ADD PRIMARY KEY (`pkgimgId`);

--
-- Indexes for table `tbltourpkginexclude`
--
ALTER TABLE `tbltourpkginexclude`
  ADD PRIMARY KEY (`PackageId`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`),
  ADD KEY `EmailId_2` (`EmailId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `BookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbldestimages`
--
ALTER TABLE `tbldestimages`
  MODIFY `destimgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblenquiry`
--
ALTER TABLE `tblenquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblgallery`
--
ALTER TABLE `tblgallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblissues`
--
ALTER TABLE `tblissues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbltouractivities`
--
ALTER TABLE `tbltouractivities`
  MODIFY `ActivityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbltourpackages`
--
ALTER TABLE `tbltourpackages`
  MODIFY `PackageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbltourpkgimages`
--
ALTER TABLE `tbltourpkgimages`
  MODIFY `pkgimgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
