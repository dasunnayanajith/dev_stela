-- Stelaran Holidays admin content/password reset update
-- Safe to run on the existing database. Designed for MySQL/MariaDB.

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `tbltestimonials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(150) NOT NULL,
  `client_location` varchar(150) DEFAULT NULL,
  `rating` tinyint NOT NULL DEFAULT 5,
  `image_filename` varchar(150) DEFAULT NULL,
  `testimonial_text` text NOT NULL,
  `display_order` int NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tblbooktourprompts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prompt_type` varchar(50) NOT NULL,
  `option_label` varchar(150) NOT NULL,
  `display_order` int NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prompt_type` (`prompt_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `admin_password_resets`;
DROP TABLE IF EXISTS `admin`;

UPDATE `tblusers`
SET `FullName` = 'Admin',
    `Password` = '5f4dcc3b5aa765d61d8327deb882cf99'
WHERE `EmailId` = 'linda.nayana96@gmail.com';

INSERT INTO `tblusers` (`FullName`, `MobileNumber`, `EmailId`, `Password`)
SELECT 'Admin', NULL, 'linda.nayana96@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'
WHERE NOT EXISTS (SELECT 1 FROM `tblusers` WHERE `EmailId` = 'linda.nayana96@gmail.com');

CREATE TABLE IF NOT EXISTS `tbluser_password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `token_hash` char(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `token_hash` (`token_hash`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `tbltourpackages`
  ADD COLUMN IF NOT EXISTS `is_active` tinyint(1) NOT NULL DEFAULT 1;

INSERT INTO `tbltestimonials`
(`client_name`, `client_location`, `rating`, `image_filename`, `testimonial_text`, `display_order`, `is_active`)
SELECT 'Kamlesh Domah', 'Mauritius', 5, 'testim_3.jpg',
'I really enjoyed the Ayurveda tour, which I customized to do some sight-seeing as well. Mr. Lal went out of his way to make the tour memorable, driving for over 10 hours on some days so that I could see as much as possible, and get a good dive into the Sri Lankan culture, cuisine and lifestyle.',
1, 1
WHERE NOT EXISTS (SELECT 1 FROM `tbltestimonials` WHERE `client_name` = 'Kamlesh Domah');

INSERT INTO `tbltestimonials`
(`client_name`, `client_location`, `rating`, `image_filename`, `testimonial_text`, `display_order`, `is_active`)
SELECT 'Susan Ramsey', 'USA', 5, 'testim_1.jpg',
'My teenage granddaughter and I choose the Stelaran Holidays 13 Day Elephant Tour based on reviews and the time that would be spent with or near Elephants. Elli has loved Elephants since she was small and this was her Dream Trip. We were NOT disappointed! The tour is ALL it says it is and SO much more. The island of Sri Lanka is magical! This country is very diverse in heritage, culture, geography, plant and animal life. Each day was an exciting new adventure! The people of Sri Lanka are so kind and hospitable, they made our trip personal. Our guide, Chandana was extremely knowledgeable about everything and went above and beyond to make sure our experience was good. We highly recommended this Tour!',
2, 1
WHERE NOT EXISTS (SELECT 1 FROM `tbltestimonials` WHERE `client_name` = 'Susan Ramsey');

INSERT INTO `tbltestimonials`
(`client_name`, `client_location`, `rating`, `image_filename`, `testimonial_text`, `display_order`, `is_active`)
SELECT 'Doug Harwood', 'USA', 5, 'testim_6.jpg',
'Our Guide Mr. Chandana was absolutely wonderful. He knew just what we liked and did not as he took the time to get to know us. We had a wonderful time on the beautiful beaches and wandering the town. To see all the hidden gems of Sri Lanka you need someone so knowledgeable.',
3, 1
WHERE NOT EXISTS (SELECT 1 FROM `tbltestimonials` WHERE `client_name` = 'Doug Harwood');

INSERT INTO `tbltestimonials`
(`client_name`, `client_location`, `rating`, `image_filename`, `testimonial_text`, `display_order`, `is_active`)
SELECT 'Klaudia Sarah', 'Doha Qatar', 5, 'testim_4.jpg',
'We are two solo women travelers from Doha, Qatar, who recently embarked on an exciting journey with Stelaran Holidays solo holidays tour. Despite heavy rain during the first days, we enjoyed every moment thanks to our fantastic guide Chandana. His kindness and expertise greatly enhanced our experience, making it a trip to remember.',
4, 1
WHERE NOT EXISTS (SELECT 1 FROM `tbltestimonials` WHERE `client_name` = 'Klaudia Sarah');

INSERT INTO `tbltestimonials`
(`client_name`, `client_location`, `rating`, `image_filename`, `testimonial_text`, `display_order`, `is_active`)
SELECT 'Alisa Sierra', 'UK', 5, 'testim_5.jpg',
'Looking to make your holiday dreams a reality? Look no further than Stelaran Holidays. Our recent excursion to Sri Lanka left us utterly enchanted. From the initial planning stages to the final farewell, Stelaran Holidays exceeded our expectations. Their dedication to crafting the perfect itinerary and their swift, helpful responses made the entire process seamless.',
5, 1
WHERE NOT EXISTS (SELECT 1 FROM `tbltestimonials` WHERE `client_name` = 'Alisa Sierra');

INSERT INTO `tbltestimonials`
(`client_name`, `client_location`, `rating`, `image_filename`, `testimonial_text`, `display_order`, `is_active`)
SELECT 'Rodrigo Mariya', 'Denmark', 5, 'testim_8.jpg',
'My family had the most incredible 17-day trip to Sri Lanka. Right from the start I knew they were the tour company for me. I highly recommend this tour, very well organized and we managed to see 15 cities in 17 days. The communication before and during the trip was excellent.',
6, 1
WHERE NOT EXISTS (SELECT 1 FROM `tbltestimonials` WHERE `client_name` = 'Rodrigo Mariya');

INSERT INTO `tbltestimonials`
(`client_name`, `client_location`, `rating`, `image_filename`, `testimonial_text`, `display_order`, `is_active`)
SELECT 'Suzanne', 'Canada', 5, 'testim_1.jpg',
'It is a lot of fun and I saw everything I wanted to see. Bring a good camera because you see lots of birds and animals at the national parks you visit. My guide was awesome. He really looked after me, and as I was travelling alone I was a little worried. I highly recommend this tour and this company!',
7, 1
WHERE NOT EXISTS (SELECT 1 FROM `tbltestimonials` WHERE `client_name` = 'Suzanne');

INSERT INTO `tbltestimonials`
(`client_name`, `client_location`, `rating`, `image_filename`, `testimonial_text`, `display_order`, `is_active`)
SELECT 'Pushpa', 'New York', 5, 'testim_2.jpg',
'This was a very good experience for me and I really enjoyed all the treatments and massages. The driver and guide was kind, punctual and informative. Sonali was very helpful, responsive and went above and beyond to fulfill my needs. I would use Stelaran Holidays again.',
8, 1
WHERE NOT EXISTS (SELECT 1 FROM `tbltestimonials` WHERE `client_name` = 'Pushpa');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'title', 'Mr.', 1, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'title' AND `option_label` = 'Mr.');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'title', 'Mrs.', 2, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'title' AND `option_label` = 'Mrs.');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'title', 'Ms.', 3, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'title' AND `option_label` = 'Ms.');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'title', 'Miss.', 4, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'title' AND `option_label` = 'Miss.');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'title', 'Dr.', 5, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'title' AND `option_label` = 'Dr.');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'title', 'Prof.', 6, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'title' AND `option_label` = 'Prof.');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'accommodation', '5 Star Hotels', 1, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'accommodation' AND `option_label` = '5 Star Hotels');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'accommodation', '4 Star Hotels', 2, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'accommodation' AND `option_label` = '4 Star Hotels');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'accommodation', '3 Star Hotels', 3, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'accommodation' AND `option_label` = '3 Star Hotels');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'accommodation', 'Luxury Boutiques', 4, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'accommodation' AND `option_label` = 'Luxury Boutiques');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'accommodation', 'Wallet Friendly', 5, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'accommodation' AND `option_label` = 'Wallet Friendly');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'found_us', 'Tripadvisor', 1, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'found_us' AND `option_label` = 'Tripadvisor');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'found_us', 'Website', 2, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'found_us' AND `option_label` = 'Website');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'found_us', 'Google', 3, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'found_us' AND `option_label` = 'Google');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'found_us', 'Social Media', 4, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'found_us' AND `option_label` = 'Social Media');

INSERT INTO `tblbooktourprompts` (`prompt_type`, `option_label`, `display_order`, `is_active`)
SELECT 'found_us', 'Other', 5, 1
WHERE NOT EXISTS (SELECT 1 FROM `tblbooktourprompts` WHERE `prompt_type` = 'found_us' AND `option_label` = 'Other');
