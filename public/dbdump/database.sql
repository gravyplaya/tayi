-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 09:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nnnndddd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `image`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@demo.com', '$2y$10$.vb8H6WFgspJSrr86hmnYuZFoty8ZYzO3IA9x6aDnjFGS3SsUSrrS', 'z9E9RBLLwVocI7EHfAso6oEBOmpm8WP9NKX3kzrPgx1niT92kZTdUO0J6xK8', '2023-03-16-6412d535b0a59.png', '2023-02-16 10:51:49', '2023-03-27 10:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `tokens` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `name`, `icon`, `tokens`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Milestone 1', '2023-03-17-641400b96ccc4.png', 100, '2023-03-16 08:36:30', '2023-03-17 11:25:05', NULL),
(8, 'Milestone 2', '2023-03-17-6414011cad087.png', 500, '2023-03-16 08:28:55', '2023-03-17 11:26:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon1` varchar(255) NOT NULL,
  `icon1_name` varchar(255) NOT NULL,
  `icon2` varchar(255) NOT NULL,
  `icon2_name` varchar(255) NOT NULL,
  `icon3` varchar(255) NOT NULL,
  `icon3_name` varchar(255) NOT NULL,
  `icon4` varchar(255) NOT NULL,
  `icon4_name` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `multi_logo` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `icon1`, `icon1_name`, `icon2`, `icon2_name`, `icon3`, `icon3_name`, `icon4`, `icon4_name`, `banner`, `content`, `multi_logo`, `created_at`, `updated_at`) VALUES
(1, '2023-03-24-641d72e6444c5.png', 'Freelancer', '2023-03-24-641d72e6580a2.png', 'Copywriter', '2023-03-24-641d72e664777.png', 'Marketer', '2023-03-24-641d72e675217.png', 'Blogger', '2023-03-24-641d72e68523b.png', 'Trusted by 60,000+ freelancers, marketing teams and agencies.', '2023-03-24-641d72e58aade.png,2023-03-24-641d72e6029a1.png,2023-03-24-641d72e615055.png,2023-03-24-641d72e620932.png,2023-03-24-641d72e62cf81.png', NULL, '2023-03-24 09:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `name`, `icon`, `created_at`, `updated_at`) VALUES
(5, 'Social-Media', 'Social Media', '2023-03-17-641409832b597.png', '2023-03-17 12:02:35', '2023-03-17 12:02:35'),
(6, 'Translate-Anything', 'Translate Anything', '2023-03-17-6414099b88fad.png', '2023-03-17 12:02:59', '2023-03-17 12:02:59'),
(7, 'Q-A', 'Q&A', '2023-03-17-641409a864af4.png', '2023-03-17 12:03:12', '2023-03-17 12:03:20'),
(8, 'Subject-Expert', 'Subject Expert', '2023-03-17-641409eadddd3.png', '2023-03-17 12:04:19', '2023-03-17 12:04:19'),
(9, 'Grammar-Check', 'Grammar Check', '2023-03-17-641409fba76b0.png', '2023-03-17 12:04:35', '2023-03-17 12:04:35'),
(10, 'Start-Writing', 'Start Writing', '2023-03-17-64140a137e041.png', '2023-03-17 12:04:59', '2023-03-17 12:04:59'),
(11, 'Write-a-Blog', 'Write a Blog', '2023-03-17-64140a1e02541.png', '2023-03-17 12:05:10', '2023-03-17 12:05:10'),
(12, 'Learn-Coding', 'Learn Coding', '2023-03-17-64140a2c378d3.png', '2023-03-17 12:05:24', '2023-03-17 12:05:24'),
(13, 'Fun---Flip', 'Fun & Flip', '2023-03-17-64140a3b3d273.png', '2023-03-17 12:05:39', '2023-03-17 12:05:39'),
(14, 'Be-a-Director', 'Be a Director', '2023-03-17-64140a4cdb66e.png', '2023-03-17 12:05:57', '2023-03-17 12:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `fav` int(11) NOT NULL DEFAULT 0,
  `chat_name` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT 'English',
  `first_msg` int(11) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `message` longtext DEFAULT NULL,
  `chat_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `framework_id` int(11) DEFAULT NULL,
  `prompt` longtext DEFAULT NULL,
  `tokens` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_answers`
--

CREATE TABLE `chat_answers` (
  `id` int(11) NOT NULL,
  `chat_session` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `answer` longtext NOT NULL,
  `options` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_questions`
--

CREATE TABLE `chat_questions` (
  `id` int(11) NOT NULL,
  `framework_id` int(11) NOT NULL,
  `question` longtext DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `options` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_questions`
--

INSERT INTO `chat_questions` (`id`, `framework_id`, `question`, `name`, `type`, `options`, `created_at`, `updated_at`) VALUES
(15, 5, 'what language do you want to learn?', 'question-1', 'option', 'english, hindi, chinese,french,spanish', '2023-03-11 05:38:35', '2023-03-11 05:38:35'),
(16, 5, 'what is the purpose of learning language?', 'question-2', 'option', 'conversation, interview', '2023-03-11 05:38:35', '2023-03-11 05:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` longtext DEFAULT NULL,
  `resolution` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `footer_blocks`
--

CREATE TABLE `footer_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `main_heading` varchar(255) NOT NULL,
  `list1` varchar(255) NOT NULL,
  `list2` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_blocks`
--

INSERT INTO `footer_blocks` (`id`, `heading`, `main_heading`, `list1`, `list2`, `image`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Boost your writing productivity', 'End writer’s block today', 'No credit card required', 'Cancel anytime', '2023-03-27-6421512f6418f.png', 'It’s like having access to a team of copywriting experts writing powerful copy for you in 1-click.', NULL, '2023-03-27 13:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `frameworks`
--

CREATE TABLE `frameworks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `variant` int(11) NOT NULL DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `chat_icon` varchar(255) DEFAULT NULL,
  `premium` int(11) NOT NULL DEFAULT 1,
  `highlighted` int(11) NOT NULL DEFAULT 0,
  `popular` int(11) NOT NULL DEFAULT 0,
  `system_message` longtext DEFAULT NULL,
  `tone` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `frameworks`
--

INSERT INTO `frameworks` (`id`, `name`, `variant`, `category_id`, `slug`, `description`, `chat_icon`, `premium`, `highlighted`, `popular`, `system_message`, `tone`, `created_at`, `updated_at`) VALUES
(5, 'Language Expert', 0, 3, 'Language-Expert', 'translate text into any language', '1995574.png', 0, 0, 0, 'translate into #question-1# for purpose of #question-2#', 0, '2023-03-10 06:32:00', '2023-03-11 05:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `f_a_q_s`
--

CREATE TABLE `f_a_q_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `f_a_q_s`
--

INSERT INTO `f_a_q_s` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'What is a tayi?', 'Content refers to any published text or written material, this includes blog articles, websites, digital ads, Tayi AI helps you generate any type of copy with the click of a button.', '2023-03-24 06:02:30', '2023-03-27 13:55:52'),
(2, 'Does tayi help to write long articles?', 'Yes, you can write long articles for your blog, product descriptions or any long article with tayi. We\'re always updating our template and tools, so let us know what are expecting!', '2023-03-24 06:05:24', '2023-03-27 13:56:31'),
(3, 'Is the generated content original?', 'Tayi has been voted as the AI writing tool generating with the lowest plagiarism rate: 2%. A rate of 5% is considered reasonable, therefore it\'s safe to say that the generated content is original.', '2023-03-27 07:56:05', '2023-03-27 13:56:57'),
(4, 'How long would it take to write an article with AI?', 'Using tayi would help you to supercharge your content production by writing long articles in minutes, not hours. We estimate that it takes about 5 min to write a long-form article.', '2023-03-27 07:56:29', '2023-03-27 13:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` int(11) NOT NULL,
  `prompt` longtext DEFAULT NULL,
  `results` longtext DEFAULT NULL,
  `token_used` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `prompt_tokens` int(11) NOT NULL DEFAULT 0,
  `response_tokens` int(11) NOT NULL DEFAULT 0,
  `tools` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `resolution` varchar(255) DEFAULT NULL,
  `like_dislike` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home2_boxes`
--

CREATE TABLE `home2_boxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `box_color` varchar(255) DEFAULT NULL,
  `box_heading` varchar(255) NOT NULL,
  `box_content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home2_boxes`
--

INSERT INTO `home2_boxes` (`id`, `icon`, `box_color`, `box_heading`, `box_content`, `created_at`, `updated_at`) VALUES
(1, '2023-03-27-6421522e2421a.png', 'info', 'Tools and templates', 'Using our AI tools and pre-built template to create content briefs, write and optimize content in one place.', NULL, '2023-03-27 13:52:06'),
(2, '2023-03-27-642152640f429.png', NULL, 'Brainstorm faster', 'Use our advanced AI as your personal content writer or partner for your endless work for your business.', '2023-03-27 05:46:09', '2023-03-27 13:53:00'),
(3, '2023-03-27-64213f84aa81d.png', NULL, 'Write content faster', 'You do not need to spend hours to write good content — let our advance AI Writer to get it done.', '2023-03-27 07:02:29', '2023-03-27 07:02:29'),
(4, '2023-03-27-64213fd04b437.png', NULL, 'Repurpose content easily', 'Write and saved once, use everywhere. Also rewrite content for different porpose with minimal effort.', '2023-03-27 07:03:46', '2023-03-27 07:03:46'),
(5, '2023-03-27-64214020cb912.png', NULL, 'Write in Any Language', 'Let AI write for you in over 40 languages. Our AI can write in English, Spanish, French and many more language.', '2023-03-27 07:05:05', '2023-03-27 07:05:05'),
(6, '2023-03-27-642140766dcba.png', NULL, 'Copy and publish anywhere', 'You can simply copy your desire content and then you can publish, like Shopify, WordPress, or anywhere.', '2023-03-27 07:06:30', '2023-03-27 07:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_howto`
--

CREATE TABLE `home_page_howto` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `main_heading` varchar(255) DEFAULT NULL,
  `main_content` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_page_howto`
--

INSERT INTO `home_page_howto` (`id`, `name`, `main_heading`, `main_content`, `created_at`, `updated_at`) VALUES
(1, 'howto', 'Few steps to write content', 'Let our AI assist with most time consuming to write blog articles, product descriptions and more.', '2023-03-23 07:21:53', '2023-03-23 12:20:40'),
(4, 'usecases', 'Generate in seconds using AI', 'Let our AI assist with most time consuming to write blog articles, product descriptions and more.', '2023-03-23 12:33:58', '2023-03-24 04:10:28'),
(5, 'pricing', 'Plans that start free and fits with your needs', 'With our simple plans, supercharge your content writing to helps your business. Let’s make great content together.', '2023-03-24 04:11:18', NULL),
(6, 'faq', 'Frequently Asked Questions', 'If you have any questions notd answered in the FAQ, please do not hesitate to contact us.', '2023-03-24 04:15:16', '2023-03-27 14:02:00'),
(7, 'home2', 'Superpower with AI Writer', 'Let our AI assist with most time consuming to write blog articles, product descriptions and more.', '2023-03-24 04:19:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `how_to_boxes`
--

CREATE TABLE `how_to_boxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `icon` varchar(255) NOT NULL,
  `box_color` varchar(255) NOT NULL DEFAULT 'info',
  `box_heading` varchar(255) NOT NULL,
  `box_content` varchar(255) NOT NULL,
  `box_list` varchar(255) NOT NULL,
  `box_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `how_to_boxes`
--

INSERT INTO `how_to_boxes` (`id`, `section_id`, `icon`, `box_color`, `box_heading`, `box_content`, `box_list`, `box_image`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-03-27-642141ed2f52b.png', 'info', 'Select writing template', 'Simply choose a template from available list to write content for blog posts, landing page, website content etc.', 'Available, more than 10 template.\",A clean and minimalist editor.\",Article generator wizard\"', '2023-03-27-642141edb6040.png', NULL, '2023-03-27 07:12:45'),
(2, 1, '2023-03-27-64214394e0a36.png', 'info', 'Describe your topic', 'Provide our AI content writer with few sentences on what you want to write, and it will start writing for you.', 'Simply provide a few input as topic\",Type a topic like \"best ways to earn money\"\",Facebook Ads, Headlines and other 10+ tools', '2023-03-27-64214395496f0.png', '2023-03-23 09:55:51', '2023-03-27 07:19:49'),
(3, 1, '2023-03-27-642142f405df3.png', 'info', 'Generate quality content', 'Our powerful AI tools will generate content in few second, then you can export it to wherever you need.', 'Generate content in under 30 seconds.\",All content is unique and original.\",Generate up to 200 words each time.', '2023-03-27-642142f36f200.png', '2023-03-27 07:17:08', '2023-03-27 07:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `image_spaces`
--

CREATE TABLE `image_spaces` (
  `id` int(11) NOT NULL,
  `aws` int(11) DEFAULT 0,
  `wasabi` int(11) NOT NULL DEFAULT 0,
  `same_server` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_spaces`
--

INSERT INTO `image_spaces` (`id`, `aws`, `wasabi`, `same_server`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 1, '2023-03-13 06:01:17', '2023-03-13 06:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL DEFAULT 'lang.png',
  `indian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `flag`, `indian`, `created_at`, `updated_at`) VALUES
(1, 'English (American)', '🇺🇸', 0, NULL, NULL),
(2, 'french', '🇫🇷', 0, NULL, NULL),
(4, 'hindi', '🇮🇳', 1, NULL, NULL),
(5, 'English (British)', '🇬🇧', 0, NULL, NULL),
(6, 'russian', '🇷🇺', 0, NULL, NULL),
(7, 'german', '🇩🇪', 0, NULL, NULL),
(8, 'indonesian', '🇮🇩', 0, NULL, NULL),
(9, 'italian', '🇫🇷', 0, NULL, NULL),
(10, 'japanese', '🇯🇵', 0, NULL, NULL),
(11, 'dutch', '🇳🇱', 0, NULL, NULL),
(12, 'polish', '🇵🇱', 0, NULL, NULL),
(13, 'czech', '🇨🇿', 0, NULL, NULL),
(14, 'hungarian', '🇭🇺', 0, NULL, NULL),
(15, 'danish', '🇩🇰', 0, NULL, NULL),
(16, 'spanish', '🇪🇸', 0, NULL, NULL),
(17, 'bulgarian', '🇧🇬', 0, NULL, NULL),
(18, 'chinese (simplified)', '🇨🇳', 0, NULL, NULL),
(19, 'estonian', '🇪🇪', 0, NULL, NULL),
(20, 'finnish', '🇫🇮', 0, NULL, NULL),
(21, 'greek', '🇬🇷', 0, NULL, NULL),
(22, 'portuguese', '🇵🇹', 0, NULL, NULL),
(23, 'Latvian', '🇱🇻', 0, NULL, NULL),
(24, 'Lithuanian', '🇱🇹', 0, NULL, NULL),
(25, 'Romanian', '🇷🇴', 0, NULL, NULL),
(26, 'Slovak', '🇸🇰', 0, NULL, NULL),
(27, 'Slovenian', '🇸🇮', 0, NULL, NULL),
(28, 'Swedish', '🇸🇪', 0, NULL, NULL),
(29, 'Turkish', '🇹🇷', 0, NULL, NULL),
(30, 'Indonesian', '🇮🇩', 0, NULL, NULL),
(31, 'Ukrainian', '🇺🇦', 0, NULL, NULL),
(32, 'Arabic', '🇦🇪', 0, NULL, NULL),
(33, 'Bengali', '🇧🇩', 0, NULL, NULL),
(34, 'Urdu', '🇵🇰', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `licensebox`
--

CREATE TABLE `licensebox` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `license` varchar(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `installed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `licensebox`
--

INSERT INTO `licensebox` (`id`, `status`, `message`, `license`, `client`, `installed_at`, `updated_at`) VALUES
(2, 'active', 'Activated! Thanks for purchasing Aifuse Package.', '11EB-799B-709E-3628', 'demo22', '2023-03-07 04:31:08', '2023-03-07 04:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tokens` int(11) NOT NULL,
  `speech_minutes` int(11) DEFAULT 0,
  `mrp` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `folder_limit` int(11) NOT NULL,
  `project_limit` int(11) NOT NULL,
  `model` varchar(255) NOT NULL DEFAULT 'text-davinci-003',
  `article` int(11) NOT NULL DEFAULT 0,
  `team_limit` int(11) NOT NULL DEFAULT 0,
  `image` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `name`, `tokens`, `speech_minutes`, `mrp`, `price`, `folder_limit`, `project_limit`, `model`, `article`, `team_limit`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Personal Plan', 1000, 10, 0, 0, 10, 25, 'gpt-3.5-turbo', 1, 0, 1, '2023-02-18 12:54:17', '2023-03-24 13:45:00'),
(2, 'Pro Plan', 50000, 50, 200, 500, 0, 0, 'gpt-3.5-turbo', 1, 5, 1, '2023-02-18 12:54:17', '2023-03-21 17:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_16_151953_create_admins_table', 1),
(6, '2023_02_21_043350_add_google_id_column_to_users_table', 2),
(7, '2023_02_21_043743_change_username_column_to_users_table', 3),
(8, '2023_02_21_051746_create_user_email_codes', 4),
(9, '2016_06_01_000001_create_oauth_auth_codes_table', 5),
(10, '2016_06_01_000002_create_oauth_access_tokens_table', 5),
(11, '2016_06_01_000003_create_oauth_refresh_tokens_table', 5),
(12, '2016_06_01_000004_create_oauth_clients_table', 5),
(13, '2016_06_01_000005_create_oauth_personal_access_clients_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `noti_type` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `discrtiption` longtext DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `noti_url` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL COMMENT '0:free,1:paid',
  `read_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `noti_type`, `color`, `title`, `discrtiption`, `icon`, `noti_url`, `user_type`, `read_status`, `created_at`, `updated_at`) VALUES
(4, '1', NULL, 'hey', 'dee', '2023-03-17-64141b8ea0883.png', NULL, '0', 0, '2023-03-17 13:19:35', '2023-03-17 13:19:35'),
(5, '0', NULL, 'Hey', 'this is a test notification', '2023-03-17-641421386939c.png', NULL, '0', 0, '2023-03-17 13:43:44', '2023-03-17 13:43:44'),
(6, '0', NULL, 'hety', 'efdeds', '2023-03-17-6414465e8e2c0.png', NULL, '0', 0, '2023-03-17 16:22:14', '2023-03-17 16:22:14'),
(7, '0', NULL, 'hey', 'deed', '2023-03-17-641447fadceb0.png', NULL, '0', 0, '2023-03-17 16:29:07', '2023-03-17 16:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('2598df6c92cf22e43a6082493bfa7f69aaa2dcc031c4e52504b8bc252e05f4e69310239eab72a6ba', 10, 1, 'MyApp', '[]', 0, '2023-03-10 11:40:41', '2023-03-10 11:40:41', '2024-03-10 17:10:41'),
('3ae0b205e474e1e336db6510990e067c929857129eb426f49ffef403760f1a992a2292395cd09230', 7, 1, 'MyApp', '[]', 0, '2023-03-10 08:14:43', '2023-03-10 08:14:43', '2024-03-10 13:44:43'),
('4510d612b68037562a84bf1f3b79e40b102383e087339e6a58c50706aa80911d23c5c8161d4dcfad', 8, 1, 'MyApp', '[]', 0, '2023-03-10 08:19:10', '2023-03-10 08:19:10', '2024-03-10 13:49:10'),
('7bf68281d1be7fbf60cf3d41ccd0464d214e356ba53f5222ea8d830d0b079768dbb2cd77785f7a54', 8, 1, 'MyApp', '[]', 0, '2023-03-10 08:18:01', '2023-03-10 08:18:01', '2024-03-10 13:48:01'),
('811689b2c18abebc9a1637906688ec957c6721fa8c8700d16e4ccdd42fcd49c8697b45612693b8ed', 8, 1, 'MyApp', '[]', 0, '2023-03-10 09:00:38', '2023-03-10 09:00:39', '2024-03-10 14:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'AIfuse Personal Access Client', '6jfrgKCAwjUtiwPnKzNerJGWjxbCqJTXuM61zcWc', NULL, 'http://localhost', 1, 0, 0, '2023-03-10 07:52:25', '2023-03-10 07:52:25'),
(2, NULL, 'AIfuse Password Grant Client', 'DMZyNI7JaO5eSypqnXwBW2cKfoVRrhxQSaeeC4AL', 'users', 'http://localhost', 0, 1, 0, '2023-03-10 07:52:25', '2023-03-10 07:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-03-10 07:52:25', '2023-03-10 07:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `secret`, `api_key`, `active`, `created_at`, `updated_at`) VALUES
(1, 'razorpay', 'hUAzUVQc6gefXBgke4XN3rG', 'rzp_test_xvdKyeZsdffWxv8', 0, '2023-02-13 10:37:11', '2023-03-21 08:36:14'),
(2, 'stripe', 'sk_test_51MdXKpk18MNssFzPHeT3vNZLMUneVu0IwZGsku4Ky2a32rZRtp1VLZ6BUF2ZM9BwxFMrmT1brp1NZFok0a9W00QgNwqmpQ', 'pk_test_51MdXKpSIHkkFEYDroDEt3HxMRUsLZp9H4TijdzZtuKnIJhb7xvquSaH4s0a7KAO4CfvVPvz09GfhWjArtH00qOEeRv2r', 1, '2023-02-13 10:37:11', '2023-03-07 06:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `tokens` int(11) NOT NULL,
  `mrp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `tokens`, `mrp`, `price`, `created_at`, `updated_at`) VALUES
(1, 5000, 12000, 10, '2023-02-13 03:06:01', '2023-03-21 17:45:35'),
(2, 50000, 200, 75, NULL, '2023-03-21 17:45:52'),
(3, 100000, 300, 100, NULL, '2023-03-21 17:45:58'),
(4, 500000, 400, 250, NULL, '2023-03-21 17:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_sections`
--

CREATE TABLE `pricing_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `main_title` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `btn_text` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `list_text` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricing_sections`
--

INSERT INTO `pricing_sections` (`id`, `name`, `main_title`, `title`, `content`, `btn_text`, `heading`, `list_text`, `created_at`, `updated_at`) VALUES
(1, 'paid', 'Pro', 'For content marketers, bloggers, freelancers & startups', 'Try out all features to determine what works best for you', 'Start Free Trial', 'Everything in Free, plus month', '\nPro Templates\",Blog Wizard Tool\",AI Images, Chat & Speech to Text', NULL, NULL),
(2, 'free', 'Forever', 'Access to AI writer features to help you get a taste of AI writing.', 'Try out all features to determine what works best for you', 'Start Free Trial', 'Give a try for free', 'Free Templates\",Blog Wizard Tool', NULL, NULL),
(3, 'custom', 'Custom', 'Design your custom package for teams and business needs', 'Take your business to the another level with custom package and support.', 'Start Free Trial', 'Everything in Pro, plus', 'Custom number of users\",Custom number of words\",Manage team member\",Premium support', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `template` int(11) DEFAULT NULL,
  `folder` int(11) DEFAULT NULL,
  `text` longtext DEFAULT NULL,
  `project_text` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `resolution` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'Tayi | Write anything', '2023-02-13 08:56:47', '2023-02-13 08:56:47'),
(2, 'per_token', '2', '2023-02-13 08:57:09', '2023-02-13 08:57:09'),
(3, 'currency_name', 'INR', '2023-02-13 09:38:12', '2023-02-13 09:38:12'),
(4, 'currency_symbol', '₹', '2023-02-13 09:38:33', '2023-02-13 09:38:33'),
(5, 'logo', '2023-03-27-642151cd10153.png', '2023-02-13 09:38:33', '2023-02-13 09:38:33'),
(6, 'favicon', '2023-03-27-642151cd31cd2.png', '2023-02-13 09:39:28', '2023-02-13 09:39:28'),
(7, 'open_ai', 'sk-FFFHFGFf5zahwirrtepT3BlbkFJM5Ttnhwp2c5asdbh', '2023-02-17 11:35:19', '2023-02-17 11:35:19'),
(8, 'words_per_image', '250', '2023-02-24 10:21:12', '2023-02-24 10:21:12'),
(9, 'open_ai_model', 'chatGPT', NULL, NULL),
(10, 'footer_text1', 'Copyright © 2023', '2023-03-04 11:50:46', '2023-03-04 11:50:46'),
(11, 'footer_text2', 'Handcrafted With ♥️', '2023-03-04 11:50:46', '2023-03-04 11:50:46'),
(12, 'footer_logo', '2023-03-27-642151cd3befb.png', '2023-03-06 05:52:23', '2023-03-06 05:52:23'),
(13, 'facebook', 'https://facebook.com', '2023-03-06 06:36:48', '2023-03-06 06:36:48'),
(14, 'twitter', 'https://twitter.com', '2023-03-06 06:36:48', '2023-03-06 06:36:48'),
(15, 'google', 'https://www.google.com', '2023-03-06 06:37:11', '2023-03-06 06:37:11'),
(16, 'btncolor', '#0e1cfc', '2023-03-16 11:26:40', '2023-03-16 11:26:40'),
(17, 'deep_ai', '86f3see1-5545-4awae-8f6a-6f0fd50', '2023-03-17 14:23:36', '2023-03-17 14:23:36'),
(18, 'image_model', 'dall', '2023-03-17 14:24:54', '2023-03-17 14:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `sub_memberships`
--

CREATE TABLE `sub_memberships` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `months` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sub_memberships`
--

INSERT INTO `sub_memberships` (`id`, `type`, `mem_id`, `discount`, `months`, `days`, `created_at`, `updated_at`) VALUES
(1, 'Monthly', 2, 0, 1, NULL, '2023-02-18 12:57:49', '2023-03-06 23:35:03'),
(4, 'Yearly', 2, 50, 12, NULL, '2023-02-18 12:59:34', '2023-03-27 13:54:23'),
(5, 'free-trial', 1, 0, NULL, 15, '2023-02-18 12:59:34', '2023-03-06 23:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `variant` int(11) NOT NULL DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `chat_icon` varchar(255) DEFAULT NULL,
  `premium` int(11) NOT NULL DEFAULT 1,
  `highlighted` int(11) NOT NULL DEFAULT 0,
  `popular` int(11) NOT NULL DEFAULT 0,
  `prompt` longtext DEFAULT NULL,
  `tone` int(11) NOT NULL DEFAULT 1,
  `system_message` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `name`, `variant`, `category_id`, `slug`, `description`, `icon`, `chat_icon`, `premium`, `highlighted`, `popular`, `prompt`, `tone`, `system_message`, `created_at`, `updated_at`) VALUES
(3, 'Generate Product Name', 0, 10, 'Generate-Product-Name', 'generate product names', '2023-03-17-64140ba206802.png', NULL, 0, 0, 1, 'Generate product names with  Product description  : #field-1# Seed Words:  #field-2#', 0, 'Generate Product name', '2023-03-07 03:58:21', '2023-03-23 13:12:03'),
(6, 'Ask me anything', 0, 7, 'Ask-me-anything', 'Ask me anything', '2023-03-17-64140c571c712.png', 'def.png', 0, 1, 0, 'Please answer the following question #field-1#', 0, 'You are a helpful assistant', '2023-03-17 12:14:39', '2023-03-17 12:29:30'),
(7, 'Explain me like a kid', 1, 8, 'Explain-me-like-a-kid', 'SUMMARIZE TO EASY', '2023-03-17-64140d0060ab4.png', 'def.png', 0, 0, 0, 'Kindly summarize the following content into easy - #field-1#', 1, 'You are a helpful assistant', '2023-03-17 12:17:28', '2023-03-17 13:12:41'),
(8, 'Translate Anything', 0, 6, 'Translate-Anything', 'To any language', '2023-03-17-64140de1e9d1e.png', 'def.png', 0, 0, 0, 'Translate the #field-1#', 0, 'You are a helpful assistant', '2023-03-17 12:20:56', '2023-03-17 13:16:02'),
(9, 'Write a Facebook Post', 0, 5, 'Write-a-Facebook-Post', 'write a facebook post', '2023-03-17-64140ed00b659.png', 'def.png', 0, 0, 1, 'write a short facebook post on the topic #field-1# covering keywords: #field-2#.', 0, 'You are a Facebook content expert.', '2023-03-17 12:25:12', '2023-03-22 21:00:01'),
(10, 'Write a Linkedin Post', 0, 5, 'Write-a-Linkedin-Post', 'write a pro Linkedin post', '2023-03-17-64140f3cd928c.png', NULL, 1, 0, 1, 'write a short linkedin post on #field-1# covering keywords like #field-2# and target #field-3# as my audience.', 0, 'You are a helpful assistant', '2023-03-17 12:27:01', '2023-03-17 13:05:21'),
(11, 'Write a Tweet', 0, 5, 'Write-a-Tweet', 'Compose a tweet', '2023-03-17-64140f9b06d3d.png', NULL, 1, 1, 0, 'write a short twitter post on #field-1# covering keywords like #field-2# and target #field-3# as my audience.', 0, 'You are a helpful assistant', '2023-03-17 12:28:35', '2023-03-17 12:29:34'),
(12, 'Classify', 1, 8, 'Classify', 'Break into classes', '2023-03-17-6414106eb614c.png', NULL, 0, 0, 1, 'Classify the following content #field-1#', 1, 'You are a helpful assistant', '2023-03-17 12:31:28', '2023-03-17 12:44:13'),
(13, 'Movie name to Emoji', 0, 13, 'Movie-name-to-Emoji', 'Turn the movie name', '2023-03-17-641410d7931a6.png', NULL, 0, 0, 0, 'Convert the movie name into emoji, movie name is #field-1#', 0, 'You are a helpful assistant', '2023-03-17 12:33:51', '2023-03-17 12:44:08'),
(14, 'Generate Keywords', 1, 5, 'Generate-Keywords', 'Get quality keywords', '2023-03-17-6414112d9260c.png', NULL, 0, 0, 1, 'Generate keywords from the content #field-1#', 1, 'You are a helpful assistant', '2023-03-17 12:35:17', '2023-03-17 12:44:05'),
(15, 'Generate Product Ad', 0, 5, 'Generate-Product-Ad', 'Ads for Social media', '2023-03-17-641411e2426a7.png', NULL, 0, 0, 0, 'Write a #field-2# ad for the product #field-1# with a target audience #field-3#', 0, 'You are a helpful assistant', '2023-03-17 12:38:18', '2023-03-17 12:54:27'),
(16, 'Factual Answers', 1, 8, 'Factual-Answers', 'Get your facts right', '2023-03-17-6414126630402.png', NULL, 0, 0, 1, 'Give me a factual answer for #field-1#', 1, 'You are a helpful assistant', '2023-03-17 12:40:30', '2023-03-17 12:43:58'),
(17, 'Spreashsheet Creator', 1, 8, 'Spreashsheet-Creator', 'Get the details in the table form', '2023-03-17-6414131b44444.png', NULL, 1, 1, 0, 'Generate a spreadsheet for the following topic: #field-1#', 1, 'You are a helpful assistant', '2023-03-17 12:43:31', '2023-03-17 13:03:11'),
(18, 'Write a Horror Story', 1, 14, 'Write-a-Horror-Story', 'This story will be unique & scary', '2023-03-17-6414142382627.png', NULL, 0, 0, 0, 'write a short horror story on #field-1#', 0, 'You are a helpful assistant', '2023-03-17 12:47:55', '2023-03-17 12:52:33'),
(19, 'Convert to 3rd person', 0, 9, 'Convert-to-3rd-person', 'This is an English exercise.', '2023-03-17-64141531d14ae.png', NULL, 1, 0, 0, 'Convert this from first-person to third-person ( gender #field-2#) : #field-1#', 0, 'You are a helpful assistant', '2023-03-17 12:52:26', '2023-03-17 12:52:39'),
(20, 'Interview Questions', 0, 8, 'Interview-Questions', 'Create interview questions.', '2023-03-17-6414167abf078.png', NULL, 0, 0, 0, 'Create a list of #field-2# questions for my interview with a #field-1#', 0, 'You are a helpful assistant', '2023-03-17 12:57:54', '2023-03-23 13:12:08'),
(21, 'Notes to Summary', 1, 10, 'Notes-to-Summary', 'Automatically generate Notes to summary', '2023-03-17-6414170910290.png', NULL, 1, 1, 0, 'Convert my short hand into a first-hand account of the meeting: #field-1#', 1, 'You are a helpful assistant', '2023-03-17 13:00:17', '2023-03-17 13:02:47'),
(22, 'Recipe Creator', 1, 13, 'Recipe-Creator', 'Eat at your own risk', '2023-03-17-6414178f8555f.png', NULL, 0, 0, 0, 'Write a recipe based on these ingredients: #field-2# and instructions: #field-1#', 1, 'You are a helpful assistant', '2023-03-17 13:02:31', '2023-03-23 13:12:13'),
(23, 'Create study notes', 1, 8, 'Create-study-notes', 'Create study notes.', '2023-03-17-641418267c6f8.png', NULL, 0, 0, 1, 'What are #field-2# key points I should know when studying #field-1#?', 1, 'You are a helpful assistant', '2023-03-17 13:05:02', '2023-03-23 13:34:29'),
(24, 'Blog Outline', 0, 11, 'Blog-Outline', 'write a blog outline in seconds.', '2023-03-17-641418978adba.png', NULL, 1, 0, 0, 'write a blog outline for the topic #field-1#', 0, 'You are a helpful assistant', '2023-03-17 13:06:55', '2023-03-17 13:07:46'),
(25, 'Blog Intro', 0, 11, 'Blog-Intro', 'write a blog intro in seconds.', '2023-03-17-641418be61278.png', NULL, 0, 0, 0, 'write a blog intro for the topic #field-1#', 0, 'You are a helpful assistant', '2023-03-17 13:07:34', '2023-03-23 13:12:20'),
(26, 'Restaurant review creator', 1, 13, 'Restaurant-review-creator', 'Write a review for the restaurant', '2023-03-17-6414193f94db5.png', NULL, 1, 0, 0, 'Write a restaurant review based on these notes: #field-1#', 0, 'You are a helpful assistant', '2023-03-17 13:09:43', '2023-03-17 13:09:43'),
(27, 'JS to Python', 1, 12, 'JS-to-Python', 'Convert javascript into python', '2023-03-17-641419e81ae5a.png', NULL, 1, 0, 1, 'JavaScript to Python: #field-1#', 1, 'You are a helpful assistant', '2023-03-17 13:12:32', '2023-03-17 13:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `template_fields`
--

CREATE TABLE `template_fields` (
  `id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `field_type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `template_fields`
--

INSERT INTO `template_fields` (`id`, `template_id`, `field_name`, `description`, `field_type`, `name`, `created_at`, `updated_at`) VALUES
(14, 4, 'title', 'title', 'textarea', 'field-1', '2023-03-07 06:54:01', '2023-03-07 06:54:01'),
(29, 6, 'Write your Question', 'e.g. who is the prime minister of India?', 'text', 'field-1', '2023-03-17 12:14:39', '2023-03-17 12:14:39'),
(30, 7, 'Post the Write up', 'e.g. paragraph', 'text', 'field-1', '2023-03-17 12:17:28', '2023-03-17 12:17:28'),
(48, 10, 'Write Title', 'e.g. AI, Startups, Stock Market, etc...', 'text', 'field-1', '2023-03-17 12:27:01', '2023-03-17 12:27:01'),
(49, 10, 'Write some keywords', 'e.g. latest trends, b2b, b2c, consumer,', 'text', 'field-2', '2023-03-17 12:27:01', '2023-03-17 12:27:01'),
(50, 10, 'Target Audience', 'e.g. Professionals, Followers, Founders etc.', 'text', 'field-3', '2023-03-17 12:27:01', '2023-03-17 12:27:01'),
(51, 11, 'Write Title', 'e.g. AI, Startups, Stock Market, etc...', 'text', 'field-1', '2023-03-17 12:28:35', '2023-03-17 12:28:35'),
(52, 11, 'Write some keywords', 'e.g. trip to jaipur, summers, family time, etc.', 'text', 'field-2', '2023-03-17 12:28:35', '2023-03-17 12:28:35'),
(53, 11, 'Target Audience', 'e.g. Family, Friends, Followers, etc.', 'text', 'field-3', '2023-03-17 12:28:35', '2023-03-17 12:28:35'),
(55, 12, 'Post here', 'e.g. apple, banana, Motorola, luxury', 'text', 'field-1', '2023-03-17 12:32:06', '2023-03-17 12:32:06'),
(56, 13, 'Enter the movie name', 'e.g. titanic, border, sholey,', 'text', 'field-1', '2023-03-17 12:33:51', '2023-03-17 12:33:51'),
(57, 14, 'Enter Text (from which you want to extract keywords)*', 'e.g. any content', 'text', 'field-1', '2023-03-17 12:35:17', '2023-03-17 12:35:17'),
(58, 15, 'Write the Product Description', 'e.g. AI, Startups, Stock Market, etc...', 'text', 'field-1', '2023-03-17 12:38:18', '2023-03-17 12:38:18'),
(59, 15, 'Platform Type', 'e.g. facebook, google, linkedin, twitter,...', 'text', 'field-2', '2023-03-17 12:38:18', '2023-03-17 12:38:18'),
(60, 15, 'Target Audience', 'e.g. Parents, Kids, Professionals, Customers etc.', 'text', 'field-3', '2023-03-17 12:38:18', '2023-03-17 12:38:18'),
(61, 16, 'Write your Question', 'e.g. who is the prime minister of India?', 'text', 'field-1', '2023-03-17 12:40:30', '2023-03-17 12:40:30'),
(62, 17, 'Write subject matter', 'e.g. recent movies with release dates and collections, india upcoming cricket matches with schedule...', 'text', 'field-1', '2023-03-17 12:43:31', '2023-03-17 12:43:31'),
(63, 18, 'Write the subject (on which you want to create short horror story)', 'e.g. a nightmare, a scary passenger, the neighbour,', 'text', 'field-1', '2023-03-17 12:47:55', '2023-03-17 12:47:55'),
(64, 19, 'Write the text (which you want to convert to third person)', 'e.g. I decided to make a movie about Ada Lovelace.', 'text', 'field-1', '2023-03-17 12:52:26', '2023-03-17 12:52:26'),
(65, 19, 'Gender', 'e.g. male, female', 'text', 'field-2', '2023-03-17 12:52:26', '2023-03-17 12:52:26'),
(66, 20, 'Job Position', 'e.g. software developer, data analyst, telecaller,', 'text', 'field-1', '2023-03-17 12:57:54', '2023-03-17 12:57:54'),
(67, 20, 'Number of Questions', 'e.g. 2, 3, 6', 'text', 'field-2', '2023-03-17 12:57:54', '2023-03-17 12:57:54'),
(68, 21, 'Write the notes here', 'e,g. any sort of notes', 'text', 'field-1', '2023-03-17 13:00:17', '2023-03-17 13:00:17'),
(69, 22, 'Instructions for recipe', 'e,g, Spicy recipe, chicken recipe, indian style, american,', 'text', 'field-1', '2023-03-17 13:02:31', '2023-03-17 13:02:31'),
(70, 22, 'Ingredients for recipe', 'e.g. potato, chicken, peas, onion, etc..', 'text', 'field-2', '2023-03-17 13:02:31', '2023-03-17 13:02:31'),
(74, 25, 'Write Title', 'e.g. AI, Startups, Stock Market, etc...', 'text', 'field-1', '2023-03-17 13:07:34', '2023-03-17 13:07:34'),
(75, 24, 'Write the topic', 'e.g. AI, Startups, Stock Market, etc...', 'text', 'field-1', '2023-03-17 13:07:46', '2023-03-17 13:07:46'),
(76, 26, 'Share your experience in notes', 'e.g. good taste, chinese food, etc.', 'text', 'field-1', '2023-03-17 13:09:43', '2023-03-17 13:09:43'),
(77, 27, 'Paste JavaScript here', 'Paste the JS', 'text', 'field-1', '2023-03-17 13:12:32', '2023-03-17 13:12:32'),
(78, 8, 'Post the content', 'Post content & change language from top icon', 'text', 'field-1', '2023-03-17 13:16:02', '2023-03-17 13:16:02'),
(89, 3, 'product description', 'e.g. fitness app', 'text', 'field-1', '2023-03-22 17:02:28', '2023-03-22 17:02:28'),
(90, 3, 'seed words', 'e.g fit, gym, fitness, physique', 'text', 'field-2', '2023-03-22 17:02:28', '2023-03-22 17:02:28'),
(98, 9, 'Write Title', 'e.g. AI, Startups, Stock Market, etc...', 'text', 'field-1', '2023-03-22 21:00:01', '2023-03-22 21:00:01'),
(99, 9, 'Write some keywords', 'e.g. trip to jaipur, summers, family time, etc.', 'text', 'field-2', '2023-03-22 21:00:01', '2023-03-22 21:00:01'),
(100, 23, 'Write Subject', 'e.g. What are 5 key points I should know when studying Ancient Rome?', 'text', 'field-1', '2023-03-23 13:34:29', '2023-03-23 13:34:29'),
(101, 23, 'Number of points?', 'e.g. 2, 5 ,8', 'text', 'field-2', '2023-03-23 13:34:29', '2023-03-23 13:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mem_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `medium` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `tokens` int(11) NOT NULL DEFAULT 0,
  `date_of_transaction` date DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'membership',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `input_lang` varchar(255) NOT NULL DEFAULT 'English',
  `output_lang` varchar(255) NOT NULL DEFAULT 'English',
  `plan_id` int(11) DEFAULT 5,
  `tokens` int(11) DEFAULT NULL,
  `token_reached` int(11) DEFAULT 0,
  `speech_minutes` int(11) NOT NULL DEFAULT 0,
  `minutes_reached` int(11) NOT NULL DEFAULT 0,
  `folders_limit` int(11) DEFAULT NULL,
  `projects_limit` int(11) DEFAULT NULL,
  `team_member_limit` int(11) NOT NULL DEFAULT 0,
  `plan_start` timestamp NULL DEFAULT NULL,
  `plan_end` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT 'user.png',
  `google_id` varchar(255) DEFAULT NULL,
  `fb_id` varchar(255) DEFAULT NULL,
  `linkedin_id` varchar(255) DEFAULT NULL,
  `signup_via` varchar(255) NOT NULL DEFAULT 'web',
  `verified` int(11) NOT NULL DEFAULT 1,
  `code` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_awards`
--

CREATE TABLE `user_awards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `award_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_email_codes`
--

CREATE TABLE `user_email_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_verifies`
--

CREATE TABLE `user_verifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user__notifications`
--

CREATE TABLE `user__notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `noti_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `use_cases_boxes`
--

CREATE TABLE `use_cases_boxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `box_heading` varchar(255) NOT NULL,
  `box_content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `use_cases_boxes`
--

INSERT INTO `use_cases_boxes` (`id`, `icon`, `box_heading`, `box_content`, `created_at`, `updated_at`) VALUES
(1, '2023-03-23-641c4b95b18ba.png', 'Blog Post & Articles', 'Generate optimized blog post and articles to get organic traffic - making you visible on the world.', '2023-03-23 12:52:38', '2023-03-23 12:52:38'),
(2, '2023-03-23-641c4bc41df3a.png', 'Product Description', 'Create a perfect description for your products to engage your customers to click and buy.', '2023-03-23 12:53:24', '2023-03-23 12:53:24'),
(3, '2023-03-27-6421449bc2731.png', 'Social Media Ads', 'Create ads copies for your social media - make an impact with your online marketing campaigns.', '2023-03-27 07:24:12', '2023-03-27 07:24:12'),
(4, '2023-03-27-642145297ce17.png', 'Product Benefits', 'Create a bullet point list of your product benefits that appeal to your customers to purchase.', '2023-03-27 07:26:34', '2023-03-27 07:26:34'),
(5, '2023-03-27-64214566ea9d6.png', 'Suggest Improvements', 'Need to improve your existing content? Our AI will rewrite and improve the content for you.', '2023-03-27 07:27:35', '2023-03-27 07:27:35'),
(6, '2023-03-27-642145a846561.png', 'Landing Page Content', 'Write very attractive headlines, slogans or paragraph for your landing page of your website.', '2023-03-27 07:28:44', '2023-03-27 07:28:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_answers`
--
ALTER TABLE `chat_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_questions`
--
ALTER TABLE `chat_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_blocks`
--
ALTER TABLE `footer_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frameworks`
--
ALTER TABLE `frameworks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home2_boxes`
--
ALTER TABLE `home2_boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_howto`
--
ALTER TABLE `home_page_howto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `how_to_boxes`
--
ALTER TABLE `how_to_boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_spaces`
--
ALTER TABLE `image_spaces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `licensebox`
--
ALTER TABLE `licensebox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_sections`
--
ALTER TABLE `pricing_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_memberships`
--
ALTER TABLE `sub_memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_fields`
--
ALTER TABLE `template_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_awards`
--
ALTER TABLE `user_awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_email_codes`
--
ALTER TABLE `user_email_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_verifies`
--
ALTER TABLE `user_verifies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user__notifications`
--
ALTER TABLE `user__notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `use_cases_boxes`
--
ALTER TABLE `use_cases_boxes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_answers`
--
ALTER TABLE `chat_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_questions`
--
ALTER TABLE `chat_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `footer_blocks`
--
ALTER TABLE `footer_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `frameworks`
--
ALTER TABLE `frameworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home2_boxes`
--
ALTER TABLE `home2_boxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `home_page_howto`
--
ALTER TABLE `home_page_howto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `how_to_boxes`
--
ALTER TABLE `how_to_boxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `image_spaces`
--
ALTER TABLE `image_spaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `licensebox`
--
ALTER TABLE `licensebox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pricing_sections`
--
ALTER TABLE `pricing_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sub_memberships`
--
ALTER TABLE `sub_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `template_fields`
--
ALTER TABLE `template_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_awards`
--
ALTER TABLE `user_awards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_email_codes`
--
ALTER TABLE `user_email_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_verifies`
--
ALTER TABLE `user_verifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user__notifications`
--
ALTER TABLE `user__notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `use_cases_boxes`
--
ALTER TABLE `use_cases_boxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
