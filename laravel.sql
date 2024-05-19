-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 09:12 AM
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
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('userPassword', 's:1:\"1\";', 1716048004);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `items`, `type`, `created_at`, `updated_at`) VALUES
(34, 4, '{\"efb26e2c6ab6bd4d1323288923522d4e\":{\"id\":4,\"name\":\"sequi a\",\"qty\":5,\"price\":246}}', 'cart', '2024-05-02 15:09:35', '2024-05-02 15:09:35'),
(35, 4, '{\"468399581342505c47f4615b81bedaa9\":{\"id\":5,\"name\":\"numquam quo\",\"qty\":1,\"price\":420},\"c42f6beec9c93fd6afea6eb0684aa99a\":{\"id\":9,\"name\":\"a magni\",\"qty\":1,\"price\":451}}', 'wishlist', '2024-05-02 15:09:35', '2024-05-02 15:09:35'),
(56, 3, '{\"027c91341fd5cf4d2579b49c4b6a90da\":{\"id\":1,\"name\":\"aliquid itaque\",\"qty\":1,\"price\":108}}', 'cart', '2024-05-18 18:11:38', '2024-05-18 18:11:38'),
(57, 3, '{\"370d08585360f5c568b18d1f2e4ca1df\":{\"id\":2,\"name\":\"praesentium in\",\"qty\":1,\"price\":201},\"a775bac9cff7dec2b984e023b95206aa\":{\"id\":3,\"name\":\"cupiditate nam\",\"qty\":1,\"price\":46}}', 'wishlist', '2024-05-18 18:11:38', '2024-05-18 18:11:38'),
(59, 7, '{\"027c91341fd5cf4d2579b49c4b6a90da\":{\"id\":1,\"name\":\"aliquid itaque\",\"qty\":1,\"price\":108},\"8a48aa7c8e5202841ddaf767bb4d10da\":{\"id\":6,\"name\":\"quis id\",\"qty\":1,\"price\":479}}', 'cart', '2024-05-18 18:36:56', '2024-05-18 18:36:56'),
(60, 7, '{\"efb26e2c6ab6bd4d1323288923522d4e\":{\"id\":4,\"name\":\"sequi a\",\"qty\":1,\"price\":246}}', 'wishlist', '2024-05-18 18:36:56', '2024-05-18 18:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`, `image`, `is_popular`) VALUES
(1, 'Canon', 'beatae-error', '2024-04-01 10:49:56', '2024-04-27 05:46:57', 'brand-1.png', 1),
(2, 'Asus', 'consequatur-ut', '2024-04-01 10:49:56', '2024-04-01 10:49:56', 'brand-2.png', 0),
(3, 'Dell', 'pariatur-ut', '2024-04-01 10:49:56', '2024-04-01 10:49:56', 'brand-3.png', 0),
(4, 'MSI', 'omnis-eum', '2024-04-01 10:49:56', '2024-04-01 10:49:56', 'brand-4.png', 0),
(5, 'Logitech', 'consequatur-sed', '2024-04-01 10:49:56', '2024-04-01 10:49:56', 'brand-5.png', 0),
(6, 'Apple', 'corporis-neque', '2024-04-01 10:49:56', '2024-04-01 10:49:56', 'brand-6.png', 0),
(7, 'Microsoft', 'ipsum-error', '2024-04-01 10:53:09', '2024-04-01 10:53:09', 'brand-1.png', 0),
(8, 'Google', 'consequatur-voluptatum', '2024-04-01 10:53:09', '2024-04-01 10:53:09', 'brand-2.png', 0),
(9, 'Amazon', 'aut-occaecati', '2024-04-01 10:53:09', '2024-04-27 05:42:31', 'brand-3.png', 1),
(10, 'NVDIA', 'consequuntur-omnis', '2024-04-01 10:53:09', '2024-04-01 10:53:09', 'brand-4.png', 0),
(11, 'IBM', 'autem-nihil', '2024-04-01 10:53:09', '2024-04-01 10:53:09', 'brand-5.png', 0),
(12, 'Samgsung', 'unde-ducimus', '2024-04-01 10:53:09', '2024-04-01 10:53:09', 'brand-6.png', 0),
(21, 'Razor', 'razor-blade', '2024-04-27 05:44:26', '2024-04-27 05:44:26', '1714218266.jpg', 1);

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
-- Table structure for table `home_sliders`
--

CREATE TABLE `home_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `top_title` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `offer` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sliders`
--

INSERT INTO `home_sliders` (`id`, `top_title`, `title`, `sub_title`, `offer`, `link`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'new slider', 'new slider', 'new slider', 'new slider', 'new slider', '1713987956.jpg', 1, '2024-04-24 13:27:45', '2024-04-24 13:45:56'),
(5, 'a new slider', 'a new slider', 'a new slider', 'a new slider', 'a new slider', '1716056219.jpg', 1, '2024-05-18 18:16:59', '2024-05-18 18:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(2, 'Zunayed Khan', 'jodnDoe@gmai.com', '01868867271', 'a', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2024-05-04 00:23:54', '2024-05-04 00:23:54');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_04_01_125251_create_categories_table', 2),
(5, '2024_04_01_125405_create_products_table', 2),
(6, '2024_04_23_060509_create_home_sliders_table', 3),
(7, '2024_04_27_102956_image_is_popular_column_categories', 4),
(8, '2024_05_01_155828_create_orders_table', 5),
(9, '2024_05_01_161406_create_orders_table', 6),
(10, '2024_05_02_162012_create_cart_table', 7),
(11, '2024_05_02_165227_add_type_column_to_carts_table', 8),
(12, '2024_05_03_193519_password_reset_tokens', 9),
(13, '2024_05_04_053030_messages', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `total_price`, `session_id`, `user_id`, `created_at`, `updated_at`) VALUES
(16, 'paid', 105.80, 'cs_test_a1YTEg0upkKplwNeX67Pj5HQ04Tls6g2BEdMPQ4R4x5KC2BnmZnMU2FOqK', '3', '2024-05-02 03:09:27', '2024-05-02 03:09:48'),
(17, 'paid', 105.80, 'cs_test_a1OHpeDBcyu0upqHEIGgWcGepsECxq4taSFsodEk8nd9UQdBwlFyTKtRFD', '3', '2024-05-02 09:22:57', '2024-05-02 09:23:28'),
(21, 'paid', 124.20, 'cs_test_a1z74iVRrmB7uvAAW3km3ouA98OC0YMA47OUWgjm52nsd9WAzrn84zKgjo', '1', '2024-05-18 18:53:02', '2024-05-18 18:53:23'),
(22, 'unpaid', 124.20, 'cs_test_a1lOXO5Dz1e7c2GV1eLhRkXDc8vOFtLjVxV0dt6XHIRG2TZekUbCkbX878', '1', '2024-05-18 19:26:56', '2024-05-18 19:26:56'),
(23, 'unpaid', 124.20, 'cs_test_a1Jel8WlpDVDb0vAMsVXXz1TNxz3AQOcWH628yI84bgLFBdj9nzC5jw7Lz', '1', '2024-05-18 19:30:52', '2024-05-18 19:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'zunayedkhanofficial@gmail.com', 'dSyJS9azs8eqem7pXZVoqF4KN6gj0t976kTvWpDoNwh4MZs49AgJ8qHJ8x2CzMbe', '2024-05-03 13:40:47'),
(2, 'zunayedkhanofficial@gmail.com', 'auvolNIZsliFZ63gXWZBVAKVrzGvmTAuntKRwFoJU84w3rOneUKjPYmJgZNAXHPA', '2024-05-03 13:41:07'),
(3, 'zunayedkhanofficial@gmail.com', '0rNTyA77IpXNUEIU6fx8EhodRbWDm8Ow8h93bSYyJDxqm3FOXzzbQo4JPk7izAYN', '2024-05-03 14:01:11'),
(4, 'zunayedkhanofficial@gmail.com', 'mmR1AlO0cOQSJ22x8e2b4XPiQ2GNYz8ygn1sjYOfDhsJV9tyB0P8lrPBgpqZh28c', '2024-05-03 14:10:40'),
(5, 'zunayedkhanofficial@gmail.com', 'o3G3WP34jV1GQ4Qu4YUYxjy6Js37XI18znZknZNstZ7tXHrfT7nXIx3xf8nsDN5J', '2024-05-03 14:14:31'),
(6, 'zunayedkhanofficial@gmail.com', 'h5zgYmjiF4HUUV3WMYJl3paDJVr50f0Jabr6Z7whB0BQfS80g2ip8w3iN0qu2XRU', '2024-05-03 14:16:13'),
(7, 'zunayedkhanofficial@gmail.com', 'xw8T3eaSGU4i8wsncOFzrRzfZPWMJxfpUv2yY7q369eWdfWoyRa1KtEmBtlFv2Jr', '2024-05-03 14:21:06'),
(8, 'zunayedkhanofficial@gmail.com', 'GZi11RmHKFi7u3xiVUljGvpVJOOMPsPw8bfGbFunqVhEKviYKWxNsQ3J6Gw9xyec', '2024-05-03 15:08:37'),
(9, 'zunayedkhanofficial@gmail.com', 'mKvLGvD20sxtr4t99iFfm0tSHjWbtbRtIwCVW4hnViYEjyLFiJ98gRceZIQX1qFE', '2024-05-03 15:12:53'),
(10, 'zunayedkhanofficial@gmail.com', '4GVu8D6K4djThMr5VJtCdagz0h2kZYMav8IqBwzcJNsL2YfJBeUkzHDvuISTTQFi', '2024-05-03 15:13:40'),
(11, 'zunayedkhanofficial@gmail.com', 'gBQeGm8MqssxmYpfAZlVaI5p2GA9KqnHDaW0K2ieOKBLdk0rlldjbvhR266S8ptl', '2024-05-03 15:15:06'),
(12, 'zunayedkhanofficial@gmail.com', 'FupdpYWbnGWYLVJdL6OVNPgfsvKQDv1cKTlHLQUMHNiUZpekW8r0oZx1etfRJ28K', '2024-05-03 17:36:57'),
(13, 'zunayedkhanofficial@gmail.com', 'A3hMLnKU9rFe2wfhs1Z9I3Qimt2n5Pvt1diD3q7a2g4sVRzI8sAL11G51h0V2rQJ', '2024-05-17 18:34:22'),
(14, 'zunayedkhanofficial@gmail.com', 'H8emrSYIIpqVd9y59JxwsDdAgrRNdopk03qy83P1nizQ9HjKjXUhyEqJ8AKY3lN4', '2024-05-18 16:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `regular_price` decimal(8,2) NOT NULL,
  `sale_price` decimal(8,2) DEFAULT NULL,
  `sku` varchar(255) NOT NULL,
  `stock_status` enum('instock','outofstock') NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 10,
  `image` varchar(255) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `short_description`, `description`, `regular_price`, `sale_price`, `sku`, `stock_status`, `featured`, `quantity`, `image`, `images`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'aliquid itaque', 'aliquid-itaque', 'Reiciendis et soluta consequatur dolores eveniet eaque incidunt. In commodi dolorum qui possimus laborum. Fugiat beatae est quos est. Sint repudiandae minus quas in nemo officia.', 'Porro ipsam sed omnis non et. Totam distinctio minima error nemo veritatis nihil. Eaque ex ab voluptatem pariatur vel. At ducimus ut saepe sit iure voluptatum accusantium. Saepe qui velit aut ab. Rerum pariatur ipsum quidem est. Voluptatibus et et non laboriosam. Necessitatibus provident quia distinctio.', 108.00, NULL, 'prd391', 'instock', 0, 19, 'product-10-1.jpg', NULL, 4, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(2, 'praesentium in', 'praesentium-in', 'Porro enim fuga quam totam pariatur. Distinctio eum asperiores et quis voluptates. Asperiores laborum quae sunt et qui eos. Eos aut ab est est.', 'Modi ex architecto et. Sunt aut vero ut totam et iure hic dolor. Ullam corrupti iste voluptas vel consequatur distinctio provident. Dolorem laborum temporibus fuga perspiciatis quo at sunt at. Quo tempora dolores sit hic. Rerum animi omnis tempora qui velit dolorem et. Totam ut odio eum ut eaque. Occaecati expedita vel libero suscipit. Tempore iure sunt minima et eum autem. Officiis voluptas est ratione. Deserunt excepturi saepe placeat voluptatem delectus alias iste aliquam.', 201.00, NULL, 'prd111', 'instock', 0, 15, 'product-3-1.jpg', NULL, 4, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(3, 'cupiditate nam', 'cupiditate-nam', 'Nisi voluptas vitae ut. Non recusandae at voluptatibus consequuntur dolore excepturi et. Corrupti ratione eum quam natus dolor sunt facere.', 'Voluptatem veniam qui laborum qui qui veritatis. Magni ea architecto quaerat ea doloribus aut. Nobis eos aliquid eligendi impedit maxime. Odio debitis quo occaecati. Enim aliquid totam ut quo. Nam animi perspiciatis deleniti quod. Beatae sunt iste odit aut reiciendis. Id modi eaque nostrum iusto molestiae aliquam. Eaque aut cum at est. Ipsam aut ut velit beatae similique consequuntur autem. Eum in animi nisi incidunt.', 46.00, NULL, 'prd104', 'instock', 1, 16, 'product-7-1.jpg', NULL, 2, '2024-04-01 10:53:09', '2024-04-27 03:58:44'),
(4, 'sequi a', 'sequi-a', 'Nostrum quia impedit repellat est reprehenderit harum enim. Quam repudiandae cumque voluptate aspernatur.', 'Sit natus voluptate molestiae suscipit quae in autem. Atque in quasi ratione magni corporis. Nam rem mollitia reprehenderit consequuntur ullam. Ut rem quia at aut. Ut quod consequatur et laudantium minima. Nam itaque iure doloribus aliquid voluptatem sed. Dolorem ab non iure omnis recusandae tenetur ut laudantium. Corrupti consequuntur et qui similique consequatur non ut facere. Veniam molestias eveniet sit eaque et optio libero. Officia sunt dolorem magnam id qui ut.', 246.00, NULL, 'prd348', 'instock', 0, 19, 'product-4-1.jpg', NULL, 1, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(5, 'numquam quo', 'numquam-quo', 'Tenetur corporis est rerum qui voluptates. Eligendi sed explicabo odio aut. Sint aut similique corporis.', 'In aliquam accusantium dolorem velit accusantium sint. Nemo ut recusandae ut sed quo hic esse nemo. Blanditiis asperiores possimus est omnis iste. Non ipsam odio sunt quasi molestiae. Quis cumque officia qui ea. Fugit aperiam aperiam sint nihil. Amet neque consequatur aut illo. Ut aliquam voluptatem dolores rem rerum. Eum voluptas velit neque provident velit ducimus. Distinctio sapiente sit facilis voluptatibus autem vero.', 420.00, NULL, 'prd267', 'instock', 1, 13, 'product-2-1.jpg', NULL, 3, '2024-04-01 10:53:09', '2024-04-27 03:59:32'),
(6, 'quis id', 'quis-id', 'Cum reprehenderit vel non accusamus omnis enim. Eos aliquid doloremque debitis consequatur ut ea harum. Veniam animi repellendus quis.', 'Ut inventore incidunt amet assumenda maiores. Cumque et animi consequatur totam. Ea sed repellendus assumenda corporis possimus libero quae. Est non quia maxime mollitia nulla eos ad. Reiciendis consequatur recusandae suscipit omnis consequatur ut aut omnis. Necessitatibus alias quaerat hic impedit ipsam id est. Culpa sapiente et ullam ex saepe labore debitis debitis. Et eveniet sint eveniet soluta cumque.', 479.00, NULL, 'prd244', 'instock', 0, 38, 'product-11-1.jpg', NULL, 4, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(7, 'quia repellat', 'quia-repellat', 'Repudiandae nihil ut consequatur delectus quam. Voluptates officia in sint iure aut. Dolor rerum consequatur voluptatum itaque minus pariatur eum. Voluptatem quidem consequatur tempore alias.', 'Quos ea eos autem porro ut a. Vel tenetur ipsum voluptas nemo debitis. Voluptatibus ut iusto sit quod reiciendis nobis quo. Saepe cum minus velit et ea omnis. Quos omnis rerum voluptatem est a ea. Totam qui sint earum. Ut quas distinctio aperiam. Et impedit voluptas rerum esse suscipit debitis. Praesentium qui et saepe quod asperiores. Laborum id nam repudiandae voluptas quasi.', 366.00, NULL, 'prd492', 'instock', 0, 43, 'product-16-1.jpg', NULL, 5, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(8, 'porro cum', 'porro-cum', 'Expedita ut et qui non. Dolorem facilis consequatur ex repellat provident ut. Sapiente labore sed eveniet in quis dolores.', 'Ad eum aperiam quia natus illo quis maxime. Minus porro perspiciatis dolor. Ut et libero nobis sunt tempore. Vero error eligendi alias odit est illum ullam. Ducimus commodi iste sed facilis est culpa. Unde sed est id autem eligendi fuga. Reiciendis dignissimos illo et voluptatem. Odit id praesentium ex cupiditate. Ut perspiciatis dolor laboriosam alias libero.', 132.00, NULL, 'prd268', 'instock', 0, 45, 'product-1-1.jpg', NULL, 4, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(9, 'a magni', 'a-magni', 'Ut aliquid similique autem cum occaecati velit maxime. Sed repudiandae amet eaque rerum.', 'Inventore sit esse accusantium in inventore enim iure. Dolore voluptate dolorem officiis sint et. At et similique totam est vel ducimus. Placeat rem voluptatum et perferendis sit porro qui. Ut dolorem reprehenderit molestias quia quae sit corrupti. Ipsum et sint sunt fuga tempora ut. Debitis quia ipsam iure. Rerum voluptatem architecto consectetur. Et earum labore et at mollitia cumque sed. Ex consequatur dolores quia sed. Quam consequuntur et itaque culpa ea iste nemo.', 451.00, NULL, 'prd277', 'instock', 0, 30, 'product-2-1.jpg', NULL, 4, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(10, 'voluptatem aut', 'voluptatem-aut', 'Enim vel omnis suscipit magnam consequatur voluptatem et. Sint id pariatur porro. Tenetur doloremque cupiditate laboriosam aut. Quis sed velit dolorum aut debitis dolorum earum.', 'Quia dolorum et ut quaerat et. Amet repellendus praesentium architecto culpa autem commodi. Inventore enim praesentium eum porro debitis voluptatibus ea. Non enim nulla illo qui saepe. Consectetur dicta dignissimos ratione consequatur ab est. Incidunt voluptatem et animi. Deserunt incidunt eos ducimus et asperiores voluptas voluptas. Culpa doloremque quaerat velit tempora aliquid.', 38.00, NULL, 'prd128', 'instock', 0, 34, 'product-14-1.jpg', NULL, 4, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(11, 'fugit error', 'fugit-error', 'Expedita neque eum aut rerum nulla aut vitae odit. Est ea eius amet et vel corrupti facere. Quae veniam pariatur sed at.', 'Rerum aliquam in soluta voluptate. Ratione quis totam magni qui qui. Velit numquam itaque sunt dolor nisi alias laboriosam porro. Architecto veniam sunt occaecati quo. Est voluptatem dolor eum. Qui voluptatum eum molestiae dignissimos voluptatum soluta ipsum vero. Eius asperiores occaecati consequuntur aut ut exercitationem. Recusandae soluta quia maxime facilis rerum corrupti. Aut consequatur odio eos voluptatem.', 264.00, NULL, 'prd274', 'instock', 0, 35, 'product-6-1.jpg', NULL, 2, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(12, 'minus consequatur', 'minus-consequatur', 'Sit aspernatur dolorum odio. Aut blanditiis praesentium qui velit totam odit nisi dolores. Qui officiis vel quisquam cupiditate.', 'Deserunt sequi doloremque ut pariatur quaerat voluptate ut ratione. Nobis consequuntur doloribus aliquam laudantium ducimus. Id est ducimus temporibus deleniti nihil. Qui eum vel amet qui voluptate. Tempore quo quis voluptates animi et. Eius iste cumque distinctio. Perferendis et repellat maiores sed.', 374.00, NULL, 'prd374', 'instock', 0, 31, 'product-13-1.jpg', NULL, 3, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(13, 'occaecati qui', 'occaecati-qui', 'Suscipit molestiae porro ex voluptatum nemo. Id voluptate facilis repudiandae hic saepe quae iusto. Deserunt cumque sapiente iure nesciunt.', 'Ea voluptatum voluptatem odio officia similique. Nesciunt fuga nihil repellat nostrum. Atque alias voluptatem perspiciatis quo aliquam. Esse error magnam pariatur. Aut eum et ratione maxime dolor. Aut numquam numquam numquam dolorem nihil. Cupiditate magnam est dolor sit. Dolore accusamus harum mollitia aut. Qui quidem deleniti et. Nobis nesciunt ut hic quos ex ut suscipit porro. Nihil nihil voluptas pariatur voluptas ipsam labore qui.', 17.00, NULL, 'prd131', 'instock', 0, 26, 'product-12-1.jpg', NULL, 2, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(14, 'necessitatibus quo', 'necessitatibus-quo', 'Est voluptatibus doloribus unde quas ut recusandae. Molestiae et totam suscipit aut. Reiciendis similique ullam quas exercitationem. Itaque qui et error voluptatem accusantium animi aspernatur.', 'Non voluptas dolorum aut. Sapiente eveniet saepe et hic. Quo est pariatur reiciendis voluptates est non quos. Velit omnis voluptas suscipit placeat error. Et eveniet ab et cum consequatur velit. Ducimus repellat eligendi voluptatem eum beatae qui. Ut voluptas explicabo ad assumenda fugiat.', 262.00, NULL, 'prd395', 'instock', 0, 12, 'product-15-1.jpg', NULL, 1, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(15, 'aut nemo', 'aut-nemo', 'Vel autem optio autem. Non provident unde aut sit aut enim hic. Et sunt recusandae laudantium rem vel eum.', 'Est est et aspernatur numquam. Possimus laudantium totam est quos. Voluptate voluptas sint maxime eos fugiat maiores commodi. Deleniti ut ducimus dolore ex molestiae et. Voluptatem iure quod ut earum. Perspiciatis asperiores dolores ullam dolorem excepturi. Blanditiis aut autem dicta quas est numquam qui. Soluta rerum eum consequatur qui maiores. Et numquam quis et.', 236.00, NULL, 'prd119', 'instock', 0, 18, 'product-8-1.jpg', NULL, 2, '2024-04-01 10:53:09', '2024-04-01 10:53:09'),
(16, 'fugiat provident', 'fugiat-provident', 'Eaque harum quia eum. Sequi rerum corrupti dolore laudantium.', 'Soluta et sunt illum quod nobis. Quaerat sed qui ipsam quia. Magnam repudiandae adipisci sit blanditiis. Id iste est illum optio veniam animi. Quia autem in quo nulla distinctio nesciunt. Ratione esse labore aliquid aut vitae veritatis. Rerum est et occaecati quisquam. Molestias atque quia et cum inventore. Fugit ut excepturi in illo consectetur ratione. Sequi unde et atque ad quia culpa veniam eius.', 499.00, NULL, 'prd429', 'instock', 0, 10, 'product-7-1.jpg', NULL, 4, '2024-04-01 10:53:09', '2024-04-01 10:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('yjCXWypLSBNAmWxavhBhbWz87PjdmLLQEtZSXDcQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnVQcExFaUF2T3A5WnE5U0VwQ05zN01GTEV2SXlCQ0U3OW9SYVUxaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1716102592);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `utype` varchar(255) NOT NULL DEFAULT 'usr',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `utype`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Zunayed Khan', 'zunayedkhanofficial@gmail.com', 'usr', NULL, '$2y$12$n4XpCFUvILSu3A.kbC3lA.TJpJsBnv0fk95gQH0mRW5ldFQMSp..2', NULL, '2024-04-01 03:01:38', '2024-05-18 16:19:41'),
(6, 'Zunayed', 'deyanuz@gmail.com', 'usr', NULL, '$2y$12$tzd9kBnqZ3vRpuql2eIDHOuLCf/mM.CmiTJbggoJCDC6i5amUl76O', NULL, '2024-04-03 05:57:24', '2024-05-02 15:00:08'),
(7, 'a', 'a@gmail.com', 'adm', NULL, '$2y$12$e/WX9L0UwKKPYO0S1.6VwOKm7G9TL6qhKeST.5pR3QdWjvttkPs6G', NULL, '2024-04-06 01:31:38', '2024-05-18 16:05:59'),
(9, 'Kawsar Khan', 'jodnDoe@gmai.com', 'usr', NULL, '$2y$12$UuSSLG5jrDxpLNWnJquxFeM3RGogoQsVGppl4/tJ5U08mXrsYPQyS', NULL, '2024-05-03 22:39:38', '2024-05-03 22:39:38'),
(11, 'khan', 'khan@gmail.com', 'usr', NULL, '$2y$12$LzUzhuh2z/2MLo0sCNqX6OUamVviXdLQZVcfFS7BOoIT3NTO7hJ.e', NULL, '2024-05-15 12:45:37', '2024-05-18 16:03:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_sliders`
--
ALTER TABLE `home_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
