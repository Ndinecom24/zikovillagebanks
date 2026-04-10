-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ziko_village_bank_management_system
DROP DATABASE IF EXISTS `ziko_village_bank_management_system`;
CREATE DATABASE IF NOT EXISTS `ziko_village_bank_management_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ziko_village_bank_management_system`;

-- Dumping structure for table ziko_village_bank_management_system.activity_logs
DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_subject_type_subject_id_index` (`subject_type`,`subject_id`),
  KEY `activity_logs_user_id_foreign` (`user_id`),
  KEY `activity_logs_created_at_index` (`created_at`),
  KEY `activity_logs_log_type_index` (`log_type`),
  KEY `activity_logs_event_index` (`event`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.activity_logs: ~26 rows (approximately)
DELETE FROM `activity_logs`;
INSERT INTO `activity_logs` (`id`, `log_type`, `event`, `description`, `subject_type`, `subject_id`, `user_id`, `user_name`, `ip_address`, `user_agent`, `properties`, `created_at`, `updated_at`) VALUES
	(1, 'auth', 'login', 'User "Ndinecom Admin" logged in', 'App\\Models\\User', 1, 1, 'Ndinecom Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-05 18:11:15', '2026-04-05 18:11:15'),
	(2, 'auth', 'login', 'User "Ndinecom Admin" logged in', 'App\\Models\\User', 1, 1, 'Ndinecom Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-06 06:37:13', '2026-04-06 06:37:13'),
	(3, 'auth', 'logout', 'User "Ndinecom Admin" logged out', 'App\\Models\\User', 1, 1, 'Ndinecom Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-06 08:21:32', '2026-04-06 08:21:32'),
	(4, 'auth', 'logout', 'User "Ndinecom Admin" logged out', 'App\\Models\\User', 1, 1, 'Ndinecom Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-06 08:22:59', '2026-04-06 08:22:59'),
	(5, 'auth', 'logout', 'User "Ndinecom Admin" logged out', 'App\\Models\\User', 1, 1, 'Ndinecom Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-06 08:23:47', '2026-04-06 08:23:47'),
	(6, 'auth', 'login', 'User "Esther Chilufya" logged in', 'App\\Models\\User', 8, 8, 'Esther Chilufya', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-06 08:23:56', '2026-04-06 08:23:56'),
	(7, 'model', 'created', 'Loan "2" was created', 'App\\Models\\VillageBanking\\Loan', 2, 8, 'Esther Chilufya', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', '{"attributes": {"id": 2, "amount": "500.00", "status": "pending", "duration": 1, "month_id": "1", "created_at": "2026-04-06T11:04:03.000000Z", "updated_at": "2026-04-06T11:04:03.000000Z", "borrower_id": "11", "interest_rate": "10.00", "total_payable": "550.00", "outstanding_balance": "550.00"}}', '2026-04-06 09:04:03', '2026-04-06 09:04:03'),
	(8, 'model', 'created', 'Loan "3" was created', 'App\\Models\\VillageBanking\\Loan', 3, 8, 'Esther Chilufya', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', '{"attributes": {"id": 3, "amount": "500.00", "status": "pending", "duration": 3, "month_id": "1", "created_at": "2026-04-06T15:28:22.000000Z", "updated_at": "2026-04-06T15:28:22.000000Z", "borrower_id": "11", "interest_rate": "10.00", "total_payable": "550.00", "outstanding_balance": "550.00"}}', '2026-04-06 13:28:22', '2026-04-06 13:28:22'),
	(9, 'model', 'created', 'Loan "4" was created', 'App\\Models\\VillageBanking\\Loan', 4, 8, 'Esther Chilufya', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', '{"attributes": {"id": 4, "amount": "900.00", "status": "pending", "duration": 4, "month_id": "1", "created_at": "2026-04-06T15:29:13.000000Z", "updated_at": "2026-04-06T15:29:13.000000Z", "borrower_id": "4", "interest_rate": "10.00", "total_payable": "990.00", "outstanding_balance": "990.00"}}', '2026-04-06 13:29:13', '2026-04-06 13:29:13'),
	(10, 'auth', 'logout', 'User "Esther Chilufya" logged out', 'App\\Models\\User', 8, 8, 'Esther Chilufya', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-06 13:32:56', '2026-04-06 13:32:56'),
	(11, 'model', 'created', 'User "Whoopi Prince" was created', 'App\\Models\\User', 12, NULL, 'System', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '{"attributes": {"id": 12, "name": "Whoopi Prince", "email": "user1@gmail.com", "username": "user1", "created_at": "2026-04-06T19:42:13.000000Z", "updated_at": "2026-04-06T19:42:13.000000Z"}}', '2026-04-06 17:42:14', '2026-04-06 17:42:14'),
	(12, 'model', 'created', 'Permission "Manage Join Requests" was created', 'App\\Models\\RoleBasedAccess\\Permission', 42, NULL, 'System', '127.0.0.1', 'Symfony', '{"attributes": {"id": 42, "name": "Manage Join Requests", "slug": "manage-join-requests", "group": "Member Management", "created_at": "2026-04-07T15:33:41.000000Z", "updated_at": "2026-04-07T15:33:41.000000Z", "description": "Review and approve join requests"}}', '2026-04-07 13:33:41', '2026-04-07 13:33:41'),
	(13, 'model', 'updated', 'Permission "Manage Months" was updated', 'App\\Models\\RoleBasedAccess\\Permission', 8, NULL, 'System', '127.0.0.1', 'Symfony', '{"new": {"group": "Circle Management"}, "old": {"group": "Monthly Cycle"}}', '2026-04-07 13:33:41', '2026-04-07 13:33:41'),
	(14, 'model', 'created', 'Permission "Force Loans" was created', 'App\\Models\\RoleBasedAccess\\Permission', 43, NULL, 'System', '127.0.0.1', 'Symfony', '{"attributes": {"id": 43, "name": "Force Loans", "slug": "force-loans", "group": "Loan Management", "created_at": "2026-04-07T15:33:41.000000Z", "updated_at": "2026-04-07T15:33:41.000000Z", "description": "Apply forced loans to members"}}', '2026-04-07 13:33:41', '2026-04-07 13:33:41'),
	(15, 'model', 'created', 'Permission "Manage Bank Config" was created', 'App\\Models\\RoleBasedAccess\\Permission', 44, NULL, 'System', '127.0.0.1', 'Symfony', '{"attributes": {"id": 44, "name": "Manage Bank Config", "slug": "manage-bank-config", "group": "Settings", "created_at": "2026-04-07T15:33:42.000000Z", "updated_at": "2026-04-07T15:33:42.000000Z", "description": "Configure village bank settings"}}', '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(16, 'model', 'created', 'Permission "Manage Training" was created', 'App\\Models\\RoleBasedAccess\\Permission', 45, NULL, 'System', '127.0.0.1', 'Symfony', '{"attributes": {"id": 45, "name": "Manage Training", "slug": "manage-training", "group": "Training", "created_at": "2026-04-07T15:33:42.000000Z", "updated_at": "2026-04-07T15:33:42.000000Z", "description": "Manage training programs and applications"}}', '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(17, 'model', 'created', 'Permission "View Activity Logs" was created', 'App\\Models\\RoleBasedAccess\\Permission', 46, NULL, 'System', '127.0.0.1', 'Symfony', '{"attributes": {"id": 46, "name": "View Activity Logs", "slug": "view-activity-logs", "group": "Activity Logs", "created_at": "2026-04-07T15:33:42.000000Z", "updated_at": "2026-04-07T15:33:42.000000Z", "description": "View system activity logs"}}', '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(18, 'model', 'created', 'Permission "Discover Banks" was created', 'App\\Models\\RoleBasedAccess\\Permission', 47, NULL, 'System', '127.0.0.1', 'Symfony', '{"attributes": {"id": 47, "name": "Discover Banks", "slug": "discover-banks", "group": "Discovery", "created_at": "2026-04-07T15:33:42.000000Z", "updated_at": "2026-04-07T15:33:42.000000Z", "description": "Search and request to join village banks"}}', '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(19, 'auth', 'login', 'User "Grace Mwanza" logged in', 'App\\Models\\User', 2, 2, 'Grace Mwanza', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-07 13:45:24', '2026-04-07 13:45:24'),
	(20, 'model', 'updated', 'Loan "3" was updated', 'App\\Models\\VillageBanking\\Loan', 3, 2, 'Grace Mwanza', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', '{"new": {"status": "approved"}, "old": {"status": "pending"}}', '2026-04-07 14:18:02', '2026-04-07 14:18:02'),
	(21, 'model', 'updated', 'Loan "4" was updated', 'App\\Models\\VillageBanking\\Loan', 4, 2, 'Grace Mwanza', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', '{"new": {"status": "approved"}, "old": {"status": "pending"}}', '2026-04-07 14:18:32', '2026-04-07 14:18:32'),
	(22, 'model', 'updated', 'Loan "4" was updated', 'App\\Models\\VillageBanking\\Loan', 4, 2, 'Grace Mwanza', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', '{"new": {"status": "active"}, "old": {"status": "approved"}}', '2026-04-07 14:18:56', '2026-04-07 14:18:56'),
	(23, 'model', 'updated', 'Loan "3" was updated', 'App\\Models\\VillageBanking\\Loan', 3, 2, 'Grace Mwanza', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', '{"new": {"status": "active"}, "old": {"status": "approved"}}', '2026-04-07 14:18:58', '2026-04-07 14:18:58'),
	(24, 'auth', 'login', 'User "Ndinecom Admin" logged in', 'App\\Models\\User', 1, 1, 'Ndinecom Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-09 16:45:02', '2026-04-09 16:45:02'),
	(25, 'auth', 'login', 'User "Ndinecom Admin" logged in', 'App\\Models\\User', 1, 1, 'Ndinecom Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-10 02:32:26', '2026-04-10 02:32:26'),
	(26, 'auth', 'login', 'User "Ndinecom Admin" logged in', 'App\\Models\\User', 1, 1, 'Ndinecom Admin', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', NULL, '2026-04-10 07:52:32', '2026-04-10 07:52:32');

-- Dumping structure for table ziko_village_bank_management_system.bank_applications
DROP TABLE IF EXISTS `bank_applications`;
CREATE TABLE IF NOT EXISTS `bank_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_description` text COLLATE utf8mb4_unicode_ci,
  `bank_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_staff_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_plan_id` bigint unsigned NOT NULL,
  `proof_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_remarks` text COLLATE utf8mb4_unicode_ci,
  `reviewed_by` bigint unsigned DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `village_bank_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_applications_subscription_plan_id_foreign` (`subscription_plan_id`),
  KEY `bank_applications_reviewed_by_foreign` (`reviewed_by`),
  KEY `bank_applications_village_bank_id_foreign` (`village_bank_id`),
  CONSTRAINT `bank_applications_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`),
  CONSTRAINT `bank_applications_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`),
  CONSTRAINT `bank_applications_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.bank_applications: ~0 rows (approximately)
DELETE FROM `bank_applications`;

-- Dumping structure for table ziko_village_bank_management_system.circles
DROP TABLE IF EXISTS `circles`;
CREATE TABLE IF NOT EXISTS `circles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `village_bank_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_months` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('draft','active','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `circles_created_by_foreign` (`created_by`),
  KEY `circles_village_bank_id_foreign` (`village_bank_id`),
  CONSTRAINT `circles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `circles_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.circles: ~3 rows (approximately)
DELETE FROM `circles`;
INSERT INTO `circles` (`id`, `village_bank_id`, `name`, `duration_months`, `start_date`, `end_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Tiyende Pamodzi', 12, '2026-04-01', '2027-04-30', 'active', 2, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(2, 2, 'InfraCash Cycle 2024/2025', 12, '2024-11-01', '2025-10-31', 'active', 13, '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(3, 3, 'VBank Cycle 2025/2026', 12, '2025-02-01', '2026-01-31', 'active', 39, '2026-04-09 18:38:02', '2026-04-09 18:38:02');

-- Dumping structure for table ziko_village_bank_management_system.circle_members
DROP TABLE IF EXISTS `circle_members`;
CREATE TABLE IF NOT EXISTS `circle_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `circle_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `joined_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `circle_members_circle_id_foreign` (`circle_id`),
  KEY `circle_members_user_id_foreign` (`user_id`),
  CONSTRAINT `circle_members_circle_id_foreign` FOREIGN KEY (`circle_id`) REFERENCES `circles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `circle_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.circle_members: ~49 rows (approximately)
DELETE FROM `circle_members`;
INSERT INTO `circle_members` (`id`, `circle_id`, `user_id`, `joined_at`) VALUES
	(1, 1, 2, '2026-04-03 18:41:37'),
	(2, 1, 3, '2026-04-03 18:41:37'),
	(3, 1, 4, '2026-04-03 18:41:37'),
	(4, 1, 5, '2026-04-03 18:41:37'),
	(5, 1, 6, '2026-04-03 18:41:37'),
	(6, 1, 7, '2026-04-03 18:41:37'),
	(7, 1, 8, '2026-04-03 18:41:37'),
	(8, 1, 9, '2026-04-03 18:41:37'),
	(9, 1, 10, '2026-04-03 18:41:37'),
	(10, 1, 11, '2026-04-03 18:41:37'),
	(11, 2, 13, '2024-10-14 22:00:00'),
	(12, 2, 14, '2024-10-19 22:00:00'),
	(13, 2, 15, '2024-10-19 22:00:00'),
	(14, 2, 16, '2024-10-19 22:00:00'),
	(15, 2, 17, '2024-10-19 22:00:00'),
	(16, 2, 18, '2024-10-19 22:00:00'),
	(17, 2, 19, '2024-10-19 22:00:00'),
	(18, 2, 20, '2024-10-19 22:00:00'),
	(19, 2, 21, '2024-10-19 22:00:00'),
	(20, 2, 22, '2024-10-19 22:00:00'),
	(21, 2, 23, '2024-10-19 22:00:00'),
	(22, 2, 24, '2024-10-19 22:00:00'),
	(23, 2, 25, '2024-10-19 22:00:00'),
	(24, 2, 26, '2024-10-19 22:00:00'),
	(25, 2, 27, '2024-10-19 22:00:00'),
	(26, 2, 28, '2024-10-19 22:00:00'),
	(27, 2, 29, '2024-10-19 22:00:00'),
	(28, 2, 30, '2024-10-19 22:00:00'),
	(29, 2, 31, '2024-10-19 22:00:00'),
	(30, 2, 32, '2024-10-19 22:00:00'),
	(31, 2, 33, '2024-10-19 22:00:00'),
	(32, 2, 34, '2024-10-19 22:00:00'),
	(33, 2, 35, '2024-10-19 22:00:00'),
	(34, 2, 36, '2024-10-19 22:00:00'),
	(35, 2, 37, '2024-10-19 22:00:00'),
	(36, 2, 38, '2024-10-19 22:00:00'),
	(37, 3, 39, '2025-01-14 22:00:00'),
	(38, 3, 40, '2025-01-19 22:00:00'),
	(39, 3, 41, '2025-01-19 22:00:00'),
	(40, 3, 42, '2025-01-19 22:00:00'),
	(41, 3, 43, '2025-01-19 22:00:00'),
	(42, 3, 44, '2025-01-19 22:00:00'),
	(43, 3, 45, '2025-01-19 22:00:00'),
	(44, 3, 46, '2025-01-19 22:00:00'),
	(45, 3, 47, '2025-01-19 22:00:00'),
	(46, 3, 48, '2025-01-19 22:00:00'),
	(47, 3, 49, '2025-01-19 22:00:00'),
	(48, 3, 50, '2025-01-19 22:00:00'),
	(49, 3, 51, '2025-01-19 22:00:00');

-- Dumping structure for table ziko_village_bank_management_system.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table ziko_village_bank_management_system.insurance_configs
DROP TABLE IF EXISTS `insurance_configs`;
CREATE TABLE IF NOT EXISTS `insurance_configs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `circle_id` bigint unsigned NOT NULL,
  `type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insurance_configs_circle_id_foreign` (`circle_id`),
  CONSTRAINT `insurance_configs_circle_id_foreign` FOREIGN KEY (`circle_id`) REFERENCES `circles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.insurance_configs: ~3 rows (approximately)
DELETE FROM `insurance_configs`;
INSERT INTO `insurance_configs` (`id`, `circle_id`, `type`, `value`, `created_at`, `updated_at`) VALUES
	(1, 1, 'fixed', 100.00, '2026-04-05 05:48:50', '2026-04-05 05:48:50'),
	(2, 2, 'fixed', 200.00, '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(3, 3, 'fixed', 100.00, '2026-04-09 18:38:02', '2026-04-09 18:38:02');

-- Dumping structure for table ziko_village_bank_management_system.insurance_contributions
DROP TABLE IF EXISTS `insurance_contributions`;
CREATE TABLE IF NOT EXISTS `insurance_contributions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `month_id` bigint unsigned NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insurance_contributions_user_id_foreign` (`user_id`),
  KEY `insurance_contributions_month_id_foreign` (`month_id`),
  CONSTRAINT `insurance_contributions_month_id_foreign` FOREIGN KEY (`month_id`) REFERENCES `months` (`id`) ON DELETE CASCADE,
  CONSTRAINT `insurance_contributions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.insurance_contributions: ~320 rows (approximately)
DELETE FROM `insurance_contributions`;
INSERT INTO `insurance_contributions` (`id`, `user_id`, `month_id`, `amount`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 100.00, '2026-04-05 05:49:26', '2026-04-05 05:49:26'),
	(2, 3, 1, 100.00, '2026-04-05 05:49:26', '2026-04-05 05:49:26'),
	(3, 4, 1, 100.00, '2026-04-05 05:49:26', '2026-04-05 05:49:26'),
	(4, 6, 1, 100.00, '2026-04-05 05:49:26', '2026-04-05 05:49:26'),
	(5, 8, 1, 100.00, '2026-04-05 05:49:26', '2026-04-05 05:49:26'),
	(6, 9, 1, 100.00, '2026-04-05 05:49:26', '2026-04-05 05:49:26'),
	(7, 10, 1, 100.00, '2026-04-05 05:49:26', '2026-04-05 05:49:26'),
	(8, 11, 1, 100.00, '2026-04-05 05:49:26', '2026-04-05 05:49:26'),
	(9, 14, 13, 200.00, '2024-11-25 22:00:00', '2026-04-09 18:37:56'),
	(10, 14, 14, 200.00, '2024-12-20 22:00:00', '2026-04-09 18:37:56'),
	(11, 14, 15, 200.00, '2025-01-21 22:00:00', '2026-04-09 18:37:56'),
	(12, 14, 16, 200.00, '2025-02-24 22:00:00', '2026-04-09 18:37:56'),
	(13, 14, 17, 200.00, '2025-03-17 22:00:00', '2026-04-09 18:37:56'),
	(14, 14, 18, 200.00, '2025-04-01 22:00:00', '2026-04-09 18:37:56'),
	(15, 14, 19, 200.00, '2025-05-06 22:00:00', '2026-04-09 18:37:56'),
	(16, 14, 20, 200.00, '2025-06-02 22:00:00', '2026-04-09 18:37:56'),
	(17, 14, 21, 200.00, '2025-07-14 22:00:00', '2026-04-09 18:37:56'),
	(18, 14, 22, 200.00, '2025-08-13 22:00:00', '2026-04-09 18:37:56'),
	(19, 15, 17, 200.00, '2025-03-21 22:00:00', '2026-04-09 18:37:56'),
	(20, 15, 18, 200.00, '2025-04-19 22:00:00', '2026-04-09 18:37:56'),
	(21, 15, 19, 200.00, '2025-05-20 22:00:00', '2026-04-09 18:37:56'),
	(22, 15, 20, 200.00, '2025-06-07 22:00:00', '2026-04-09 18:37:56'),
	(23, 15, 21, 200.00, '2025-07-15 22:00:00', '2026-04-09 18:37:56'),
	(24, 15, 22, 200.00, '2025-08-13 22:00:00', '2026-04-09 18:37:56'),
	(25, 16, 13, 200.00, '2024-11-25 22:00:00', '2026-04-09 18:37:56'),
	(26, 16, 14, 200.00, '2024-12-09 22:00:00', '2026-04-09 18:37:56'),
	(27, 16, 15, 200.00, '2025-01-09 22:00:00', '2026-04-09 18:37:56'),
	(28, 16, 16, 200.00, '2025-02-15 22:00:00', '2026-04-09 18:37:56'),
	(29, 16, 17, 200.00, '2025-03-25 22:00:00', '2026-04-09 18:37:56'),
	(30, 16, 18, 200.00, '2025-04-17 22:00:00', '2026-04-09 18:37:56'),
	(31, 16, 19, 200.00, '2025-05-16 22:00:00', '2026-04-09 18:37:56'),
	(32, 16, 20, 200.00, '2025-06-17 22:00:00', '2026-04-09 18:37:56'),
	(33, 16, 21, 200.00, '2025-07-10 22:00:00', '2026-04-09 18:37:56'),
	(34, 16, 22, 200.00, '2025-08-07 22:00:00', '2026-04-09 18:37:56'),
	(35, 17, 13, 200.00, '2024-11-01 22:00:00', '2026-04-09 18:37:56'),
	(36, 17, 14, 200.00, '2024-12-15 22:00:00', '2026-04-09 18:37:56'),
	(37, 17, 15, 200.00, '2025-01-06 22:00:00', '2026-04-09 18:37:56'),
	(38, 17, 16, 200.00, '2025-02-19 22:00:00', '2026-04-09 18:37:56'),
	(39, 17, 17, 200.00, '2025-03-03 22:00:00', '2026-04-09 18:37:56'),
	(40, 17, 18, 200.00, '2025-04-01 22:00:00', '2026-04-09 18:37:56'),
	(41, 17, 19, 200.00, '2025-05-10 22:00:00', '2026-04-09 18:37:56'),
	(42, 17, 20, 200.00, '2025-06-16 22:00:00', '2026-04-09 18:37:56'),
	(43, 17, 21, 200.00, '2025-07-06 22:00:00', '2026-04-09 18:37:56'),
	(44, 17, 22, 200.00, '2025-08-12 22:00:00', '2026-04-09 18:37:56'),
	(45, 18, 13, 200.00, '2024-11-20 22:00:00', '2026-04-09 18:37:56'),
	(46, 18, 14, 200.00, '2024-12-18 22:00:00', '2026-04-09 18:37:56'),
	(47, 18, 15, 200.00, '2025-01-16 22:00:00', '2026-04-09 18:37:56'),
	(48, 18, 16, 200.00, '2025-02-20 22:00:00', '2026-04-09 18:37:56'),
	(49, 18, 17, 200.00, '2025-03-12 22:00:00', '2026-04-09 18:37:56'),
	(50, 18, 18, 200.00, '2025-04-02 22:00:00', '2026-04-09 18:37:56'),
	(51, 18, 19, 200.00, '2025-05-12 22:00:00', '2026-04-09 18:37:56'),
	(52, 18, 20, 200.00, '2025-06-19 22:00:00', '2026-04-09 18:37:56'),
	(53, 18, 21, 200.00, '2025-07-08 22:00:00', '2026-04-09 18:37:56'),
	(54, 18, 22, 200.00, '2025-08-22 22:00:00', '2026-04-09 18:37:56'),
	(55, 19, 13, 200.00, '2024-11-05 22:00:00', '2026-04-09 18:37:56'),
	(56, 19, 14, 200.00, '2024-12-06 22:00:00', '2026-04-09 18:37:56'),
	(57, 19, 15, 200.00, '2025-01-15 22:00:00', '2026-04-09 18:37:56'),
	(58, 19, 16, 200.00, '2025-02-25 22:00:00', '2026-04-09 18:37:56'),
	(59, 19, 17, 200.00, '2025-03-14 22:00:00', '2026-04-09 18:37:56'),
	(60, 19, 18, 200.00, '2025-04-15 22:00:00', '2026-04-09 18:37:56'),
	(61, 19, 19, 200.00, '2025-05-23 22:00:00', '2026-04-09 18:37:56'),
	(62, 19, 20, 200.00, '2025-06-09 22:00:00', '2026-04-09 18:37:56'),
	(63, 19, 21, 200.00, '2025-07-01 22:00:00', '2026-04-09 18:37:56'),
	(64, 19, 22, 200.00, '2025-08-20 22:00:00', '2026-04-09 18:37:56'),
	(65, 20, 13, 200.00, '2024-11-10 22:00:00', '2026-04-09 18:37:56'),
	(66, 20, 14, 200.00, '2024-12-15 22:00:00', '2026-04-09 18:37:56'),
	(67, 20, 15, 200.00, '2025-01-25 22:00:00', '2026-04-09 18:37:56'),
	(68, 20, 16, 200.00, '2025-02-13 22:00:00', '2026-04-09 18:37:56'),
	(69, 20, 17, 200.00, '2025-03-01 22:00:00', '2026-04-09 18:37:56'),
	(70, 20, 18, 200.00, '2025-04-25 22:00:00', '2026-04-09 18:37:56'),
	(71, 20, 19, 200.00, '2025-05-13 22:00:00', '2026-04-09 18:37:56'),
	(72, 20, 20, 200.00, '2025-06-11 22:00:00', '2026-04-09 18:37:56'),
	(73, 20, 21, 200.00, '2025-07-02 22:00:00', '2026-04-09 18:37:56'),
	(74, 20, 22, 200.00, '2025-08-25 22:00:00', '2026-04-09 18:37:56'),
	(75, 21, 13, 200.00, '2024-11-03 22:00:00', '2026-04-09 18:37:56'),
	(76, 21, 14, 200.00, '2024-12-08 22:00:00', '2026-04-09 18:37:56'),
	(77, 21, 15, 200.00, '2025-01-07 22:00:00', '2026-04-09 18:37:56'),
	(78, 21, 16, 200.00, '2025-02-20 22:00:00', '2026-04-09 18:37:56'),
	(79, 21, 17, 200.00, '2025-03-12 22:00:00', '2026-04-09 18:37:56'),
	(80, 21, 18, 200.00, '2025-04-03 22:00:00', '2026-04-09 18:37:56'),
	(81, 21, 19, 200.00, '2025-05-06 22:00:00', '2026-04-09 18:37:56'),
	(82, 21, 20, 200.00, '2025-06-07 22:00:00', '2026-04-09 18:37:56'),
	(83, 21, 21, 200.00, '2025-07-03 22:00:00', '2026-04-09 18:37:56'),
	(84, 21, 22, 200.00, '2025-08-13 22:00:00', '2026-04-09 18:37:56'),
	(85, 22, 13, 200.00, '2024-11-24 22:00:00', '2026-04-09 18:37:56'),
	(86, 22, 14, 200.00, '2024-12-19 22:00:00', '2026-04-09 18:37:56'),
	(87, 22, 15, 200.00, '2025-01-16 22:00:00', '2026-04-09 18:37:56'),
	(88, 22, 16, 200.00, '2025-02-03 22:00:00', '2026-04-09 18:37:56'),
	(89, 22, 17, 200.00, '2025-03-03 22:00:00', '2026-04-09 18:37:56'),
	(90, 22, 18, 200.00, '2025-04-15 22:00:00', '2026-04-09 18:37:56'),
	(91, 22, 19, 200.00, '2025-05-25 22:00:00', '2026-04-09 18:37:56'),
	(92, 22, 20, 200.00, '2025-06-07 22:00:00', '2026-04-09 18:37:56'),
	(93, 22, 21, 200.00, '2025-07-05 22:00:00', '2026-04-09 18:37:56'),
	(94, 22, 22, 200.00, '2025-08-05 22:00:00', '2026-04-09 18:37:56'),
	(95, 23, 13, 200.00, '2024-11-24 22:00:00', '2026-04-09 18:37:56'),
	(96, 23, 14, 200.00, '2024-12-20 22:00:00', '2026-04-09 18:37:56'),
	(97, 23, 15, 200.00, '2025-01-17 22:00:00', '2026-04-09 18:37:56'),
	(98, 23, 16, 200.00, '2025-02-04 22:00:00', '2026-04-09 18:37:56'),
	(99, 23, 17, 200.00, '2025-03-12 22:00:00', '2026-04-09 18:37:56'),
	(100, 23, 18, 200.00, '2025-04-17 22:00:00', '2026-04-09 18:37:56'),
	(101, 23, 19, 200.00, '2025-05-22 22:00:00', '2026-04-09 18:37:56'),
	(102, 23, 20, 200.00, '2025-06-05 22:00:00', '2026-04-09 18:37:56'),
	(103, 23, 21, 200.00, '2025-07-08 22:00:00', '2026-04-09 18:37:56'),
	(104, 23, 22, 200.00, '2025-08-22 22:00:00', '2026-04-09 18:37:56'),
	(105, 24, 13, 200.00, '2024-11-13 22:00:00', '2026-04-09 18:37:56'),
	(106, 24, 14, 200.00, '2024-12-09 22:00:00', '2026-04-09 18:37:56'),
	(107, 24, 15, 200.00, '2025-01-04 22:00:00', '2026-04-09 18:37:56'),
	(108, 24, 16, 200.00, '2025-02-18 22:00:00', '2026-04-09 18:37:56'),
	(109, 24, 17, 200.00, '2025-03-20 22:00:00', '2026-04-09 18:37:56'),
	(110, 24, 18, 200.00, '2025-04-15 22:00:00', '2026-04-09 18:37:56'),
	(111, 24, 19, 200.00, '2025-05-19 22:00:00', '2026-04-09 18:37:56'),
	(112, 24, 20, 200.00, '2025-06-08 22:00:00', '2026-04-09 18:37:56'),
	(113, 24, 21, 200.00, '2025-07-24 22:00:00', '2026-04-09 18:37:56'),
	(114, 24, 22, 200.00, '2025-08-25 22:00:00', '2026-04-09 18:37:56'),
	(115, 25, 13, 200.00, '2024-11-19 22:00:00', '2026-04-09 18:37:56'),
	(116, 25, 14, 200.00, '2024-12-22 22:00:00', '2026-04-09 18:37:56'),
	(117, 25, 15, 200.00, '2025-01-07 22:00:00', '2026-04-09 18:37:56'),
	(118, 25, 16, 200.00, '2025-02-25 22:00:00', '2026-04-09 18:37:56'),
	(119, 25, 17, 200.00, '2025-03-01 22:00:00', '2026-04-09 18:37:56'),
	(120, 25, 18, 200.00, '2025-04-22 22:00:00', '2026-04-09 18:37:56'),
	(121, 25, 19, 200.00, '2025-05-12 22:00:00', '2026-04-09 18:37:56'),
	(122, 25, 20, 200.00, '2025-06-03 22:00:00', '2026-04-09 18:37:56'),
	(123, 25, 21, 200.00, '2025-07-11 22:00:00', '2026-04-09 18:37:56'),
	(124, 25, 22, 200.00, '2025-08-15 22:00:00', '2026-04-09 18:37:56'),
	(125, 26, 13, 200.00, '2024-11-19 22:00:00', '2026-04-09 18:37:56'),
	(126, 26, 14, 200.00, '2024-12-01 22:00:00', '2026-04-09 18:37:56'),
	(127, 26, 15, 200.00, '2025-01-12 22:00:00', '2026-04-09 18:37:56'),
	(128, 26, 16, 200.00, '2025-02-02 22:00:00', '2026-04-09 18:37:56'),
	(129, 26, 17, 200.00, '2025-03-18 22:00:00', '2026-04-09 18:37:56'),
	(130, 26, 18, 200.00, '2025-04-25 22:00:00', '2026-04-09 18:37:56'),
	(131, 26, 19, 200.00, '2025-05-10 22:00:00', '2026-04-09 18:37:56'),
	(132, 26, 20, 200.00, '2025-06-19 22:00:00', '2026-04-09 18:37:56'),
	(133, 26, 21, 200.00, '2025-07-13 22:00:00', '2026-04-09 18:37:56'),
	(134, 26, 22, 200.00, '2025-08-15 22:00:00', '2026-04-09 18:37:56'),
	(135, 27, 13, 200.00, '2024-11-04 22:00:00', '2026-04-09 18:37:56'),
	(136, 27, 14, 200.00, '2024-12-15 22:00:00', '2026-04-09 18:37:56'),
	(137, 27, 15, 200.00, '2025-01-21 22:00:00', '2026-04-09 18:37:56'),
	(138, 27, 16, 200.00, '2025-02-08 22:00:00', '2026-04-09 18:37:56'),
	(139, 27, 17, 200.00, '2025-03-16 22:00:00', '2026-04-09 18:37:56'),
	(140, 27, 18, 200.00, '2025-04-17 22:00:00', '2026-04-09 18:37:56'),
	(141, 27, 19, 200.00, '2025-05-24 22:00:00', '2026-04-09 18:37:56'),
	(142, 27, 20, 200.00, '2025-06-03 22:00:00', '2026-04-09 18:37:56'),
	(143, 27, 21, 200.00, '2025-07-10 22:00:00', '2026-04-09 18:37:56'),
	(144, 27, 22, 200.00, '2025-08-22 22:00:00', '2026-04-09 18:37:56'),
	(145, 28, 13, 200.00, '2024-11-02 22:00:00', '2026-04-09 18:37:56'),
	(146, 28, 14, 200.00, '2024-12-07 22:00:00', '2026-04-09 18:37:56'),
	(147, 28, 15, 200.00, '2025-01-01 22:00:00', '2026-04-09 18:37:56'),
	(148, 28, 16, 200.00, '2025-02-07 22:00:00', '2026-04-09 18:37:56'),
	(149, 28, 17, 200.00, '2025-03-14 22:00:00', '2026-04-09 18:37:56'),
	(150, 28, 18, 200.00, '2025-04-20 22:00:00', '2026-04-09 18:37:56'),
	(151, 28, 19, 200.00, '2025-05-22 22:00:00', '2026-04-09 18:37:56'),
	(152, 28, 20, 200.00, '2025-06-02 22:00:00', '2026-04-09 18:37:56'),
	(153, 28, 21, 200.00, '2025-07-11 22:00:00', '2026-04-09 18:37:56'),
	(154, 28, 22, 200.00, '2025-08-02 22:00:00', '2026-04-09 18:37:56'),
	(155, 29, 13, 200.00, '2024-11-18 22:00:00', '2026-04-09 18:37:56'),
	(156, 29, 14, 200.00, '2024-12-13 22:00:00', '2026-04-09 18:37:56'),
	(157, 29, 15, 200.00, '2025-01-06 22:00:00', '2026-04-09 18:37:56'),
	(158, 29, 16, 200.00, '2025-02-12 22:00:00', '2026-04-09 18:37:56'),
	(159, 29, 17, 200.00, '2025-03-03 22:00:00', '2026-04-09 18:37:56'),
	(160, 29, 18, 200.00, '2025-04-06 22:00:00', '2026-04-09 18:37:56'),
	(161, 29, 19, 200.00, '2025-05-25 22:00:00', '2026-04-09 18:37:56'),
	(162, 29, 20, 200.00, '2025-06-01 22:00:00', '2026-04-09 18:37:56'),
	(163, 29, 21, 200.00, '2025-07-02 22:00:00', '2026-04-09 18:37:56'),
	(164, 29, 22, 200.00, '2025-08-08 22:00:00', '2026-04-09 18:37:56'),
	(165, 30, 13, 200.00, '2024-11-23 22:00:00', '2026-04-09 18:37:56'),
	(166, 30, 14, 200.00, '2024-12-05 22:00:00', '2026-04-09 18:37:56'),
	(167, 30, 15, 200.00, '2025-01-09 22:00:00', '2026-04-09 18:37:56'),
	(168, 30, 16, 200.00, '2025-02-19 22:00:00', '2026-04-09 18:37:56'),
	(169, 30, 17, 200.00, '2025-03-18 22:00:00', '2026-04-09 18:37:56'),
	(170, 30, 18, 200.00, '2025-04-01 22:00:00', '2026-04-09 18:37:56'),
	(171, 30, 19, 200.00, '2025-05-11 22:00:00', '2026-04-09 18:37:56'),
	(172, 30, 20, 200.00, '2025-06-21 22:00:00', '2026-04-09 18:37:56'),
	(173, 30, 21, 200.00, '2025-07-06 22:00:00', '2026-04-09 18:37:56'),
	(174, 30, 22, 200.00, '2025-08-15 22:00:00', '2026-04-09 18:37:56'),
	(175, 31, 13, 200.00, '2024-11-15 22:00:00', '2026-04-09 18:37:56'),
	(176, 31, 14, 200.00, '2024-12-13 22:00:00', '2026-04-09 18:37:56'),
	(177, 31, 15, 200.00, '2025-01-21 22:00:00', '2026-04-09 18:37:56'),
	(178, 31, 16, 200.00, '2025-02-05 22:00:00', '2026-04-09 18:37:56'),
	(179, 31, 17, 200.00, '2025-03-02 22:00:00', '2026-04-09 18:37:56'),
	(180, 31, 18, 200.00, '2025-04-22 22:00:00', '2026-04-09 18:37:56'),
	(181, 31, 19, 200.00, '2025-05-02 22:00:00', '2026-04-09 18:37:56'),
	(182, 31, 20, 200.00, '2025-06-08 22:00:00', '2026-04-09 18:37:56'),
	(183, 31, 21, 200.00, '2025-07-11 22:00:00', '2026-04-09 18:37:56'),
	(184, 31, 22, 200.00, '2025-08-17 22:00:00', '2026-04-09 18:37:56'),
	(185, 32, 14, 200.00, '2024-12-19 22:00:00', '2026-04-09 18:37:56'),
	(186, 32, 15, 200.00, '2025-01-14 22:00:00', '2026-04-09 18:37:56'),
	(187, 32, 16, 200.00, '2025-02-08 22:00:00', '2026-04-09 18:37:56'),
	(188, 32, 17, 200.00, '2025-03-01 22:00:00', '2026-04-09 18:37:56'),
	(189, 32, 18, 200.00, '2025-04-12 22:00:00', '2026-04-09 18:37:56'),
	(190, 32, 19, 200.00, '2025-05-03 22:00:00', '2026-04-09 18:37:56'),
	(191, 32, 20, 200.00, '2025-06-23 22:00:00', '2026-04-09 18:37:56'),
	(192, 32, 21, 200.00, '2025-07-23 22:00:00', '2026-04-09 18:37:56'),
	(193, 32, 22, 200.00, '2025-08-17 22:00:00', '2026-04-09 18:37:56'),
	(194, 33, 13, 200.00, '2024-11-16 22:00:00', '2026-04-09 18:37:56'),
	(195, 33, 14, 200.00, '2024-12-06 22:00:00', '2026-04-09 18:37:56'),
	(196, 33, 15, 200.00, '2025-01-16 22:00:00', '2026-04-09 18:37:56'),
	(197, 33, 16, 200.00, '2025-02-23 22:00:00', '2026-04-09 18:37:56'),
	(198, 33, 17, 200.00, '2025-03-03 22:00:00', '2026-04-09 18:37:56'),
	(199, 33, 18, 200.00, '2025-04-22 22:00:00', '2026-04-09 18:37:56'),
	(200, 33, 19, 200.00, '2025-05-09 22:00:00', '2026-04-09 18:37:56'),
	(201, 33, 20, 200.00, '2025-06-06 22:00:00', '2026-04-09 18:37:56'),
	(202, 33, 21, 200.00, '2025-07-13 22:00:00', '2026-04-09 18:37:56'),
	(203, 33, 22, 200.00, '2025-08-25 22:00:00', '2026-04-09 18:37:56'),
	(204, 34, 13, 200.00, '2024-11-13 22:00:00', '2026-04-09 18:37:56'),
	(205, 34, 14, 200.00, '2024-12-17 22:00:00', '2026-04-09 18:37:56'),
	(206, 34, 15, 200.00, '2025-01-09 22:00:00', '2026-04-09 18:37:56'),
	(207, 34, 16, 200.00, '2025-02-09 22:00:00', '2026-04-09 18:37:56'),
	(208, 34, 17, 200.00, '2025-03-24 22:00:00', '2026-04-09 18:37:56'),
	(209, 34, 18, 200.00, '2025-04-08 22:00:00', '2026-04-09 18:37:56'),
	(210, 34, 19, 200.00, '2025-05-15 22:00:00', '2026-04-09 18:37:56'),
	(211, 34, 20, 200.00, '2025-06-21 22:00:00', '2026-04-09 18:37:56'),
	(212, 34, 21, 200.00, '2025-07-14 22:00:00', '2026-04-09 18:37:56'),
	(213, 34, 22, 200.00, '2025-08-05 22:00:00', '2026-04-09 18:37:56'),
	(214, 35, 13, 200.00, '2024-11-09 22:00:00', '2026-04-09 18:37:56'),
	(215, 35, 14, 200.00, '2024-12-23 22:00:00', '2026-04-09 18:37:56'),
	(216, 35, 15, 200.00, '2025-01-17 22:00:00', '2026-04-09 18:37:56'),
	(217, 35, 16, 200.00, '2025-02-20 22:00:00', '2026-04-09 18:37:56'),
	(218, 35, 17, 200.00, '2025-03-06 22:00:00', '2026-04-09 18:37:56'),
	(219, 35, 18, 200.00, '2025-04-12 22:00:00', '2026-04-09 18:37:56'),
	(220, 35, 19, 200.00, '2025-05-20 22:00:00', '2026-04-09 18:37:56'),
	(221, 35, 20, 200.00, '2025-06-08 22:00:00', '2026-04-09 18:37:56'),
	(222, 35, 21, 200.00, '2025-07-16 22:00:00', '2026-04-09 18:37:56'),
	(223, 35, 22, 200.00, '2025-08-04 22:00:00', '2026-04-09 18:37:56'),
	(224, 36, 13, 200.00, '2024-11-04 22:00:00', '2026-04-09 18:37:56'),
	(225, 36, 14, 200.00, '2024-12-14 22:00:00', '2026-04-09 18:37:56'),
	(226, 36, 15, 200.00, '2025-01-04 22:00:00', '2026-04-09 18:37:56'),
	(227, 36, 16, 200.00, '2025-02-05 22:00:00', '2026-04-09 18:37:56'),
	(228, 36, 17, 200.00, '2025-03-21 22:00:00', '2026-04-09 18:37:56'),
	(229, 36, 18, 200.00, '2025-04-21 22:00:00', '2026-04-09 18:37:56'),
	(230, 36, 19, 200.00, '2025-05-10 22:00:00', '2026-04-09 18:37:56'),
	(231, 36, 21, 200.00, '2025-07-20 22:00:00', '2026-04-09 18:37:56'),
	(232, 36, 22, 200.00, '2025-08-17 22:00:00', '2026-04-09 18:37:56'),
	(233, 37, 13, 200.00, '2024-11-17 22:00:00', '2026-04-09 18:37:56'),
	(234, 37, 14, 200.00, '2024-12-10 22:00:00', '2026-04-09 18:37:56'),
	(235, 37, 15, 200.00, '2025-01-23 22:00:00', '2026-04-09 18:37:56'),
	(236, 37, 16, 200.00, '2025-02-10 22:00:00', '2026-04-09 18:37:56'),
	(237, 37, 17, 200.00, '2025-03-19 22:00:00', '2026-04-09 18:37:56'),
	(238, 37, 18, 200.00, '2025-04-17 22:00:00', '2026-04-09 18:37:56'),
	(239, 37, 19, 200.00, '2025-05-09 22:00:00', '2026-04-09 18:37:56'),
	(240, 37, 20, 200.00, '2025-06-16 22:00:00', '2026-04-09 18:37:56'),
	(241, 37, 21, 200.00, '2025-07-14 22:00:00', '2026-04-09 18:37:56'),
	(242, 37, 22, 200.00, '2025-08-17 22:00:00', '2026-04-09 18:37:56'),
	(243, 38, 13, 200.00, '2024-11-07 22:00:00', '2026-04-09 18:37:56'),
	(244, 40, 25, 100.00, '2025-02-07 22:00:00', '2026-04-09 18:38:02'),
	(245, 40, 26, 100.00, '2025-03-19 22:00:00', '2026-04-09 18:38:02'),
	(246, 40, 27, 100.00, '2025-04-13 22:00:00', '2026-04-09 18:38:02'),
	(247, 40, 28, 100.00, '2025-05-04 22:00:00', '2026-04-09 18:38:02'),
	(248, 40, 29, 100.00, '2025-06-03 22:00:00', '2026-04-09 18:38:02'),
	(249, 40, 30, 100.00, '2025-07-02 22:00:00', '2026-04-09 18:38:02'),
	(250, 40, 33, 100.00, '2025-10-09 22:00:00', '2026-04-09 18:38:02'),
	(251, 41, 25, 100.00, '2025-02-11 22:00:00', '2026-04-09 18:38:02'),
	(252, 41, 26, 100.00, '2025-03-12 22:00:00', '2026-04-09 18:38:02'),
	(253, 41, 27, 100.00, '2025-04-08 22:00:00', '2026-04-09 18:38:02'),
	(254, 41, 28, 100.00, '2025-05-18 22:00:00', '2026-04-09 18:38:02'),
	(255, 41, 29, 100.00, '2025-06-20 22:00:00', '2026-04-09 18:38:02'),
	(256, 41, 30, 100.00, '2025-07-05 22:00:00', '2026-04-09 18:38:02'),
	(257, 41, 31, 100.00, '2025-08-12 22:00:00', '2026-04-09 18:38:02'),
	(258, 41, 32, 100.00, '2025-09-12 22:00:00', '2026-04-09 18:38:02'),
	(259, 41, 33, 100.00, '2025-10-03 22:00:00', '2026-04-09 18:38:02'),
	(260, 42, 25, 100.00, '2025-02-05 22:00:00', '2026-04-09 18:38:02'),
	(261, 42, 26, 100.00, '2025-03-04 22:00:00', '2026-04-09 18:38:02'),
	(262, 42, 27, 100.00, '2025-04-09 22:00:00', '2026-04-09 18:38:02'),
	(263, 42, 28, 100.00, '2025-05-18 22:00:00', '2026-04-09 18:38:02'),
	(264, 42, 29, 100.00, '2025-06-16 22:00:00', '2026-04-09 18:38:02'),
	(265, 42, 30, 100.00, '2025-07-08 22:00:00', '2026-04-09 18:38:02'),
	(266, 42, 31, 100.00, '2025-08-11 22:00:00', '2026-04-09 18:38:02'),
	(267, 42, 32, 100.00, '2025-09-17 22:00:00', '2026-04-09 18:38:02'),
	(268, 42, 33, 100.00, '2025-10-07 22:00:00', '2026-04-09 18:38:02'),
	(269, 43, 26, 100.00, '2025-03-05 22:00:00', '2026-04-09 18:38:02'),
	(270, 43, 27, 100.00, '2025-04-07 22:00:00', '2026-04-09 18:38:02'),
	(271, 43, 28, 100.00, '2025-05-15 22:00:00', '2026-04-09 18:38:02'),
	(272, 43, 29, 100.00, '2025-06-09 22:00:00', '2026-04-09 18:38:02'),
	(273, 43, 30, 100.00, '2025-07-06 22:00:00', '2026-04-09 18:38:02'),
	(274, 43, 31, 100.00, '2025-08-10 22:00:00', '2026-04-09 18:38:02'),
	(275, 43, 32, 100.00, '2025-09-10 22:00:00', '2026-04-09 18:38:02'),
	(276, 43, 33, 100.00, '2025-10-10 22:00:00', '2026-04-09 18:38:02'),
	(277, 44, 25, 100.00, '2025-02-17 22:00:00', '2026-04-09 18:38:02'),
	(278, 44, 26, 100.00, '2025-03-05 22:00:00', '2026-04-09 18:38:02'),
	(279, 44, 27, 100.00, '2025-04-04 22:00:00', '2026-04-09 18:38:02'),
	(280, 44, 28, 100.00, '2025-05-11 22:00:00', '2026-04-09 18:38:02'),
	(281, 44, 29, 100.00, '2025-06-19 22:00:00', '2026-04-09 18:38:02'),
	(282, 44, 30, 100.00, '2025-07-18 22:00:00', '2026-04-09 18:38:02'),
	(283, 44, 31, 100.00, '2025-08-02 22:00:00', '2026-04-09 18:38:02'),
	(284, 44, 32, 100.00, '2025-09-10 22:00:00', '2026-04-09 18:38:02'),
	(285, 44, 33, 100.00, '2025-10-06 22:00:00', '2026-04-09 18:38:02'),
	(286, 45, 25, 100.00, '2025-02-05 22:00:00', '2026-04-09 18:38:02'),
	(287, 45, 26, 100.00, '2025-03-09 22:00:00', '2026-04-09 18:38:02'),
	(288, 45, 28, 100.00, '2025-05-10 22:00:00', '2026-04-09 18:38:02'),
	(289, 45, 29, 100.00, '2025-06-20 22:00:00', '2026-04-09 18:38:02'),
	(290, 45, 30, 100.00, '2025-07-09 22:00:00', '2026-04-09 18:38:02'),
	(291, 45, 31, 100.00, '2025-08-01 22:00:00', '2026-04-09 18:38:02'),
	(292, 45, 33, 100.00, '2025-10-06 22:00:00', '2026-04-09 18:38:02'),
	(293, 46, 25, 100.00, '2025-02-19 22:00:00', '2026-04-09 18:38:02'),
	(294, 46, 26, 100.00, '2025-03-14 22:00:00', '2026-04-09 18:38:02'),
	(295, 46, 27, 100.00, '2025-04-08 22:00:00', '2026-04-09 18:38:02'),
	(296, 46, 28, 100.00, '2025-05-12 22:00:00', '2026-04-09 18:38:02'),
	(297, 46, 29, 100.00, '2025-06-16 22:00:00', '2026-04-09 18:38:02'),
	(298, 46, 30, 100.00, '2025-07-07 22:00:00', '2026-04-09 18:38:02'),
	(299, 46, 31, 100.00, '2025-08-16 22:00:00', '2026-04-09 18:38:02'),
	(300, 46, 33, 100.00, '2025-10-11 22:00:00', '2026-04-09 18:38:02'),
	(301, 47, 27, 100.00, '2025-04-08 22:00:00', '2026-04-09 18:38:02'),
	(302, 47, 28, 100.00, '2025-05-08 22:00:00', '2026-04-09 18:38:02'),
	(303, 47, 29, 100.00, '2025-06-06 22:00:00', '2026-04-09 18:38:02'),
	(304, 47, 30, 100.00, '2025-07-13 22:00:00', '2026-04-09 18:38:02'),
	(305, 47, 33, 100.00, '2025-10-05 22:00:00', '2026-04-09 18:38:02'),
	(306, 48, 26, 100.00, '2025-03-01 22:00:00', '2026-04-09 18:38:02'),
	(307, 48, 28, 100.00, '2025-05-16 22:00:00', '2026-04-09 18:38:02'),
	(308, 48, 29, 100.00, '2025-06-11 22:00:00', '2026-04-09 18:38:02'),
	(309, 48, 30, 100.00, '2025-07-17 22:00:00', '2026-04-09 18:38:02'),
	(310, 48, 31, 100.00, '2025-08-02 22:00:00', '2026-04-09 18:38:02'),
	(311, 48, 32, 100.00, '2025-09-19 22:00:00', '2026-04-09 18:38:02'),
	(312, 48, 33, 100.00, '2025-10-07 22:00:00', '2026-04-09 18:38:02'),
	(313, 49, 29, 100.00, '2025-06-10 22:00:00', '2026-04-09 18:38:02'),
	(314, 49, 30, 100.00, '2025-07-13 22:00:00', '2026-04-09 18:38:02'),
	(315, 49, 33, 100.00, '2025-10-14 22:00:00', '2026-04-09 18:38:02'),
	(316, 50, 29, 100.00, '2025-06-07 22:00:00', '2026-04-09 18:38:02'),
	(317, 50, 30, 100.00, '2025-07-10 22:00:00', '2026-04-09 18:38:02'),
	(318, 50, 31, 100.00, '2025-08-02 22:00:00', '2026-04-09 18:38:02'),
	(319, 50, 33, 100.00, '2025-10-07 22:00:00', '2026-04-09 18:38:02'),
	(320, 51, 33, 100.00, '2025-10-03 22:00:00', '2026-04-09 18:38:02');

-- Dumping structure for table ziko_village_bank_management_system.licenses
DROP TABLE IF EXISTS `licenses`;
CREATE TABLE IF NOT EXISTS `licenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `village_bank_id` bigint unsigned NOT NULL,
  `subscription_id` bigint unsigned NOT NULL,
  `license_key` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','expired','revoked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `issued_at` timestamp NOT NULL,
  `expires_at` timestamp NOT NULL,
  `revoked_at` timestamp NULL DEFAULT NULL,
  `revoke_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `licenses_license_key_unique` (`license_key`),
  KEY `licenses_village_bank_id_foreign` (`village_bank_id`),
  KEY `licenses_subscription_id_foreign` (`subscription_id`),
  CONSTRAINT `licenses_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `licenses_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.licenses: ~1 rows (approximately)
DELETE FROM `licenses`;
INSERT INTO `licenses` (`id`, `village_bank_id`, `subscription_id`, `license_key`, `status`, `issued_at`, `expires_at`, `revoked_at`, `revoke_reason`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'VB-RK0Y-8S9T-2FXY', 'active', '2026-04-03 18:41:37', '2026-05-03 18:41:37', NULL, NULL, '2026-04-03 18:41:37', '2026-04-03 18:41:37');

-- Dumping structure for table ziko_village_bank_management_system.loans
DROP TABLE IF EXISTS `loans`;
CREATE TABLE IF NOT EXISTS `loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `borrower_id` bigint unsigned NOT NULL,
  `month_id` bigint unsigned NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `duration` int NOT NULL DEFAULT '1',
  `total_payable` decimal(12,2) DEFAULT NULL,
  `outstanding_balance` decimal(12,2) DEFAULT NULL,
  `status` enum('pending','approved','rejected','active','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'voluntary',
  `forced_by` bigint unsigned DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loans_borrower_id_foreign` (`borrower_id`),
  KEY `loans_month_id_foreign` (`month_id`),
  KEY `loans_forced_by_foreign` (`forced_by`),
  CONSTRAINT `loans_borrower_id_foreign` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`id`),
  CONSTRAINT `loans_forced_by_foreign` FOREIGN KEY (`forced_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loans_month_id_foreign` FOREIGN KEY (`month_id`) REFERENCES `months` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.loans: ~72 rows (approximately)
DELETE FROM `loans`;
INSERT INTO `loans` (`id`, `borrower_id`, `month_id`, `amount`, `interest_rate`, `duration`, `total_payable`, `outstanding_balance`, `status`, `type`, `forced_by`, `notes`, `created_at`, `updated_at`) VALUES
	(1, 6, 1, 5000.00, 20.00, 5, 6000.00, 2900.00, 'active', 'voluntary', NULL, NULL, '2026-04-04 19:41:18', '2026-04-05 12:56:18'),
	(2, 11, 1, 500.00, 10.00, 1, 550.00, 550.00, 'pending', 'voluntary', NULL, NULL, '2026-04-06 09:04:03', '2026-04-06 09:04:03'),
	(3, 11, 1, 500.00, 10.00, 3, 550.00, 550.00, 'active', 'voluntary', NULL, NULL, '2026-04-06 13:28:22', '2026-04-07 14:18:58'),
	(4, 4, 1, 900.00, 10.00, 4, 990.00, 990.00, 'active', 'voluntary', NULL, NULL, '2026-04-06 13:29:13', '2026-04-07 14:18:56'),
	(5, 14, 14, 44800.00, 10.00, 1, 49280.00, 26180.00, 'active', 'voluntary', NULL, 'Loan of K44800 in Dec — 10% service fee', '2024-12-20 22:00:00', '2026-04-09 18:37:56'),
	(6, 14, 17, 50000.00, 10.00, 1, 55000.00, 55000.00, 'active', 'voluntary', NULL, 'Loan of K50000 in Mar — 10% service fee', '2025-03-06 22:00:00', '2026-04-09 18:37:56'),
	(7, 14, 19, 3429.00, 10.00, 1, 3771.90, 3771.90, 'active', 'voluntary', NULL, 'Loan of K3429 in May — 10% service fee', '2025-05-06 22:00:00', '2026-04-09 18:37:56'),
	(8, 15, 20, 14025.00, 10.00, 1, 15427.50, 15427.50, 'active', 'voluntary', NULL, 'Loan of K14025 in Jun — 10% service fee', '2025-06-20 22:00:00', '2026-04-09 18:37:56'),
	(9, 15, 21, 26090.00, 10.00, 1, 28699.00, 28699.00, 'active', 'voluntary', NULL, 'Loan of K26090 in Jul — 10% service fee', '2025-07-15 22:00:00', '2026-04-09 18:37:56'),
	(10, 16, 13, 6400.00, 10.00, 1, 7040.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K6400 in Nov — 10% service fee', '2024-11-05 22:00:00', '2026-04-09 18:37:56'),
	(11, 16, 17, 24000.00, 10.00, 1, 26400.00, 26400.00, 'active', 'voluntary', NULL, 'Loan of K24000 in Mar — 10% service fee', '2025-03-14 22:00:00', '2026-04-09 18:37:56'),
	(12, 16, 19, 8000.00, 10.00, 1, 8800.00, 8800.00, 'active', 'voluntary', NULL, 'Loan of K8000 in May — 10% service fee', '2025-05-20 22:00:00', '2026-04-09 18:37:56'),
	(13, 17, 20, 17000.00, 10.00, 1, 18700.00, 18700.00, 'active', 'voluntary', NULL, 'Loan of K17000 in Jun — 10% service fee', '2025-06-18 22:00:00', '2026-04-09 18:37:56'),
	(14, 18, 13, 20000.00, 10.00, 1, 22000.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K20000 in Nov — 10% service fee', '2024-11-07 22:00:00', '2026-04-09 18:37:56'),
	(15, 18, 14, 11340.00, 10.00, 1, 12474.00, 12474.00, 'active', 'voluntary', NULL, 'Loan of K11340 in Dec — 10% service fee', '2024-12-19 22:00:00', '2026-04-09 18:37:56'),
	(16, 18, 18, 9968.00, 10.00, 1, 10964.80, 10964.80, 'active', 'voluntary', NULL, 'Loan of K9968 in Apr — 10% service fee', '2025-04-06 22:00:00', '2026-04-09 18:37:56'),
	(17, 18, 19, 5300.00, 10.00, 1, 5830.00, 5830.00, 'active', 'voluntary', NULL, 'Loan of K5300 in May — 10% service fee', '2025-05-15 22:00:00', '2026-04-09 18:37:56'),
	(18, 18, 21, 10000.00, 10.00, 1, 11000.00, 11000.00, 'active', 'voluntary', NULL, 'Loan of K10000 in Jul — 10% service fee', '2025-07-06 22:00:00', '2026-04-09 18:37:56'),
	(19, 20, 15, 3400.00, 10.00, 1, 3740.00, 3740.00, 'active', 'voluntary', NULL, 'Loan of K3400 in Jan — 10% service fee', '2025-01-18 22:00:00', '2026-04-09 18:37:56'),
	(20, 20, 22, 11000.00, 10.00, 1, 12100.00, 12100.00, 'active', 'voluntary', NULL, 'Loan of K11000 in Aug — 10% service fee', '2025-08-12 22:00:00', '2026-04-09 18:37:56'),
	(21, 21, 13, 600.00, 10.00, 1, 660.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K600 in Nov — 10% service fee', '2024-11-12 22:00:00', '2026-04-09 18:37:56'),
	(22, 21, 18, 17500.00, 10.00, 1, 19250.00, 19250.00, 'active', 'voluntary', NULL, 'Loan of K17500 in Apr — 10% service fee', '2025-04-16 22:00:00', '2026-04-09 18:37:56'),
	(23, 22, 15, 11300.00, 10.00, 1, 12430.00, 12430.00, 'active', 'voluntary', NULL, 'Loan of K11300 in Jan — 10% service fee', '2025-01-05 22:00:00', '2026-04-09 18:37:56'),
	(24, 22, 20, 50000.00, 10.00, 1, 55000.00, 55000.00, 'active', 'voluntary', NULL, 'Loan of K50000 in Jun — 10% service fee', '2025-06-20 22:00:00', '2026-04-09 18:37:56'),
	(25, 23, 13, 6100.00, 10.00, 1, 6710.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K6100 in Nov — 10% service fee', '2024-11-05 22:00:00', '2026-04-09 18:37:56'),
	(26, 23, 16, 21000.00, 10.00, 1, 23100.00, 23100.00, 'active', 'voluntary', NULL, 'Loan of K21000 in Feb — 10% service fee', '2025-02-19 22:00:00', '2026-04-09 18:37:56'),
	(27, 24, 14, 6000.00, 10.00, 1, 6600.00, 6600.00, 'active', 'voluntary', NULL, 'Loan of K6000 in Dec — 10% service fee', '2024-12-12 22:00:00', '2026-04-09 18:37:56'),
	(28, 24, 15, 8750.00, 10.00, 1, 9625.00, 9625.00, 'active', 'voluntary', NULL, 'Loan of K8750 in Jan — 10% service fee', '2025-01-17 22:00:00', '2026-04-09 18:37:56'),
	(29, 24, 17, 50000.00, 10.00, 1, 55000.00, 55000.00, 'active', 'voluntary', NULL, 'Loan of K50000 in Mar — 10% service fee', '2025-03-18 22:00:00', '2026-04-09 18:37:56'),
	(30, 24, 19, 55000.00, 10.00, 1, 60500.00, 60500.00, 'active', 'voluntary', NULL, 'Loan of K55000 in May — 10% service fee', '2025-05-07 22:00:00', '2026-04-09 18:37:56'),
	(31, 25, 15, 1400.00, 10.00, 1, 1540.00, 1540.00, 'active', 'voluntary', NULL, 'Loan of K1400 in Jan — 10% service fee', '2025-01-15 22:00:00', '2026-04-09 18:37:56'),
	(32, 26, 13, 15000.00, 10.00, 1, 16500.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K15000 in Nov — 10% service fee', '2024-11-16 22:00:00', '2026-04-09 18:37:56'),
	(33, 26, 14, 3500.00, 10.00, 1, 3850.00, 3850.00, 'active', 'voluntary', NULL, 'Loan of K3500 in Dec — 10% service fee', '2024-12-10 22:00:00', '2026-04-09 18:37:56'),
	(34, 26, 15, 2800.00, 10.00, 1, 3080.00, 3080.00, 'active', 'voluntary', NULL, 'Loan of K2800 in Jan — 10% service fee', '2025-01-18 22:00:00', '2026-04-09 18:37:56'),
	(35, 26, 18, 8000.00, 10.00, 1, 8800.00, 8800.00, 'active', 'voluntary', NULL, 'Loan of K8000 in Apr — 10% service fee', '2025-04-15 22:00:00', '2026-04-09 18:37:56'),
	(36, 27, 18, 15000.00, 10.00, 1, 16500.00, 16500.00, 'active', 'voluntary', NULL, 'Loan of K15000 in Apr — 10% service fee', '2025-04-11 22:00:00', '2026-04-09 18:37:56'),
	(37, 28, 15, 10000.00, 10.00, 1, 11000.00, 11000.00, 'active', 'voluntary', NULL, 'Loan of K10000 in Jan — 10% service fee', '2025-01-16 22:00:00', '2026-04-09 18:37:56'),
	(38, 28, 20, 10000.00, 10.00, 1, 11000.00, 11000.00, 'active', 'voluntary', NULL, 'Loan of K10000 in Jun — 10% service fee', '2025-06-05 22:00:00', '2026-04-09 18:37:56'),
	(39, 29, 15, 3000.00, 10.00, 1, 3300.00, 3300.00, 'active', 'voluntary', NULL, 'Loan of K3000 in Jan — 10% service fee', '2025-01-12 22:00:00', '2026-04-09 18:37:56'),
	(40, 29, 18, 10000.00, 10.00, 1, 11000.00, 11000.00, 'active', 'voluntary', NULL, 'Loan of K10000 in Apr — 10% service fee', '2025-04-11 22:00:00', '2026-04-09 18:37:56'),
	(41, 30, 17, 10000.00, 10.00, 1, 11000.00, 11000.00, 'active', 'voluntary', NULL, 'Loan of K10000 in Mar — 10% service fee', '2025-03-10 22:00:00', '2026-04-09 18:37:56'),
	(42, 31, 14, 3000.00, 10.00, 1, 3300.00, 3300.00, 'active', 'voluntary', NULL, 'Loan of K3000 in Dec — 10% service fee', '2024-12-12 22:00:00', '2026-04-09 18:37:56'),
	(43, 31, 15, 3000.00, 10.00, 1, 3300.00, 3300.00, 'active', 'voluntary', NULL, 'Loan of K3000 in Jan — 10% service fee', '2025-01-07 22:00:00', '2026-04-09 18:37:56'),
	(44, 31, 19, 5000.00, 10.00, 1, 5500.00, 5500.00, 'active', 'voluntary', NULL, 'Loan of K5000 in May — 10% service fee', '2025-05-05 22:00:00', '2026-04-09 18:37:56'),
	(45, 32, 21, 15000.00, 10.00, 1, 16500.00, 16500.00, 'active', 'voluntary', NULL, 'Loan of K15000 in Jul — 10% service fee', '2025-07-18 22:00:00', '2026-04-09 18:37:56'),
	(46, 33, 16, 51300.00, 10.00, 1, 56430.00, 56430.00, 'active', 'voluntary', NULL, 'Loan of K51300 in Feb — 10% service fee', '2025-02-17 22:00:00', '2026-04-09 18:37:56'),
	(47, 34, 17, 30000.00, 10.00, 1, 33000.00, 33000.00, 'active', 'voluntary', NULL, 'Loan of K30000 in Mar — 10% service fee', '2025-03-13 22:00:00', '2026-04-09 18:37:56'),
	(48, 35, 21, 25000.00, 10.00, 1, 27500.00, 27500.00, 'active', 'voluntary', NULL, 'Loan of K25000 in Jul — 10% service fee', '2025-07-16 22:00:00', '2026-04-09 18:37:56'),
	(49, 36, 17, 13265.00, 10.00, 1, 14591.50, 14591.50, 'active', 'voluntary', NULL, 'Loan of K13265 in Mar — 10% service fee', '2025-03-09 22:00:00', '2026-04-09 18:37:56'),
	(50, 37, 22, 15000.00, 10.00, 1, 16500.00, 16500.00, 'active', 'voluntary', NULL, 'Loan of K15000 in Aug — 10% service fee', '2025-08-05 22:00:00', '2026-04-09 18:37:56'),
	(51, 40, 26, 1100.00, 10.00, 1, 1210.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K1100 in Mar — 10% service fee', '2025-03-05 22:00:00', '2026-04-09 18:38:02'),
	(52, 40, 33, 7556.61, 10.00, 1, 8312.27, 8312.27, 'active', 'voluntary', NULL, 'Loan of K7556.61 in Oct — 10% service fee', '2025-10-11 22:00:00', '2026-04-09 18:38:02'),
	(53, 42, 27, 1000.00, 10.00, 1, 1100.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K1000 in Apr — 10% service fee', '2025-04-13 22:00:00', '2026-04-09 18:38:02'),
	(54, 42, 30, 1500.00, 10.00, 1, 1650.00, 1650.00, 'active', 'voluntary', NULL, 'Loan of K1500 in Jul — 10% service fee', '2025-07-16 22:00:00', '2026-04-09 18:38:02'),
	(55, 42, 32, 500.00, 10.00, 1, 550.00, 550.00, 'active', 'voluntary', NULL, 'Loan of K500 in Sep — 10% service fee', '2025-09-11 22:00:00', '2026-04-09 18:38:02'),
	(56, 43, 26, 1000.00, 10.00, 1, 1100.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K1000 in Mar — 10% service fee', '2025-03-07 22:00:00', '2026-04-09 18:38:02'),
	(57, 44, 25, 800.00, 10.00, 1, 880.00, 80.00, 'active', 'voluntary', NULL, 'Loan of K800 in Feb — 10% service fee', '2025-02-08 22:00:00', '2026-04-09 18:38:02'),
	(58, 44, 29, 2000.00, 10.00, 1, 2200.00, 2200.00, 'active', 'voluntary', NULL, 'Loan of K2000 in Jun — 10% service fee', '2025-06-08 22:00:00', '2026-04-09 18:38:02'),
	(59, 44, 32, 2300.00, 10.00, 1, 2530.00, 2530.00, 'active', 'voluntary', NULL, 'Loan of K2300 in Sep — 10% service fee', '2025-09-06 22:00:00', '2026-04-09 18:38:02'),
	(60, 45, 25, 1000.00, 10.00, 1, 1100.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K1000 in Feb — 10% service fee', '2025-02-05 22:00:00', '2026-04-09 18:38:02'),
	(61, 45, 31, 3000.00, 10.00, 1, 3300.00, 3300.00, 'active', 'voluntary', NULL, 'Loan of K3000 in Aug — 10% service fee', '2025-08-16 22:00:00', '2026-04-09 18:38:02'),
	(62, 46, 27, 1800.00, 10.00, 1, 1980.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K1800 in Apr — 10% service fee', '2025-04-18 22:00:00', '2026-04-09 18:38:02'),
	(63, 46, 29, 1528.00, 10.00, 1, 1680.80, 1680.80, 'active', 'voluntary', NULL, 'Loan of K1528 in Jun — 10% service fee', '2025-06-05 22:00:00', '2026-04-09 18:38:02'),
	(64, 46, 31, 3151.45, 10.00, 1, 3466.60, 3466.60, 'active', 'voluntary', NULL, 'Loan of K3151.45 in Aug — 10% service fee', '2025-08-05 22:00:00', '2026-04-09 18:38:02'),
	(65, 47, 28, 3900.00, 10.00, 1, 4290.00, 1290.00, 'active', 'voluntary', NULL, 'Loan of K3900 in May — 10% service fee', '2025-05-06 22:00:00', '2026-04-09 18:38:02'),
	(66, 47, 29, 1300.00, 10.00, 1, 1430.00, 1430.00, 'active', 'voluntary', NULL, 'Loan of K1300 in Jun — 10% service fee', '2025-06-18 22:00:00', '2026-04-09 18:38:02'),
	(67, 48, 26, 900.00, 10.00, 1, 990.00, 0.00, 'completed', 'voluntary', NULL, 'Loan of K900 in Mar — 10% service fee', '2025-03-06 22:00:00', '2026-04-09 18:38:02'),
	(68, 48, 28, 580.00, 10.00, 1, 638.00, 638.00, 'active', 'voluntary', NULL, 'Loan of K580 in May — 10% service fee', '2025-05-09 22:00:00', '2026-04-09 18:38:02'),
	(69, 48, 30, 3000.00, 10.00, 1, 3300.00, 3300.00, 'active', 'voluntary', NULL, 'Loan of K3000 in Jul — 10% service fee', '2025-07-06 22:00:00', '2026-04-09 18:38:02'),
	(70, 48, 32, 500.00, 10.00, 1, 550.00, 550.00, 'active', 'voluntary', NULL, 'Loan of K500 in Sep — 10% service fee', '2025-09-05 22:00:00', '2026-04-09 18:38:02'),
	(71, 49, 29, 5000.00, 10.00, 1, 5500.00, 3900.00, 'active', 'voluntary', NULL, 'Loan of K5000 in Jun — 10% service fee', '2025-06-11 22:00:00', '2026-04-09 18:38:02'),
	(72, 50, 30, 1500.00, 10.00, 1, 1650.00, 517.00, 'active', 'voluntary', NULL, 'Loan of K1500 in Jul — 10% service fee', '2025-07-20 22:00:00', '2026-04-09 18:38:02');

-- Dumping structure for table ziko_village_bank_management_system.loan_approvals
DROP TABLE IF EXISTS `loan_approvals`;
CREATE TABLE IF NOT EXISTS `loan_approvals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint unsigned NOT NULL,
  `approved_by` bigint unsigned NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loan_approvals_loan_id_foreign` (`loan_id`),
  KEY `loan_approvals_approved_by_foreign` (`approved_by`),
  CONSTRAINT `loan_approvals_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  CONSTRAINT `loan_approvals_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.loan_approvals: ~3 rows (approximately)
DELETE FROM `loan_approvals`;
INSERT INTO `loan_approvals` (`id`, `loan_id`, `approved_by`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'approved', 'approved', '2026-04-04 19:51:43', '2026-04-04 19:51:43'),
	(2, 3, 2, 'approved', 'approved', '2026-04-07 14:18:02', '2026-04-07 14:18:02'),
	(3, 4, 2, 'approved', 'approved', '2026-04-07 14:18:32', '2026-04-07 14:18:32');

-- Dumping structure for table ziko_village_bank_management_system.loan_pairings
DROP TABLE IF EXISTS `loan_pairings`;
CREATE TABLE IF NOT EXISTS `loan_pairings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint unsigned NOT NULL,
  `lender_id` bigint unsigned NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loan_pairings_loan_id_foreign` (`loan_id`),
  KEY `loan_pairings_lender_id_foreign` (`lender_id`),
  CONSTRAINT `loan_pairings_lender_id_foreign` FOREIGN KEY (`lender_id`) REFERENCES `users` (`id`),
  CONSTRAINT `loan_pairings_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.loan_pairings: ~14 rows (approximately)
DELETE FROM `loan_pairings`;
INSERT INTO `loan_pairings` (`id`, `loan_id`, `lender_id`, `amount`, `created_at`, `updated_at`) VALUES
	(1, 4, 2, 160.71, '2026-04-07 14:18:55', '2026-04-07 14:18:55'),
	(2, 4, 3, 192.86, '2026-04-07 14:18:55', '2026-04-07 14:18:55'),
	(3, 4, 6, 64.29, '2026-04-07 14:18:55', '2026-04-07 14:18:55'),
	(4, 4, 8, 96.43, '2026-04-07 14:18:56', '2026-04-07 14:18:56'),
	(5, 4, 9, 32.14, '2026-04-07 14:18:56', '2026-04-07 14:18:56'),
	(6, 4, 10, 160.71, '2026-04-07 14:18:56', '2026-04-07 14:18:56'),
	(7, 4, 11, 192.86, '2026-04-07 14:18:56', '2026-04-07 14:18:56'),
	(8, 3, 2, 104.17, '2026-04-07 14:18:58', '2026-04-07 14:18:58'),
	(9, 3, 3, 125.00, '2026-04-07 14:18:58', '2026-04-07 14:18:58'),
	(10, 3, 4, 41.67, '2026-04-07 14:18:58', '2026-04-07 14:18:58'),
	(11, 3, 6, 41.67, '2026-04-07 14:18:58', '2026-04-07 14:18:58'),
	(12, 3, 8, 62.50, '2026-04-07 14:18:58', '2026-04-07 14:18:58'),
	(13, 3, 9, 20.83, '2026-04-07 14:18:58', '2026-04-07 14:18:58'),
	(14, 3, 10, 104.16, '2026-04-07 14:18:58', '2026-04-07 14:18:58');

-- Dumping structure for table ziko_village_bank_management_system.media
DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.media: ~0 rows (approximately)
DELETE FROM `media`;

-- Dumping structure for table ziko_village_bank_management_system.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.migrations: ~30 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2026_03_18_105352_create_media_table', 1),
	(6, '2026_03_19_000001_create_roles_and_permissions_tables', 1),
	(7, '2026_03_19_000002_add_avatar_to_users_table', 1),
	(8, '2026_04_03_000000_create_village_banking_tables', 1),
	(9, '2026_04_03_100000_create_village_banks_tables', 1),
	(10, '2026_04_03_200000_create_rules_and_polls_tables', 1),
	(11, '2026_04_03_300000_create_subscription_tables', 1),
	(12, '2026_04_03_400000_add_soft_deletes_to_users_table', 2),
	(13, '2026_04_03_500000_rename_staff_no_to_username_on_users_table', 3),
	(14, '2026_04_04_000000_create_payment_configurations_table', 4),
	(15, '2026_04_04_100000_create_training_tables', 5),
	(16, '2026_04_04_200000_add_current_session_id_to_users_table', 6),
	(17, '2026_04_04_300000_restructure_users_for_village_banking', 7),
	(18, '2026_04_04_400000_create_user_payment_methods_table', 8),
	(19, '2026_04_05_193654_add_total_login_to_users_table', 9),
	(20, '2026_04_05_194114_create_activity_logs_table', 10),
	(21, '2026_04_05_201552_add_nrc_and_passport_photos_to_users_table', 11),
	(22, '2026_04_06_000000_create_village_bank_configurations_table', 12),
	(23, '2026_04_06_100000_add_accounts_month_configs_interest_type', 13),
	(24, '2026_04_06_200000_add_share_unit_config_to_village_bank_configurations', 14),
	(25, '2026_04_06_300000_add_loan_type_and_forced_loan_fields', 15),
	(26, '2026_04_06_400000_create_village_bank_join_requests_table', 16),
	(27, '2026_04_06_193836_make_optional_user_fields_nullable', 17),
	(28, '2026_04_09_000000_add_detailed_shareout_columns', 18),
	(29, '2026_04_09_100000_add_compound_shareout_fields', 19),
	(30, '2026_04_10_000000_add_social_fund_tables', 20);

-- Dumping structure for table ziko_village_bank_management_system.months
DROP TABLE IF EXISTS `months`;
CREATE TABLE IF NOT EXISTS `months` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `circle_id` bigint unsigned NOT NULL,
  `month_number` int NOT NULL,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_share_declarations` tinyint(1) NOT NULL DEFAULT '1',
  `allow_insurance_declarations` tinyint(1) NOT NULL DEFAULT '1',
  `allow_loan_requests` tinyint(1) NOT NULL DEFAULT '1',
  `allow_loan_repayments` tinyint(1) NOT NULL DEFAULT '1',
  `is_shareout_month` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('pending','active','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `months_circle_id_foreign` (`circle_id`),
  CONSTRAINT `months_circle_id_foreign` FOREIGN KEY (`circle_id`) REFERENCES `circles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.months: ~36 rows (approximately)
DELETE FROM `months`;
INSERT INTO `months` (`id`, `circle_id`, `month_number`, `label`, `allow_share_declarations`, `allow_insurance_declarations`, `allow_loan_requests`, `allow_loan_repayments`, `is_shareout_month`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, 1, 1, 1, 1, 0, '2026-04-01', '2026-04-30', 'active', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(2, 1, 2, NULL, 1, 1, 1, 1, 0, '2026-05-01', '2026-05-31', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(3, 1, 3, NULL, 1, 1, 1, 1, 0, '2026-06-01', '2026-06-30', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(4, 1, 4, NULL, 1, 1, 1, 1, 0, '2026-07-01', '2026-07-31', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(5, 1, 5, NULL, 1, 1, 1, 1, 0, '2026-08-01', '2026-08-31', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(6, 1, 6, NULL, 1, 1, 1, 1, 0, '2026-09-01', '2026-09-30', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(7, 1, 7, NULL, 1, 1, 1, 1, 0, '2026-10-01', '2026-10-31', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(8, 1, 8, NULL, 1, 1, 1, 1, 0, '2026-11-01', '2026-11-30', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(9, 1, 9, NULL, 1, 1, 1, 1, 0, '2026-12-01', '2026-12-31', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(10, 1, 10, NULL, 1, 1, 1, 1, 0, '2027-01-01', '2027-01-31', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(11, 1, 11, NULL, 1, 1, 1, 1, 0, '2027-02-01', '2027-02-28', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(12, 1, 12, NULL, 1, 1, 1, 1, 0, '2027-03-01', '2027-03-31', 'pending', '2026-04-04 19:34:42', '2026-04-04 19:34:42'),
	(13, 2, 1, 'Nov', 1, 1, 1, 1, 0, '2024-11-01', '2024-11-30', 'closed', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(14, 2, 2, 'Dec', 1, 1, 1, 1, 0, '2024-12-01', '2024-12-31', 'closed', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(15, 2, 3, 'Jan', 1, 1, 1, 1, 0, '2025-01-01', '2025-01-31', 'closed', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(16, 2, 4, 'Feb', 1, 1, 1, 1, 0, '2025-02-01', '2025-02-28', 'closed', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(17, 2, 5, 'Mar', 1, 1, 1, 1, 0, '2025-03-01', '2025-03-31', 'closed', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(18, 2, 6, 'Apr', 1, 1, 1, 1, 0, '2025-04-01', '2025-04-30', 'closed', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(19, 2, 7, 'May', 1, 1, 1, 1, 0, '2025-05-01', '2025-05-31', 'closed', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(20, 2, 8, 'Jun', 1, 1, 1, 1, 0, '2025-06-01', '2025-06-30', 'closed', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(21, 2, 9, 'Jul', 1, 1, 1, 1, 0, '2025-07-01', '2025-07-31', 'closed', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(22, 2, 10, 'Aug', 1, 1, 1, 1, 0, '2025-08-01', '2025-08-31', 'closed', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(23, 2, 11, 'Sep', 1, 1, 1, 1, 0, '2025-09-01', '2025-09-30', 'pending', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(24, 2, 12, 'Oct', 1, 1, 1, 1, 1, '2025-10-01', '2025-10-31', 'pending', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(25, 3, 1, 'Feb', 1, 1, 1, 1, 0, '2025-02-01', '2025-02-28', 'closed', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(26, 3, 2, 'Mar', 1, 1, 1, 1, 0, '2025-03-01', '2025-03-31', 'closed', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(27, 3, 3, 'Apr', 1, 1, 1, 1, 0, '2025-04-01', '2025-04-30', 'closed', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(28, 3, 4, 'May', 1, 1, 1, 1, 0, '2025-05-01', '2025-05-31', 'closed', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(29, 3, 5, 'Jun', 1, 1, 1, 1, 0, '2025-06-01', '2025-06-30', 'closed', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(30, 3, 6, 'Jul', 1, 1, 1, 1, 0, '2025-07-01', '2025-07-31', 'closed', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(31, 3, 7, 'Aug', 1, 1, 1, 1, 0, '2025-08-01', '2025-08-31', 'closed', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(32, 3, 8, 'Sep', 1, 1, 1, 1, 0, '2025-09-01', '2025-09-30', 'closed', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(33, 3, 9, 'Oct', 1, 1, 1, 1, 0, '2025-10-01', '2025-10-31', 'closed', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(34, 3, 10, 'Nov', 1, 1, 1, 1, 0, '2025-11-01', '2025-11-30', 'pending', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(35, 3, 11, 'Dec', 1, 1, 1, 1, 0, '2025-12-01', '2025-12-31', 'pending', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(36, 3, 12, 'Jan26', 1, 1, 1, 1, 1, '2026-01-01', '2026-01-31', 'pending', '2026-04-09 18:38:02', '2026-04-09 18:38:02');

-- Dumping structure for table ziko_village_bank_management_system.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;

-- Dumping structure for table ziko_village_bank_management_system.payment_configurations
DROP TABLE IF EXISTS `payment_configurations`;
CREATE TABLE IF NOT EXISTS `payment_configurations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `method_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.payment_configurations: ~0 rows (approximately)
DELETE FROM `payment_configurations`;

-- Dumping structure for table ziko_village_bank_management_system.payment_methods
DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('mobile_money','bank') COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.payment_methods: ~8 rows (approximately)
DELETE FROM `payment_methods`;
INSERT INTO `payment_methods` (`id`, `name`, `type`, `account_name`, `account_number`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Airtel Money', 'mobile_money', NULL, NULL, 1, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(2, 'MTN Mobile Money', 'mobile_money', NULL, NULL, 1, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(3, 'Zamtel Money', 'mobile_money', NULL, NULL, 1, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(4, 'Zanaco Bank', 'bank', NULL, NULL, 1, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(5, 'FNB Zambia', 'bank', NULL, NULL, 1, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(6, 'Stanbic Bank', 'bank', NULL, NULL, 1, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(7, 'ABSA Bank', 'bank', NULL, NULL, 1, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(8, 'Cash', 'mobile_money', NULL, NULL, 1, '2026-04-03 18:41:37', '2026-04-03 18:41:37');

-- Dumping structure for table ziko_village_bank_management_system.penalties
DROP TABLE IF EXISTS `penalties`;
CREATE TABLE IF NOT EXISTS `penalties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint unsigned NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `applied_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `penalties_loan_id_foreign` (`loan_id`),
  CONSTRAINT `penalties_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.penalties: ~0 rows (approximately)
DELETE FROM `penalties`;

-- Dumping structure for table ziko_village_bank_management_system.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.permissions: ~47 rows (approximately)
DELETE FROM `permissions`;
INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `group`, `created_at`, `updated_at`) VALUES
	(1, 'View Members', 'view-members', 'View member list', 'Member Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(2, 'Create Members', 'create-members', 'Register new members', 'Member Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(3, 'Approve Members', 'approve-members', 'Approve or reject pending members', 'Member Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(4, 'Edit Members', 'edit-members', 'Edit member details', 'Member Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(5, 'View Circles', 'view-circles', 'View banking circles', 'Circle Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(6, 'Create Circles', 'create-circles', 'Create new circles', 'Circle Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(7, 'Manage Circles', 'manage-circles', 'Edit, activate, close circles', 'Circle Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(8, 'Manage Months', 'manage-months', 'Open/close months and phases', 'Circle Management', '2026-04-03 18:38:03', '2026-04-07 13:33:41'),
	(9, 'Declare Shares', 'declare-shares', 'Declare monthly share amount', 'Shares & Insurance', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(10, 'View Shares', 'view-shares', 'View share declarations', 'Shares & Insurance', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(11, 'Configure Insurance', 'configure-insurance', 'Set insurance rules for a circle', 'Shares & Insurance', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(12, 'Request Loans', 'request-loans', 'Submit a loan request', 'Loan Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(13, 'Approve Loans', 'approve-loans', 'Approve or reject loan requests', 'Loan Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(14, 'View Loans', 'view-loans', 'View all loans', 'Loan Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(15, 'Pair Loans', 'pair-loans', 'Match borrowers with lenders', 'Loan Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(16, 'Upload Payments', 'upload-payments', 'Upload proof of payment', 'Payments', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(17, 'Confirm Payments', 'confirm-payments', 'Confirm or reject payments', 'Payments', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(18, 'Manage Payment Methods', 'manage-payment-methods', 'Configure payment methods', 'Payments', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(19, 'Make Repayments', 'make-repayments', 'Submit loan repayments', 'Repayments', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(20, 'View Repayments', 'view-repayments', 'View repayment history', 'Repayments', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(21, 'Calculate Shareout', 'calculate-shareout', 'Run shareout calculations', 'Shareout', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(22, 'View Shareout', 'view-shareout', 'View shareout results', 'Shareout', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(23, 'Manage Rules', 'manage-rules', 'Create, edit, delete rules and bylaws', 'Rules & Bylaws', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(24, 'View Rules', 'view-rules', 'View rules and acknowledge them', 'Rules & Bylaws', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(25, 'Manage Polls', 'manage-polls', 'Create, edit, open, close polls', 'Polls & Voting', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(26, 'Vote Polls', 'vote-polls', 'Cast votes and comment on polls', 'Polls & Voting', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(27, 'View Polls', 'view-polls', 'View poll results', 'Polls & Voting', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(28, 'View Reports', 'view-reports', 'Access financial and operational reports', 'Reports', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(29, 'View Dashboard', 'view-dashboard', 'Access the main dashboard', 'Dashboard', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(30, 'Export Reports', 'export-reports', 'Export reports to PDF/Excel', 'Reports', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(31, 'View Users', 'view-users', 'View user list', 'User Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(32, 'Create Users', 'create-users', 'Create new users', 'User Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(33, 'Edit Users', 'edit-users', 'Edit user details', 'User Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(34, 'Delete Users', 'delete-users', 'Delete users', 'User Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(35, 'Manage Roles', 'manage-roles', 'Manage roles and permissions', 'User Management', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(36, 'Manage Village Banks', 'manage-village-banks', 'Create and manage village banks', 'Village Banks', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(37, 'View Village Banks', 'view-village-banks', 'View village bank details', 'Village Banks', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(38, 'Manage Subscriptions', 'manage-subscriptions', 'Manage subscription plans and payments', 'Subscriptions', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(39, 'Manage Licenses', 'manage-licenses', 'Issue, revoke, and manage licenses', 'Subscriptions', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(40, 'Review Applications', 'review-applications', 'Approve or reject bank applications', 'Subscriptions', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(41, 'View Applications', 'view-applications', 'View submitted bank applications', 'Subscriptions', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(42, 'Manage Join Requests', 'manage-join-requests', 'Review and approve join requests', 'Member Management', '2026-04-07 13:33:41', '2026-04-07 13:33:41'),
	(43, 'Force Loans', 'force-loans', 'Apply forced loans to members', 'Loan Management', '2026-04-07 13:33:41', '2026-04-07 13:33:41'),
	(44, 'Manage Bank Config', 'manage-bank-config', 'Configure village bank settings', 'Settings', '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(45, 'Manage Training', 'manage-training', 'Manage training programs and applications', 'Training', '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(46, 'View Activity Logs', 'view-activity-logs', 'View system activity logs', 'Activity Logs', '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(47, 'Discover Banks', 'discover-banks', 'Search and request to join village banks', 'Discovery', '2026-04-07 13:33:42', '2026-04-07 13:33:42');

-- Dumping structure for table ziko_village_bank_management_system.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table ziko_village_bank_management_system.phases
DROP TABLE IF EXISTS `phases`;
CREATE TABLE IF NOT EXISTS `phases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `month_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` enum('pending','active','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phases_month_id_foreign` (`month_id`),
  CONSTRAINT `phases_month_id_foreign` FOREIGN KEY (`month_id`) REFERENCES `months` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.phases: ~4 rows (approximately)
DELETE FROM `phases`;
INSERT INTO `phases` (`id`, `month_id`, `name`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Share Collection', '2026-05-01 00:00:00', '2026-05-07 23:59:59', 'active', '2026-04-04 19:38:45', '2026-04-04 19:40:01'),
	(2, 2, 'Loan Processing', '2026-05-08 00:00:00', '2026-05-14 23:59:59', 'pending', '2026-04-04 19:38:45', '2026-04-04 19:38:45'),
	(3, 2, 'Repayment Window', '2026-05-15 00:00:00', '2026-05-24 23:59:59', 'pending', '2026-04-04 19:38:45', '2026-04-04 19:38:45'),
	(4, 2, 'Reconciliation', '2026-05-25 00:00:00', '2026-05-30 23:59:59', 'pending', '2026-04-04 19:38:45', '2026-04-04 19:38:45');

-- Dumping structure for table ziko_village_bank_management_system.polls
DROP TABLE IF EXISTS `polls`;
CREATE TABLE IF NOT EXISTS `polls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `village_bank_id` bigint unsigned NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('single','multiple') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('draft','active','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `polls_village_bank_id_foreign` (`village_bank_id`),
  KEY `polls_created_by_foreign` (`created_by`),
  CONSTRAINT `polls_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `polls_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.polls: ~1 rows (approximately)
DELETE FROM `polls`;
INSERT INTO `polls` (`id`, `village_bank_id`, `question`, `description`, `type`, `is_anonymous`, `status`, `starts_at`, `ends_at`, `created_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Should we increase the shares amount from 200 to 300', 'Should we increase the shares amount from 200 to 300', 'single', 0, 'active', '2026-04-07 14:24:58', NULL, 2, '2026-04-07 14:24:47', '2026-04-07 14:24:58');

-- Dumping structure for table ziko_village_bank_management_system.poll_comments
DROP TABLE IF EXISTS `poll_comments`;
CREATE TABLE IF NOT EXISTS `poll_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `poll_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `poll_comments_poll_id_foreign` (`poll_id`),
  KEY `poll_comments_user_id_foreign` (`user_id`),
  CONSTRAINT `poll_comments_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE,
  CONSTRAINT `poll_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.poll_comments: ~0 rows (approximately)
DELETE FROM `poll_comments`;

-- Dumping structure for table ziko_village_bank_management_system.poll_options
DROP TABLE IF EXISTS `poll_options`;
CREATE TABLE IF NOT EXISTS `poll_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `poll_id` bigint unsigned NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `poll_options_poll_id_foreign` (`poll_id`),
  CONSTRAINT `poll_options_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.poll_options: ~2 rows (approximately)
DELETE FROM `poll_options`;
INSERT INTO `poll_options` (`id`, `poll_id`, `label`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 1, 'yes', 0, '2026-04-07 14:24:47', '2026-04-07 14:24:47'),
	(2, 1, 'no', 1, '2026-04-07 14:24:47', '2026-04-07 14:24:47');

-- Dumping structure for table ziko_village_bank_management_system.poll_votes
DROP TABLE IF EXISTS `poll_votes`;
CREATE TABLE IF NOT EXISTS `poll_votes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `poll_id` bigint unsigned NOT NULL,
  `poll_option_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `poll_votes_poll_id_poll_option_id_user_id_unique` (`poll_id`,`poll_option_id`,`user_id`),
  KEY `poll_votes_poll_option_id_foreign` (`poll_option_id`),
  KEY `poll_votes_user_id_foreign` (`user_id`),
  CONSTRAINT `poll_votes_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE,
  CONSTRAINT `poll_votes_poll_option_id_foreign` FOREIGN KEY (`poll_option_id`) REFERENCES `poll_options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `poll_votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.poll_votes: ~1 rows (approximately)
DELETE FROM `poll_votes`;
INSERT INTO `poll_votes` (`id`, `poll_id`, `poll_option_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, '2026-04-07 14:25:18', '2026-04-07 14:25:18');

-- Dumping structure for table ziko_village_bank_management_system.repayments
DROP TABLE IF EXISTS `repayments`;
CREATE TABLE IF NOT EXISTS `repayments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint unsigned NOT NULL,
  `amount_paid` decimal(12,2) NOT NULL,
  `remaining_balance` decimal(12,2) NOT NULL,
  `penalty_applied` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `repayments_loan_id_foreign` (`loan_id`),
  CONSTRAINT `repayments_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.repayments: ~75 rows (approximately)
DELETE FROM `repayments`;
INSERT INTO `repayments` (`id`, `loan_id`, `amount_paid`, `remaining_balance`, `penalty_applied`, `created_at`, `updated_at`) VALUES
	(1, 1, 100.00, 5900.00, 0.00, '2026-04-05 04:41:55', '2026-04-05 04:41:55'),
	(2, 1, 3000.00, 2900.00, 0.00, '2026-04-05 12:56:18', '2026-04-05 12:56:18'),
	(3, 5, 12000.00, 37280.00, 0.00, '2024-12-02 22:00:00', '2026-04-09 18:37:56'),
	(4, 5, 5500.00, 31780.00, 0.00, '2025-01-25 22:00:00', '2026-04-09 18:37:56'),
	(5, 5, 1250.00, 30530.00, 0.00, '2025-02-19 22:00:00', '2026-04-09 18:37:56'),
	(6, 5, 1200.00, 29330.00, 0.00, '2025-03-03 22:00:00', '2026-04-09 18:37:56'),
	(7, 5, 3150.00, 26180.00, 0.00, '2025-04-08 22:00:00', '2026-04-09 18:37:56'),
	(8, 32, 1500.00, 15000.00, 0.00, '2024-12-05 22:00:00', '2026-04-09 18:37:56'),
	(9, 32, 3000.00, 12000.00, 0.00, '2025-01-10 22:00:00', '2026-04-09 18:37:56'),
	(10, 32, 1500.00, 10500.00, 0.00, '2025-02-24 22:00:00', '2026-04-09 18:37:56'),
	(11, 32, 1500.00, 9000.00, 0.00, '2025-03-12 22:00:00', '2026-04-09 18:37:56'),
	(12, 32, 1500.00, 7500.00, 0.00, '2025-04-24 22:00:00', '2026-04-09 18:37:56'),
	(13, 32, 1500.00, 6000.00, 0.00, '2025-05-05 22:00:00', '2026-04-09 18:37:56'),
	(14, 32, 6000.00, 0.00, 0.00, '2025-06-11 22:00:00', '2026-04-09 18:37:56'),
	(15, 14, 2000.00, 20000.00, 0.00, '2024-12-08 22:00:00', '2026-04-09 18:37:56'),
	(16, 14, 2000.00, 18000.00, 0.00, '2025-01-15 22:00:00', '2026-04-09 18:37:56'),
	(17, 14, 2000.00, 16000.00, 0.00, '2025-02-05 22:00:00', '2026-04-09 18:37:56'),
	(18, 14, 2000.00, 14000.00, 0.00, '2025-03-14 22:00:00', '2026-04-09 18:37:56'),
	(19, 14, 5000.00, 9000.00, 0.00, '2025-04-01 22:00:00', '2026-04-09 18:37:56'),
	(20, 14, 3000.00, 6000.00, 0.00, '2025-05-20 22:00:00', '2026-04-09 18:37:56'),
	(21, 14, 3000.00, 3000.00, 0.00, '2025-06-21 22:00:00', '2026-04-09 18:37:56'),
	(22, 14, 3000.00, 0.00, 0.00, '2025-07-17 22:00:00', '2026-04-09 18:37:56'),
	(23, 10, 1000.00, 6040.00, 0.00, '2024-12-14 22:00:00', '2026-04-09 18:37:56'),
	(24, 10, 1000.00, 5040.00, 0.00, '2025-01-09 22:00:00', '2026-04-09 18:37:56'),
	(25, 10, 1000.00, 4040.00, 0.00, '2025-02-21 22:00:00', '2026-04-09 18:37:56'),
	(26, 10, 2000.00, 2040.00, 0.00, '2025-03-08 22:00:00', '2026-04-09 18:37:56'),
	(27, 10, 2040.00, 0.00, 0.00, '2025-04-23 22:00:00', '2026-04-09 18:37:56'),
	(28, 25, 1000.00, 5710.00, 0.00, '2024-12-08 22:00:00', '2026-04-09 18:37:56'),
	(29, 25, 1000.00, 4710.00, 0.00, '2025-01-05 22:00:00', '2026-04-09 18:37:56'),
	(30, 25, 1000.00, 3710.00, 0.00, '2025-02-17 22:00:00', '2026-04-09 18:37:56'),
	(31, 25, 1000.00, 2710.00, 0.00, '2025-03-09 22:00:00', '2026-04-09 18:37:56'),
	(32, 25, 1000.00, 1710.00, 0.00, '2025-04-04 22:00:00', '2026-04-09 18:37:56'),
	(33, 25, 1710.00, 0.00, 0.00, '2025-05-06 22:00:00', '2026-04-09 18:37:56'),
	(34, 21, 660.00, 0.00, 0.00, '2024-12-18 22:00:00', '2026-04-09 18:37:56'),
	(35, 51, 200.00, 1010.00, 0.00, '2025-04-01 22:00:00', '2026-04-09 18:38:02'),
	(36, 51, 200.00, 810.00, 0.00, '2025-05-03 22:00:00', '2026-04-09 18:38:02'),
	(37, 51, 200.00, 610.00, 0.00, '2025-06-13 22:00:00', '2026-04-09 18:38:02'),
	(38, 51, 200.00, 410.00, 0.00, '2025-07-14 22:00:00', '2026-04-09 18:38:02'),
	(39, 51, 623.61, 0.00, 0.00, '2025-10-07 22:00:00', '2026-04-09 18:38:02'),
	(40, 53, 200.00, 900.00, 0.00, '2025-05-15 22:00:00', '2026-04-09 18:38:02'),
	(41, 53, 200.00, 700.00, 0.00, '2025-06-13 22:00:00', '2026-04-09 18:38:02'),
	(42, 53, 200.00, 500.00, 0.00, '2025-07-18 22:00:00', '2026-04-09 18:38:02'),
	(43, 53, 500.00, 0.00, 0.00, '2025-08-02 22:00:00', '2026-04-09 18:38:02'),
	(44, 53, 200.00, 0.00, 0.00, '2025-09-03 22:00:00', '2026-04-09 18:38:02'),
	(45, 53, 200.00, 0.00, 0.00, '2025-10-15 22:00:00', '2026-04-09 18:38:02'),
	(46, 56, 200.00, 900.00, 0.00, '2025-04-06 22:00:00', '2026-04-09 18:38:02'),
	(47, 56, 200.00, 700.00, 0.00, '2025-05-20 22:00:00', '2026-04-09 18:38:02'),
	(48, 56, 500.00, 200.00, 0.00, '2025-06-05 22:00:00', '2026-04-09 18:38:02'),
	(49, 56, 300.00, 0.00, 0.00, '2025-07-16 22:00:00', '2026-04-09 18:38:02'),
	(50, 57, 400.00, 480.00, 0.00, '2025-07-06 22:00:00', '2026-04-09 18:38:02'),
	(51, 57, 400.00, 80.00, 0.00, '2025-10-06 22:00:00', '2026-04-09 18:38:02'),
	(52, 60, 200.00, 900.00, 0.00, '2025-05-09 22:00:00', '2026-04-09 18:38:02'),
	(53, 60, 200.00, 700.00, 0.00, '2025-06-16 22:00:00', '2026-04-09 18:38:02'),
	(54, 60, 200.00, 500.00, 0.00, '2025-07-14 22:00:00', '2026-04-09 18:38:02'),
	(55, 60, 700.00, 0.00, 0.00, '2025-10-12 22:00:00', '2026-04-09 18:38:02'),
	(56, 62, 180.00, 1800.00, 0.00, '2025-05-17 22:00:00', '2026-04-09 18:38:02'),
	(57, 62, 2528.00, 0.00, 0.00, '2025-06-03 22:00:00', '2026-04-09 18:38:02'),
	(58, 62, 200.00, 0.00, 0.00, '2025-07-15 22:00:00', '2026-04-09 18:38:02'),
	(59, 62, 851.45, 0.00, 0.00, '2025-08-18 22:00:00', '2026-04-09 18:38:02'),
	(60, 62, 300.00, 0.00, 0.00, '2025-10-01 22:00:00', '2026-04-09 18:38:02'),
	(61, 65, 1500.00, 2790.00, 0.00, '2025-06-03 22:00:00', '2026-04-09 18:38:02'),
	(62, 65, 200.00, 2590.00, 0.00, '2025-07-06 22:00:00', '2026-04-09 18:38:02'),
	(63, 65, 300.00, 2290.00, 0.00, '2025-08-13 22:00:00', '2026-04-09 18:38:02'),
	(64, 65, 1000.00, 1290.00, 0.00, '2025-10-15 22:00:00', '2026-04-09 18:38:02'),
	(65, 67, 200.00, 790.00, 0.00, '2025-05-16 22:00:00', '2026-04-09 18:38:02'),
	(66, 67, 200.00, 590.00, 0.00, '2025-06-07 22:00:00', '2026-04-09 18:38:02'),
	(67, 67, 200.00, 390.00, 0.00, '2025-07-10 22:00:00', '2026-04-09 18:38:02'),
	(68, 67, 500.00, 0.00, 0.00, '2025-08-14 22:00:00', '2026-04-09 18:38:02'),
	(69, 67, 200.00, 0.00, 0.00, '2025-09-08 22:00:00', '2026-04-09 18:38:02'),
	(70, 67, 200.00, 0.00, 0.00, '2025-10-06 22:00:00', '2026-04-09 18:38:02'),
	(71, 71, 200.00, 5300.00, 0.00, '2025-07-01 22:00:00', '2026-04-09 18:38:02'),
	(72, 71, 1000.00, 4300.00, 0.00, '2025-09-15 22:00:00', '2026-04-09 18:38:02'),
	(73, 71, 400.00, 3900.00, 0.00, '2025-10-20 22:00:00', '2026-04-09 18:38:02'),
	(74, 72, 500.00, 1150.00, 0.00, '2025-08-14 22:00:00', '2026-04-09 18:38:02'),
	(75, 72, 633.00, 517.00, 0.00, '2025-10-20 22:00:00', '2026-04-09 18:38:02');

-- Dumping structure for table ziko_village_bank_management_system.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.roles: ~6 rows (approximately)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'super-admin', 'Ndinecom platform super administrator — full system access', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(2, 'Chairperson', 'chairperson', 'Circle chairperson — full village bank admin access', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(3, 'Secretary', 'secretary', 'Records, member management, monthly cycles', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(4, 'Treasurer', 'treasurer', 'Financial operations — shares, loans, payments', '2026-04-03 18:38:03', '2026-04-03 18:38:03'),
	(5, 'Committee Member', 'committee-member', 'Loan approvals and oversight', '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(6, 'Member', 'member', 'Regular circle member', '2026-04-03 18:38:04', '2026-04-03 18:38:04');

-- Dumping structure for table ziko_village_bank_management_system.role_permission
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE IF NOT EXISTS `role_permission` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_permission_role_id_permission_id_unique` (`role_id`,`permission_id`),
  KEY `role_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.role_permission: ~160 rows (approximately)
DELETE FROM `role_permission`;
INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 13, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(2, 1, 3, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(3, 1, 21, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(4, 1, 11, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(5, 1, 17, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(6, 1, 6, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(7, 1, 2, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(8, 1, 32, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(9, 1, 9, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(10, 1, 34, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(11, 1, 4, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(12, 1, 33, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(13, 1, 30, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(14, 1, 19, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(15, 1, 7, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(16, 1, 39, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(17, 1, 8, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(18, 1, 18, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(19, 1, 25, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(20, 1, 35, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(21, 1, 23, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(22, 1, 38, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(23, 1, 36, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(24, 1, 15, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(25, 1, 12, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(26, 1, 40, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(27, 1, 16, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(28, 1, 41, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(29, 1, 5, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(30, 1, 29, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(31, 1, 14, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(32, 1, 1, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(33, 1, 27, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(34, 1, 20, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(35, 1, 28, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(36, 1, 24, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(37, 1, 22, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(38, 1, 10, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(39, 1, 31, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(40, 1, 37, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(41, 1, 26, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(42, 2, 13, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(43, 2, 3, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(44, 2, 21, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(45, 2, 11, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(46, 2, 17, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(47, 2, 6, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(48, 2, 2, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(50, 2, 9, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(52, 2, 4, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(54, 2, 30, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(55, 2, 19, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(56, 2, 7, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(57, 2, 8, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(58, 2, 18, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(59, 2, 25, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(61, 2, 23, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(62, 2, 36, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(63, 2, 15, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(64, 2, 12, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(65, 2, 16, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(66, 2, 5, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(67, 2, 29, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(68, 2, 14, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(69, 2, 1, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(70, 2, 27, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(71, 2, 20, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(72, 2, 28, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(73, 2, 24, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(74, 2, 22, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(75, 2, 10, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(76, 2, 31, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(77, 2, 37, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(78, 2, 26, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(79, 3, 3, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(80, 3, 6, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(81, 3, 2, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(82, 3, 4, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(83, 3, 7, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(84, 3, 8, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(85, 3, 25, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(86, 3, 23, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(87, 3, 5, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(88, 3, 29, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(89, 3, 14, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(90, 3, 1, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(91, 3, 27, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(92, 3, 20, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(93, 3, 28, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(94, 3, 24, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(95, 3, 22, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(96, 3, 10, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(97, 3, 31, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(98, 3, 37, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(99, 3, 26, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(100, 4, 21, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(101, 4, 11, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(102, 4, 17, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(103, 4, 9, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(104, 4, 30, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(105, 4, 18, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(106, 4, 15, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(107, 4, 16, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(108, 4, 5, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(109, 4, 29, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(110, 4, 14, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(111, 4, 1, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(112, 4, 27, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(113, 4, 20, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(114, 4, 28, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(115, 4, 24, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(116, 4, 22, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(117, 4, 10, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(118, 4, 37, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(119, 4, 26, '2026-04-03 18:38:04', '2026-04-03 18:38:04'),
	(120, 5, 13, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(121, 5, 3, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(122, 5, 17, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(123, 5, 5, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(124, 5, 29, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(125, 5, 14, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(126, 5, 1, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(127, 5, 27, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(128, 5, 20, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(129, 5, 28, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(130, 5, 24, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(131, 5, 22, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(132, 5, 10, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(133, 5, 37, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(134, 5, 26, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(135, 6, 9, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(136, 6, 19, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(137, 6, 12, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(138, 6, 16, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(139, 6, 5, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(140, 6, 29, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(141, 6, 14, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(142, 6, 1, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(143, 6, 27, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(144, 6, 20, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(145, 6, 24, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(146, 6, 22, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(147, 6, 10, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(148, 6, 37, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(149, 6, 26, '2026-04-03 18:38:05', '2026-04-03 18:38:05'),
	(150, 1, 47, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(151, 1, 43, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(152, 1, 44, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(153, 1, 42, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(154, 1, 45, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(155, 1, 46, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(156, 2, 47, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(157, 2, 43, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(158, 2, 44, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(159, 2, 42, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(160, 3, 47, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(161, 3, 42, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(162, 4, 47, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(163, 5, 47, '2026-04-07 13:33:42', '2026-04-07 13:33:42'),
	(164, 6, 47, '2026-04-07 13:33:42', '2026-04-07 13:33:42');

-- Dumping structure for table ziko_village_bank_management_system.role_user
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_user_user_id_role_id_unique` (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.role_user: ~11 rows (approximately)
DELETE FROM `role_user`;
INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2026-04-03 18:41:36', '2026-04-03 18:41:36'),
	(2, 2, 2, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(3, 3, 3, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(4, 4, 4, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(5, 5, 5, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(6, 6, 6, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(7, 7, 6, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(8, 8, 6, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(9, 9, 6, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(10, 10, 6, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(11, 11, 6, '2026-04-03 18:41:37', '2026-04-03 18:41:37');

-- Dumping structure for table ziko_village_bank_management_system.rule_acknowledgements
DROP TABLE IF EXISTS `rule_acknowledgements`;
CREATE TABLE IF NOT EXISTS `rule_acknowledgements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rule_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `acknowledged_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rule_acknowledgements_rule_id_user_id_unique` (`rule_id`,`user_id`),
  KEY `rule_acknowledgements_user_id_foreign` (`user_id`),
  CONSTRAINT `rule_acknowledgements_rule_id_foreign` FOREIGN KEY (`rule_id`) REFERENCES `village_bank_rules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rule_acknowledgements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.rule_acknowledgements: ~0 rows (approximately)
DELETE FROM `rule_acknowledgements`;

-- Dumping structure for table ziko_village_bank_management_system.shareouts
DROP TABLE IF EXISTS `shareouts`;
CREATE TABLE IF NOT EXISTS `shareouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `circle_id` bigint unsigned NOT NULL,
  `total_contributions` decimal(15,2) NOT NULL,
  `total_insurance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_interest` decimal(15,2) NOT NULL,
  `total_penalties` decimal(15,2) NOT NULL,
  `total_loans_outstanding` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_pool` decimal(15,2) NOT NULL,
  `compound_rate` decimal(5,2) NOT NULL DEFAULT '5.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shareouts_circle_id_foreign` (`circle_id`),
  CONSTRAINT `shareouts_circle_id_foreign` FOREIGN KEY (`circle_id`) REFERENCES `circles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.shareouts: ~0 rows (approximately)
DELETE FROM `shareouts`;

-- Dumping structure for table ziko_village_bank_management_system.shareout_allocations
DROP TABLE IF EXISTS `shareout_allocations`;
CREATE TABLE IF NOT EXISTS `shareout_allocations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `shareout_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `contribution_total` decimal(15,2) NOT NULL,
  `investment_compounded` decimal(15,2) NOT NULL DEFAULT '0.00',
  `insurance_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `insurance_compounded` decimal(15,2) NOT NULL DEFAULT '0.00',
  `shares_profit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `insurance_profit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `loan_deduction` decimal(15,2) NOT NULL DEFAULT '0.00',
  `credit_limit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `profit_share` decimal(15,2) NOT NULL,
  `payout_amount` decimal(15,2) NOT NULL,
  `action` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Receiving',
  PRIMARY KEY (`id`),
  KEY `shareout_allocations_shareout_id_foreign` (`shareout_id`),
  KEY `shareout_allocations_user_id_foreign` (`user_id`),
  CONSTRAINT `shareout_allocations_shareout_id_foreign` FOREIGN KEY (`shareout_id`) REFERENCES `shareouts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `shareout_allocations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.shareout_allocations: ~0 rows (approximately)
DELETE FROM `shareout_allocations`;

-- Dumping structure for table ziko_village_bank_management_system.share_declarations
DROP TABLE IF EXISTS `share_declarations`;
CREATE TABLE IF NOT EXISTS `share_declarations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `month_id` bigint unsigned NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `share_declarations_user_id_foreign` (`user_id`),
  KEY `share_declarations_month_id_foreign` (`month_id`),
  CONSTRAINT `share_declarations_month_id_foreign` FOREIGN KEY (`month_id`) REFERENCES `months` (`id`) ON DELETE CASCADE,
  CONSTRAINT `share_declarations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.share_declarations: ~317 rows (approximately)
DELETE FROM `share_declarations`;
INSERT INTO `share_declarations` (`id`, `user_id`, `month_id`, `amount`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 500.00, '2026-04-05 04:37:41', '2026-04-05 04:37:41'),
	(2, 6, 1, 200.00, '2026-04-05 04:37:41', '2026-04-05 04:37:41'),
	(3, 8, 1, 300.00, '2026-04-05 04:37:41', '2026-04-05 04:37:41'),
	(4, 9, 1, 100.00, '2026-04-05 04:37:41', '2026-04-05 04:37:41'),
	(5, 10, 1, 500.00, '2026-04-05 04:37:41', '2026-04-05 04:37:41'),
	(6, 11, 1, 600.00, '2026-04-05 04:37:41', '2026-04-05 04:37:41'),
	(7, 3, 1, 600.00, '2026-04-05 05:49:26', '2026-04-05 05:49:26'),
	(8, 4, 1, 200.00, '2026-04-05 05:49:26', '2026-04-05 05:49:26'),
	(9, 14, 13, 200.00, '2024-11-21 22:00:00', '2026-04-09 18:37:56'),
	(10, 14, 14, 15000.00, '2024-12-16 22:00:00', '2026-04-09 18:37:56'),
	(11, 14, 15, 200.00, '2025-01-10 22:00:00', '2026-04-09 18:37:56'),
	(12, 14, 16, 200.00, '2025-02-13 22:00:00', '2026-04-09 18:37:56'),
	(13, 14, 17, 10000.00, '2025-03-11 22:00:00', '2026-04-09 18:37:56'),
	(14, 14, 18, 200.00, '2025-04-23 22:00:00', '2026-04-09 18:37:56'),
	(15, 14, 19, 200.00, '2025-05-08 22:00:00', '2026-04-09 18:37:56'),
	(16, 14, 20, 200.00, '2025-06-21 22:00:00', '2026-04-09 18:37:56'),
	(17, 14, 21, 200.00, '2025-07-03 22:00:00', '2026-04-09 18:37:56'),
	(18, 14, 22, 1000.00, '2025-08-09 22:00:00', '2026-04-09 18:37:56'),
	(19, 15, 17, 48000.00, '2025-03-04 22:00:00', '2026-04-09 18:37:56'),
	(20, 15, 18, 200.00, '2025-04-13 22:00:00', '2026-04-09 18:37:56'),
	(21, 15, 19, 200.00, '2025-05-07 22:00:00', '2026-04-09 18:37:56'),
	(22, 15, 20, 200.00, '2025-06-19 22:00:00', '2026-04-09 18:37:56'),
	(23, 15, 21, 200.00, '2025-07-25 22:00:00', '2026-04-09 18:37:56'),
	(24, 15, 22, 200.00, '2025-08-22 22:00:00', '2026-04-09 18:37:56'),
	(25, 16, 13, 1200.00, '2024-11-15 22:00:00', '2026-04-09 18:37:56'),
	(26, 16, 14, 200.00, '2024-12-21 22:00:00', '2026-04-09 18:37:56'),
	(27, 16, 15, 200.00, '2025-01-22 22:00:00', '2026-04-09 18:37:56'),
	(28, 16, 16, 200.00, '2025-02-02 22:00:00', '2026-04-09 18:37:56'),
	(29, 16, 17, 3000.00, '2025-03-13 22:00:00', '2026-04-09 18:37:56'),
	(30, 16, 18, 200.00, '2025-04-13 22:00:00', '2026-04-09 18:37:56'),
	(31, 16, 19, 200.00, '2025-05-19 22:00:00', '2026-04-09 18:37:56'),
	(32, 16, 20, 200.00, '2025-06-22 22:00:00', '2026-04-09 18:37:56'),
	(33, 16, 21, 200.00, '2025-07-22 22:00:00', '2026-04-09 18:37:56'),
	(34, 16, 22, 200.00, '2025-08-10 22:00:00', '2026-04-09 18:37:56'),
	(35, 17, 13, 200.00, '2024-11-04 22:00:00', '2026-04-09 18:37:56'),
	(36, 17, 14, 200.00, '2024-12-15 22:00:00', '2026-04-09 18:37:56'),
	(37, 17, 15, 400.00, '2025-01-08 22:00:00', '2026-04-09 18:37:56'),
	(38, 17, 16, 200.00, '2025-02-12 22:00:00', '2026-04-09 18:37:56'),
	(39, 17, 17, 400.00, '2025-03-23 22:00:00', '2026-04-09 18:37:56'),
	(40, 17, 18, 400.00, '2025-04-08 22:00:00', '2026-04-09 18:37:56'),
	(41, 17, 19, 1000.00, '2025-05-07 22:00:00', '2026-04-09 18:37:56'),
	(42, 17, 20, 3000.00, '2025-06-05 22:00:00', '2026-04-09 18:37:56'),
	(43, 17, 21, 200.00, '2025-07-19 22:00:00', '2026-04-09 18:37:56'),
	(44, 17, 22, 200.00, '2025-08-20 22:00:00', '2026-04-09 18:37:56'),
	(45, 18, 13, 5000.00, '2024-11-16 22:00:00', '2026-04-09 18:37:56'),
	(46, 18, 14, 200.00, '2024-12-09 22:00:00', '2026-04-09 18:37:56'),
	(47, 18, 15, 2000.00, '2025-01-13 22:00:00', '2026-04-09 18:37:56'),
	(48, 18, 16, 200.00, '2025-02-15 22:00:00', '2026-04-09 18:37:56'),
	(49, 18, 17, 200.00, '2025-03-02 22:00:00', '2026-04-09 18:37:56'),
	(50, 18, 18, 2000.00, '2025-04-21 22:00:00', '2026-04-09 18:37:56'),
	(51, 18, 19, 200.00, '2025-05-24 22:00:00', '2026-04-09 18:37:56'),
	(52, 18, 20, 200.00, '2025-06-10 22:00:00', '2026-04-09 18:37:56'),
	(53, 18, 21, 200.00, '2025-07-24 22:00:00', '2026-04-09 18:37:56'),
	(54, 18, 22, 200.00, '2025-08-16 22:00:00', '2026-04-09 18:37:56'),
	(55, 19, 13, 200.00, '2024-11-17 22:00:00', '2026-04-09 18:37:56'),
	(56, 19, 14, 200.00, '2024-12-25 22:00:00', '2026-04-09 18:37:56'),
	(57, 19, 15, 200.00, '2025-01-21 22:00:00', '2026-04-09 18:37:56'),
	(58, 19, 16, 200.00, '2025-02-17 22:00:00', '2026-04-09 18:37:56'),
	(59, 19, 17, 200.00, '2025-03-24 22:00:00', '2026-04-09 18:37:56'),
	(60, 19, 18, 200.00, '2025-04-15 22:00:00', '2026-04-09 18:37:56'),
	(61, 19, 19, 200.00, '2025-05-20 22:00:00', '2026-04-09 18:37:56'),
	(62, 19, 20, 400.00, '2025-06-06 22:00:00', '2026-04-09 18:37:56'),
	(63, 19, 21, 200.00, '2025-07-17 22:00:00', '2026-04-09 18:37:56'),
	(64, 19, 22, 200.00, '2025-08-18 22:00:00', '2026-04-09 18:37:56'),
	(65, 20, 13, 200.00, '2024-11-01 22:00:00', '2026-04-09 18:37:56'),
	(66, 20, 14, 200.00, '2024-12-19 22:00:00', '2026-04-09 18:37:56'),
	(67, 20, 15, 200.00, '2025-01-17 22:00:00', '2026-04-09 18:37:56'),
	(68, 20, 16, 200.00, '2025-02-08 22:00:00', '2026-04-09 18:37:56'),
	(69, 20, 17, 200.00, '2025-03-04 22:00:00', '2026-04-09 18:37:56'),
	(70, 20, 18, 200.00, '2025-04-20 22:00:00', '2026-04-09 18:37:56'),
	(71, 20, 19, 200.00, '2025-05-13 22:00:00', '2026-04-09 18:37:56'),
	(72, 20, 20, 10000.00, '2025-06-06 22:00:00', '2026-04-09 18:37:56'),
	(73, 20, 21, 1000.00, '2025-07-14 22:00:00', '2026-04-09 18:37:56'),
	(74, 20, 22, 1000.00, '2025-08-08 22:00:00', '2026-04-09 18:37:56'),
	(75, 21, 13, 400.00, '2024-11-16 22:00:00', '2026-04-09 18:37:56'),
	(76, 21, 14, 400.00, '2024-12-10 22:00:00', '2026-04-09 18:37:56'),
	(77, 21, 15, 1200.00, '2025-01-08 22:00:00', '2026-04-09 18:37:56'),
	(78, 21, 16, 400.00, '2025-02-06 22:00:00', '2026-04-09 18:37:56'),
	(79, 21, 17, 400.00, '2025-03-24 22:00:00', '2026-04-09 18:37:56'),
	(80, 21, 18, 3600.00, '2025-04-18 22:00:00', '2026-04-09 18:37:56'),
	(81, 21, 19, 200.00, '2025-05-11 22:00:00', '2026-04-09 18:37:56'),
	(82, 21, 20, 200.00, '2025-06-06 22:00:00', '2026-04-09 18:37:56'),
	(83, 21, 21, 200.00, '2025-07-01 22:00:00', '2026-04-09 18:37:56'),
	(84, 21, 22, 400.00, '2025-08-06 22:00:00', '2026-04-09 18:37:56'),
	(85, 22, 13, 1000.00, '2024-11-03 22:00:00', '2026-04-09 18:37:56'),
	(86, 22, 14, 200.00, '2024-12-11 22:00:00', '2026-04-09 18:37:56'),
	(87, 22, 15, 200.00, '2025-01-02 22:00:00', '2026-04-09 18:37:56'),
	(88, 22, 16, 200.00, '2025-02-18 22:00:00', '2026-04-09 18:37:56'),
	(89, 22, 17, 1000.00, '2025-03-13 22:00:00', '2026-04-09 18:37:56'),
	(90, 22, 18, 200.00, '2025-04-03 22:00:00', '2026-04-09 18:37:56'),
	(91, 22, 19, 1000.00, '2025-05-11 22:00:00', '2026-04-09 18:37:56'),
	(92, 22, 20, 1000.00, '2025-06-07 22:00:00', '2026-04-09 18:37:56'),
	(93, 22, 21, 200.00, '2025-07-02 22:00:00', '2026-04-09 18:37:56'),
	(94, 22, 22, 200.00, '2025-08-11 22:00:00', '2026-04-09 18:37:56'),
	(95, 23, 13, 200.00, '2024-11-10 22:00:00', '2026-04-09 18:37:56'),
	(96, 23, 14, 200.00, '2024-12-05 22:00:00', '2026-04-09 18:37:56'),
	(97, 23, 15, 200.00, '2025-01-06 22:00:00', '2026-04-09 18:37:56'),
	(98, 23, 16, 4800.00, '2025-02-24 22:00:00', '2026-04-09 18:37:56'),
	(99, 23, 17, 200.00, '2025-03-21 22:00:00', '2026-04-09 18:37:56'),
	(100, 23, 18, 200.00, '2025-04-21 22:00:00', '2026-04-09 18:37:56'),
	(101, 23, 19, 200.00, '2025-05-05 22:00:00', '2026-04-09 18:37:56'),
	(102, 23, 20, 200.00, '2025-06-22 22:00:00', '2026-04-09 18:37:56'),
	(103, 23, 21, 200.00, '2025-07-19 22:00:00', '2026-04-09 18:37:56'),
	(104, 23, 22, 200.00, '2025-08-05 22:00:00', '2026-04-09 18:37:56'),
	(105, 24, 13, 200.00, '2024-11-12 22:00:00', '2026-04-09 18:37:56'),
	(106, 24, 14, 200.00, '2024-12-21 22:00:00', '2026-04-09 18:37:56'),
	(107, 24, 15, 200.00, '2025-01-18 22:00:00', '2026-04-09 18:37:56'),
	(108, 24, 16, 200.00, '2025-02-15 22:00:00', '2026-04-09 18:37:56'),
	(109, 24, 17, 15000.00, '2025-03-23 22:00:00', '2026-04-09 18:37:56'),
	(110, 24, 18, 200.00, '2025-04-02 22:00:00', '2026-04-09 18:37:56'),
	(111, 24, 19, 15000.00, '2025-05-10 22:00:00', '2026-04-09 18:37:56'),
	(112, 24, 20, 400.00, '2025-06-22 22:00:00', '2026-04-09 18:37:56'),
	(113, 24, 21, 200.00, '2025-07-23 22:00:00', '2026-04-09 18:37:56'),
	(114, 24, 22, 200.00, '2025-08-06 22:00:00', '2026-04-09 18:37:56'),
	(115, 25, 13, 200.00, '2024-11-03 22:00:00', '2026-04-09 18:37:56'),
	(116, 25, 14, 400.00, '2024-12-05 22:00:00', '2026-04-09 18:37:56'),
	(117, 25, 15, 200.00, '2025-01-13 22:00:00', '2026-04-09 18:37:56'),
	(118, 25, 16, 200.00, '2025-02-19 22:00:00', '2026-04-09 18:37:56'),
	(119, 25, 17, 200.00, '2025-03-17 22:00:00', '2026-04-09 18:37:56'),
	(120, 25, 18, 200.00, '2025-04-18 22:00:00', '2026-04-09 18:37:56'),
	(121, 25, 19, 200.00, '2025-05-02 22:00:00', '2026-04-09 18:37:56'),
	(122, 25, 20, 400.00, '2025-06-15 22:00:00', '2026-04-09 18:37:56'),
	(123, 25, 21, 1000.00, '2025-07-01 22:00:00', '2026-04-09 18:37:56'),
	(124, 25, 22, 200.00, '2025-08-08 22:00:00', '2026-04-09 18:37:56'),
	(125, 26, 13, 5000.00, '2024-11-14 22:00:00', '2026-04-09 18:37:56'),
	(126, 26, 14, 200.00, '2024-12-17 22:00:00', '2026-04-09 18:37:56'),
	(127, 26, 15, 200.00, '2025-01-04 22:00:00', '2026-04-09 18:37:56'),
	(128, 26, 16, 200.00, '2025-02-05 22:00:00', '2026-04-09 18:37:56'),
	(129, 26, 17, 200.00, '2025-03-17 22:00:00', '2026-04-09 18:37:56'),
	(130, 26, 18, 200.00, '2025-04-04 22:00:00', '2026-04-09 18:37:56'),
	(131, 26, 19, 1000.00, '2025-05-23 22:00:00', '2026-04-09 18:37:56'),
	(132, 26, 20, 200.00, '2025-06-04 22:00:00', '2026-04-09 18:37:56'),
	(133, 26, 21, 200.00, '2025-07-18 22:00:00', '2026-04-09 18:37:56'),
	(134, 26, 22, 200.00, '2025-08-01 22:00:00', '2026-04-09 18:37:56'),
	(135, 27, 13, 5000.00, '2024-11-02 22:00:00', '2026-04-09 18:37:56'),
	(136, 27, 14, 5000.00, '2024-12-03 22:00:00', '2026-04-09 18:37:56'),
	(137, 27, 15, 5000.00, '2025-01-25 22:00:00', '2026-04-09 18:37:56'),
	(138, 27, 16, 5000.00, '2025-02-05 22:00:00', '2026-04-09 18:37:56'),
	(139, 27, 17, 10000.00, '2025-03-19 22:00:00', '2026-04-09 18:37:56'),
	(140, 27, 18, 5000.00, '2025-04-22 22:00:00', '2026-04-09 18:37:56'),
	(141, 27, 19, 5000.00, '2025-05-06 22:00:00', '2026-04-09 18:37:56'),
	(142, 27, 20, 5000.00, '2025-06-02 22:00:00', '2026-04-09 18:37:56'),
	(143, 27, 21, 3600.00, '2025-07-06 22:00:00', '2026-04-09 18:37:56'),
	(144, 27, 22, 200.00, '2025-08-08 22:00:00', '2026-04-09 18:37:56'),
	(145, 28, 13, 600.00, '2024-11-13 22:00:00', '2026-04-09 18:37:56'),
	(146, 28, 14, 200.00, '2024-12-10 22:00:00', '2026-04-09 18:37:56'),
	(147, 28, 15, 400.00, '2025-01-01 22:00:00', '2026-04-09 18:37:56'),
	(148, 28, 16, 600.00, '2025-02-21 22:00:00', '2026-04-09 18:37:56'),
	(149, 28, 17, 200.00, '2025-03-04 22:00:00', '2026-04-09 18:37:56'),
	(150, 28, 18, 200.00, '2025-04-15 22:00:00', '2026-04-09 18:37:56'),
	(151, 28, 19, 600.00, '2025-05-18 22:00:00', '2026-04-09 18:37:56'),
	(152, 28, 20, 400.00, '2025-06-21 22:00:00', '2026-04-09 18:37:56'),
	(153, 28, 21, 200.00, '2025-07-17 22:00:00', '2026-04-09 18:37:56'),
	(154, 28, 22, 200.00, '2025-08-06 22:00:00', '2026-04-09 18:37:56'),
	(155, 29, 13, 3000.00, '2024-11-06 22:00:00', '2026-04-09 18:37:56'),
	(156, 29, 14, 3000.00, '2024-12-18 22:00:00', '2026-04-09 18:37:56'),
	(157, 29, 15, 5000.00, '2025-01-02 22:00:00', '2026-04-09 18:37:56'),
	(158, 29, 16, 1000.00, '2025-02-11 22:00:00', '2026-04-09 18:37:56'),
	(159, 29, 17, 3400.00, '2025-03-01 22:00:00', '2026-04-09 18:37:56'),
	(160, 29, 18, 1000.00, '2025-04-18 22:00:00', '2026-04-09 18:37:56'),
	(161, 29, 19, 1000.00, '2025-05-12 22:00:00', '2026-04-09 18:37:56'),
	(162, 29, 20, 2600.00, '2025-06-07 22:00:00', '2026-04-09 18:37:56'),
	(163, 29, 21, 2600.00, '2025-07-16 22:00:00', '2026-04-09 18:37:56'),
	(164, 29, 22, 2600.00, '2025-08-16 22:00:00', '2026-04-09 18:37:56'),
	(165, 30, 13, 1000.00, '2024-11-20 22:00:00', '2026-04-09 18:37:56'),
	(166, 30, 14, 1000.00, '2024-12-11 22:00:00', '2026-04-09 18:37:56'),
	(167, 30, 15, 6000.00, '2025-01-16 22:00:00', '2026-04-09 18:37:56'),
	(168, 30, 16, 4000.00, '2025-02-20 22:00:00', '2026-04-09 18:37:56'),
	(169, 30, 17, 7000.00, '2025-03-24 22:00:00', '2026-04-09 18:37:56'),
	(170, 30, 18, 200.00, '2025-04-25 22:00:00', '2026-04-09 18:37:56'),
	(171, 30, 19, 1000.00, '2025-05-25 22:00:00', '2026-04-09 18:37:56'),
	(172, 30, 20, 2000.00, '2025-06-16 22:00:00', '2026-04-09 18:37:56'),
	(173, 30, 21, 2000.00, '2025-07-21 22:00:00', '2026-04-09 18:37:56'),
	(174, 30, 22, 1000.00, '2025-08-20 22:00:00', '2026-04-09 18:37:56'),
	(175, 31, 13, 1000.00, '2024-11-04 22:00:00', '2026-04-09 18:37:56'),
	(176, 31, 14, 2000.00, '2024-12-20 22:00:00', '2026-04-09 18:37:56'),
	(177, 31, 15, 4000.00, '2025-01-08 22:00:00', '2026-04-09 18:37:56'),
	(178, 31, 16, 13000.00, '2025-02-16 22:00:00', '2026-04-09 18:37:56'),
	(179, 31, 17, 5000.00, '2025-03-01 22:00:00', '2026-04-09 18:37:56'),
	(180, 31, 18, 200.00, '2025-04-13 22:00:00', '2026-04-09 18:37:56'),
	(181, 31, 19, 1000.00, '2025-05-14 22:00:00', '2026-04-09 18:37:56'),
	(182, 31, 20, 400.00, '2025-06-05 22:00:00', '2026-04-09 18:37:56'),
	(183, 31, 21, 200.00, '2025-07-25 22:00:00', '2026-04-09 18:37:56'),
	(184, 31, 22, 200.00, '2025-08-19 22:00:00', '2026-04-09 18:37:56'),
	(185, 32, 14, 1000.00, '2024-12-03 22:00:00', '2026-04-09 18:37:56'),
	(186, 32, 15, 1800.00, '2025-01-07 22:00:00', '2026-04-09 18:37:56'),
	(187, 32, 16, 8800.00, '2025-02-02 22:00:00', '2026-04-09 18:37:56'),
	(188, 32, 17, 20000.00, '2025-03-02 22:00:00', '2026-04-09 18:37:56'),
	(189, 32, 18, 400.00, '2025-04-11 22:00:00', '2026-04-09 18:37:56'),
	(190, 32, 19, 1000.00, '2025-05-21 22:00:00', '2026-04-09 18:37:56'),
	(191, 32, 20, 200.00, '2025-06-01 22:00:00', '2026-04-09 18:37:56'),
	(192, 32, 21, 400.00, '2025-07-22 22:00:00', '2026-04-09 18:37:56'),
	(193, 32, 22, 200.00, '2025-08-08 22:00:00', '2026-04-09 18:37:56'),
	(194, 33, 13, 6000.00, '2024-11-03 22:00:00', '2026-04-09 18:37:56'),
	(195, 33, 14, 10000.00, '2024-12-10 22:00:00', '2026-04-09 18:37:56'),
	(196, 33, 15, 2000.00, '2025-01-14 22:00:00', '2026-04-09 18:37:56'),
	(197, 33, 16, 200.00, '2025-02-07 22:00:00', '2026-04-09 18:37:56'),
	(198, 33, 17, 5000.00, '2025-03-15 22:00:00', '2026-04-09 18:37:56'),
	(199, 33, 18, 200.00, '2025-04-10 22:00:00', '2026-04-09 18:37:56'),
	(200, 33, 19, 1000.00, '2025-05-03 22:00:00', '2026-04-09 18:37:56'),
	(201, 33, 20, 200.00, '2025-06-12 22:00:00', '2026-04-09 18:37:56'),
	(202, 33, 21, 200.00, '2025-07-09 22:00:00', '2026-04-09 18:37:56'),
	(203, 33, 22, 200.00, '2025-08-17 22:00:00', '2026-04-09 18:37:56'),
	(204, 34, 13, 200.00, '2024-11-18 22:00:00', '2026-04-09 18:37:56'),
	(205, 34, 14, 1000.00, '2024-12-11 22:00:00', '2026-04-09 18:37:56'),
	(206, 34, 15, 1000.00, '2025-01-16 22:00:00', '2026-04-09 18:37:56'),
	(207, 34, 16, 200.00, '2025-02-11 22:00:00', '2026-04-09 18:37:56'),
	(208, 34, 17, 10000.00, '2025-03-06 22:00:00', '2026-04-09 18:37:56'),
	(209, 34, 18, 200.00, '2025-04-23 22:00:00', '2026-04-09 18:37:56'),
	(210, 34, 19, 1000.00, '2025-05-01 22:00:00', '2026-04-09 18:37:56'),
	(211, 34, 20, 200.00, '2025-06-24 22:00:00', '2026-04-09 18:37:56'),
	(212, 34, 21, 200.00, '2025-07-05 22:00:00', '2026-04-09 18:37:56'),
	(213, 34, 22, 200.00, '2025-08-17 22:00:00', '2026-04-09 18:37:56'),
	(214, 35, 13, 5000.00, '2024-11-03 22:00:00', '2026-04-09 18:37:56'),
	(215, 35, 14, 10000.00, '2024-12-11 22:00:00', '2026-04-09 18:37:56'),
	(216, 35, 15, 1000.00, '2025-01-06 22:00:00', '2026-04-09 18:37:56'),
	(217, 35, 16, 5000.00, '2025-02-20 22:00:00', '2026-04-09 18:37:56'),
	(218, 35, 17, 5000.00, '2025-03-08 22:00:00', '2026-04-09 18:37:56'),
	(219, 35, 18, 1000.00, '2025-04-06 22:00:00', '2026-04-09 18:37:56'),
	(220, 35, 19, 1000.00, '2025-05-03 22:00:00', '2026-04-09 18:37:56'),
	(221, 35, 20, 2000.00, '2025-06-11 22:00:00', '2026-04-09 18:37:56'),
	(222, 35, 21, 2000.00, '2025-07-14 22:00:00', '2026-04-09 18:37:56'),
	(223, 35, 22, 200.00, '2025-08-10 22:00:00', '2026-04-09 18:37:56'),
	(224, 36, 13, 5000.00, '2024-11-13 22:00:00', '2026-04-09 18:37:56'),
	(225, 36, 14, 1000.00, '2024-12-17 22:00:00', '2026-04-09 18:37:56'),
	(226, 36, 15, 1000.00, '2025-01-06 22:00:00', '2026-04-09 18:37:56'),
	(227, 36, 16, 2000.00, '2025-02-12 22:00:00', '2026-04-09 18:37:56'),
	(228, 36, 17, 1000.00, '2025-03-12 22:00:00', '2026-04-09 18:37:56'),
	(229, 36, 18, 200.00, '2025-04-11 22:00:00', '2026-04-09 18:37:56'),
	(230, 36, 19, 200.00, '2025-05-13 22:00:00', '2026-04-09 18:37:56'),
	(231, 36, 21, 200.00, '2025-07-16 22:00:00', '2026-04-09 18:37:56'),
	(232, 36, 22, 400.00, '2025-08-14 22:00:00', '2026-04-09 18:37:56'),
	(233, 37, 13, 2000.00, '2024-11-01 22:00:00', '2026-04-09 18:37:56'),
	(234, 37, 14, 4000.00, '2024-12-04 22:00:00', '2026-04-09 18:37:56'),
	(235, 37, 15, 1000.00, '2025-01-02 22:00:00', '2026-04-09 18:37:56'),
	(236, 37, 16, 200.00, '2025-02-18 22:00:00', '2026-04-09 18:37:56'),
	(237, 37, 17, 200.00, '2025-03-09 22:00:00', '2026-04-09 18:37:56'),
	(238, 37, 18, 400.00, '2025-04-16 22:00:00', '2026-04-09 18:37:56'),
	(239, 37, 19, 600.00, '2025-05-19 22:00:00', '2026-04-09 18:37:56'),
	(240, 37, 20, 600.00, '2025-06-12 22:00:00', '2026-04-09 18:37:56'),
	(241, 37, 21, 200.00, '2025-07-20 22:00:00', '2026-04-09 18:37:56'),
	(242, 37, 22, 200.00, '2025-08-25 22:00:00', '2026-04-09 18:37:56'),
	(243, 38, 13, 200.00, '2024-11-04 22:00:00', '2026-04-09 18:37:56'),
	(244, 40, 25, 200.00, '2025-02-06 22:00:00', '2026-04-09 18:38:02'),
	(245, 40, 26, 400.00, '2025-03-11 22:00:00', '2026-04-09 18:38:02'),
	(246, 40, 27, 200.00, '2025-04-08 22:00:00', '2026-04-09 18:38:02'),
	(247, 40, 28, 200.00, '2025-05-10 22:00:00', '2026-04-09 18:38:02'),
	(248, 40, 29, 200.00, '2025-06-20 22:00:00', '2026-04-09 18:38:02'),
	(249, 40, 30, 200.00, '2025-07-12 22:00:00', '2026-04-09 18:38:02'),
	(250, 40, 33, 200.00, '2025-10-01 22:00:00', '2026-04-09 18:38:02'),
	(251, 41, 25, 500.00, '2025-02-18 22:00:00', '2026-04-09 18:38:02'),
	(252, 41, 26, 400.00, '2025-03-06 22:00:00', '2026-04-09 18:38:02'),
	(253, 41, 27, 400.00, '2025-04-08 22:00:00', '2026-04-09 18:38:02'),
	(254, 41, 28, 200.00, '2025-05-01 22:00:00', '2026-04-09 18:38:02'),
	(255, 41, 29, 400.00, '2025-06-13 22:00:00', '2026-04-09 18:38:02'),
	(256, 41, 30, 600.00, '2025-07-11 22:00:00', '2026-04-09 18:38:02'),
	(257, 41, 31, 400.00, '2025-08-05 22:00:00', '2026-04-09 18:38:02'),
	(258, 41, 32, 600.00, '2025-09-18 22:00:00', '2026-04-09 18:38:02'),
	(259, 41, 33, 400.00, '2025-10-15 22:00:00', '2026-04-09 18:38:02'),
	(260, 42, 25, 200.00, '2025-02-12 22:00:00', '2026-04-09 18:38:02'),
	(261, 42, 26, 200.00, '2025-03-13 22:00:00', '2026-04-09 18:38:02'),
	(262, 42, 27, 200.00, '2025-04-13 22:00:00', '2026-04-09 18:38:02'),
	(263, 42, 28, 200.00, '2025-05-05 22:00:00', '2026-04-09 18:38:02'),
	(264, 42, 29, 200.00, '2025-06-05 22:00:00', '2026-04-09 18:38:02'),
	(265, 42, 30, 200.00, '2025-07-19 22:00:00', '2026-04-09 18:38:02'),
	(266, 42, 31, 400.00, '2025-08-18 22:00:00', '2026-04-09 18:38:02'),
	(267, 42, 32, 200.00, '2025-09-11 22:00:00', '2026-04-09 18:38:02'),
	(268, 42, 33, 200.00, '2025-10-13 22:00:00', '2026-04-09 18:38:02'),
	(269, 43, 26, 200.00, '2025-03-08 22:00:00', '2026-04-09 18:38:02'),
	(270, 43, 27, 200.00, '2025-04-18 22:00:00', '2026-04-09 18:38:02'),
	(271, 43, 28, 200.00, '2025-05-16 22:00:00', '2026-04-09 18:38:02'),
	(272, 43, 29, 200.00, '2025-06-11 22:00:00', '2026-04-09 18:38:02'),
	(273, 43, 30, 400.00, '2025-07-03 22:00:00', '2026-04-09 18:38:02'),
	(274, 43, 31, 500.00, '2025-08-07 22:00:00', '2026-04-09 18:38:02'),
	(275, 43, 32, 400.00, '2025-09-01 22:00:00', '2026-04-09 18:38:02'),
	(276, 43, 33, 400.00, '2025-10-02 22:00:00', '2026-04-09 18:38:02'),
	(277, 44, 25, 200.00, '2025-02-05 22:00:00', '2026-04-09 18:38:02'),
	(278, 44, 26, 200.00, '2025-03-18 22:00:00', '2026-04-09 18:38:02'),
	(279, 44, 27, 200.00, '2025-04-04 22:00:00', '2026-04-09 18:38:02'),
	(280, 44, 28, 200.00, '2025-05-09 22:00:00', '2026-04-09 18:38:02'),
	(281, 44, 29, 200.00, '2025-06-05 22:00:00', '2026-04-09 18:38:02'),
	(282, 44, 30, 400.00, '2025-07-19 22:00:00', '2026-04-09 18:38:02'),
	(283, 44, 31, 200.00, '2025-08-07 22:00:00', '2026-04-09 18:38:02'),
	(284, 44, 32, 200.00, '2025-09-01 22:00:00', '2026-04-09 18:38:02'),
	(285, 44, 33, 200.00, '2025-10-17 22:00:00', '2026-04-09 18:38:02'),
	(286, 45, 25, 200.00, '2025-02-09 22:00:00', '2026-04-09 18:38:02'),
	(287, 45, 26, 200.00, '2025-03-14 22:00:00', '2026-04-09 18:38:02'),
	(288, 45, 28, 200.00, '2025-05-05 22:00:00', '2026-04-09 18:38:02'),
	(289, 45, 29, 200.00, '2025-06-18 22:00:00', '2026-04-09 18:38:02'),
	(290, 45, 30, 200.00, '2025-07-15 22:00:00', '2026-04-09 18:38:02'),
	(291, 45, 31, 200.00, '2025-08-17 22:00:00', '2026-04-09 18:38:02'),
	(292, 45, 33, 200.00, '2025-10-05 22:00:00', '2026-04-09 18:38:02'),
	(293, 46, 25, 200.00, '2025-02-13 22:00:00', '2026-04-09 18:38:02'),
	(294, 46, 26, 200.00, '2025-03-10 22:00:00', '2026-04-09 18:38:02'),
	(295, 46, 27, 200.00, '2025-04-12 22:00:00', '2026-04-09 18:38:02'),
	(296, 46, 28, 200.00, '2025-05-20 22:00:00', '2026-04-09 18:38:02'),
	(297, 46, 29, 200.00, '2025-06-14 22:00:00', '2026-04-09 18:38:02'),
	(298, 46, 30, 200.00, '2025-07-20 22:00:00', '2026-04-09 18:38:02'),
	(299, 46, 31, 200.00, '2025-08-18 22:00:00', '2026-04-09 18:38:02'),
	(300, 47, 27, 200.00, '2025-04-17 22:00:00', '2026-04-09 18:38:02'),
	(301, 47, 28, 800.00, '2025-05-14 22:00:00', '2026-04-09 18:38:02'),
	(302, 47, 29, 400.00, '2025-06-19 22:00:00', '2026-04-09 18:38:02'),
	(303, 47, 33, 400.00, '2025-10-03 22:00:00', '2026-04-09 18:38:02'),
	(304, 48, 26, 200.00, '2025-03-05 22:00:00', '2026-04-09 18:38:02'),
	(305, 48, 28, 200.00, '2025-05-13 22:00:00', '2026-04-09 18:38:02'),
	(306, 48, 29, 200.00, '2025-06-18 22:00:00', '2026-04-09 18:38:02'),
	(307, 48, 30, 200.00, '2025-07-14 22:00:00', '2026-04-09 18:38:02'),
	(308, 48, 31, 200.00, '2025-08-04 22:00:00', '2026-04-09 18:38:02'),
	(309, 48, 32, 200.00, '2025-09-02 22:00:00', '2026-04-09 18:38:02'),
	(310, 48, 33, 200.00, '2025-10-07 22:00:00', '2026-04-09 18:38:02'),
	(311, 49, 29, 1000.00, '2025-06-05 22:00:00', '2026-04-09 18:38:02'),
	(312, 49, 30, 200.00, '2025-07-18 22:00:00', '2026-04-09 18:38:02'),
	(313, 50, 29, 200.00, '2025-06-04 22:00:00', '2026-04-09 18:38:02'),
	(314, 50, 30, 200.00, '2025-07-19 22:00:00', '2026-04-09 18:38:02'),
	(315, 50, 31, 200.00, '2025-08-03 22:00:00', '2026-04-09 18:38:02'),
	(316, 50, 33, 200.00, '2025-10-16 22:00:00', '2026-04-09 18:38:02'),
	(317, 51, 33, 200.00, '2025-10-20 22:00:00', '2026-04-09 18:38:02');

-- Dumping structure for table ziko_village_bank_management_system.social_funds
DROP TABLE IF EXISTS `social_funds`;
CREATE TABLE IF NOT EXISTS `social_funds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `circle_id` bigint unsigned NOT NULL,
  `shareout_id` bigint unsigned DEFAULT NULL,
  `total_insurance_profit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_penalties` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_fund` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_used` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_remaining` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` enum('active','depleted','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_funds_circle_id_foreign` (`circle_id`),
  KEY `social_funds_shareout_id_foreign` (`shareout_id`),
  CONSTRAINT `social_funds_circle_id_foreign` FOREIGN KEY (`circle_id`) REFERENCES `circles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `social_funds_shareout_id_foreign` FOREIGN KEY (`shareout_id`) REFERENCES `shareouts` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.social_funds: ~0 rows (approximately)
DELETE FROM `social_funds`;

-- Dumping structure for table ziko_village_bank_management_system.social_fund_usages
DROP TABLE IF EXISTS `social_fund_usages`;
CREATE TABLE IF NOT EXISTS `social_fund_usages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `social_fund_id` bigint unsigned NOT NULL,
  `type` enum('shareout','donation','payment','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `recipient` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Person or organisation receiving funds',
  `usage_date` date NOT NULL,
  `recorded_by` bigint unsigned NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_fund_usages_social_fund_id_foreign` (`social_fund_id`),
  KEY `social_fund_usages_recorded_by_foreign` (`recorded_by`),
  CONSTRAINT `social_fund_usages_recorded_by_foreign` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `social_fund_usages_social_fund_id_foreign` FOREIGN KEY (`social_fund_id`) REFERENCES `social_funds` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.social_fund_usages: ~0 rows (approximately)
DELETE FROM `social_fund_usages`;

-- Dumping structure for table ziko_village_bank_management_system.subscriptions
DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `village_bank_id` bigint unsigned NOT NULL,
  `subscription_plan_id` bigint unsigned NOT NULL,
  `status` enum('pending','active','expired','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `auto_renew` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_village_bank_id_foreign` (`village_bank_id`),
  KEY `subscriptions_subscription_plan_id_foreign` (`subscription_plan_id`),
  CONSTRAINT `subscriptions_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subscriptions_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.subscriptions: ~1 rows (approximately)
DELETE FROM `subscriptions`;
INSERT INTO `subscriptions` (`id`, `village_bank_id`, `subscription_plan_id`, `status`, `starts_at`, `ends_at`, `auto_renew`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 'active', '2026-04-03 18:41:37', '2026-05-03 18:41:37', 0, '2026-04-03 18:41:37', '2026-04-03 18:41:37');

-- Dumping structure for table ziko_village_bank_management_system.subscription_payments
DROP TABLE IF EXISTS `subscription_payments`;
CREATE TABLE IF NOT EXISTS `subscription_payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint unsigned NOT NULL,
  `paid_by` bigint unsigned NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','confirmed','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_remarks` text COLLATE utf8mb4_unicode_ci,
  `reviewed_by` bigint unsigned DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscription_payments_subscription_id_foreign` (`subscription_id`),
  KEY `subscription_payments_paid_by_foreign` (`paid_by`),
  KEY `subscription_payments_reviewed_by_foreign` (`reviewed_by`),
  CONSTRAINT `subscription_payments_paid_by_foreign` FOREIGN KEY (`paid_by`) REFERENCES `users` (`id`),
  CONSTRAINT `subscription_payments_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`),
  CONSTRAINT `subscription_payments_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.subscription_payments: ~0 rows (approximately)
DELETE FROM `subscription_payments`;

-- Dumping structure for table ziko_village_bank_management_system.subscription_plans
DROP TABLE IF EXISTS `subscription_plans`;
CREATE TABLE IF NOT EXISTS `subscription_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,2) NOT NULL,
  `billing_cycle` enum('monthly','quarterly','yearly') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `duration_days` int NOT NULL,
  `max_circles` int DEFAULT NULL,
  `max_members` int DEFAULT NULL,
  `features` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscription_plans_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.subscription_plans: ~6 rows (approximately)
DELETE FROM `subscription_plans`;
INSERT INTO `subscription_plans` (`id`, `name`, `slug`, `description`, `price`, `billing_cycle`, `duration_days`, `max_circles`, `max_members`, `features`, `is_active`, `sort_order`, `is_featured`, `created_at`, `updated_at`) VALUES
	(1, 'Starter', 'starter', 'Perfect for small savings groups just getting started. Manage one circle with up to 15 members.', 150.00, 'monthly', 30, 1, 15, '["Share declarations & tracking", "Basic loan management", "Payment uploads", "Monthly reports"]', 1, 1, 0, '2026-04-03 18:41:36', '2026-04-03 18:41:36'),
	(2, 'Growth', 'growth', 'For growing village banks with multiple circles. Full financial management and reporting.', 350.00, 'monthly', 30, 5, 50, '["Everything in Starter", "Up to 5 circles", "Insurance management", "Loan pairing & approvals", "Shareout calculations", "Rules & bylaws module", "Polls & voting", "Export reports (PDF/Excel)"]', 1, 2, 1, '2026-04-03 18:41:36', '2026-04-03 18:41:36'),
	(3, 'Community', 'community', 'Unlimited circles and members. Full platform access for large community banking operations.', 750.00, 'monthly', 30, NULL, NULL, '["Everything in Growth", "Unlimited circles", "Unlimited members", "Priority support", "Custom branding", "Advanced analytics", "Multi-admin management"]', 1, 3, 0, '2026-04-03 18:41:36', '2026-04-03 18:41:36'),
	(4, 'Starter Annual', 'starter-annual', 'Starter plan billed annually — save 2 months!', 1500.00, 'yearly', 365, 1, 15, '["Share declarations & tracking", "Basic loan management", "Payment uploads", "Monthly reports", "2 months free (annual billing)"]', 1, 4, 0, '2026-04-03 18:41:36', '2026-04-03 18:41:36'),
	(5, 'Growth Annual', 'growth-annual', 'Growth plan billed annually — save 2 months!', 3500.00, 'yearly', 365, 5, 50, '["Everything in Starter", "Up to 5 circles", "Insurance management", "Loan pairing & approvals", "Shareout calculations", "Rules & bylaws module", "Polls & voting", "Export reports (PDF/Excel)", "2 months free (annual billing)"]', 1, 5, 0, '2026-04-03 18:41:36', '2026-04-03 18:41:36'),
	(6, 'Community Annual', 'community-annual', 'Community plan billed annually — save 2 months!', 7500.00, 'yearly', 365, NULL, NULL, '["Everything in Growth", "Unlimited circles", "Unlimited members", "Priority support", "Custom branding", "Advanced analytics", "Multi-admin management", "2 months free (annual billing)"]', 1, 6, 0, '2026-04-03 18:41:36', '2026-04-03 18:41:36');

-- Dumping structure for table ziko_village_bank_management_system.training_applications
DROP TABLE IF EXISTS `training_applications`;
CREATE TABLE IF NOT EXISTS `training_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `training_program_id` bigint unsigned NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village_bank` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_in_bank` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motivation` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `training_applications_training_program_id_foreign` (`training_program_id`),
  CONSTRAINT `training_applications_training_program_id_foreign` FOREIGN KEY (`training_program_id`) REFERENCES `training_programs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.training_applications: ~0 rows (approximately)
DELETE FROM `training_applications`;

-- Dumping structure for table ziko_village_bank_management_system.training_programs
DROP TABLE IF EXISTS `training_programs`;
CREATE TABLE IF NOT EXISTS `training_programs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `trainer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` decimal(12,2) NOT NULL DEFAULT '0.00',
  `max_participants` int unsigned DEFAULT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published','closed','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.training_programs: ~0 rows (approximately)
DELETE FROM `training_programs`;

-- Dumping structure for table ziko_village_bank_management_system.transactions
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `loan_id` bigint unsigned DEFAULT NULL,
  `month_id` bigint unsigned DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method_id` bigint unsigned NOT NULL,
  `proof_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','confirmed','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_sender_id_foreign` (`sender_id`),
  KEY `transactions_receiver_id_foreign` (`receiver_id`),
  KEY `transactions_loan_id_foreign` (`loan_id`),
  KEY `transactions_month_id_foreign` (`month_id`),
  KEY `transactions_payment_method_id_foreign` (`payment_method_id`),
  CONSTRAINT `transactions_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `transactions_month_id_foreign` FOREIGN KEY (`month_id`) REFERENCES `months` (`id`) ON DELETE SET NULL,
  CONSTRAINT `transactions_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  CONSTRAINT `transactions_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`),
  CONSTRAINT `transactions_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.transactions: ~0 rows (approximately)
DELETE FROM `transactions`;

-- Dumping structure for table ziko_village_bank_management_system.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `directorate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` int DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guarantor_id` bigint unsigned DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_address` text COLLATE utf8mb4_unicode_ci,
  `nok_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nok_relationship` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nok_contact` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nok_address` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','active','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `total_login` int unsigned NOT NULL DEFAULT '0',
  `nrc_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_guarantor_id_foreign` (`guarantor_id`),
  CONSTRAINT `users_guarantor_id_foreign` FOREIGN KEY (`guarantor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.users: ~51 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `username`, `job_title`, `user_unit`, `directorate`, `mobile_no`, `user_role_id`, `email`, `avatar`, `email_verified_at`, `password`, `usertype`, `remember_token`, `current_session_id`, `created_at`, `updated_at`, `guarantor_id`, `phone`, `employment_status`, `company_name`, `company_location`, `date_of_birth`, `gender`, `national_id`, `country`, `province`, `city`, `home_address`, `nok_name`, `nok_relationship`, `nok_contact`, `nok_address`, `status`, `deleted_at`, `total_login`, `nrc_photo`, `passport_photo`) VALUES
	(1, 'Ndinecom Admin', 'NDC-001', 'Platform Administrator', 'Technology', 'Ndinecom', '+260977000001', '1', 'admin@ndinecom.com', NULL, '2026-04-03 18:41:36', '$2y$10$rnUjWVYYafauX6y9.wYzOOJONyWcQBUCkfFvhu9gC9aFVj9BdsGsa', 1, 'anfC3WnvwCwH2HNgWQ2yvQlXwjV90fXtGcxnU4hou4H7fuBy1ApWGZc2st3L', 'MVSMtNAZf2fKkbXaHiUlCPttOThvQJJaDPG5LQEB', '2026-04-03 18:41:36', '2026-04-10 07:52:32', NULL, '+260211000001', NULL, 'Technology', 'Ndinecom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 5, NULL, NULL),
	(2, 'Grace Mwanza', 'VB-001', 'Chairperson', 'Village Banking', 'Lusaka Community Savings', '+260977200001', '2', 'grace@demo.com', NULL, '2026-04-03 18:41:37', '$2y$10$bBec9sqVhneaAGvYkU3fwe7uDhiaffg1v/mJVuPwbpdsg9Oc3LYo.', 2, 'RDRJDgM4D0rlxE6SE8FZprkIPqTVvAvAlziMWm7bGjA3R8X7nEDgf8z71R5f', 'cjZtHTzirbzajMz9vrax4ZyE4W9R4nTg5CEcLwaX', '2026-04-03 18:41:37', '2026-04-07 13:45:24', NULL, NULL, NULL, 'Village Banking', 'Lusaka Community Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 1, NULL, NULL),
	(3, 'Joseph Banda', 'VB-002', 'Secretary', 'Village Banking', 'Lusaka Community Savings', '+260977200002', '2', 'joseph@demo.com', NULL, '2026-04-03 18:41:37', '$2y$10$OO.ai6sl75SLWx1sL4/OA.7TGgKbaK00QvV6mY.9LUjXz3Q2Fo7K2', 2, NULL, NULL, '2026-04-03 18:41:37', '2026-04-03 18:41:37', NULL, NULL, NULL, 'Village Banking', 'Lusaka Community Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(4, 'Mary Phiri', 'VB-003', 'Treasurer', 'Village Banking', 'Lusaka Community Savings', '+260977200003', '2', 'mary@demo.com', NULL, '2026-04-03 18:41:37', '$2y$10$OO.ai6sl75SLWx1sL4/OA.7TGgKbaK00QvV6mY.9LUjXz3Q2Fo7K2', 2, NULL, NULL, '2026-04-03 18:41:37', '2026-04-03 18:41:37', NULL, NULL, NULL, 'Village Banking', 'Lusaka Community Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(5, 'Peter Tembo', 'VB-004', 'Committee Member', 'Village Banking', 'Lusaka Community Savings', '+260977200004', '2', 'peter@demo.com', NULL, '2026-04-03 18:41:37', '$2y$10$OO.ai6sl75SLWx1sL4/OA.7TGgKbaK00QvV6mY.9LUjXz3Q2Fo7K2', 2, NULL, NULL, '2026-04-03 18:41:37', '2026-04-03 18:41:37', NULL, NULL, NULL, 'Village Banking', 'Lusaka Community Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(6, 'Charity Zulu', 'VB-005', 'Member', 'Village Banking', 'Lusaka Community Savings', '+260977200005', '2', 'charity@demo.com', NULL, '2026-04-03 18:41:37', '$2y$10$OO.ai6sl75SLWx1sL4/OA.7TGgKbaK00QvV6mY.9LUjXz3Q2Fo7K2', 2, NULL, NULL, '2026-04-03 18:41:37', '2026-04-03 18:41:37', NULL, NULL, NULL, 'Village Banking', 'Lusaka Community Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(7, 'Moses Mumba', 'VB-006', 'Member', 'Village Banking', 'Lusaka Community Savings', '+260977200006', '2', 'moses@demo.com', NULL, '2026-04-03 18:41:37', '$2y$10$OO.ai6sl75SLWx1sL4/OA.7TGgKbaK00QvV6mY.9LUjXz3Q2Fo7K2', 2, NULL, NULL, '2026-04-03 18:41:37', '2026-04-03 18:41:37', NULL, NULL, NULL, 'Village Banking', 'Lusaka Community Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(8, 'Esther Chilufya', 'VB-007', 'Member', 'Village Banking', 'Lusaka Community Savings', '+260977200007', '2', 'esther@demo.com', NULL, '2026-04-03 18:41:37', '$2y$10$mTvPXitTfW6JI6t1Rj67YOxCGmHMqGx34PI4Ib1XTCJ9Q3XI37qWa', 2, 'UmUTYXvrikw1BsGZcAB52eEX73XVeAR5Qw6NPYrF9M89Nr9qlTgl6BC6rw7u', 'fOWy6ZutPJ4HjD3nf5lR3E4O2lTtNtGR52IvHbKA', '2026-04-03 18:41:37', '2026-04-06 08:23:56', NULL, NULL, NULL, 'Village Banking', 'Lusaka Community Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 1, NULL, NULL),
	(9, 'David Mulenga', 'VB-008', 'Member', 'Village Banking', 'Lusaka Community Savings', '+260977200008', '2', 'david@demo.com', NULL, '2026-04-03 18:41:37', '$2y$10$OO.ai6sl75SLWx1sL4/OA.7TGgKbaK00QvV6mY.9LUjXz3Q2Fo7K2', 2, NULL, NULL, '2026-04-03 18:41:37', '2026-04-03 18:41:37', NULL, NULL, NULL, 'Village Banking', 'Lusaka Community Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(10, 'Agnes Chanda', 'VB-009', 'Member', 'Village Banking', 'Lusaka Community Savings', '+260977200009', '2', 'agnes@demo.com', NULL, '2026-04-03 18:41:37', '$2y$10$OO.ai6sl75SLWx1sL4/OA.7TGgKbaK00QvV6mY.9LUjXz3Q2Fo7K2', 2, NULL, NULL, '2026-04-03 18:41:37', '2026-04-03 18:41:37', NULL, NULL, NULL, 'Village Banking', 'Lusaka Community Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(11, 'James Sakala', 'VB-010', 'Member', 'Village Banking', 'Lusaka Community Savings', '+260977200010', '2', 'james@demo.com', NULL, '2026-04-03 18:41:37', '$2y$10$OO.ai6sl75SLWx1sL4/OA.7TGgKbaK00QvV6mY.9LUjXz3Q2Fo7K2', 2, NULL, NULL, '2026-04-03 18:41:37', '2026-04-03 18:41:37', NULL, NULL, NULL, 'Village Banking', 'Lusaka Community Savings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(12, 'Whoopi Prince', 'user1', NULL, NULL, NULL, NULL, NULL, 'user1@gmail.com', NULL, NULL, '$2y$10$Cn7I97aduO78HIkczJZRLOiJv0LFofqwC9k4ik622RG8zlrsvni.2', NULL, NULL, NULL, '2026-04-06 17:42:13', '2026-04-06 17:42:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, 0, NULL, NULL),
	(13, 'InfraCash Admin', 'infracash_admin', NULL, NULL, NULL, '0971000000', NULL, 'admin@infracash.test', NULL, NULL, '$2y$10$PEqMb/.q2OVkNcfzwwREj.a.WVoANvHPusdmzH.ubViaAEUyweOfS', 1, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0971000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(14, 'Abigail Mundia', 'abigail.mundia', NULL, NULL, NULL, '0970000001', NULL, 'abigail.mundia@infracash.test', NULL, NULL, '$2y$10$VJybH0nlOsmQNrIbQaWNA.kZ3OOi2cTamIAXtfr0cRRuk1d4JC5di', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(15, 'Abel Kunda', 'abel.kunda', NULL, NULL, NULL, '0970000002', NULL, 'abel.kunda@infracash.test', NULL, NULL, '$2y$10$nYp9U9.YtW6rnPlxyZSfhuIcnDfCbqcSyZCceCE2dT73u/KCMYDYC', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(16, 'Andrew Chola', 'andrew.chola', NULL, NULL, NULL, '0970000003', NULL, 'andrew.chola@infracash.test', NULL, NULL, '$2y$10$W2XJZUq7kHjp1qQwnz4xl.oGbiMCNyB8mmw7fWVOs6IjMb06s1gYS', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(17, 'Arthur Mbewe', 'arthur.mbewe', NULL, NULL, NULL, '0970000004', NULL, 'arthur.mbewe@infracash.test', NULL, NULL, '$2y$10$WNLbctErIjREg073iFnXpuv0CuxXasdSfpQUAEd1Mo5/i8JkDr8Hu', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(18, 'Evans Banda', 'evans.banda', NULL, NULL, NULL, '0970000005', NULL, 'evans.banda@infracash.test', NULL, NULL, '$2y$10$Tbd/2yzMoCEgFo3G0RIdg.45JwZ.D23doezHdxDIw0n8cHRFf8VDK', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(19, 'Jesper Lungu', 'jesper.lungu', NULL, NULL, NULL, '0970000006', NULL, 'jesper.lungu@infracash.test', NULL, NULL, '$2y$10$Dys8ANyp7V6DLJnhHrkDPuCEZmLBe7aE/egkI/exrYi4ofP2VXp3y', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(20, 'Joshua Tembo', 'joshua.tembo', NULL, NULL, NULL, '0970000007', NULL, 'joshua.tembo@infracash.test', NULL, NULL, '$2y$10$bGAQxGl/EzDuqBChHxB4BOapc2hu1ReB.F8gE2o7Gr5voGrg6Ebmq', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000007', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(21, 'Kampamba Mwale', 'kampamba.mwale', NULL, NULL, NULL, '0970000008', NULL, 'kampamba.mwale@infracash.test', NULL, NULL, '$2y$10$Mc6RSCBa0.6Dq6FpKQy/veDu.dvO5Ab1mqiW9ut6jODZSvh8v8Iee', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(22, 'Karen Mwinga', 'karen.mwinga', NULL, NULL, NULL, '0970000009', NULL, 'karen.mwinga@infracash.test', NULL, NULL, '$2y$10$le3zMldo00IxtNKeFeSxkea6g7ftLCPuin3mKcIYi9sR3tADnc.Lq', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(23, 'Keji Phiri', 'keji.phiri', NULL, NULL, NULL, '0970000010', NULL, 'keji.phiri@infracash.test', NULL, NULL, '$2y$10$lmjGDo.S6oT2IN0jzxC2hOnbNmtsq8B914u26RYPt9RuGcktQFE62', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(24, 'Kombe Musonda', 'kombe.musonda', NULL, NULL, NULL, '0970000011', NULL, 'kombe.musonda@infracash.test', NULL, NULL, '$2y$10$kd/1l46s9jxjjO2e2LScqeQ95LykaZEMuLWH5.zi4j.ACcg2U1FtW', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(25, 'Khucwayo Mulenga', 'khucwayo.mulenga', NULL, NULL, NULL, '0970000012', NULL, 'khucwayo.mulenga@infracash.test', NULL, NULL, '$2y$10$emZQKNX0A2znG/pqIRH3les/BnGY92QTjwGeZ.wUALspgqR0q7Xx2', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(26, 'Kwibisa Kalumba', 'kwibisa.kalumba', NULL, NULL, NULL, '0970000013', NULL, 'kwibisa.kalumba@infracash.test', NULL, NULL, '$2y$10$v.Z9SjssRlBaNsV7EG0Lh.q7bwgT.g3kmkjluIO1F3XgodViUS8em', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000013', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(27, 'Michael Zulu', 'michael.zulu', NULL, NULL, NULL, '0970000014', NULL, 'michael.zulu@infracash.test', NULL, NULL, '$2y$10$QTgp.7MPfqZjkfKcbqDb9OklpiOylGVRzv59HR460p/mlS1cmTOg6', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000014', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(28, 'Millie Bwalya', 'millie.bwalya', NULL, NULL, NULL, '0970000015', NULL, 'millie.bwalya@infracash.test', NULL, NULL, '$2y$10$BkCF0MssoWfSuWGFNFqGsuBu/etezijeIZuUfJhi0G5RySlVZDz2O', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000015', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(29, 'Mukuma Chilufya', 'mukuma.chilufya', NULL, NULL, NULL, '0970000016', NULL, 'mukuma.chilufya@infracash.test', NULL, NULL, '$2y$10$pOJu9xPk9YiWC5htvbiGpOi36T7BTySmC6U5nVWGNnamfTTeKWSca', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(30, 'Mumba Kapasa', 'mumba.kapasa', NULL, NULL, NULL, '0970000017', NULL, 'mumba.kapasa@infracash.test', NULL, NULL, '$2y$10$tK9cptiRqXwys5eEjPjFIOiPKALVCO57t.raPr7l0KVk2mEcxJQ9m', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000017', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(31, 'Mumbi Chanda', 'mumbi.chanda', NULL, NULL, NULL, '0970000018', NULL, 'mumbi.chanda@infracash.test', NULL, NULL, '$2y$10$2VrZOnfKbNjrvSZM6XGP4.NS1nbr53OitdNktCOScLR5EDoD074Sm', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(32, 'Mwenya Sakala', 'mwenya.sakala', NULL, NULL, NULL, '0970000019', NULL, 'mwenya.sakala@infracash.test', NULL, NULL, '$2y$10$pjUqk6EtvlsgcNbx.oJOguvaq5x/bezSOBChSAsTOXVFogsTBIBkq', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(33, 'Nyanyiwe Tembo', 'nyanyiwe.tembo', NULL, NULL, NULL, '0970000020', NULL, 'nyanyiwe.tembo@infracash.test', NULL, NULL, '$2y$10$yQ70HSX6erZE5utiRI4rBu2sSEckERhxi3gzXtLYnUYKXbb5vkozK', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(34, 'Pamela Mwansa', 'pamela.mwansa', NULL, NULL, NULL, '0970000021', NULL, 'pamela.mwansa@infracash.test', NULL, NULL, '$2y$10$50b5gaSyuddZhKhyrK08ge49QPC9Jm99nmgGGF6bPr3zUFuth.KIi', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(35, 'Schuller Katongo', 'schuller.katongo', NULL, NULL, NULL, '0970000022', NULL, 'schuller.katongo@infracash.test', NULL, NULL, '$2y$10$TIe0es2eDE8Fe.gG3OTLJOl7Z/J3wQw11MxmqkBQdQ4A1HtLn38fG', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000022', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(36, 'Shubart Nyimbili', 'shubart.nyimbili', NULL, NULL, NULL, '0970000023', NULL, 'shubart.nyimbili@infracash.test', NULL, NULL, '$2y$10$YoLYMnbkUYutOa9R7BLEAO4t.S8vQUF/nelzxJw4mMwMkSH42Y8.u', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000023', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(37, 'Solomon Banda', 'solomon.banda', NULL, NULL, NULL, '0970000024', NULL, 'solomon.banda@infracash.test', NULL, NULL, '$2y$10$/TF7MAnKdt3PygzHDWFK4OSlKPq.Cw5NHRJ1nKX/NUzJXzi97Nr.u', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(38, 'Tumelo Ngosa', 'tumelo.ngosa', NULL, NULL, NULL, '0970000025', NULL, 'tumelo.ngosa@infracash.test', NULL, NULL, '$2y$10$LYCs8e5zyc.ux/geSYZ1EOpWqAJy5MamygSZNJnIZxc7///c/OKVu', 2, NULL, NULL, '2026-04-09 18:37:56', '2026-04-09 18:37:56', NULL, '0970000025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(39, 'VBank25 Admin', 'vbank25_admin', NULL, NULL, NULL, '0972000000', NULL, 'admin@vbank25.test', NULL, NULL, '$2y$10$sfwVv3gxqo7dShv0F4d2i.heB9KUgiyawmhWDlYBmWo4GzErnS.3e', 1, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0972000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(40, 'Shubart Nyimbili', 'vb_shubart.nyimbili', NULL, NULL, NULL, '0979780593', NULL, 'shubart.nyimbili@vbank25.test', NULL, NULL, '$2y$10$7U1C95La/EUpmjDfCZL/qO85hOOXkwbGsbtPFsdc8W0zYCVdU6qY2', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0979780593', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(41, 'Peter Njovu', 'vb_peter.njovu', NULL, NULL, NULL, '0978958789', NULL, 'peter.njovu@vbank25.test', NULL, NULL, '$2y$10$n5UPON9ub2MSOm4MIAV3seiPOALUQ9RxknTH7b/e1owahcHaRIOo6', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0978958789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(42, 'Jailos Daka', 'vb_jailos.daka', NULL, NULL, NULL, '0973097114', NULL, 'jailos.daka@vbank25.test', NULL, NULL, '$2y$10$wYCv2xa1xoi7j3TToHTe8OXMWa9h.sJJLcKiDXfkmmLiX.O1yaXxa', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0973097114', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(43, 'Gabriel Nyimbili', 'vb_gabriel.nyimbili', NULL, NULL, NULL, '0974498509', NULL, 'gabriel.nyimbili@vbank25.test', NULL, NULL, '$2y$10$aNT4pVqzcgNUXI.6lMPYjOp1yB/ujD085PAj1ahI8ir87RApfrRrW', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0974498509', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(44, 'Daniel Banda', 'vb_daniel.banda', NULL, NULL, NULL, '0978647507', NULL, 'daniel.banda@vbank25.test', NULL, NULL, '$2y$10$YtnyUkfRGaEGbk/LasdiLudZHAeOjJdxwJPX7ZQkB/fDJgIstsGxC', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0978647507', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(45, 'Faides Nyimbili', 'vb_faides.nyimbili', NULL, NULL, NULL, '0971817434', NULL, 'faides.nyimbili@vbank25.test', NULL, NULL, '$2y$10$pVcWdtG3Abfb.yrQ.nlxBux7Uv6zuvHvzciCQQefjdwxtc7aLFWda', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0971817434', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(46, 'Clera Mashonga', 'vb_clera.mashonga', NULL, NULL, NULL, '0977516128', NULL, 'clera.mashonga@vbank25.test', NULL, NULL, '$2y$10$r/r4rsFrf.rGnvxbGYkhKedr2UFCdOApkzkI48.eVSatN2J8Uu03u', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0977516128', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(47, 'Maureen Daka', 'vb_maureen.daka', NULL, NULL, NULL, '0976663626', NULL, 'maureen.daka@vbank25.test', NULL, NULL, '$2y$10$4t2zs.59K7XdXjcw3vzfx.gv82GIj75TXGQodI.bfzEN4A76iyBK2', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0976663626', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(48, 'Lesa Chisanga', 'vb_lesa.chisanga', NULL, NULL, NULL, '0973274443', NULL, 'lesa.chisanga@vbank25.test', NULL, NULL, '$2y$10$4csqrIjJW0TRkmLeTtTkz.k0LIccGhSDPvA0jaxAqGWdvOnF0vvzC', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0973274443', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(49, 'Michelle Nangandu', 'vb_michelle.nangandu', NULL, NULL, NULL, '0971585569', NULL, 'michelle.nangandu@vbank25.test', NULL, NULL, '$2y$10$k5cA4MWiFp/HlzEg8nQKMuubJ3vo5AWrcoGUaiPo7cljr4m5.kOam', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0971585569', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(50, 'Rosemary Kalikoga', 'vb_rosemary.kalikoga', NULL, NULL, NULL, '0773472923', NULL, 'rosemary.kalikoga@vbank25.test', NULL, NULL, '$2y$10$BNWfmTuPhvzb2HfQWCeYD.tK.eDlJdbL6.c8dRoMg8tNDF8iuXds6', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0773472923', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL),
	(51, 'Osward Mwansa', 'vb_osward.mwansa', NULL, NULL, NULL, '0976941466', NULL, 'osward.mwansa@vbank25.test', NULL, NULL, '$2y$10$ORB4Ho65aUNKIx.IZc.H9u3Jj86jCf58TYIn/b5hsNIjBvs1uAHtu', 2, NULL, NULL, '2026-04-09 18:38:02', '2026-04-09 18:38:02', NULL, '0976941466', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, 0, NULL, NULL);

-- Dumping structure for table ziko_village_bank_management_system.user_payment_methods
DROP TABLE IF EXISTS `user_payment_methods`;
CREATE TABLE IF NOT EXISTS `user_payment_methods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bank',
  `label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ZMW',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_payment_methods_user_id_type_index` (`user_id`,`type`),
  KEY `user_payment_methods_user_id_is_primary_index` (`user_id`,`is_primary`),
  CONSTRAINT `user_payment_methods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.user_payment_methods: ~0 rows (approximately)
DELETE FROM `user_payment_methods`;

-- Dumping structure for table ziko_village_bank_management_system.village_banks
DROP TABLE IF EXISTS `village_banks`;
CREATE TABLE IF NOT EXISTS `village_banks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `village_banks_code_unique` (`code`),
  KEY `village_banks_created_by_foreign` (`created_by`),
  CONSTRAINT `village_banks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.village_banks: ~3 rows (approximately)
DELETE FROM `village_banks`;
INSERT INTO `village_banks` (`id`, `name`, `code`, `description`, `logo`, `address`, `phone`, `email`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
	(1, 'Lusaka Community Savings', 'DEMO-VB-001', 'A demo village bank for testing the platform. Based in Lusaka.', NULL, 'Plot 123, Great East Road, Lusaka', '+260977100001', 'lusaka.savings@demo.com', 'active', 1, '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(2, 'InfraCash 2025', 'INFRA2025', 'InfraCash Village Bank — November 2024 to October 2025 cycle. 25 members. Share unit K200, 5% monthly compound interest.', NULL, NULL, NULL, NULL, 'active', 13, '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(3, 'Village Bank 2025/2026', 'VBANK2526', 'Village Bank — February 2025 to January 2026 cycle. 12 members. Share unit K200, insurance K100, 5% monthly compound interest, 10% service fee on loans.', NULL, NULL, NULL, NULL, 'active', 39, '2026-04-09 18:38:02', '2026-04-09 18:38:02');

-- Dumping structure for table ziko_village_bank_management_system.village_bank_accounts
DROP TABLE IF EXISTS `village_bank_accounts`;
CREATE TABLE IF NOT EXISTS `village_bank_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `village_bank_id` bigint unsigned NOT NULL,
  `account_type` enum('bank_account','mobile_money') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mobile_money',
  `provider_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `village_bank_accounts_village_bank_id_foreign` (`village_bank_id`),
  CONSTRAINT `village_bank_accounts_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.village_bank_accounts: ~0 rows (approximately)
DELETE FROM `village_bank_accounts`;

-- Dumping structure for table ziko_village_bank_management_system.village_bank_configurations
DROP TABLE IF EXISTS `village_bank_configurations`;
CREATE TABLE IF NOT EXISTS `village_bank_configurations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `village_bank_id` bigint unsigned NOT NULL,
  `circle_duration_months` smallint unsigned NOT NULL DEFAULT '12',
  `share_unit_amount` decimal(12,2) NOT NULL DEFAULT '200.00',
  `min_shares_per_month` int unsigned NOT NULL DEFAULT '1',
  `max_shares_per_month` int unsigned NOT NULL DEFAULT '50',
  `insurance_type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `insurance_value` decimal(12,2) NOT NULL DEFAULT '0.00',
  `insurance_profit_to_members` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'false = insurance profit goes to social fund',
  `max_loan_multiplier` int unsigned NOT NULL DEFAULT '3',
  `default_interest_rate` decimal(5,2) NOT NULL DEFAULT '20.00',
  `interest_type` enum('flat','reducing_balance') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'flat',
  `reducing_balance_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `default_loan_duration` int unsigned NOT NULL DEFAULT '1',
  `allow_multiple_active_loans` tinyint(1) NOT NULL DEFAULT '0',
  `min_loan_amount` decimal(12,2) DEFAULT NULL,
  `max_loan_amount` decimal(12,2) DEFAULT NULL,
  `late_repayment_penalty_rate` decimal(5,2) NOT NULL DEFAULT '5.00',
  `grace_period_days` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `village_bank_configurations_village_bank_id_unique` (`village_bank_id`),
  CONSTRAINT `village_bank_configurations_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.village_bank_configurations: ~3 rows (approximately)
DELETE FROM `village_bank_configurations`;
INSERT INTO `village_bank_configurations` (`id`, `village_bank_id`, `circle_duration_months`, `share_unit_amount`, `min_shares_per_month`, `max_shares_per_month`, `insurance_type`, `insurance_value`, `insurance_profit_to_members`, `max_loan_multiplier`, `default_interest_rate`, `interest_type`, `reducing_balance_rate`, `default_loan_duration`, `allow_multiple_active_loans`, `min_loan_amount`, `max_loan_amount`, `late_repayment_penalty_rate`, `grace_period_days`, `created_at`, `updated_at`) VALUES
	(1, 1, 12, 200.00, 1, 200, 'fixed', 100.00, 1, 3, 10.00, 'reducing_balance', 5.00, 1, 1, NULL, NULL, 5.00, 0, '2026-04-06 08:24:04', '2026-04-06 08:26:05'),
	(2, 2, 12, 200.00, 1, 100, 'fixed', 200.00, 1, 3, 10.00, 'reducing_balance', 5.00, 1, 0, NULL, NULL, 5.00, 0, '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(3, 3, 12, 200.00, 1, 50, 'fixed', 100.00, 1, 3, 10.00, 'reducing_balance', 5.00, 1, 0, NULL, NULL, 5.00, 0, '2026-04-09 18:38:02', '2026-04-09 18:38:02');

-- Dumping structure for table ziko_village_bank_management_system.village_bank_join_requests
DROP TABLE IF EXISTS `village_bank_join_requests`;
CREATE TABLE IF NOT EXISTS `village_bank_join_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `village_bank_id` bigint unsigned NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `guarantor_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_id` bigint unsigned DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `admin_remarks` text COLLATE utf8mb4_unicode_ci,
  `reviewed_by` bigint unsigned DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pending_request` (`user_id`,`village_bank_id`,`status`),
  KEY `village_bank_join_requests_village_bank_id_foreign` (`village_bank_id`),
  KEY `village_bank_join_requests_guarantor_id_foreign` (`guarantor_id`),
  KEY `village_bank_join_requests_reviewed_by_foreign` (`reviewed_by`),
  CONSTRAINT `village_bank_join_requests_guarantor_id_foreign` FOREIGN KEY (`guarantor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `village_bank_join_requests_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `village_bank_join_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `village_bank_join_requests_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.village_bank_join_requests: ~1 rows (approximately)
DELETE FROM `village_bank_join_requests`;
INSERT INTO `village_bank_join_requests` (`id`, `user_id`, `village_bank_id`, `status`, `guarantor_username`, `guarantor_id`, `message`, `admin_remarks`, `reviewed_by`, `reviewed_at`, `created_at`, `updated_at`) VALUES
	(1, 12, 1, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 18:12:51', '2026-04-06 18:12:51');

-- Dumping structure for table ziko_village_bank_management_system.village_bank_members
DROP TABLE IF EXISTS `village_bank_members`;
CREATE TABLE IF NOT EXISTS `village_bank_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `village_bank_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `role` enum('admin','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `joined_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `village_bank_members_village_bank_id_user_id_unique` (`village_bank_id`,`user_id`),
  KEY `village_bank_members_user_id_foreign` (`user_id`),
  CONSTRAINT `village_bank_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `village_bank_members_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.village_bank_members: ~49 rows (approximately)
DELETE FROM `village_bank_members`;
INSERT INTO `village_bank_members` (`id`, `village_bank_id`, `user_id`, `role`, `joined_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 'admin', '2026-04-03 18:41:37', '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(2, 1, 3, 'admin', '2026-04-03 18:41:37', '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(3, 1, 4, 'admin', '2026-04-03 18:41:37', '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(4, 1, 5, 'member', '2026-04-03 18:41:37', '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(5, 1, 6, 'member', '2026-04-03 18:41:37', '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(6, 1, 7, 'member', '2026-04-03 18:41:37', '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(7, 1, 8, 'member', '2026-04-03 18:41:37', '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(8, 1, 9, 'member', '2026-04-03 18:41:37', '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(9, 1, 10, 'member', '2026-04-03 18:41:37', '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(10, 1, 11, 'member', '2026-04-03 18:41:37', '2026-04-03 18:41:37', '2026-04-03 18:41:37'),
	(11, 2, 13, 'admin', '2024-10-14 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(12, 2, 14, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(13, 2, 15, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(14, 2, 16, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(15, 2, 17, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(16, 2, 18, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(17, 2, 19, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(18, 2, 20, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(19, 2, 21, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(20, 2, 22, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(21, 2, 23, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(22, 2, 24, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(23, 2, 25, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(24, 2, 26, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(25, 2, 27, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(26, 2, 28, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(27, 2, 29, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(28, 2, 30, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(29, 2, 31, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(30, 2, 32, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(31, 2, 33, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(32, 2, 34, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(33, 2, 35, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(34, 2, 36, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(35, 2, 37, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(36, 2, 38, 'member', '2024-10-19 22:00:00', '2026-04-09 18:37:56', '2026-04-09 18:37:56'),
	(37, 3, 39, 'admin', '2025-01-14 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(38, 3, 40, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(39, 3, 41, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(40, 3, 42, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(41, 3, 43, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(42, 3, 44, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(43, 3, 45, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(44, 3, 46, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(45, 3, 47, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(46, 3, 48, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(47, 3, 49, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(48, 3, 50, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02'),
	(49, 3, 51, 'member', '2025-01-19 22:00:00', '2026-04-09 18:38:02', '2026-04-09 18:38:02');

-- Dumping structure for table ziko_village_bank_management_system.village_bank_month_configs
DROP TABLE IF EXISTS `village_bank_month_configs`;
CREATE TABLE IF NOT EXISTS `village_bank_month_configs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `village_bank_id` bigint unsigned NOT NULL,
  `month_number` smallint unsigned NOT NULL,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_share_declarations` tinyint(1) NOT NULL DEFAULT '1',
  `allow_insurance_declarations` tinyint(1) NOT NULL DEFAULT '1',
  `allow_loan_requests` tinyint(1) NOT NULL DEFAULT '1',
  `allow_loan_repayments` tinyint(1) NOT NULL DEFAULT '1',
  `is_shareout_month` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vb_month_cfg_unique` (`village_bank_id`,`month_number`),
  CONSTRAINT `village_bank_month_configs_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.village_bank_month_configs: ~36 rows (approximately)
DELETE FROM `village_bank_month_configs`;
INSERT INTO `village_bank_month_configs` (`id`, `village_bank_id`, `month_number`, `label`, `allow_share_declarations`, `allow_insurance_declarations`, `allow_loan_requests`, `allow_loan_repayments`, `is_shareout_month`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Month 1', 1, 1, 1, 1, 0, '2026-04-06 08:24:04', '2026-04-06 08:26:56'),
	(2, 1, 2, 'Month 2', 1, 1, 1, 1, 0, '2026-04-06 08:24:04', '2026-04-06 08:26:56'),
	(3, 1, 3, 'Month 3', 1, 1, 1, 1, 0, '2026-04-06 08:24:04', '2026-04-06 08:26:56'),
	(4, 1, 4, 'Month 4', 1, 1, 1, 1, 0, '2026-04-06 08:24:04', '2026-04-06 08:26:56'),
	(5, 1, 5, 'Month 5', 1, 1, 1, 1, 0, '2026-04-06 08:24:04', '2026-04-06 08:26:56'),
	(6, 1, 6, 'Month 6', 1, 1, 1, 1, 0, '2026-04-06 08:24:05', '2026-04-06 08:26:56'),
	(7, 1, 7, 'Month 7', 1, 1, 1, 1, 0, '2026-04-06 08:24:05', '2026-04-06 08:26:56'),
	(8, 1, 8, 'Month 8', 1, 1, 1, 1, 0, '2026-04-06 08:24:05', '2026-04-06 08:26:56'),
	(9, 1, 9, 'Month 9', 1, 1, 1, 1, 0, '2026-04-06 08:24:05', '2026-04-06 08:26:56'),
	(10, 1, 10, 'Month 10', 1, 1, 1, 1, 0, '2026-04-06 08:24:05', '2026-04-06 08:26:56'),
	(11, 1, 11, 'Month 11', 1, 1, 0, 1, 0, '2026-04-06 08:24:05', '2026-04-06 08:26:56'),
	(12, 1, 12, 'Month 12 – Shareout', 0, 0, 0, 1, 1, '2026-04-06 08:24:05', '2026-04-06 08:26:57'),
	(13, 2, 1, 'Month 1', 1, 1, 1, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(14, 2, 2, 'Month 2', 1, 1, 1, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(15, 2, 3, 'Month 3', 1, 1, 1, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(16, 2, 4, 'Month 4', 1, 1, 1, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(17, 2, 5, 'Month 5', 1, 1, 1, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(18, 2, 6, 'Month 6', 1, 1, 1, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(19, 2, 7, 'Month 7', 1, 1, 1, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(20, 2, 8, 'Month 8', 1, 1, 1, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(21, 2, 9, 'Month 9', 1, 1, 1, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(22, 2, 10, 'Month 10', 1, 1, 1, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(23, 2, 11, 'Month 11', 1, 1, 0, 1, 0, '2026-04-10 03:21:54', '2026-04-10 03:21:54'),
	(24, 2, 12, 'Month 12 – Shareout', 0, 0, 0, 1, 1, '2026-04-10 03:21:55', '2026-04-10 03:21:55'),
	(25, 3, 1, 'Month 1', 1, 1, 1, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(26, 3, 2, 'Month 2', 1, 1, 1, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(27, 3, 3, 'Month 3', 1, 1, 1, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(28, 3, 4, 'Month 4', 1, 1, 1, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(29, 3, 5, 'Month 5', 1, 1, 1, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(30, 3, 6, 'Month 6', 1, 1, 1, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(31, 3, 7, 'Month 7', 1, 1, 1, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(32, 3, 8, 'Month 8', 1, 1, 1, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(33, 3, 9, 'Month 9', 1, 1, 1, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(34, 3, 10, 'Month 10', 1, 1, 1, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(35, 3, 11, 'Month 11', 1, 1, 0, 1, 0, '2026-04-10 03:23:52', '2026-04-10 03:23:52'),
	(36, 3, 12, 'Month 12 – Shareout', 0, 0, 0, 1, 1, '2026-04-10 03:23:52', '2026-04-10 03:23:52');

-- Dumping structure for table ziko_village_bank_management_system.village_bank_rules
DROP TABLE IF EXISTS `village_bank_rules`;
CREATE TABLE IF NOT EXISTS `village_bank_rules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `village_bank_id` bigint unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `village_bank_rules_village_bank_id_foreign` (`village_bank_id`),
  KEY `village_bank_rules_created_by_foreign` (`created_by`),
  CONSTRAINT `village_bank_rules_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `village_bank_rules_village_bank_id_foreign` FOREIGN KEY (`village_bank_id`) REFERENCES `village_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ziko_village_bank_management_system.village_bank_rules: ~0 rows (approximately)
DELETE FROM `village_bank_rules`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
