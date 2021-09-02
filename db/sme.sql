-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 02, 2021 at 01:04 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sme`
--

-- --------------------------------------------------------

--
-- Table structure for table `artifact`
--

DROP TABLE IF EXISTS `artifact`;
CREATE TABLE IF NOT EXISTS `artifact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `artifact`
--

INSERT INTO `artifact` (`id`, `name`, `description`) VALUES
(1, 'Product Requirement Document', '<p>This artifact contains a list of requirements for any product (i.e. a landing page or an MVP) that needs to be developed by the engineers. This artifact has been mentioned in the literature <strong>&quot;Four Steps To Epiphanny&quot;. </strong>Depending on the size of the business (i.e. staff availability), this document can be created either by the platform owner or the marketing department.</p>'),
(2, 'BMI Business Patterns', '<p>This artifact has been mentioned in the literature &quot;<strong>The Business Model Navigator</strong>&quot; where the author argues that almost all businesses in the world follow a specific business pattern. The author has found and documented <u><span style=\"background-color:#dddddd\">55 such patterns</span></u> in this literature.&nbsp;These patterns are used during innovating an existing business model. Several employees from various departments take part in innovating a business model.</p>\r\n\r\n<p>Some of the famous business patterns are <strong>Add-on, Razor and Blade, Freemium. </strong>The &quot;<strong><em>Add-on</em></strong>&quot; pattern has been used in companies such as Ryan Air, SAP etc where the core value offerings are priced competitively, however, there are other extra value offerings that might raise the total price. In the &quot;Add-on&quot; pattern, customers benefit from variable pricing which they might adjust as per their need. The &quot;<em><strong>Razor and Blade</strong>&quot; </em>pattern has been used in companies such as Hewlett-Packard, Nestle, Gillette etc. where the main product is offered at a negligible price or even for free, however, the consumables that are needed to use the main product are marketed at a higher price. The lower price of the main product decreases the customer&#39;s hesitancy to buy it and the subsequent sale of high priced consumables provide recurring profits and also make up the loss due to selling the main product at a low price. The &quot;<strong>Freemium</strong>&quot; business pattern has been used in companies such as Skype, Linked In, Dropbox etc where certain value propositions are given away for free for a limited time period in the hope of persuading the customers to pay for it after that period.</p>'),
(3, 'Hypothetical Business Model', '<p>A hypothetical business model consists of business-related hypotheses such as who are the customers, in what values are they interested in, who are the competitors etc that have not to be known to be profitable or feasible. Depending on the size of the business, only the platform owner and his/her friends or several employees from various departments can take part in creating a hypothetical business model.</p>\r\n\r\n<p><strong>Source:</strong></p>\r\n\r\n<ul>\r\n	<li>The Four Steps to the Epiphany</li>\r\n	<li>The Business Model Navigator</li>\r\n</ul>'),
(4, 'Concrete Business Model', '<p>A concrete business model consists of business-related ideas such as who are the customers, in what values are they interested in, who are the competitors etc that have been validated by several experiments i.e. it has been found out that the business model is economically feasible and profitable. Depending on the size of the business, only the platform owner and his/her friends or several employees from various departments can take part in creating a concrete business model.</p>\r\n\r\n<p><strong>Source:</strong></p>\r\n\r\n<ul>\r\n	<li>The Four Steps to the Epiphany</li>\r\n	<li>The Business Model Navigator</li>\r\n</ul>'),
(5, 'Landing Page', '<p>This artifact is assumed to be produced by the developers (a web developer). A landing page is required for an online Ad that is used to test several hypotheses such as value propositions, channels etc.</p>\r\n\r\n<p><strong>Source: </strong></p>\r\n\r\n<ul>\r\n	<li>Testing Business Ideas</li>\r\n	<li>The Business Model Navigator</li>\r\n</ul>\r\n<tmpopup style=\"top: 32px; left: 20px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 32px; left: 20px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(6, 'Marketing Plan', '<p>This artifact has been mentioned in the literature <strong>&quot;Four Steps To Epiphanny&quot;. </strong>This document contains information regarding how to create demand and acquire customers by taking feedback from several early evangelists. This is our assumption that the <strong>Pull</strong> and <strong>Push</strong> marketing strategy can be decided based on the marketing plan. Depending on the size of the business, it can be either made by a platform owner or a marketing team.</p>'),
(7, 'Explainer Video', '<p>This video can be considered as a marketing material because it can be used to create positioning in the market. This artifact has been mentioned in the literature &quot;<strong>Testing Business Ideas</strong>&quot; where it is used to test the value propositions. The video is posted to social media and then it is checked how many people clicked on the video, how many people shared the video. Depending on the Click Through Rate (CTR), the offered value propositions should be carefully advertised to attract more customers. Depending on the size of any company, this artifact can be created by the platform owner or by a marketing team.</p>'),
(8, 'An MVP', '<p>MVP stands for Minimum Viable Product (as discussed in <strong>Testing Business Ideas</strong> and <strong>The </strong><strong>Business Model Navigator</strong>. An MVP is a minimalistic application that can be used to test whether the offered value propositions are attractive to the customers or not. This is our assumption that the MVP is produced by any app developer (as discussed in <strong>Four Steps To Epiphanny</strong>).</p>'),
(9, 'Customer Interview Questionnaire', '<p>This is a script that is used during the customer interviews to understand the problem hypotheses match with the customer&#39;s problem, whether the offered solution matches the customer&#39;s solution expectation.</p>\r\n\r\n<p>&nbsp;</p>'),
(10, 'Test Result', '<p>This artifact has been mentioned in the literature <strong>&quot;The Business Model Navigator&quot;</strong>. A test result carries results from various experimentation that had been carried out to validate business hypotheses such as who are the customers, in what value are they interested, what channel to reach them, what resources are required to produce the offered value propositions etc. In this literature, the test result is produced by a group called &quot;<strong>Test Group&quot;</strong>. This is our assumption that a test group consists of employees from all departments and if it is a startup then the test group can consist of the platform owner and his/her friends.</p>'),
(11, 'List of Earlyvangelists', '<p>Earlyvangelists are those customers who are interested in the business concept of any entrepreneur. They are even willing to buy the partially developed value units from the entrepreneur and very much willing to provide feedback to improve the value propositions. These types of customers have been mentioned in the literature &quot;<strong>Four Steps To The Epiphanny&quot;. </strong>This is our assumption that earlyvangelists are appropriate candidates for activities such as customer interviews, Single Feature MVP (<strong>Source</strong>: Testing Business Ideas) where business hypotheses can be tested by asking questions to the customers.</p>'),
(13, 'API & SDK', '<p>API stands for Application Programming Interface and SDK stands for the software development kit. An API provides free data or functionality to third-party app developers. SDK is a collection of development tools and APIs that can be used by the producers of any platform to easily produce software applications. These two resources not only opens up any platform to the direct producers but also to other third-party developers.</p>\r\n\r\n<p><strong>Source</strong>: Four Tactics for Implementing a Balanced Digital Platform Strategy</p>\r\n<tmpopup style=\"top: 53px; left: 425px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 53px; left: 425px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(14, 'Terms & Conditions', '<p>This artifact is used to restrict the producers on any platform so that they can produce value units for the customers within a specified set of rules. For example, the terms and conditions of Apple restrict app developers publish iOS applications only on the official application store of Apple.</p>\r\n\r\n<p><strong>Source</strong>: Four Tactics for Implementing a Balanced Digital Platform Strategy</p>\r\n<tmpopup style=\"top: 32px; left: 404px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 32px; left: 404px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(15, 'Guidelines', '<p>This artifact guides the producers on the platform regarding how to produce high quality and compatible content for the platform.</p>\r\n\r\n<p><strong>Source</strong>: Four Tactics for Implementing a Balanced Digital Platform Strategy</p>\r\n<tmpopup style=\"top: 11px; left: 408px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 11px; left: 408px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(16, 'License', '<p>This artifact is used to provide permissions regarding whether a resource can be used freely or by paying a fee. A license can be open or proprietary. An example of an open license is Creative Commons (e.g. contents published on Wikipedia). An example of a proprietary resource (i.e. resource published with closed license) is Samsung&#39;s TouchWiz user interface.</p>\r\n\r\n<p><strong>Source</strong>: Four Tactics for Implementing a Balanced Digital Platform Strategy</p>');

-- --------------------------------------------------------

--
-- Table structure for table `bmd_graph`
--

DROP TABLE IF EXISTS `bmd_graph`;
CREATE TABLE IF NOT EXISTS `bmd_graph` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_process_kind_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `situational_factors` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `nodes` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `edges` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_923428F3EFD4F280` (`parent_process_kind_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bmd_graph`
--

INSERT INTO `bmd_graph` (`id`, `parent_process_kind_id`, `name`, `situational_factors`, `nodes`, `edges`, `description`) VALUES
(1, 5, 'Platform With Switching Sides', 'a:2:{i:0;s:28:\"Platform Age : Startup Phase\";i:1;s:24:\"Simultaneous Entry : Yes\";}}', '[{\"id\":\"1\",\"label\":\"Platform With Switching Sides\",\"level\":\"0\",\"shape\":\"circle\",\"color\":\"#bababa\",\"margin\":\"8\"},{\"id\":\"2\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"},{\"id\":\"3\",\"label\":\"<<getCustomers>>\",\"level\":\"4\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"5\"},{\"id\":\"4\",\"label\":\"<<getCustomers>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"5\"},{\"id\":\"5\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"}]', '[{\"from\":\"1\",\"to\":\"2\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"9a097691-1dec-4d1b-86fb-bfd24fa73243\"},{\"from\":\"1\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"8bbfdfde-0904-4125-a2fc-7d4df0ba7149\"},{\"from\":\"1\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"7dade564-3449-4879-b7fb-9378c00e8865\"},{\"from\":\"1\",\"to\":\"5\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"370725ce-e160-4a55-9dec-0ee340e3e1e3\"},{\"from\":\"2\",\"to\":\"3\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"93be8aff-63ff-4484-9024-f4b8a2303a21\"},{\"from\":\"2\",\"to\":\"4\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"2b545fc9-5036-48c8-b7a0-ee200c5a3221\"},{\"from\":\"4\",\"to\":\"5\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"675b858b-f96e-40ce-95bd-dc831d1e2531\"},{\"from\":\"3\",\"to\":\"5\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"d18c1a6b-bd5c-40fc-ab74-f8b0bb930d3f\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"2\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"d236ca75-10bb-4891-8b53-7ab6202fe355\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"2\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"edf9b542-c137-4eb9-91e4-8d82f426234c\"}]', '<p>This is a customized pattern derived from the original pattern called &quot;<em>Simultaneous entry of a platform with switching user sides</em>&quot;. The original pattern does not mention anything about the two <strong>prepare </strong>types as shown in the figure, however, we strongly believe that the platform owner would have to prepare some documents before getting customers e.g. marketing plan, business hypotheses and also would have to prepare documents after being able to acquire customers e.g. concrete business model, sales plan etc. Furthermore, the original pattern has not mentioned anything about an iterative approach as shown between the first <strong>prepare </strong>type and the two <strong>getCustomers </strong>type. However, we strongly believe that it would take several tries with different plans before the platform owner is able to successfully get the expected customers. This pattern is used in that kind of platform business where the presence of both the consumers and the producers is necessary to create a network effect. Therefore, the platform owner would have to simultaneously acquire both the producers and the consumers. Examples of such kinds of platforms businesses are CarRental and OfficeSharing platforms.</p>\r\n\r\n<p><strong>Source:- </strong>LAUNCH STRATEGIES OF DIGITAL PLATFORMS: PLATFORMS WITH SWITCHING AND NON-SWITCHING USERS</p>\r\n<tmpopup style=\"top: 0px; left: 20px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 0px; left: 20px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(2, 5, 'Platform Without Switching Sides', 'a:2:{i:0;s:28:\"Platform Age : Startup Phase\";i:1;s:23:\"Simultaneous Entry : No\";}}', '[{\"id\":\"1\",\"label\":\"Platform Without Switching Sides\",\"level\":\"0\",\"shape\":\"circle\",\"color\":\"#bababa\",\"margin\":\"8\"},{\"id\":\"2\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"},{\"id\":\"3\",\"label\":\"<<getCustomers>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"5\"},{\"id\":\"4\",\"label\":\"<<getCustomers>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"5\"},{\"id\":\"5\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"}]', '[{\"from\":\"1\",\"to\":\"2\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"b54fa079-0897-40e8-952f-f31de47d127d\"},{\"from\":\"1\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"9d10344b-e12a-472d-89d6-e7b67ef88085\"},{\"from\":\"1\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"176b3621-1918-42a3-aeba-97aa606b4a8c\"},{\"from\":\"2\",\"to\":\"3\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"b17d4ff0-9bcd-4469-b328-13ea8c967322\"},{\"from\":\"3\",\"to\":\"4\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"866b8445-9db4-428e-9cfc-5a7a7330b3a7\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"2\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"82e60698-6ed0-45be-8e3b-ab9bacdad8e7\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"2\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"3ee1205f-6b68-4217-9f18-bbc176eedb09\"},{\"from\":\"1\",\"to\":\"5\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"5ff804cf-6551-4cf3-88d4-b0f94677b1ba\"},{\"from\":\"4\",\"to\":\"5\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"f8bf72f4-1942-4a8f-9921-74872057024f\"}]', '<p>This is a customized pattern derived from the original pattern called &quot;<strong>Sequential entry of a platform without switching user sides</strong>&quot;. The original pattern does not mention anything about the two <strong>prepare </strong>types as shown in the figure, however, we strongly believe that the platform owner would have to prepare some documents before getting customers e.g. marketing plan, business hypotheses and also would have to prepare documents after being able to acquire customers e.g. concrete business model, sales plan etc. Furthermore, the original pattern has not mentioned anything about an iterative approach as shown between the first <strong>prepare </strong>type and the two <strong>getCustomers </strong>type. However, we strongly believe that it would take several tries with different plans before the platform owner is able to successfully get the expected customers. This pattern is used in that kind of platform business where the first one side of the customers (i.e. either consumers and producers) are acquired first. When enough customers are on board then the platform owner opens the business to the opposite side. An example of such business is RedBus which first acquired the bus operators by providing them with seating management software. When enough bus operators were on board, the platform opened the business to the opposite side i.e. bus passengers.</p>\r\n\r\n<p><strong>Source:- </strong>LAUNCH STRATEGIES OF DIGITAL PLATFORMS: PLATFORMS WITH SWITCHING AND NON-SWITCHING USERS</p>'),
(3, 13, 'Increase Variety and Openness', 'a:3:{i:0;s:27:\"Platform Age : Growth Phase\";i:1;s:20:\"Variety Level : High\";i:2;s:21:\"Openness Level : High\";}}', '[{\"id\":\"1\",\"label\":\"Increase Variety and Openness\",\"level\":\"0\",\"shape\":\"circle\",\"color\":\"#bababa\",\"margin\":\"8\"},{\"id\":\"2\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"},{\"id\":\"3\",\"label\":\"<<Leverage>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"13\"},{\"id\":\"4\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"}]', '[{\"from\":\"1\",\"to\":\"2\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"e27db7c6-0e51-4dd2-845d-e02c866243b0\"},{\"from\":\"1\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"d6c87bf6-8249-4076-8141-4662089aa2e4\"},{\"from\":\"1\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"0579d67f-d68f-4243-a9f8-4b3c2be2f54b\"},{\"from\":\"2\",\"to\":\"3\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"ab42c42b-6b66-4e0b-bbeb-91bd41481ab7\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"2\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"4d519266-2216-4d6d-b62e-6db86d941340\"},{\"from\":\"3\",\"to\":\"4\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"5cbb94a3-84b0-4683-a5c7-119aea2973b1\"}]', '<p>This pattern is derived from the literature &quot;<strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</strong>&quot;.&nbsp; The<em> leverage activities</em> are used to increase the <em>variety</em> (i.e. diversity) and the<em> openness</em> of any digital platform. The literature does not mention anything about the two <strong>prepare </strong>types as shown in the figure, however, we strongly believe that the platform owner would have to prepare some documents before deciding on key leverage activities e.g. marketing plan to invite 3rd-party developers, business hypotheses etc. We also believe that once the platform owner is successful in performing the leverage activities he would have to prepare a document regarding which leveraging activities were most effective, a concrete business model etc. The transition between the first <strong>prepare </strong>type and the <strong>leverage </strong>type is shown as an <em>iterative process</em> because we believe that it would take many cycles before the platform owner will be able to perform successful leverage.</p>\r\n\r\n<p><strong>Source:- </strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</p>\r\n<tmpopup style=\"top: 94px; left: 447px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 94px; left: 447px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(4, 14, 'Reduce Variety', 'a:3:{i:0;s:27:\"Platform Age : Growth Phase\";i:1;s:20:\"Variety Level : Less\";i:2;s:29:\"Platform Age : Maturity Phase\";}}', '[{\"id\":\"1\",\"label\":\"Reduce Openness\",\"level\":\"0\",\"shape\":\"circle\",\"color\":\"#bababa\",\"margin\":\"8\"},{\"id\":\"2\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"},{\"id\":\"3\",\"label\":\"<<Defense>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"15\"},{\"id\":\"4\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"}]', '[{\"from\":\"1\",\"to\":\"2\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"51a57074-b9df-4e89-b710-4e8b891bdd8e\"},{\"from\":\"1\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"bac79c6e-3136-4ab3-aa42-787f9766c636\"},{\"from\":\"1\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"aef04d91-6877-4ef8-89f4-8c1609e23de0\"},{\"from\":\"2\",\"to\":\"3\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"b2631559-5db8-4540-b04a-82d3ee64a331\"},{\"from\":\"3\",\"to\":\"4\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"b301b63b-f07b-4642-a988-5e65962e6790\"}]', '<p>This pattern is derived from the literature &quot;<strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</strong>&quot;. The&nbsp;<em>control </em>activities are used to reduce the variety (i.e. diversity) in any digital platform. The literature does not mention anything about the two <strong>prepare </strong>types as shown in the figure, however, we strongly believe that the platform owner would have to prepare some documents before deciding on key control activities e.g. going ahead with <strong>creating terms and conditions or creating guidelines</strong>, etc. We also believe that once the platform owner is successful in performing the <strong>control</strong> activities, he/she would have to prepare a document regarding which control activities were most effective i.e. concrete business model etc. The transition between the first <strong>prepare </strong>type and the <strong>control </strong>type is shown as an <em>iterative process</em> because we believe that it would take many cycles before the platform owner will be able to perform successful control.</p>\r\n\r\n<p><strong>Source:- </strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</p>'),
(5, 15, 'Reduce Openness', 'a:4:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:20:\"Openness Level : Low\";i:2;s:27:\"Platform Age : Growth Phase\";i:3;s:29:\"Platform Age : Maturity Phase\";}}', '[{\"id\":\"1\",\"label\":\"Reduce Openness\",\"level\":\"0\",\"shape\":\"circle\",\"color\":\"#bababa\",\"margin\":\"8\"},{\"id\":\"2\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"},{\"id\":\"3\",\"label\":\"<<Defense>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"15\"},{\"id\":\"4\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"}]', '[{\"from\":\"1\",\"to\":\"2\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"51a57074-b9df-4e89-b710-4e8b891bdd8e\"},{\"from\":\"1\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"bac79c6e-3136-4ab3-aa42-787f9766c636\"},{\"from\":\"1\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"aef04d91-6877-4ef8-89f4-8c1609e23de0\"},{\"from\":\"2\",\"to\":\"3\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"b2631559-5db8-4540-b04a-82d3ee64a331\"},{\"from\":\"3\",\"to\":\"4\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"b301b63b-f07b-4642-a988-5e65962e6790\"}]', '<p>This pattern is derived from the literature &quot;<strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</strong>&quot;. The <em>defense type </em>activities are used to reduce the openness in any digital platform. The literature does not mention anything about the two <strong>prepare </strong>types as shown in the figure, however, we strongly believe that the platform owner would have to prepare some documents before deciding on key defense activities e.g. close open license, speed up API development etc. We also believe that once the platform owner is successful in performing the <strong>defense</strong> activities, he/she would have to prepare a document regarding which defense activities were most effective i.e. concrete business model etc.</p>\r\n\r\n<p><strong>Source:- </strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</p>'),
(6, 19, 'Balanced Digital Platform', 'a:6:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:25:\"Openness Level : Balanced\";i:2;s:27:\"Platform Age : Growth Phase\";i:3;s:29:\"Platform Age : Maturity Phase\";i:4;s:28:\"Platform Age : Startup Phase\";i:5;s:24:\"Variety Level : Balanced\";}}', '[{\"id\":\"1\",\"label\":\"Balanced Digital Platform\",\"level\":\"0\",\"shape\":\"circle\",\"color\":\"#bababa\",\"margin\":\"8\"},{\"id\":\"2\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"},{\"id\":\"3\",\"label\":\"<<Leverage>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"13\"},{\"id\":\"4\",\"label\":\"<<Control>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"14\",\"x\":\"NaN\"},{\"id\":\"5\",\"label\":\"<<Defense>>\",\"level\":\"4\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"15\"},{\"id\":\"6\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"}]', '[{\"from\":\"1\",\"to\":\"2\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"965c58bc-21e5-4f39-a5f5-c905cb78b83f\"},{\"from\":\"1\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"14fd9c3c-a9d8-46f9-9a5b-209489888a5b\"},{\"from\":\"2\",\"to\":\"3\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"ba672733-3f28-48bf-9c93-614b7cfc0252\"},{\"from\":\"1\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"96d7e725-c1fc-4ec4-b11f-db0abdcddd58\"},{\"from\":\"1\",\"to\":\"5\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"64474779-68b6-4b88-b851-c61fbc19f9a6\"},{\"from\":\"3\",\"to\":\"5\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"4fbb9718-4833-4682-80ca-fafa0ef174fe\"},{\"from\":\"3\",\"to\":\"4\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"3538e2f3-ec88-4623-b57a-a82bb6786219\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"2\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"224dbb74-c248-48cb-afd6-15994e362ad4\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"2\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"664835bd-43be-43fd-9aee-04418ec19c1c\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"2\",\"to\":\"5\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"962e9a67-4051-440c-a6ab-ce3d1d77d716\"},{\"from\":\"1\",\"to\":\"6\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"34e4499c-2f53-4cbe-92e1-54f38ed45f5d\"},{\"from\":\"4\",\"to\":\"6\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"1fd6f18e-72ed-4428-a4e0-aea32271dee8\"},{\"from\":\"5\",\"to\":\"6\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"ff79cfa9-16e6-4f7a-ab49-650a7c27f715\"}]', '<p>This pattern is derived from the literature &quot;<strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</strong>&quot;. The <strong>leverage </strong>pattern is first used to provide both openness and variety to any digital platform. If the platform becomes too much diversified due the <strong>leverage</strong> then the platform owner can apply some <strong>control </strong>type activities to reduce the variety from the platform. Furthermore, if the platform becomes too much open due to the <strong>leverage </strong>then it may suffer from exploitation from other market rivals. To reduce the openness, the platform owner can apply <strong>defense</strong> type activities. In activities belonging to leverage or control or defense becomes unsuccessful than the platform owner needs to go back to the prepare type to rethink the respective strategies. In the end, the platform owner should prepare a concrete business model to document all the key activities.</p>\r\n\r\n<p><strong>Source:- </strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</p>'),
(7, 10, 'Platform Performance Measurement', 'a:2:{i:1;s:29:\"Customer Retention Rate : Low\";i:2;s:28:\"Platform Age : Startup Phase\";}}', '[{\"id\":\"1\",\"label\":\"Platform Performance Measurement\",\"level\":\"0\",\"shape\":\"circle\",\"color\":\"#bababa\",\"margin\":\"8\"},{\"id\":\"2\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"},{\"id\":\"3\",\"label\":\"<<Develop>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"3\"},{\"id\":\"4\",\"label\":\"<<Measure>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"10\"},{\"id\":\"5\",\"label\":\"<<Modify>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"4\"},{\"id\":\"6\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"}]', '[{\"from\":\"1\",\"to\":\"2\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"2dd30f1a-bb1f-4f79-a2a2-0c8f8848bf97\"},{\"from\":\"1\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"05d0340c-e99a-4c37-a71d-449165a46de4\"},{\"from\":\"1\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"3fabc1bd-66f2-4974-a6a7-68cbd98849d9\"},{\"from\":\"1\",\"to\":\"5\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"ad4a4829-6912-4f37-acb1-f46523be14ca\"},{\"from\":\"1\",\"to\":\"6\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"500f5d87-a433-4d9f-8e78-cdc2f8178728\"},{\"from\":\"2\",\"to\":\"3\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"7cfeb72b-5713-4fac-8e77-ca9d4a97a896\"},{\"from\":\"3\",\"to\":\"4\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"16bbbadc-02b6-4362-bb19-56fe6beb1bb8\"},{\"from\":\"4\",\"to\":\"5\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"e4cb9ee1-cb08-44eb-a7b9-bfe30045fa28\"},{\"from\":\"5\",\"to\":\"6\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"972a30c5-b33c-42d8-9f38-e0abb5d1fbf6\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"4\",\"to\":\"5\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"e0e2d34e-826f-4eb5-bb51-30a647eca60c\"}]', '<p>This pattern has been mentioned in the literature &quot;<strong>Platform Revolution: How Networked Markets Are Transforming The Economy</strong>&quot; without the two <strong>&quot;prepare&quot; </strong>process types. We added the two prepare types so that the platform owner can prepare necessary documents such as <em>development requirements document</em>,<em> existing value proposition</em>, <em>key activities</em> etc and also prepare any final documents at the end of the business model development such as a <em>concrete business model</em>.</p>'),
(8, 5, 'Customer Discovery & Validation', 'a:1:{i:0;s:19:\"Customer Known : No\";}}', '[{\"id\":\"1\",\"label\":\"Find Paying Customers\",\"level\":\"0\",\"shape\":\"circle\",\"color\":\"#bababa\",\"margin\":\"8\"},{\"id\":\"2\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"},{\"id\":\"3\",\"label\":\"<<Develop>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"3\"},{\"id\":\"4\",\"label\":\"<<Pull>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"16\"},{\"id\":\"5\",\"label\":\"<<Test>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"6\"},{\"id\":\"6\",\"label\":\"<<Verify>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"12\"},{\"id\":\"7\",\"label\":\"<<Develop>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"3\"},{\"id\":\"8\",\"label\":\"<<Sell>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"11\"},{\"id\":\"9\",\"label\":\"<<Verify>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"12\"},{\"id\":\"10\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"}]', '[{\"from\":\"1\",\"to\":\"2\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"015ce037-1ae7-4e0b-9d09-8e351c11bfa1\"},{\"from\":\"1\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"135f62e2-68fd-4c70-a852-4d24ee7e6c89\"},{\"from\":\"1\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"01caa45d-4443-41fe-9f14-2eee71fe34cf\"},{\"from\":\"1\",\"to\":\"5\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"c87b7d9e-16e0-4a4d-8e79-ef66209db6b6\"},{\"from\":\"1\",\"to\":\"6\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"4a3e6e82-ab04-415b-94a7-075dcc11dd3f\"},{\"from\":\"1\",\"to\":\"7\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"241796b2-2158-417a-94d8-a5a754b60e7c\"},{\"from\":\"1\",\"to\":\"8\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"f36b92e9-b2bb-49b2-8910-c2bae48f1931\"},{\"from\":\"1\",\"to\":\"9\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"5f965978-b6f1-47d4-92cf-976bd69cc3b6\"},{\"from\":\"2\",\"to\":\"3\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"681e5d51-27ef-43e4-934c-360e37f46a48\"},{\"from\":\"3\",\"to\":\"4\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"2e1996fb-7198-454f-b649-cb0b6d32816a\"},{\"from\":\"4\",\"to\":\"5\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"8b9bcf7d-82f9-479f-ab4a-4f0b810ee28b\"},{\"from\":\"6\",\"to\":\"7\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"a69d5063-d634-4823-b89c-84935a7e5f48\"},{\"from\":\"5\",\"to\":\"6\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"4f656c89-9dd9-48cd-a0da-0504de8c5f00\"},{\"from\":\"7\",\"to\":\"8\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"73975c11-8109-468b-9c0d-3d7f07685be3\"},{\"from\":\"8\",\"to\":\"9\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"bac7e527-e894-426d-86f4-29955d48bcd6\"},{\"from\":\"1\",\"to\":\"10\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"ba3e8009-4f19-48de-9dfc-35b3f00475e7\"},{\"from\":\"9\",\"to\":\"10\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"15653c9b-186e-41d0-96b8-e59444eb1207\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"6\",\"to\":\"2\",\"arrows\":\"to\",\"color\":\"rgb(20,24,200)\",\"id\":\"84b81751-c42f-4892-95c8-bf0de7607a83\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"9\",\"to\":\"2\",\"arrows\":\"to\",\"color\":\"rgb(20,24,200)\",\"id\":\"fd9c0fca-0203-4a3b-abee-bf1ddbab512f\"}]', '<p>This pattern comes from the literature &quot;<strong>Four Steps To Epiphanny</strong>&quot;. The first five process types are about validating the hypotheses regarding customer and value propositions and also collecting some early customers. The last four process types are about validating whether the customers found are really interested in participating in the value propositions provided by the business owner. In the last four process types, initiatives are taken to sell partially developed MVP to those customers. If the sale figures are high then there is a viable market.</p>'),
(9, 9, 'Innovate Business  Model', 'a:6:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:20:\"Customer Known : Yes\";i:2;s:22:\"Market Type : Existing\";i:3;s:19:\"Market Type : Niche\";i:4;s:27:\"Platform Age : Growth Phase\";i:5;s:29:\"Platform Age : Maturity Phase\";}}', '[{\"id\":\"1\",\"label\":\"Innovate Business  Model\",\"level\":\"0\",\"shape\":\"circle\",\"color\":\"#bababa\",\"margin\":\"8\"},{\"id\":\"2\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"},{\"id\":\"3\",\"label\":\"<<findPattern>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"2\"},{\"id\":\"4\",\"label\":\"<<Ideate>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"8\"},{\"id\":\"5\",\"label\":\"<<Analyze>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"7\"},{\"id\":\"6\",\"label\":\"<<Develop>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"3\"},{\"id\":\"7\",\"label\":\"<<Test>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"6\"},{\"id\":\"8\",\"label\":\"<<Prepare>>\",\"level\":\"3\",\"shape\":\"box\",\"color\":\"#bababa\",\"margin\":\"8\",\"tableId\":\"1\"}]', '[{\"from\":\"1\",\"to\":\"2\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"107acafc-1cce-4840-b368-788d0ad525b4\"},{\"from\":\"1\",\"to\":\"3\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"360688d7-1bee-4486-9cb1-536b0bbc8f71\"},{\"from\":\"1\",\"to\":\"4\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"1e4245ba-5e2f-4c98-a5e3-96abf4de70d9\"},{\"from\":\"1\",\"to\":\"5\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"248348d9-4f53-4f15-b00b-97e031021eb4\"},{\"from\":\"1\",\"to\":\"6\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"b15c454c-8630-4b99-84a8-2a2af937752f\"},{\"from\":\"1\",\"to\":\"7\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"fa17b12b-7143-47c9-9063-27a4fcbcb6ef\"},{\"from\":\"1\",\"to\":\"8\",\"arrows\":\"from\",\"color\":\"red\",\"id\":\"5dc9f0ae-16c4-48ca-911a-a5a4d4ec06b3\"},{\"from\":\"2\",\"to\":\"3\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"a56228d8-2760-47b1-8bd0-2ba98a06ed7f\"},{\"from\":\"3\",\"to\":\"4\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"f54ce5f1-a481-49a2-9c3d-b9ccdb47a015\"},{\"from\":\"4\",\"to\":\"5\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"dc9c1ada-67a9-4bea-9f70-0e4a4d2e43e8\"},{\"from\":\"5\",\"to\":\"6\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"263c715a-f775-4c80-8aff-0d0f101b68b3\"},{\"from\":\"6\",\"to\":\"7\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"9c09c3c9-4fa3-4b3c-969b-7975df667fb1\"},{\"from\":\"7\",\"to\":\"8\",\"arrows\":\"to\",\"color\":\"blue\",\"id\":\"5e687f31-1395-4162-b41f-915a345171b5\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"4\",\"to\":\"5\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"c0847921-79c3-45d5-b100-794905e1a2a1\"},{\"smooth\":{\"enabled\":\"true\",\"type\":\"curvedCW\",\"roundness\":\"0.2\",\"forceDirection\":\"horizontal\"},\"from\":\"4\",\"to\":\"7\",\"arrows\":\"from\",\"color\":\"rgb(20,24,200)\",\"id\":\"57061f63-8ace-42ce-ba3a-ae5b272d8cf8\"}]', '<p>This pattern has been illustrated in the literature &quot;<strong>The Business Model Navigator&quot;</strong>. As the author of this literature has repeatedly mentioned about the innovation of business model in the existing companies (e.g. during the initiation-phase) and collaboration of several stakeholders in the ideation phase, this is our assumption that this pattern is applicable only for large or medium-sized businesses where the customers are already known.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `bmd_graph_process_kind`
--

DROP TABLE IF EXISTS `bmd_graph_process_kind`;
CREATE TABLE IF NOT EXISTS `bmd_graph_process_kind` (
  `bmd_graph_id` int(11) NOT NULL,
  `process_kind_id` int(11) NOT NULL,
  PRIMARY KEY (`bmd_graph_id`,`process_kind_id`),
  KEY `IDX_6AF2F454AD2A5234` (`bmd_graph_id`),
  KEY `IDX_6AF2F4547818F67C` (`process_kind_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bmd_graph_process_kind`
--

INSERT INTO `bmd_graph_process_kind` (`bmd_graph_id`, `process_kind_id`) VALUES
(1, 1),
(1, 5),
(2, 1),
(2, 5),
(3, 1),
(3, 13),
(4, 1),
(4, 15),
(5, 1),
(5, 15),
(6, 1),
(6, 13),
(6, 14),
(6, 15),
(7, 1),
(7, 3),
(7, 4),
(7, 10),
(8, 1),
(8, 3),
(8, 6),
(8, 11),
(8, 12),
(8, 16),
(9, 1),
(9, 2),
(9, 3),
(9, 6),
(9, 7),
(9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_method_block`
--

DROP TABLE IF EXISTS `cancelled_method_block`;
CREATE TABLE IF NOT EXISTS `cancelled_method_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `situational_method_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `json_data` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_217C617BC2F871C5` (`situational_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `method_building_block`
--

DROP TABLE IF EXISTS `method_building_block`;
CREATE TABLE IF NOT EXISTS `method_building_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) DEFAULT NULL,
  `input_artifacts` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `output_artifacts` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `situational_factors` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_534814707EC2F574` (`process_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `method_building_block`
--

INSERT INTO `method_building_block` (`id`, `process_id`, `input_artifacts`, `output_artifacts`, `situational_factors`) VALUES
(1, 1, 'a:0:{}', 'a:1:{i:0;s:27:\"Hypothetical Business Model\";}', 'a:1:{i:0;s:31:\"All Situations : BMD Situations\";}'),
(2, 2, 'a:1:{i:0;s:11:\"Test Result\";}', 'a:1:{i:0;s:23:\"Concrete Business Model\";}', 'a:1:{i:0;s:31:\"All Situations : BMD Situations\";}'),
(3, 3, 'a:0:{}', 'a:1:{i:0;s:28:\"Product Requirement Document\";}', 'a:1:{i:0;s:31:\"All Situations : BMD Situations\";}'),
(4, 4, 'a:0:{}', 'a:1:{i:0;s:14:\"Marketing Plan\";}', 'a:2:{i:0;s:20:\"Customer Known : Yes\";i:1;s:22:\"Market Type : Existing\";}'),
(5, 46, 'a:0:{}', 'a:1:{i:0;s:14:\"Marketing Plan\";}', 'a:2:{i:0;s:19:\"Customer Known : No\";i:1;s:17:\"Market Type : New\";}'),
(6, 47, 'a:0:{}', 'a:1:{i:0;s:14:\"Marketing Plan\";}', 'a:1:{i:0;s:19:\"Market Type : Niche\";}'),
(7, 5, 'a:0:{}', 'a:1:{i:0;s:15:\"Explainer Video\";}', 'a:1:{i:0;s:31:\"All Situations : BMD Situations\";}'),
(8, 6, 'a:0:{}', 'a:1:{i:0;s:21:\"BMI Business Patterns\";}', 'a:6:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:26:\"Compitition : Late Entrant\";i:2;s:22:\"Market Type : Existing\";i:3;s:19:\"Market Type : Niche\";i:4;s:27:\"Platform Age : Growth Phase\";i:5;s:29:\"Platform Age : Maturity Phase\";}'),
(9, 7, 'a:0:{}', 'a:1:{i:0;s:21:\"BMI Business Patterns\";}', 'a:6:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:26:\"Compitition : Late Entrant\";i:2;s:22:\"Market Type : Existing\";i:3;s:19:\"Market Type : Niche\";i:4;s:27:\"Platform Age : Growth Phase\";i:5;s:29:\"Platform Age : Maturity Phase\";}'),
(10, 8, 'a:1:{i:0;s:21:\"BMI Business Patterns\";}', 'a:0:{}', 'a:6:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:26:\"Compitition : Late Entrant\";i:2;s:22:\"Market Type : Existing\";i:3;s:19:\"Market Type : Niche\";i:4;s:27:\"Platform Age : Growth Phase\";i:5;s:29:\"Platform Age : Maturity Phase\";}'),
(11, 9, 'a:1:{i:0;s:21:\"BMI Business Patterns\";}', 'a:0:{}', 'a:6:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:26:\"Compitition : Late Entrant\";i:2;s:22:\"Market Type : Existing\";i:3;s:19:\"Market Type : Niche\";i:4;s:27:\"Platform Age : Growth Phase\";i:5;s:29:\"Platform Age : Maturity Phase\";}'),
(12, 10, 'a:1:{i:0;s:28:\"Product Requirement Document\";}', 'a:1:{i:0;s:6:\"An MVP\";}', 'a:3:{i:0;s:19:\"Customer Known : No\";i:1;s:17:\"Market Type : New\";i:2;s:28:\"Platform Age : Startup Phase\";}'),
(13, 11, 'a:1:{i:0;s:28:\"Product Requirement Document\";}', 'a:0:{}', 'a:2:{i:0;s:29:\"Customer Retention Rate : Low\";i:1;s:28:\"Platform Age : Startup Phase\";}'),
(14, 12, 'a:1:{i:0;s:28:\"Product Requirement Document\";}', 'a:0:{}', 'a:2:{i:0;s:29:\"Customer Retention Rate : Low\";i:1;s:28:\"Platform Age : Startup Phase\";}'),
(15, 13, 'a:1:{i:0;s:28:\"Product Requirement Document\";}', 'a:1:{i:0;s:12:\"Landing Page\";}', 'a:1:{i:0;s:31:\"All Situations : BMD Situations\";}'),
(16, 14, 'a:1:{i:0;s:27:\"Hypothetical Business Model\";}', 'a:0:{}', 'a:3:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:29:\"Customer Retention Rate : Low\";i:2;s:25:\"Network Effect : Negative\";}'),
(17, 15, 'a:1:{i:0;s:27:\"Hypothetical Business Model\";}', 'a:1:{i:0;s:27:\"Hypothetical Business Model\";}', 'a:3:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:29:\"Customer Retention Rate : Low\";i:2;s:25:\"Network Effect : Negative\";}'),
(18, 16, 'a:1:{i:0;s:14:\"Marketing Plan\";}', 'a:0:{}', 'a:2:{i:0;s:28:\"Platform Age : Startup Phase\";i:1;s:24:\"Simultaneous Entry : Yes\";}'),
(19, 17, 'a:1:{i:0;s:14:\"Marketing Plan\";}', 'a:0:{}', 'a:2:{i:0;s:28:\"Platform Age : Startup Phase\";i:1;s:24:\"Simultaneous Entry : Yes\";}'),
(20, 18, 'a:1:{i:0;s:14:\"Marketing Plan\";}', 'a:0:{}', 'a:2:{i:0;s:28:\"Platform Age : Startup Phase\";i:1;s:23:\"Simultaneous Entry : No\";}'),
(21, 19, 'a:1:{i:0;s:14:\"Marketing Plan\";}', 'a:0:{}', 'a:5:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:22:\"Market Type : Existing\";i:2;s:27:\"Platform Age : Growth Phase\";i:3;s:28:\"Platform Age : Startup Phase\";i:4;s:24:\"Simultaneous Entry : Yes\";}'),
(22, 20, 'a:1:{i:0;s:14:\"Marketing Plan\";}', 'a:0:{}', 'a:2:{i:0;s:28:\"Platform Age : Startup Phase\";i:1;s:23:\"Simultaneous Entry : No\";}'),
(23, 21, 'a:1:{i:0;s:14:\"Marketing Plan\";}', 'a:0:{}', 'a:4:{i:0;s:17:\"Market Type : New\";i:1;s:19:\"Market Type : Niche\";i:2;s:28:\"Platform Age : Startup Phase\";i:3;s:24:\"Simultaneous Entry : Yes\";}'),
(24, 22, 'a:2:{i:0;s:12:\"Landing Page\";i:1;s:14:\"Marketing Plan\";}', 'a:0:{}', 'a:1:{i:0;s:31:\"All Situations : BMD Situations\";}'),
(25, 23, 'a:1:{i:0;s:14:\"Marketing Plan\";}', 'a:0:{}', 'a:3:{i:0;s:17:\"Market Type : New\";i:1;s:19:\"Market Type : Niche\";i:2;s:28:\"Platform Age : Startup Phase\";}'),
(26, 24, 'a:1:{i:0;s:27:\"Hypothetical Business Model\";}', 'a:1:{i:0;s:23:\"List of Earlyvangelists\";}', 'a:2:{i:0;s:19:\"Customer Known : No\";i:1;s:28:\"Platform Age : Startup Phase\";}'),
(27, 25, 'a:1:{i:0;s:23:\"List of Earlyvangelists\";}', 'a:1:{i:0;s:11:\"Test Result\";}', 'a:6:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:26:\"Compitition : Late Entrant\";i:2;s:19:\"Customer Known : No\";i:3;s:22:\"Market Type : Existing\";i:4;s:17:\"Market Type : New\";i:5;s:19:\"Market Type : Niche\";}'),
(28, 27, 'a:2:{i:0;s:6:\"An MVP\";i:1;s:23:\"List of Earlyvangelists\";}', 'a:1:{i:0;s:11:\"Test Result\";}', 'a:2:{i:2;s:19:\"Customer Known : No\";i:1;s:17:\"Market Type : New\";}'),
(29, 28, 'a:1:{i:0;s:27:\"Hypothetical Business Model\";}', 'a:0:{}', 'a:3:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:26:\"Compitition : Late Entrant\";i:2;s:19:\"Customer Known : No\";}'),
(30, 29, 'a:1:{i:0;s:27:\"Hypothetical Business Model\";}', 'a:0:{}', 'a:3:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:26:\"Compitition : Late Entrant\";i:2;s:19:\"Customer Known : No\";}'),
(31, 30, 'a:1:{i:0;s:27:\"Hypothetical Business Model\";}', 'a:0:{}', 'a:5:{i:0;s:28:\"Platform Age : Startup Phase\";i:1;s:20:\"Variety Level : High\";i:2;s:25:\"Openness Level : Balanced\";i:3;s:21:\"Openness Level : High\";i:4;s:24:\"Variety Level : Balanced\";}'),
(32, 31, 'a:1:{i:0;s:28:\"Product Requirement Document\";}', 'a:1:{i:0;s:9:\"API & SDK\";}', 'a:5:{i:0;s:27:\"Platform Age : Growth Phase\";i:1;s:20:\"Variety Level : High\";i:2;s:21:\"Openness Level : High\";i:3;s:25:\"Openness Level : Balanced\";i:4;s:24:\"Variety Level : Balanced\";}'),
(33, 32, 'a:0:{}', 'a:1:{i:0;s:18:\"Terms & Conditions\";}', 'a:5:{i:0;s:27:\"Platform Age : Growth Phase\";i:1;s:20:\"Variety Level : Less\";i:2;s:20:\"Openness Level : Low\";i:3;s:25:\"Openness Level : Balanced\";i:4;s:24:\"Variety Level : Balanced\";}'),
(34, 33, 'a:0:{}', 'a:1:{i:0;s:10:\"Guidelines\";}', 'a:5:{i:0;s:27:\"Platform Age : Growth Phase\";i:1;s:20:\"Variety Level : Less\";i:2;s:20:\"Openness Level : Low\";i:3;s:25:\"Openness Level : Balanced\";i:4;s:24:\"Variety Level : Balanced\";}'),
(35, 34, 'a:0:{}', 'a:1:{i:0;s:7:\"License\";}', 'a:5:{i:0;s:28:\"Platform Age : Startup Phase\";i:1;s:20:\"Variety Level : High\";i:2;s:21:\"Openness Level : High\";i:3;s:25:\"Openness Level : Balanced\";i:4;s:24:\"Variety Level : Balanced\";}'),
(36, 35, 'a:0:{}', 'a:0:{}', 'a:5:{i:0;s:25:\"Openness Level : Balanced\";i:1;s:20:\"Openness Level : Low\";i:2;s:27:\"Platform Age : Growth Phase\";i:3;s:29:\"Platform Age : Maturity Phase\";i:4;s:23:\"Compitition : Incumbent\";}'),
(37, 36, 'a:1:{i:0;s:7:\"License\";}', 'a:0:{}', 'a:5:{i:0;s:25:\"Openness Level : Balanced\";i:1;s:20:\"Openness Level : Low\";i:2;s:27:\"Platform Age : Growth Phase\";i:3;s:29:\"Platform Age : Maturity Phase\";i:4;s:23:\"Compitition : Incumbent\";}'),
(38, 37, 'a:1:{i:0;s:7:\"License\";}', 'a:0:{}', 'a:5:{i:0;s:25:\"Openness Level : Balanced\";i:1;s:20:\"Openness Level : Low\";i:2;s:27:\"Platform Age : Growth Phase\";i:3;s:29:\"Platform Age : Maturity Phase\";i:4;s:23:\"Compitition : Incumbent\";}'),
(39, 38, 'a:0:{}', 'a:0:{}', 'a:4:{i:1;s:22:\"Market Type : Existing\";i:2;s:21:\"Openness Level : High\";i:3;s:20:\"Variety Level : High\";i:0;s:26:\"Compitition : Late Entrant\";}'),
(40, 39, 'a:0:{}', 'a:1:{i:0;s:11:\"Test Result\";}', 'a:2:{i:0;s:28:\"Platform Age : Startup Phase\";i:1;s:29:\"Customer Retention Rate : Low\";}'),
(41, 40, 'a:0:{}', 'a:1:{i:0;s:11:\"Test Result\";}', 'a:2:{i:0;s:29:\"Customer Retention Rate : Low\";i:1;s:28:\"Platform Age : Startup Phase\";}'),
(42, 41, 'a:1:{i:0;s:6:\"An MVP\";}', 'a:0:{}', 'a:2:{i:0;s:19:\"Customer Known : No\";i:1;s:28:\"Platform Age : Startup Phase\";}'),
(43, 43, 'a:1:{i:0;s:11:\"Test Result\";}', 'a:0:{}', 'a:5:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:26:\"Compitition : Late Entrant\";i:2;s:19:\"Customer Known : No\";i:3;s:29:\"Platform Age : Maturity Phase\";i:4;s:28:\"Platform Age : Startup Phase\";}'),
(44, 44, 'a:1:{i:0;s:11:\"Test Result\";}', 'a:0:{}', 'a:6:{i:0;s:23:\"Compitition : Incumbent\";i:1;s:26:\"Compitition : Late Entrant\";i:2;s:19:\"Customer Known : No\";i:3;s:27:\"Platform Age : Growth Phase\";i:4;s:29:\"Platform Age : Maturity Phase\";i:5;s:28:\"Platform Age : Startup Phase\";}');

-- --------------------------------------------------------

--
-- Table structure for table `method_building_block_role`
--

DROP TABLE IF EXISTS `method_building_block_role`;
CREATE TABLE IF NOT EXISTS `method_building_block_role` (
  `method_building_block_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`method_building_block_id`,`role_id`),
  KEY `IDX_C3FA08996419B3C4` (`method_building_block_id`),
  KEY `IDX_C3FA0899D60322AC` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `method_building_block_role`
--

INSERT INTO `method_building_block_role` (`method_building_block_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(1, 5),
(2, 1),
(2, 3),
(2, 5),
(3, 1),
(4, 1),
(4, 3),
(4, 4),
(5, 1),
(5, 3),
(5, 4),
(6, 1),
(6, 3),
(6, 4),
(7, 1),
(7, 3),
(8, 1),
(8, 3),
(8, 5),
(9, 1),
(9, 3),
(9, 5),
(10, 1),
(10, 3),
(10, 5),
(11, 1),
(11, 3),
(11, 5),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 1),
(17, 1),
(18, 1),
(18, 4),
(19, 1),
(19, 4),
(20, 1),
(20, 4),
(21, 1),
(22, 1),
(22, 4),
(23, 1),
(23, 4),
(24, 1),
(24, 4),
(25, 1),
(25, 3),
(25, 4),
(26, 1),
(27, 1),
(27, 3),
(27, 5),
(28, 1),
(28, 3),
(28, 5),
(29, 1),
(29, 3),
(29, 5),
(30, 1),
(30, 3),
(30, 5),
(31, 1),
(32, 2),
(33, 1),
(34, 2),
(35, 1),
(36, 2),
(37, 1),
(38, 1),
(39, 1),
(39, 2),
(40, 1),
(41, 1),
(42, 1),
(42, 5),
(43, 1),
(43, 3),
(43, 5),
(44, 1),
(44, 3),
(44, 5);

-- --------------------------------------------------------

--
-- Table structure for table `method_building_block_tool`
--

DROP TABLE IF EXISTS `method_building_block_tool`;
CREATE TABLE IF NOT EXISTS `method_building_block_tool` (
  `method_building_block_id` int(11) NOT NULL,
  `tool_id` int(11) NOT NULL,
  PRIMARY KEY (`method_building_block_id`,`tool_id`),
  KEY `IDX_B460BC226419B3C4` (`method_building_block_id`),
  KEY `IDX_B460BC228F7B22CC` (`tool_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `method_building_block_tool`
--

INSERT INTO `method_building_block_tool` (`method_building_block_id`, `tool_id`) VALUES
(1, 1),
(1, 7),
(2, 1),
(2, 7),
(3, 1),
(3, 7),
(4, 7),
(5, 7),
(6, 7),
(7, 8),
(8, 7),
(9, 7),
(10, 7),
(11, 7),
(12, 5),
(12, 6),
(13, 5),
(13, 6),
(14, 5),
(14, 6),
(15, 5),
(15, 6),
(16, 7),
(17, 7),
(26, 3),
(27, 3),
(27, 7),
(28, 7),
(29, 7),
(30, 7),
(31, 2),
(31, 3),
(32, 5),
(32, 6),
(33, 7),
(34, 7),
(35, 7),
(36, 7),
(37, 7),
(38, 7),
(39, 6),
(39, 7),
(40, 7),
(41, 7),
(42, 3),
(42, 7),
(43, 7),
(44, 7);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seen_counter` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `IDX_BF5476CAA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

DROP TABLE IF EXISTS `process`;
CREATE TABLE IF NOT EXISTS `process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_process_kind_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_861D1896EFD4F280` (`parent_process_kind_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`id`, `parent_process_kind_id`, `name`, `description`) VALUES
(1, 1, 'Prepare Hypothetical Business Model', '<p>A hypothetical business model consists of business hypotheses (<em>who are the customers, in what value are they interested, what channel to be used to reach them etc</em>) that need to be validated by testing with associated stakeholders. This process has been mentioned in several pieces of literature (<strong>Model-based Hypothesis Engineering for Supporting Adaptation to Uncertain Customer Needs</strong>, <strong>The Four Steps to the Epiphany</strong>, <strong>The Business Model Navigator</strong>). The output of this process is a hypothetical business model which can be in the form of a platform canvas or business canvas or a magic triangle.</p>'),
(2, 1, 'Prepare Concrete Business Model', '<p>A concrete business model consists of profitable business ideas (<em>who are the customers, in what value are they interested, what channel to be used to reach them etc</em>) that have been validated by testing those ideas with the respective stakeholders. This process has been mentioned in several pieces of literature (<strong>Model-based Hypothesis Engineering for Supporting Adaptation to Uncertain Customer Needs</strong>, <strong>The Four Steps to the Epiphany</strong>, <strong>The Business Model Navigator</strong>). The output of this process is a validated business model which can be in the form of a platform canvas or business canvas or a magic triangle.</p>\r\n<tmpopup style=\"top: 40px; left: 87px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 40px; left: 87px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(3, 1, 'Prepare Development Requirement Document', '<p>This process creates a requirement document that will be used by a software developer to create an application. This process has been mention in the literature &quot;<strong>The Four Steps to the Epiphany</strong>&quot;.</p>'),
(4, 1, 'Prepare Marketing Plan for Existing Market', '<p>This process comes from the literature &quot;<strong>The Four Steps to the Epiphany</strong>&quot;. The existing market means that there are already competitors in the market who are offering exactly the same value propositions. As per the author, in an existing market, the marketing plan should focus more on <strong>performance, user experience and cost</strong> regarding the offered value propositions.</p>\r\n\r\n<p>For example, HandSpring was PDA manufacturer that competed in an existing market with rivals such as Palm, Microsoft and Hewlett Packard. HandSpring boosted the sales of its PDA through a marketing message that emphasized the <strong>performance/User experience</strong> provided by its manufactured PDA. As a result, HandSpring generated $170 million in two months. A similar example can be seen in <strong>Platform Revolution: How Networked Markets Are Transforming The Economy </strong>where Airbnb competed with the rival Craiglist and Airbnb came out victorious due to better user experience.</p>'),
(5, 1, 'Prepare Explainer Video', '<p>This process has been mentioned in the literature &quot;<strong>Testing Business Ideas</strong>&quot; where an introductory video about the value propositions are made which can later be used for testing the value propositions.</p>'),
(6, 2, 'Find Similar Business Patterns', '<p>This process comes from the literature &quot;<strong>The Business Model Navigator</strong>&quot; where the author has provided 55 business patterns. During business model innovation, new ideas can be generated based on the similarity principle (as well as dissimilarity principle). When the similarity principle is chosen then ideas are created by looking at businesses that are similar to the business of the business owner. For example,</p>\r\n\r\n<ul>\r\n	<li>A food processing machine manufacturer used the similarity principle and adopted the business pattern of IKEA i.e. self-service. By using this pattern IKEA outsources parts of the value chain to the customers.</li>\r\n	<li>A swiss printing company that was suffering from excess printing capacity used the similarity principle and chose the business model used by the low-cost airline i.e. no frill. By using this business pattern, the printing company exploited its excess printing capacity and provided a simple and low-cost printing service.&nbsp;</li>\r\n</ul>'),
(7, 2, 'Find Dissimilar Business Patterns', '<p>This process comes from the literature &quot;<strong>The Business Model Navigator</strong>&quot; were has provided 55 business patterns. During business model innovation, new ideas can be generated based on the dissimilarity principle (as well as similarity principle). When the dissimilarity principle is chosen then ideas are created by looking at businesses that are not similar to the business of the business owner. For example,</p>\r\n\r\n<ul>\r\n	<li>A steel industry used the <strong>Pay Per Use</strong> business pattern which has been used in carsharing platforms such as Car2Go or internet advertisement where the advertisers are charged the number of times a user clicks on an ad. By using the <strong>Pay Per Use </strong>pattern, the steel company charged its customers only for the amount of steel used rather than billing for the fixed units of steel shipped. The excess steel used to be collected and recycled for future production.</li>\r\n</ul>'),
(8, 8, 'Ideate From Similar Business Patterns', '<p>The meaning of this process is to generate new ideas by looking at business patterns similar to the current business. In this process, employees irrespective of their designation from all the departments participate. Normally this process takes place in a workshop-like environment. Pen and paper are distributed to all the participants so that they can write down their ideas. All the participants should be treated equally and their ideas should be respected and discussed. During this session, negative comments such as &quot;We have already tried that&quot;, &quot;Have not been invented&quot; etc should be avoided. In the end, a vote is taken to decide on new ideas.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Source: The Business Model Navigator</strong></p>\r\n<tmpopup style=\"top: 55px; left: 20px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 55px; left: 20px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(9, 8, 'Ideate From Dissimilar Business Patterns', '<p>The meaning of this process is to generate new ideas by looking at business patterns dissimilar to the current business. In this process, employees irrespective of their designation from all the departments participate. Normally this process takes place in a workshop-like environment. Pen and paper are distributed to all the participants so that they can write down their ideas. All the participants should be treated equally and their ideas should be respected and discussed. During this session, negative comments such as &quot;We have already tried that&quot;, &quot;Have not been invented&quot; etc should be avoided. In the end, a vote is taken to decide on new ideas.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Source: The Business Model Navigator</strong></p>'),
(10, 3, 'Develop MVP', '<p>The MVP stands for Minimum Viable Product. An MVP is a product or application with minimalistic features which takes less time and money to be built. This process has been mentioned in several literature (<strong>The Business Model Navigator</strong>, <strong>Testing Business Ideas</strong>,&nbsp;<strong>The Four Steps to the Epiphany</strong>).</p>'),
(11, 3, 'Develop Liquidity Metric', '<p>This metric is used to show the rate of occurrence of core interaction in the platform. Depending on the working functionality of the platform<br />\r\nand the type of the customer base, the formula to state the liquidity can vary. On a professional networking platform, it might be the number of profiles viewed. On a marketing platform, it might be the number of products sold. On an entertainment platform, it might be the number of stories read etc.</p>\r\n\r\n<p><strong>Source:-</strong> <strong>Platform Revolution: How Networked Markets Are Transforming The Economy</strong></p>'),
(12, 3, 'Develop Matching Quality Metric', '<p>This metric shows how well the search algorithm on any digital platform works. If a search functionality does not work well then the consumers might get frustrated and stop using the platform.</p>\r\n\r\n<p><strong>Source:</strong>- <strong>Platform Revolution: How Networked Markets Are Transforming The Economy</strong></p>'),
(13, 3, 'Develop Landing Page', '<p>This process has been coined from the literature &quot;<strong>Testing Business Ideas&quot;. </strong>A landing page is a required artifact during social media advertisement where users can be redirected to understand the value propositions provided by any business.</p>'),
(14, 4, 'Modify Value Proposition', '<p>This activity is used to change the provided value propositions.</p>\r\n\r\n<p><strong>Example</strong>: When it is found out that the provided value propositions are not attractive then it should be modified so that customers would be attracted. For example, MeetUp was a digital platform that provided free meeting arrangement services. However, the number people signed up for meeting were not actually showing up. Therefore, the quality and quantity of the core interactions on the platform were getting affected due non-attendance of non-serious users. As experimentation, MeetUp monetized the meeting arrangement where users would have to pay a fee for the meetings. Since a user would have to pay, he/she would definitely turn up for the meeting. Even though it reduced the network effect, it resulted in an improved core interaction and all the serious participants of the platform admired this new value proposition.</p>\r\n\r\n<p><strong>Source:</strong> <strong>Platform Revolution: How Networked Markets Are Transforming The Economy</strong></p>'),
(15, 4, 'Modify Key Activities', '<p>Key activities illustrate how value propositions are created and delivered to the customers. If the produced value proposition is not attractive then actions should be taken or the key activities should be changed to create more attractive value propositions.</p>\r\n\r\n<p><strong>Example: </strong>Chatroulette was a platform that paired random people for video chat for free and without any registration. However, the no-registration feature attracted many perverts to the platform where naked hairy men showed for video chat. This discouraged decent customers from using the platform. Chatroulette realized the problem in its value propositions and modified its key activities. Chatroulette provided tools so that any indecent people can be filtered before any video chat happens.</p>\r\n\r\n<p><strong>Source:</strong> <strong>Platform Revolution: How Networked Markets Are Transforming The Economy</strong></p>'),
(16, 16, 'Micromarket', '<p>This is an activity used to get customers to the platform. This is a pull-type of marketing strategy which means it provides incentives or any other kind of attraction so that customers are pulled to use the platform. A micro market is normally applied in a small geographical area or any small/single category. When enough customers use the platform i.e. when enough network effect is created then the platform owner can grow the business by focusing on other geographic areas or categories.</p>\r\n\r\n<p><strong>Example</strong>: Facebook successfully used this strategy by first focusing on the Harvard community. Instead, If Facebook had started globally then the joining customers would not interact because they would not have known each other and therefore network effect could not have been created. The micromarket strategy solved this issue for Facebook.</p>\r\n\r\n<p><strong>Source:</strong> <strong>Platform Revolution: How Networked Markets Are Transforming The Economy</strong></p>\r\n<tmpopup style=\"top: 211px; left: 73px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 211px; left: 73px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(17, 16, 'Piggyback', '<p>This is an activity used to get customers to the platform. This is a pull-type of marketing strategy which means it provides incentives or any other kind of attraction so that customers are pulled to use the platform. YouTube used this strategy to increase its customer base during its early days. YouTube piggybacked on MySpace which was a famous platform for music bands. YouTube provided tools that were easier for music bands to upload videos to YoutTube which could then easily be embedded into MySpace. As a result, the viewers of those videos were redirected to the YoutTube platform who would find tons of content from other video producers. The piggyback strategy not only solved the problem of acquiring producers but also provided youtube with the consumers of videos.</p>\r\n\r\n<p><strong>Source:</strong>&nbsp;<strong> Platform Revolution: How Networked Markets Are Transforming The Economy</strong></p>'),
(18, 16, 'Single Sided', '<p>This is an activity used to get customers to the platform. This is a pull-type of marketing strategy which means it provides incentives or any other kind of attraction so that customers are pulled to use the platform. In this strategy, first, a customer base is built on one side of the platform i.e. either the consumers are first acquired or the producers are first acquired. The presence of this excess amount of customers attracts the opposite customers i.e. either producers or consumers.</p>\r\n\r\n<p><strong>Example: </strong>Redbus first started as a bus seating arrangement software. When enough bus operators were on board, Redbus opened its business to the bus passengers. Similarly, OpenTable first started as a restaurant seating arrangement software. When enough restaurants were on board, OpenTable opened its business to the diners.</p>\r\n\r\n<p><strong>Source:</strong><strong> Platform Revolution: How Networked Markets Are Transforming The Economy</strong></p>'),
(19, 16, 'Marquee', '<p>This is an activity used to get customers to the platform. This is a pull-type of marketing strategy which means it provides incentives or any other kind of attraction so that customers are pulled to use the platform. In this strategy, an influential customer is enticed to join the platform whose presence can attract the opposite customers.</p>\r\n\r\n<p><strong>Example: </strong>Gaming platforms such as Xbox, Nintendo and PlayStation try to make enticing deals with champion game producer, Electronic Arts (EA). They encourage EA to create games that can compatible with their gaming platform. As a result, the presence of a wide array of EA games attracts many gamers to their platforms.</p>\r\n\r\n<p><strong>Source:</strong> <strong>LAUNCH STRATEGIES OF DIGITAL PLATFORMS: PLATFORMS WITH SWITCHING AND NON-SWITCHING USERS</strong></p>\r\n\r\n<p>&nbsp;</p>'),
(20, 16, 'Seeding', '<p>This is an activity used to get customers to the platform. This is a pull-type of marketing strategy which means it provides incentives or any other kind of attraction so that customers are pulled to use the platform. In this strategy, the platform owner himself/herself trying to provide the initial set of products that will attract the consumers.</p>\r\n\r\n<p><strong>Example: </strong>A car-sharing platform, acquired its first cars from family members and friends (1). In Quora (a question answering platform), the first questions were posted by the editors of the platform which were also answered by the editors until sufficient customers joined the platform to ask and answer the questions (2).</p>\r\n\r\n<p><strong>Source:&nbsp;</strong></p>\r\n\r\n<p><strong>1. </strong>LAUNCH STRATEGIES OF DIGITAL PLATFORMS: PLATFORMS WITH SWITCHING AND NON-SWITCHING USERS.</p>\r\n\r\n<p><strong>2</strong>.<strong> </strong>Platform Revolution: How Networked Markets Are Transforming The Economy</p>'),
(21, 17, 'TV Commercials', '<p>This is a push-type marketing strategy where TV commercials are used to generate public awareness about the value propositions.</p>\r\n\r\n<p><strong>Source:- Platform Revolution: How Networked Markets Are Transforming The Economy</strong></p>\r\n<tmpopup style=\"top: 11px; left: 548px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 11px; left: 548px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(22, 17, 'Social Media Ads', '<p>This is a push-type marketing strategy where ads in social networks (such as Facebook, Instagram) are posted to generate public awareness about the value propositions. This activity can also be used to test the customer segment and the value propositions. The ad which needs to be posted needs a<strong> <em>landing page</em></strong> showing the offered value propositions.</p>\r\n\r\n<p><strong>Source:- Testing Business Ideas</strong></p>'),
(23, 17, 'Events During Music or Technology Festivals', '<p>This is a push-type marketing strategy where a large amount of money is invested to show ads featuring the value proposition of the platform. <span style=\"background-color:#bdc3c7\">Twitter</span> used this tactic where it spent $11000 to install a pair of giant screens at the South by Southwest (SXSW) festival and provided an activity that resulted in mass public awareness. As a result, Twitter&#39;s customer base tripled from 20000 daily tweets to 60000 daily tweets.</p>\r\n\r\n<p><strong>Source:- </strong>Platform Revolution: How Networked Markets Are Transforming The Economy</p>'),
(24, 5, 'Ask Friends and Business Contacts', '<p>This is neither a pull nor push strategy. Rather this is a strategy to find early customers who can validate the value propositions of any business. Usually, these early customers are given a presentation regarding the assumed problem hypotheses and the proposed solution hypotheses (i.e. the value units offered by the business owner). If the early customers agree on the problem and accept the proposed solution (by buying them) then it proves that there are customers in the market who will buy the value offered by the business.</p>'),
(25, 6, 'Customer Interview', '<p>With this activity, the hypotheses about value propositions, customer segments and profitability can be tested. This activity needs a <em><strong>customer interview questionnaire</strong></em>. This artefact contains questions that need to be asked to the customers.</p>\r\n\r\n<p><strong>Source</strong>: Testing Business Ideas</p>'),
(27, 6, 'Single Feature MVP', '<p>This activity can be used to test the customer segments and the offered value propositions. To do this, an MVP (Minimum Viable Product) and a list of customers are required.</p>\r\n\r\n<p><strong>Source</strong>: Testing Business Ideas</p>'),
(28, 7, 'Analyze Internal Consistency', '<p>This is an activity that checks whether the hpothetical business model is consistent or not. In other words, all the sections in the business model should be consistent e.g. does the key activities provide sufficient value to the customer segments? Is it feasible to produce specific value propositions? Can the resources be acquired that is essential to produce the value? Are external partners required to produce the offered values? etc.</p>\r\n\r\n<p><strong>Source</strong>: The Business Model Navigator</p>\r\n<tmpopup style=\"top: 94px; left: 244px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 94px; left: 244px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(29, 7, 'Analyze External Consistency', '<p>This activity is used to check whether the hypothetical business model is consistent with external factors such as external stakeholders such as suppliers, partners, current trends etc. It is also checked whether the business model can compete with the market rivals.</p>\r\n\r\n<p><strong>Source</strong>: The Business Model Navigator</p>'),
(30, 13, 'Invite Third Party App Developers', '<p>To create a network effect, a large variety of applications from different app developers must be present on the platform. This is an activity that opens the platform to a large number of diverse app developers. This activity comes under leverage type.</p>\r\n\r\n<p><strong>Source:</strong> Four Tactics for Implementing a Balanced Digital Platform Strategy</p>\r\n<tmpopup style=\"top: 53px; left: 450px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 53px; left: 450px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(31, 13, 'Develop API and SDK', '<p>This activity comes under leverage type where initiative is taken to open the platform to third-party app developers. This activity provides essential artifacts to the third-party developers using which innovative value propositions can be developers for the app users.</p>\r\n\r\n<p><strong>Source:</strong> Four Tactics for Implementing a Balanced Digital Platform Strategy</p>'),
(32, 14, 'Create Terms and Conditions', '<p>This activity comes under control type which restricts the app developers by enforcing terms and conditions. With the help of this activity, a digital platform can be kept consistent and discourage the app developers from too much diversifying the platform.</p>\r\n\r\n<p>An example case of too much diversity is handsets with different versions of Android OS which makes app development difficult for the app developers.</p>\r\n\r\n<p><strong>Source:</strong> Four Tactics for Implementing a Balanced Digital Platform Strategy</p>'),
(33, 14, 'Create Guidelines for App Developers', '<p>A guideline can help the producers on the platform to develop high-quality value units. Since guideline encourages to develop while following the consistency principles, it comes under <strong>control </strong>type.</p>\r\n\r\n<p><strong>Source:</strong> Four Tactics for Implementing a Balanced Digital Platform Strategy</p>'),
(34, 13, 'Create Open License', '<p>This is a leverage type activity that aims at acquiring a large number of producers who can create apps to attract consumers and in turn create a network effect. An open-source license such as Creative Commons can attract many developers looking for free resources.</p>\r\n\r\n<p><strong>Source:</strong> Four Tactics for Implementing a Balanced Digital Platform Strategy</p>'),
(35, 15, 'SpeedUp API Development', '<p>This belongs to defence type activity. When a copy-cat platform is copying the under developed API then the victim platform can speed up the API development so that the copying platform can not cope up with the speed of the API development.</p>\r\n\r\n<p><strong>Source:</strong> Four Tactics for Implementing a Balanced Digital Platform Strategy</p>'),
(36, 15, 'Close Open Source License', '<p>This is a defence type activity that suggests closing any open source license that is getting exploited by any rival digital platform.</p>\r\n\r\n<p><strong>Source:</strong> Four Tactics for Implementing a Balanced Digital Platform Strategy</p>'),
(37, 15, 'Force To Share', '<p>This is a defence type action where a license is created for shared resources that force third-part resource users to share the profit generated by using the resources.</p>\r\n\r\n<p><strong>Source:</strong> Four Tactics for Implementing a Balanced Digital Platform Strategy</p>'),
(38, 18, 'Replicate Resources', '<p>This is an exploit type activity where a competing platform can copy resources from the other platform. Before copying resources, it must be checked whether the resources are available under an open license or not. Otherwise, it can create an expensive legal battle between two digital platforms. For example, Google&#39;s Android platform was made by copying several Java libraries without paying any fees to the owning platform that resulted in a billion-dollar legal suit.</p>'),
(39, 10, 'Measure Liquidity', '<p>This activity is carried out to find whether sufficient activity is happening on the platform. To create a network effect, the platform must provide attractive value units that can encourage more activity. To perform this activity, a liquidity metric must be developed that can be used by the platform owner.</p>\r\n\r\n<p><strong>Source:- Platform Revolution: How Networked Markets Are Transforming The Economy</strong></p>\r\n\r\n<p><tmpopup style=\"top: 0px; left: 525px;\"><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup></p>'),
(40, 10, 'Measure Matching Quality', '<p>This activity illustrates whether the search functionality provided by the platform working properly or not. If the search function does not work well then the consumers can not find their preferred value units provided by the producers which in turn result in limited core interactions. Without proper search functionality, a network effect in any platform can not be created. This activity requires a matching quality metric that can be used by the platform owner.</p>\r\n\r\n<p><strong>Source:- Platform Revolution: How Networked Markets Are Transforming The Economy</strong></p>'),
(41, 11, 'Sell To EarlyVangelists', '<p>This activity tries to sell the value propositions to the early customers (or Earlyvangelists). It has been mentioned in the literature &quot;<strong>Four Steps To Epiphanny&quot;. </strong>In the context of any digital platform, these customers can be thought of as both the producers and the consumers. Early customers are those customers who are enthusiastic about the business idea of the business owner. These customers also spread the message about the business idea. In most cases, these early evangelists are willing to buy the value units even if it is not designed/developed completely i.e. they are willing to buy the MVP (Minimum Viable Product).</p>\r\n<tmpopup style=\"top: 0px; left: 236px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 0px; left: 236px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(42, 11, 'Sell To Pragmatists and Conservatives', '<p>The pragmatists and the conservatives (PCs) are called the mainstream markets. They are not so much as enthusiastic as the earlyvangelists for the business idea. The marketing strategy used to get the earlyevangelists can not be used to get the PCs. The PCs will never buy any MVP. They would need value units that should have all the advertised features and which should be easy to consume/use. The PCs don&#39;t trust the earlyvangelists and do not pay heed to the advertisement messages spread through the earlyvangelists, rather a PC believes another PC. With trial and error, a technique must be found out how to reach to these PCs and sell to them.</p>\r\n\r\n<p><strong>Source:</strong> <strong>Four Steps To Epiphanny</strong></p>\r\n<tmpopup style=\"top: 157px; left: 61px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 157px; left: 61px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(43, 12, 'Verify Customer Segment', '<p>This activity looks at test results from tests such as customer interviews or online ads and ensures whether the hypotheses about the customers and their problems are correct or not.</p>\r\n\r\n<p><strong>Source: Testing Business Ideas, Business Model Navigator</strong></p>'),
(44, 12, 'Verify Value Proposition', '<p>This activity looks at test results from tests such as customer interviews or online ads and ensures whether the hypotheses about the value propositions offered by the business owner are correct or not.</p>\r\n\r\n<p><strong>Source: Testing Business Ideas, Business Model Navigator</strong></p>\r\n<tmpopup style=\"top: 53px; left: 373px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 53px; left: 373px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(45, 12, 'Verify Channel', '<p>This activity looks at test results from tests such as customer interviews or online ads and ensures whether the hypotheses about the channels used by the business owner to reach the customers are correct or not.</p>\r\n\r\n<p><strong>Source: Testing Business Ideas, Business Model Navigator</strong></p>'),
(46, 1, 'Prepare Marketing Plan for New Market', '<p>This process comes from the literature &quot;<strong>The Four Steps to the Epiphany</strong>&quot;. The new market means that there are no competitors in the market who are offering exactly the same value propositions. In this type of market, the marketing message should <u><strong>educate</strong></u> the customers about the new value propositions which never existed before. In this type of market, focusing on performance or user experience has no meaning because the customers would not understand the message because such value propositions never existed before.</p>\r\n<tmpopup style=\"top: 81px; left: 406px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 81px; left: 406px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(47, 1, 'Prepare Marketing Plan for Niche Market', '<p>This process comes from the literature &quot;<strong>The Four Steps to the Epiphany</strong>&quot;. The niche market means that there are already competitors in the market however these competitors are not providing the value propositions offered by the business owner. An example situation has been mentioned in &quot;<strong>Platform Revolution: How Networked Markets Are Transforming The Economy</strong>&quot;&nbsp; where a late entrant called Vimeo had to compete with the incumbent video-sharing platform YouTube. Vimeo focused on value propositions that had been neglected by YouTube i.e. providing sophisticated tools to producers that supported high-definition video playback and much better video embedment on blogs.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `process_kind`
--

DROP TABLE IF EXISTS `process_kind`;
CREATE TABLE IF NOT EXISTS `process_kind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_process_kind_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D42D6EECEFD4F280` (`parent_process_kind_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `process_kind`
--

INSERT INTO `process_kind` (`id`, `parent_process_kind_id`, `name`, `description`) VALUES
(1, NULL, 'Prepare', '<p>The <u><strong>prepare</strong></u> type has been used in several pieces of literature such as <strong>prepare product hypotheses</strong> (The Four Steps to the Epiphany), <strong>prepare problem hypotheses</strong> (The Four Steps to the Epiphany), <strong>Prepare Marketing Plan</strong> (The Four Steps to the Epiphany), <strong>Prepare hypotheses about Customers</strong> (The Business Model Navigator) Etc.</p>'),
(2, NULL, 'findPattern', '<p>The <strong>find</strong> type has been used in &quot;<strong>The Business Model Navigator</strong>&quot; in finding similar and dissimilar business patterns.</p>'),
(3, NULL, 'Develop', '<p>The <strong>develop</strong> type has been used in several pieces of literature such as <strong>developing an MVP</strong> (The Business Model Navigator), <strong>Developing a single feature MVP </strong>(Testing Business Ideas), <strong>Develop Metrics</strong> (Platform Revolution: How Networked Markets Are Transforming The Economy), <strong>Develop a landing page</strong> (Testing Business Ideas) etc</p>'),
(4, NULL, 'Modify', '<p>The <strong>modify </strong>type can be seen in the literature <strong>Platform Revolution: How Networked Markets Are Transforming The Economy </strong>where a meeting arrangement platform called MeetUp modified its value proposition from free meetup service to paid meetup service to attract serious customers. Similarly, another platform called <strong>chatroulette </strong>modified its key activities to prevent naked men from participating in the platform.&nbsp;<strong> </strong></p>\r\n<tmpopup style=\"top: 0px; left: 286px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 0px; left: 286px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(5, NULL, 'getCustomers', '<p>This <strong>type</strong> can be seen in the literature<strong> &quot;The Four Steps to the Epiphany&quot; </strong>where the author suggest to first procure the early customers called Earlyvangelists. This type of customer is enthusiastic about the business idea of the business developer and ready to buy the product and also spread the message about the product. In&nbsp;the literature <strong>&quot;Platform Revolution: How Networked Markets Are Transforming The Economy&quot;, </strong>the author speaks about two kinds of strategies called pull and push to get the customers who can either be a consumer or a producer. In&nbsp;the literature &quot;<strong>LAUNCH STRATEGIES OF DIGITAL PLATFORMS: PLATFORMS WITH SWITCHING AND NON-SWITCHING USERS&quot;, </strong>the author speaks about getting customers who can join the platform simultaneously or sequentially.</p>\r\n<tmpopup style=\"top: 0px; left: 442px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 0px; left: 442px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(6, NULL, 'Test', '<p>The <strong>test</strong> type has been used in several pieces of literature such as <strong>testing value proposition</strong> (The Business Model Navigator), <strong>testing channel </strong>(Testing Business Ideas), etc.</p>\r\n<tmpopup style=\"top: 0px; left: 571px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 0px; left: 571px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(7, NULL, 'Analyze', '<p>This type has been mentioned as <strong>analyze internal consistency</strong> (The Business Model Navigator), <strong>analyze external consistency</strong> (The Business Model Navigator) which are mostly the same as internal audit and external audit (The Four Steps to the Epiphany) respectively.</p>'),
(8, NULL, 'Ideate', '<p>This type has been used in the literature, &quot;<strong>The Business Model Navigator</strong>&quot; where the author speaks about generating ideas by comparing the existing business model with other similar and dissimilar business patterns.</p>\r\n<tmpopup style=\"top: 0px; left: 265px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 0px; left: 265px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(9, NULL, 'Innovate', '<p>This process type has been coined from the notion of innovating an existing business model (<strong>The Business Model Navigator).</strong></p>'),
(10, NULL, 'Measure', '<p>This type has been mentioned in several platforms related literature (<strong>Platform Revolution: How Networked Markets Are Transforming The Economy, The Platform Canvas Conceptualization of a Design Framework for Multi-Sided Platform Businesses) </strong>where the authors speak about measuring key metrics to track the progress of any digital platform.</p>'),
(11, NULL, 'Sell', '<p>This type has been coined from the literature<strong> &quot;The Four Steps to the Epiphany&quot; </strong>where<strong> </strong>the author suggests selling value units to the customers to confirm the business hypotheses of the business owner. Several types of selling have been suggested here. Sell to early customers, Sell to pragmatists, Sell to conservatives etc.</p>'),
(12, NULL, 'Verify', '<p>The <strong>verify type</strong> has been mentioned in two literature<strong>&quot;The Four Steps to the Epiphany&quot; </strong>and <strong>&quot;The Business Model Navigator&quot;</strong> where the authors speak about verifying business hypotheses by analyzing several test results.<tmpopup style=\"top: 0px; left: 250px;\"><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup></p>'),
(13, 19, 'Leverage', '<p>This type has been mentioned in the literature <strong>&quot;Four Tactics for Implementing a Balanced Digital Platform Strategy&quot; </strong>where the author speaks about several kinds of leverage activities such as &quot;Provide API&quot;, &quot;Provide SDK&quot;, &quot;Invite third-party app developers&quot; etc. Leverage type activities are used to open the platform to a wide array of app developers so that a platform can be seeded with large amount of contents.</p>'),
(14, 19, 'Control', '<p>This type has been mentioned in the literature <strong>&quot;Four Tactics for Implementing a Balanced Digital Platform Strategy&quot; </strong>where the author speaks about several kinds of control activities such as &quot;Create development guidelines&quot;, &quot;Create client library&quot;, &quot;Create terms and conditions&quot; etc.</p>'),
(15, 19, 'Defense', '<p>This type has been mentioned in the literature <strong>&quot;Four Tactics for Implementing a Balanced Digital Platform Strategy&quot; </strong>where the author speaks about several kinds of defence activities such as &quot;Close open source license&quot;, &quot;Speed-up API development&quot;, etc.</p>'),
(16, 5, 'Pull', '<p>This type has been mentioned in the literature &quot;<strong>Platform Revolution: How Networked Markets Are Transforming The Economy</strong>&quot;. The pull-type indicates strategies to get customers to the digital platform through different kinds of attractive incentives. Some examples of pull-type tactics are piggyback, micromarket, marquee etc</p>\r\n<tmpopup style=\"top: 0px; left: 951px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 0px; left: 951px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(17, 5, 'Push', '<p>This type has been mentioned in the literature &quot;<strong>Platform Revolution: How Networked Markets Are Transforming The Economy</strong>&quot;. The push-type indicates strategies to get customers by pushing the value propositions offered by a digital platform through large public relation events such as TV commercials,&nbsp; Social Media Ads, Events during festivals etc. <u>Generally, push-type strategies cost a large sum of investment compared to pull-type strategies.</u></p>'),
(18, NULL, 'Exploit', '<p>This type has been recommended in the literature &quot;<strong>Four Tactics for Implementing a Balanced Digital Platform Strategy&quot; </strong>where a competing platform can copy some of the resources from a rival platform to save time and money.</p>'),
(19, NULL, 'Balance', '<p>This is a type suggested by us. We consider that a balance type process consists of several child process types such as leverage, control and defence which are required to strike a balance between low variety vs high variety and low openness vs high openness in any digital platform.</p>\r\n\r\n<p><strong>Source:- </strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</p>');

-- --------------------------------------------------------

--
-- Table structure for table `process_process_kind`
--

DROP TABLE IF EXISTS `process_process_kind`;
CREATE TABLE IF NOT EXISTS `process_process_kind` (
  `process_id` int(11) NOT NULL,
  `process_kind_id` int(11) NOT NULL,
  PRIMARY KEY (`process_id`,`process_kind_id`),
  KEY `IDX_BE933BDD7EC2F574` (`process_id`),
  KEY `IDX_BE933BDD7818F67C` (`process_kind_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `process_process_kind`
--

INSERT INTO `process_process_kind` (`process_id`, `process_kind_id`) VALUES
(22, 6),
(24, 16),
(31, 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'Platform Owner', '<p>This role has been mentioned in platforms related literature such as <strong>&quot;(1) Platform Revolution: How Networked Markets Are Transforming The Economy&quot; </strong>and <strong>&quot; (2) Four Tactics for Implementing a Balanced Digital Platform Strategy&quot;. </strong>This role is also known as the <strong>Founder </strong>in other platform-related literature such as <strong>&quot;(3) Pipelines, Platforms, and the New Rules of Strategy&quot; </strong>and <strong>&quot; (4) LAUNCH STRATEGIES OF DIGITAL PLATFORMS: PLATFORMS WITH SWITCHING AND NON-SWITCHING USERS&quot;</strong>.</p>\r\n\r\n<p>This is a general assumption that a platform owner or the founders take important decisions regarding the platform. Such as in (1), the platform owner takes decisions regarding marketing strategy (Seeding Strategy). In (1), it has also been mentioned platform owners in digital platforms such as Facebook, Apple etc. take important decisions such as deciding/modifying the value propositions, governing the platform, deciding on the partners etc. In (2), platform owners decide what kind of key activities should be carried out to tackle different situational factors such as exploitation, low and high variety, low control etc. In <strong>&quot;Four Steps To Epiphanny&quot;, </strong>they are known as the <strong>founder </strong>who is responsible for creating many artifacts such as <em>Business Hypotheses Document, Product Requirement Document, Marketing and Sale Plan</em> etc.</p>'),
(2, 'Developer', '<p>This role has been coined from the literature <strong>&quot;Four Steps To Epiphanny&quot; </strong>where a product development team is responsible for developing a minimalistic product/application (or an MVP Platform in this context). To develop they need a <em>Product Requirement Document. </em></p>\r\n\r\n<p>The notion of the <strong>Developer </strong>can also be found in &quot;<strong>Platform Revolution: How Networked Markets Are Transforming The Economy&quot; </strong>where it has been frequently mentioned that the platform should develop specific value propositions, specific filters, specific metrics etc.</p>'),
(3, 'Marketing VP', '<p>This role has been mentioned in the literature <strong>&quot;Four Steps To Epiphanny&quot; </strong>where the VP is responsible for taking key decisions that can create demand for the offered value propositions in the market. Even though this role has not been specifically mentioned in other platform-related literature, we assume that this role is also responsible for taking key decisions in any platform business as well. Therefore in the future, we are going to associate this role with marketing-related decision-taking activities.</p>\r\n<tmpopup style=\"top: 0px; left: 20px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 0px; left: 20px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(4, 'Marketing Executive', '<p>This role has been mentioned in the literature <strong>&quot;Four Steps To Epiphanny&quot;</strong>. This role is assumed to be a junior role compared to the<strong> VP of Marketing</strong>. The marketing executives conduct market demand related activities such as creating marketing requirement documents (MRD) for the engineers, creating sales presentations and sales materials etc.</p>\r\n<tmpopup style=\"top: 0px; left: 20px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 0px; left: 20px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(5, 'Sales VP', '<p>This role has been mentioned in the literature <strong>&quot;Four Steps To Epiphanny&quot; </strong>where the VP is responsible for taking key decisions regarding the sales operations.</p>'),
(6, 'Sales Executives', '<p>This role has been mentioned in the literature <strong>&quot;Four Steps To Epiphanny&quot;</strong>. This role is assumed to be a junior role compared to the<strong> VP of Sales</strong>. These executives are directly responsible for the sale of the produced value propositions.</p>'),
(7, 'Partner', '<p>This role has been mentioned in several platforms related literature such as &quot;<strong>Platform Revolution: How Networked Markets Are Transforming The Economy&quot; </strong>and <strong>&quot;Pipelines, Platforms, and the New Rules of Strategy&quot; </strong>where the <strong><u>partners</u></strong> are responsible for bringing the value propositions not developed by the platform owner.</p>'),
(8, 'Earlyvangelists', '<p>This role has been mentioned in <strong>&quot;Four Steps To Epiphanny&quot;. </strong>These are enthusiastic early customers who are willing to not only buy (or participate in) the partially developed value propositions but also provide valuable feedback which can be used to improve the offered value units.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `situational_factor`
--

DROP TABLE IF EXISTS `situational_factor`;
CREATE TABLE IF NOT EXISTS `situational_factor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `variants` longtext COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:array)',
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `situational_factor`
--

INSERT INTO `situational_factor` (`id`, `name`, `variants`, `description`) VALUES
(1, 'All Situations', 'a:1:{i:0;s:14:\"BMD Situations\";}}', '<p>This indicates all situations where it is necessary to develop a new business model. We assume that there could be some methods that can be used in all situations. For example, <strong>Prepare a Product Requirement Document, Prepare Marketing Plan</strong> etc.</p>'),
(2, 'Platform Age', 'a:3:{i:0;s:13:\"Startup Phase\";i:1;s:12:\"Growth Phase\";i:2;s:14:\"Maturity Phase\";}}', '<p>The <strong>Platform Age </strong>situation has been mentioned in the literature <strong>LAUNCH STRATEGIES OF DIGITAL PLATFORMS: PLATFORMS WITH SWITCHING AND NON-SWITCHING USERS. </strong>The author here speaks about three kinds of <strong>Platform Age</strong> i.e. Startup Phase, Grwoth Phase and Maturity Phase.</p>'),
(3, 'Customer Retention Rate', 'a:1:{i:0;s:3:\"Low\";}}', '<p>This situation has been mentioned in <strong>Platform Revolution: How Networked Markets Are Transforming The Economy </strong>where BranchOut and ChatRoulette struggled with retaining customers due to no activity and negative network effect respectively.</p>'),
(4, 'Customer Known', 'a:2:{i:0;s:2:\"No\";i:1;s:3:\"Yes\";}}', '<p>This situation has been mentioned in the literature <strong>Four Steps To Epiphany. </strong>The situation <strong>Customer Known: No </strong>means that the business owner is not sure whether the customers would be interested in the value propositions that she/he is going to provide. The situation <strong>Customer Known: Yes </strong>means that the business owner is sure that that the customers would be very much willing to consume the value propositions offered by him/her.</p>'),
(5, 'Simultaneous Entry', 'a:2:{i:0;s:3:\"Yes\";i:1;s:2:\"No\";}}', '<p>The <strong>Simultaneous Entry </strong>situation has been coined from the literature <strong>LAUNCH STRATEGIES OF DIGITAL PLATFORMS: PLATFORMS WITH SWITCHING AND NON-SWITCHING USERS</strong>. The situation <strong>Simultaneous Entry: Yes </strong>means that both producers and consumers are given high priority during acquiring customers. Whereas the situation <strong>Simultaneous Entry: No </strong>means either the producers or the customers are acquired first.</p>\r\n\r\n<p>Example of <strong>Simultaneous Entry: No </strong>situation is when RedBus first acquired the bus operators by providing them bus seating arrangement software. When enough bus operators were on board, RedBus opened its business to the opposite side i.e. the bus passengers. Example of <strong>Simultaneous Entry: Yes </strong>situation is when Airbnb acquired both the apartment owners and the travellers simultaneous as the producers and consumers respectively.</p>'),
(6, 'Compitition', 'a:2:{i:0;s:12:\"Late Entrant\";i:1;s:9:\"Incumbent\";}}', '<p>This situation can be observed in several platforms related literature such as <strong>LAUNCH STRATEGIES OF DIGITAL PLATFORMS: PLATFORMS WITH SWITCHING AND NON-SWITCHING USERS (1) </strong>and <strong>Platform Revolution: How Networked Markets Are Transforming The Economy (2)</strong>. We can find two variants of competition i.e. late entrant platforms and incumbent platforms. In (1), we can find Amazon Fire was in a <strong>late entrant competition situation </strong>compared to Google Android who was in an incumbent competition situation. A similar situation can be observed in (2) as well between two digital platforms YouTube and Vimeo where the former was in an incumbent competition situation whereas the latter was in a late entrant situation.</p>'),
(7, 'Market Type', 'a:3:{i:0;s:3:\"New\";i:1;s:8:\"Existing\";i:2;s:5:\"Niche\";}}', '<p>In &quot;<strong>Four Steps To Epiphanny</strong>&quot;, the author speaks about three kinds of the market as follows:</p>\r\n\r\n<ol>\r\n	<li><em>The new market</em>: This means that there are no competitors in the market who are offering exactly the same value propositions.</li>\r\n	<li><em>The existing market</em>: This means that there are already competitors in the market who are offering exactly the same value propositions.</li>\r\n	<li><em>The niche market</em>: This means that there are already competitors in the market however these competitors are not providing the value propositions offered by the business owner.</li>\r\n</ol>\r\n\r\n<p>These three situations have also been illustrated in <strong>Platform Revolution: How Networked Markets Are Transforming The Economy </strong>between three video sharing platforms: YouTube, MegaUpload and Vimeo.</p>'),
(8, 'Variety Level', 'a:3:{i:0;s:4:\"Less\";i:1;s:8:\"Balanced\";i:2;s:4:\"High\";}}', '<p>This situational factor has been mentioned in the literature &quot;<strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</strong>&quot;. This situation has three stages as follows:</p>\r\n\r\n<ol>\r\n	<li><em>High Variety</em>: This means high diversification which is necessary during the initial stage of any digital platform. A diverse set of applications are required to attract more consumers so that a network effect can be created. Google&#39;s Android Store is an example of a highly varied platform where developers have full liberty for innovation.</li>\r\n	<li><em>Low Variety: </em>This means low diversification. Too much diversification can change the image of any platform negatively in terms of low quality or irrelevant or harmful products. Apple&#39;s App store is an example of a platform with low variety where the developers do not have a free hand regarding innovation.</li>\r\n	<li><em>Balanced Variety</em>: In this situation, the variety is neither too high nor too low.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>'),
(9, 'Openness Level', 'a:3:{i:0;s:4:\"High\";i:1;s:3:\"Low\";i:2;s:8:\"Balanced\";}}', '<p>This situational factor has been mentioned in the literature &quot;<strong>Four Tactics for Implementing a Balanced Digital Platform Strategy</strong>&quot;. This situation has three stages as follows:</p>\r\n\r\n<ol>\r\n	<li><em><strong>High</strong></em>: In this situation, the platform is too open and provides many resources freely to the app developers to produce innovative applications for the platform. Google&#39;s relaxed policy of allowing the Android operating system to be installed on any device is an example of a high level of openness.</li>\r\n	<li><strong><em>Low</em></strong>: In this situation, resources are not freely available anymore. Even if the resources are available freely their usage comes with terms and conditions. Google changed its open source policy for Google Maps and rebranded it under a proprietary license so that copy-cat platforms such as Amazon Fire can not copy it anymore. This attitude of Google is an example of a low level of opennes.</li>\r\n	<li><em><strong>Balanced</strong></em>: In this situation, the attitude of a digital platform is not too much open or not too much closed.</li>\r\n</ol>'),
(10, 'Network Effect', 'a:1:{i:0;s:8:\"Negative\";}}', '<p>A negative network effect is created due to poor curation of value propositions. For example, Chatroulette was a platform that provided free video chat services without any user registration. Furthermore, there was no filter to restrict indecent behaviours during the video chat. As a result, many naked men showed up to video chat with decently dressed users. This resulted in too much negative experience or effect and eventually caused the collapse of Chatroulette.</p>\r\n\r\n<p><strong>Source: </strong>Pipelines, Platforms, and the New Rules of Strategy</p>');

-- --------------------------------------------------------

--
-- Table structure for table `situational_method`
--

DROP TABLE IF EXISTS `situational_method`;
CREATE TABLE IF NOT EXISTS `situational_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `platform_owner_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `platform_owner_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `platform_owner_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `platform_owner_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `json_nodes` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `json_edges` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `json_tasks` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `bmd_graphs_being_used` longtext COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:array)',
  `graphs_and_their_situational_factors` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `enacted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tool`
--

DROP TABLE IF EXISTS `tool`;
CREATE TABLE IF NOT EXISTS `tool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `variants` longtext COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:array)',
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tool`
--

INSERT INTO `tool` (`id`, `type`, `variants`, `description`) VALUES
(1, 'Drawing Tool', 'a:3:{i:0;s:4:\"Gimp\";i:1;s:5:\"Figma\";i:2;s:5:\"Visio\";}}', '<p>This tool is required during drawing a hypothetical or concrete business model. It can also be used for other artifacts such as designing a landing page, designing an MVP etc. There are several kinds of drawing tools available such as Gimp, Figma, Visio etc.</p>\r\n<tmpopup style=\"top: 0px; left: 470px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup><tmpopup style=\"top: 0px; left: 470px;\"><tmpopupcolor id=\"tmpopupcolor--1\" style=\"background: rgb(221, 153, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--2\" style=\"background: rgb(102, 187, 255) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--3\" style=\"background: rgb(85, 255, 85) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--4\" style=\"background: rgb(255, 102, 102) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--5\" style=\"background: rgb(255, 204, 0) none repeat scroll 0% 0%;\"></tmpopupcolor><tmpopupcolor id=\"tmpopupcolor--m\" style=\"background: rgb(255, 238, 0) none repeat scroll 0% 0%;\"></tmpopupcolor></tmpopup>'),
(2, 'Tool for Finding Professional Contacts', 'a:2:{i:0;s:6:\"Hunter\";i:1;s:10:\"ContactOut\";}}', '<p>This kind of tool might be required during searching for earlyvangelists who can be interviewed to validate business-related hypotheses. We found several tools that can help a platform owner in finding professional contacts such as <strong>Hunter, ContactOut.</strong></p>\r\n\r\n<p>The idea of this tool type has been taken from the following source:</p>\r\n\r\n<p><strong>Source: </strong>https://thebdschool.com/business-development-tools/</p>'),
(3, 'Calling Tool', 'a:3:{i:0;s:15:\"Microsoft Teams\";i:1;s:5:\"Skype\";i:2;s:7:\"Discord\";}}', '<p>This kind of tool might be required during searching and reaching out to the earlyvangelists who can be interviewed to validate business-related hypotheses. We found several tools that can help a platform owner in finding professional contacts such as <strong>Microsoft Teams, Skype.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The idea of this tool type has been taken from the following source:</p>\r\n\r\n<p><strong>Source: </strong>https://thebdschool.com/business-development-tools/</p>'),
(4, 'Social Media Scheduling Tool', 'a:2:{i:0;s:9:\"HootSuite\";i:1;s:12:\"LinkedHelper\";}}', '<p>We already discussed <strong>that online ads </strong>can be used to test business hypotheses such as customer segments, value propositions and channels. These ads are usually posted on social networks for exposure to a large audience. There are several tools available in the market that can help select audience types and provide results such as Ads impressions. These tools can make the activity of online Ads more efficient and effective. Some of these tools are HootSuite, LinkedHelper etc.</p>\r\n\r\n<p>The idea of this tool type has been taken from the following source:</p>\r\n\r\n<p><strong>Source: </strong>https://thebdschool.com/business-development-tools/</p>'),
(5, 'IDE Tool', 'a:3:{i:0;s:9:\"Php Storm\";i:1;s:13:\"Visual Studio\";i:2;s:12:\"Code Igniter\";}}', '<p>IDE stands for Integrated Development Environment. We discussed that an MVP is required during methods such as <em>Customer Discovery</em> to find customers for a business and also during <em>Single MVP Test </em>to validate the offered value propositions. It is evident that application developers are going to develop this MVP and they are going to use an IDE to develop an MVP or a landing page. There are several IDEs available in the market such as Visual Studio, PhpStorm, Code Igniter etc</p>'),
(6, 'Version Control Tool', 'a:2:{i:0;s:6:\"GitHub\";i:1;s:6:\"GitLab\";}}', '<p>A version control tool can help developers to save different versions of their programming code and also serve as a tool for collaboration. The two most famous version control tools available are <em>GitHub </em>and <em>GitLab</em>.</p>'),
(7, 'Report Writing Tool', 'a:2:{i:0;s:16:\"Google Docs Word\";i:1;s:21:\"Microsoft Share Point\";}}', '<p>This tool is required during the writing and storing of information about a hypothetical or concrete business model. We recommend some cloud-based document writing tools such as Google Docs Word, Microsoft Share Point etc.</p>'),
(8, 'Video Making Tool', 'a:4:{i:0;s:11:\"Smart Phone\";i:1;s:6:\"Go Pro\";i:2;s:15:\"DJI Pocket Osmo\";i:3;s:9:\"Camcorder\";}}', '<p>This tool is required during creating an <strong>Explainer Video. </strong>An explainer video as the name suggests explains the value propositions of any business. Usually, explainer videos are used to test the hypotheses about the value propositions by posting the video on any social network platform and tracking how many people watched the video. There are several tools using which videos can be made such as any smartphone, cam coders, Go Pro, DJI Pocket Osmo etc</p>');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `employee_name` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_counter` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649EBFA3441` (`employee_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `employee_name`, `roles`, `password`, `password_reset_counter`) VALUES
(1, 'james@anderson.com', 'James Anderson', '[\"ROLE_SUPER_ADMIN\"]', '$2y$13$ELs52GRh0YcMTb4H1QYLoeeWrFO262F6hQoGeB0rO2aTM17ejOHX6', 0),
(2, 'saul@brown.com', 'Saul Brown', '[\"ROLE_PROJECT_MANAGER\"]', '$2y$13$tRlBcHUMoNJPTxEPBcgvluSOuJTstRaExJOgFoCqnzD48pmMCI0me', 0),
(3, 'alexander@belov.com', 'Alexander Belov', '[\"ROLE_PLATFORM_OWNER\"]', '$2y$13$EUXulUqu7MJF.hMznmsMh.55Y7xdmK3XJ.yJ9MJfwdmyKjwgPTXbm', 0),
(4, 'walter@white.com', 'Walter White', '[\"ROLE_METHOD_ENGINEER\"]', '$2y$13$g9g8yopNJTXalUm4MZc8HO5p8MIHxklhXeMvQOKMGEVrCzwKIRohS', 0),
(5, 'peter@gates.com', 'Peter Gates', '[\"ROLE_WEB_DEVELOPER\"]', '$2y$13$.1L6y84Y94LHfD.FyiTIXO9U9lPTM2Ai/KxKFQW9JlGBCLRIttyH6', 0),
(6, 'adam@black.com', 'Adam Black', '[\"ROLE_WEB_DEVELOPER\"]', '$2y$13$XyQTdq3NFFcKopreof/N4OZ7Rux9nHvF8qP2dCTSKZzLrMH6tNGEu', 0),
(7, 'joyita@ambett.com', 'Joyita Ambett', '[\"ROLE_MARKETING_VP\"]', '$2y$13$LZfmTvE2l01la08sB0g1iuzDvaBOe4QnaiD2XAl87IbG/Q5eGwX5a', 0),
(8, 'jane@brown.com', 'Jane Brown', '[\"ROLE_MARKETING_MANAGER\"]', '$2y$13$nif9vdXiGLiRq0DLP6Xot.GsA0jTvMytIF7y2kOgNGeUPLKcviSqC', 0),
(9, 'samir@baptist.com', 'Samir Baptist', '[\"ROLE_MARKETING_EXECUTIVE\"]', '$2y$13$D3fyrqlg34anXklR7QO/c.uE7DRWRY.bc5jg70bcLdfQTvPhRkT22', 0),
(10, 'amanda@wilson.com', 'Amanda Wilson', '[\"ROLE_SALES_VP\"]', '$2y$13$THLvmcxFQcTGnquV7uxeN.CEllURggWHxC534mQkV6c1J2YfFr.vu', 0),
(11, 'daniel@yeh.com', 'Daniel Yeh', '[\"ROLE_SALES_MANAGER\"]', '$2y$13$dioseYzbmoIRBNgJ5w8OHeocA4GZhSCEbkpmhzJsPwD4JeghbuEMe', 0),
(12, 'xavier@selvan.com', 'Xavier Selvan', '[\"ROLE_SALES_EXECUTIVE\"]', '$2y$13$18ZocUYOekN4bqqg4bjzE.A8Tb2e217ekrIStA/rASG.JUJ5bkcdK', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bmd_graph`
--
ALTER TABLE `bmd_graph`
  ADD CONSTRAINT `FK_923428F3EFD4F280` FOREIGN KEY (`parent_process_kind_id`) REFERENCES `process_kind` (`id`);

--
-- Constraints for table `bmd_graph_process_kind`
--
ALTER TABLE `bmd_graph_process_kind`
  ADD CONSTRAINT `FK_6AF2F4547818F67C` FOREIGN KEY (`process_kind_id`) REFERENCES `process_kind` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6AF2F454AD2A5234` FOREIGN KEY (`bmd_graph_id`) REFERENCES `bmd_graph` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cancelled_method_block`
--
ALTER TABLE `cancelled_method_block`
  ADD CONSTRAINT `FK_217C617BC2F871C5` FOREIGN KEY (`situational_method_id`) REFERENCES `situational_method` (`id`);

--
-- Constraints for table `method_building_block`
--
ALTER TABLE `method_building_block`
  ADD CONSTRAINT `FK_534814707EC2F574` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`);

--
-- Constraints for table `method_building_block_role`
--
ALTER TABLE `method_building_block_role`
  ADD CONSTRAINT `FK_C3FA08996419B3C4` FOREIGN KEY (`method_building_block_id`) REFERENCES `method_building_block` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C3FA0899D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `method_building_block_tool`
--
ALTER TABLE `method_building_block_tool`
  ADD CONSTRAINT `FK_B460BC226419B3C4` FOREIGN KEY (`method_building_block_id`) REFERENCES `method_building_block` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B460BC228F7B22CC` FOREIGN KEY (`tool_id`) REFERENCES `tool` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_BF5476CAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `process`
--
ALTER TABLE `process`
  ADD CONSTRAINT `FK_861D1896EFD4F280` FOREIGN KEY (`parent_process_kind_id`) REFERENCES `process_kind` (`id`);

--
-- Constraints for table `process_kind`
--
ALTER TABLE `process_kind`
  ADD CONSTRAINT `FK_D42D6EECEFD4F280` FOREIGN KEY (`parent_process_kind_id`) REFERENCES `process_kind` (`id`);

--
-- Constraints for table `process_process_kind`
--
ALTER TABLE `process_process_kind`
  ADD CONSTRAINT `FK_BE933BDD7818F67C` FOREIGN KEY (`process_kind_id`) REFERENCES `process_kind` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BE933BDD7EC2F574` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
