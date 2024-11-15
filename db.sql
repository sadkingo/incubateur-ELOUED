/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;



CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'days', '5', '2024-05-07 12:18:47', '2024-05-07 12:18:47'),
	(2, 'groups', '8', '2024-05-07 12:18:47', '2024-05-07 12:18:47'),
	(3, 'specialization', 'إعلام', '2024-05-07 12:20:18', '2024-05-07 12:20:18'),
	(4, 'branch', 'الاعلام والاتصال', '2024-05-07 12:20:18', '2024-05-07 12:20:18'),
	(5, 'promotion', 'أفريل 2023', '2024-05-07 12:22:25', '2024-05-07 12:22:25'),
	(6, 'batchs', '3', '2024-05-07 12:22:25', '2024-05-07 12:22:25'),
	(7, 'start_date', '2021', '2024-05-07 12:23:30', '2024-05-07 12:23:30'),
	(8, 'email', 'kaidnews@gmail.com', '2024-05-07 12:23:30', '2024-05-07 12:23:30'),
	(9, 'fax', '032124353', '2024-05-07 12:24:35', '2024-05-07 12:24:35'),
	(10, 'phone', '0770988020', '2024-05-07 12:24:35', '2024-05-07 12:24:35'),
	(11, 'project_count', '2', '2023-11-15 06:39:22', '2024-11-15 06:08:25');

CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','incubateur','cde','cati','superadmin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `admins_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', '0775805470', '2024-05-06 16:01:34', '$2y$10$r.R0DMbk0g7m7tJA2jvzKu0voQ4bB7wKRp0o7pDxLAhRQNrB.aVty', 'admin', NULL, '2024-05-06 16:01:34', '2024-11-07 09:30:47', NULL),
	(6, 'elhareth csdcs', 'admin2@gmail.com', '07777777377', NULL, '$2y$10$wxepcDkF/H5SManQpj6QCexHfjISorAoGRVZSrD19mUJ1xiEMpp9C', 'cde', NULL, '2024-11-02 10:29:05', '2024-11-02 10:34:32', '2024-11-02 10:34:32'),
	(7, 'elhareth csdcs', 'admin3@gmail.com', '0795909128', NULL, '$2y$10$UZxrSGsd9RcDALv4/dXoReIDJFTH7755UaHZbHbA4Kk4SbEI13D1W', 'admin', NULL, '2024-11-07 09:06:31', '2024-11-07 09:06:31', NULL),
	(8, 'elhareth csdcs', 'admin6@gmail.com', '0795909122', NULL, '$2y$10$9W3ABT9SWnWy5QUCMtQ9p.XetQja98CwYLnDm1RADl6gqb/y2e/Ca', 'incubateur', NULL, '2024-11-07 09:11:15', '2024-11-07 09:21:25', '2024-11-07 09:21:25'),
	(9, 'elhareth csdcs', 'admin76@gmail.com', '0795909120', NULL, '$2y$10$mLuWY/FnSGyiU6MhnQQVdO4Q6/HapiIkbUzKRnNBd99H54INyerHq', 'admin', NULL, '2024-11-07 09:30:35', '2024-11-07 09:30:35', NULL);


CREATE TABLE IF NOT EXISTS `commissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `id_project` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `commissions` (`id`, `name_ar`, `name_fr`, `photo`, `status`, `id_project`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'لجنة المشاريع المبتكرة', 'Comité des Projets Innovants', NULL, 1, NULL, '2024-07-16 16:13:28', '2024-07-16 16:13:28', NULL),
	(2, 'اللجنة الخاصة بتقييم أفكار  بالمنصات والتطبيقات', 'com2', NULL, 1, NULL, '2024-07-17 18:44:08', '2024-07-17 18:44:08', NULL),
	(3, 'لجنة تقييم براءات الاختراع', 'com 3', NULL, 1, NULL, '2024-07-24 06:24:09', '2024-07-24 06:24:09', NULL),
	(4, 'elhareth csdcs', 'elhareth csdcs', NULL, 1, NULL, '2024-11-02 14:47:27', '2024-11-02 14:47:33', '2024-11-02 14:47:33'),
	(5, 'Khlafaoui Elhareth', 'Khlafaoui Elhareth', NULL, 1, NULL, '2024-11-07 15:17:18', '2024-11-07 15:17:18', NULL),
	(6, 'Khlafaoui Elhareth', 'Khlafaoui Elhareth', NULL, 1, NULL, '2024-11-07 15:22:04', '2024-11-07 15:22:09', '2024-11-07 15:22:09');


CREATE TABLE IF NOT EXISTS `faculties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faculties` (`id`, `name_ar`, `name_fr`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'كلية التكنولوجيا', 'Faculté de Technologie', '2024-07-02 08:26:38', '2024-07-02 08:26:38', NULL),
	(2, 'كلية علوم الطبيعة و الحياة', 'Faculté des Sciences de la Nature et de la Vie', '2024-07-02 08:26:38', '2024-07-02 08:26:38', NULL),
	(3, 'كلية الآداب و اللغات', 'Faculté des Lettres et des Langues', '2024-07-02 08:26:38', '2024-07-02 08:26:38', NULL),
	(4, 'كلية العلوم الاجتماعية و الانسانية', 'Faculté des Sciences Sociales et Humaines', '2024-07-02 08:26:38', '2024-07-02 08:26:38', NULL),
	(5, 'كلية العلوم الاقتصادية و التجارية و علوم التسيير', 'Faculté des Sciences Économiques, Commerciales et des Sciences de Gestion', '2024-07-02 08:26:38', '2024-07-02 08:26:38', NULL),
	(6, 'كلية الحقوق و العلوم السياسية', 'Faculté de Droit et des Sciences Politiques', '2024-07-02 08:26:38', '2024-07-02 08:26:38', NULL),
	(7, 'كلية العلوم الدقيقة', 'Faculté des Sciences Exactes', '2024-07-02 08:26:38', '2024-07-02 08:26:38', NULL),
	(8, 'معهد العلوم الاسلامية', 'Institut des Sciences Islamiques', '2024-07-02 08:26:38', '2024-07-02 08:26:38', NULL);


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


CREATE TABLE IF NOT EXISTS `managers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `faculty_id` bigint unsigned NOT NULL,
  `firstname_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `managers_phone_unique` (`phone`),
  UNIQUE KEY `managers_email_unique` (`email`),
  KEY `managers_faculty_id_foreign` (`faculty_id`),
  CONSTRAINT `managers_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `managers` (`id`, `faculty_id`, `firstname_ar`, `lastname_ar`, `phone`, `email`, `password`, `created_at`, `updated_at`) VALUES
	(2, 7, 'elhareth', 'csdcs', '079594128', 'manager@gmail.com', '$2y$10$0Kj3ecJtDdWmgX4n7uWe9ut22nSXiBKNl4L6y3y71yFZHVzsTkv2u', '2024-11-01 15:23:53', '2024-11-07 08:40:00'),
	(3, 7, 'elhareth', 'csdcs', '0795909129', 'manager2@gmail.com', '$2y$10$ZkrXgAHwDEwYX4dIhWCLf.kljI5JLC1sJwrsvWi.WHB6lND9UyOyi', '2024-11-07 08:40:26', '2024-11-07 08:40:26'),
	(4, 6, 'elhareth', 'csdcs', '0795909126', 'manager3@gmail.com', '$2y$10$8S7GXsKdmvJ4nv8RJ4aqj.JTvx/G0XsmSnFX1EJAb5u9wQR029Pry', '2024-11-07 09:10:57', '2024-11-07 09:10:57');

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_03_08_162749_create_admins_table', 1),
	(6, '2024_03_09_104138_create_students_table', 1),
	(7, '2024_03_09_214119_create_teachers_table', 1),
	(8, '2024_03_16_141824_create_attendences_table', 1),
	(9, '2024_03_17_133104_create_subjects_table', 1),
	(10, '2024_03_17_141348_create_tests_table', 1),
	(11, '2024_03_20_144700_create_settings_table', 1),
	(12, '2024_03_27_134849_create_certificates_table', 1),
	(13, '2024_04_04_130012_create_evaluations_table', 1),
	(14, '2024_04_04_164008_create_notes_table', 1),
	(15, '2024_05_09_083530_create_student_groupes_table', 2),
	(16, '2024_05_09_083855_create_projects_table', 2),
	(17, '2024_05_09_135000_create_projucts_table', 3),
	(18, '2024_05_10_195155_create_student_groups_table', 4),
	(19, '2024_05_11_132332_add_deleted_at_to_student-groups_table', 5),
	(20, '2024_05_12_081800_create_projects_table', 6),
	(21, '2024_05_12_082020_create_project_images_table', 6),
	(22, '2024_05_12_153845_create_student_groups_table', 7),
	(23, '2024_05_12_161330_create_projects_table', 8),
	(24, '2024_05_12_162210_create_project_images_table', 9),
	(25, '2024_06_08_022238_add_column_to_teachers_table', 10),
	(26, '2024_06_08_025550_create_commissions_table', 11),
	(27, '2024_06_08_040503_add_column_to_teachers_table', 12),
	(28, '2024_06_08_045133_add_column_to_projects_table', 13),
	(29, '2024_06_09_003142_add_column_file_to_projects', 14),
	(30, '2024_06_21_013736_add_column_to_projects_table', 14),
	(31, '2024_06_21_170337_add_columns_to_students_table', 15),
	(32, '2024_06_22_093937_create_supervising_teachers_table', 16),
	(33, '2024_06_22_095051_add_columns_to_supervising_teachers_table', 17),
	(34, '2024_06_22_111325_create_supervising_teacher_projects_table', 18),
	(35, '2024_06_22_112328_drop_columns_to_supervising_teachers_table', 19),
	(36, '2024_06_22_222735_add_deadline_to_projects_table', 20),
	(37, '2024_06_23_105137_drop_deadline_to_projects_table', 21),
	(38, '2024_06_23_105420_add_columns_to_projects_table', 22),
	(39, '2024_06_24_111509_add_project_stage_to_students_table', 23),
	(40, '2024_06_24_114808_drop_project_stage_to_students_table', 24),
	(41, '2024_06_24_114925_add_project_stage_to_students_table', 25),
	(42, '2024_06_24_202026_add_columns_to_student_groups_table', 26),
	(43, '2024_06_26_181218_add_columns_to_projects-table', 27),
	(44, '2024_06_27_234744_add_columns_to_projects-table', 27),
	(45, '2024_06_28_181321_add_columns_to_projects-table', 28),
	(46, '2024_06_29_180429_add_column_to_students-table', 29),
	(47, '2024_06_29_224552_add_column_to_supervising_teachers_table', 30),
	(48, '2024_06_30_000254_add_academic_year_to_projects_table', 31),
	(49, '2024_06_30_130142_add_new_to_projects_table', 32),
	(50, '2024_07_01_235745_create_faculties_table', 33),
	(51, '2024_07_02_090634_add_columns_to_students_table', 34),
	(52, '2024_07_02_090856_add_columns_to_student_groups_table', 35),
	(53, '2024_07_02_092859_create_departements_table', 36),
	(54, '2024_07_02_093545_add_columns_to_departements_table', 37),
	(55, '2024_07_02_105420_drop_columns_to_students_table', 38),
	(56, '2024_07_04_232344_add_column_to_projects', 39),
	(57, '2024_07_06_000022_create_supervisors_table', 39),
	(58, '2024_07_06_105738_drop_supervisors_table', 39),
	(59, '2024_07_07_163223_add_columns_to_students_table', 40),
	(60, '2024_07_07_164936_adrop_column_to_students_table', 41),
	(61, '2024_07_07_165119_drop_faculty_column_to_students_table', 42),
	(62, '2024_07_11_101439_add_columns_to_student_groups_table', 43),
	(63, '2024_07_11_110559_drop_columns_to_student_groups_table', 44),
	(64, '2024_07_11_154308_create_administrative_files_table', 45),
	(65, '2024_07_12_155648_add_status_column_administrative_files_table', 46),
	(66, '2024_07_13_170532_add_role_column_to_admins_table', 47),
	(67, '2024_07_14_001216_add_id_student_group_column_to_certificates_table', 48),
	(68, '2024_10_17_153713_create_managers_table', 49);

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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

CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `faculty_id` bigint unsigned NOT NULL,
  `commission_id` bigint unsigned DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_project` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_classification` tinyint DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bmc_status` tinyint NOT NULL DEFAULT '0',
  `bmc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `administrative_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_tracking` tinyint DEFAULT '0',
  `status_project_tracking` tinyint DEFAULT '0',
  `archived` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` tinyint DEFAULT '1',
  `new` tinyint NOT NULL DEFAULT '1',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `academic_year` year DEFAULT '2024',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commission_id` (`commission_id`),
  KEY `faculty_id` (`faculty_id`),
  CONSTRAINT `commission_id` FOREIGN KEY (`commission_id`) REFERENCES `commissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `key_faculty_id` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `projects` (`id`, `faculty_id`, `commission_id`, `code`, `password`, `name`, `description`, `type_project`, `project_classification`, `video`, `bmc_status`, `bmc`, `administrative_file`, `project_tracking`, `status_project_tracking`, `archived`, `status`, `new`, `start_date`, `end_date`, `academic_year`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 7, 1, NULL, NULL, 'Mon livre', 'Mon Livre est une plateforme innovante de location de livres en ligne qui vise à faciliter l\'accès à une variété de livres pour les lecteurs de tous âges et de tous intérêts. Le site offre une expérience d\'emprunt transparente et pratique, permettant aux utilisateurs de lire des livres sans avoir à les acheter.\r\n\r\nFonctionnalités du site :\r\nLarge gamme de livres :\r\n\r\nMon Livre contient une immense bibliothèque qui comprend des milliers de titres dans divers domaines tels que la littérature, les sciences, l\'histoire, la philosophie, les arts et bien d\'autres catégories. Que vous recherchiez des romans à suspense, des livres pédagogiques ou une biographie inspirante, vous trouverez quelque chose qui correspond à vos intérêts.\r\nInterface utilisateur facile à utiliser :\r\n\r\nLe site présente un design élégant et une interface intuitive, facilitant la recherche et l\'emprunt de livres. Les utilisateurs peuvent parcourir différentes sections ou utiliser la barre de recherche pour accéder rapidement au livre souhaité.\r\nPlans de location flexibles :\r\n\r\nMon Livre propose différentes formules de location pour répondre aux besoins de tous les lecteurs. Vous pouvez choisir un plan de location mensuel ou annuel, ainsi que des options de location à court terme pour des jours spécifiques. Cela vous donne la liberté de louer des livres en fonction de vos besoins personnels et de votre budget.\r\nLivraison et ramassage pratiques :\r\n\r\nLe site propose des services de livraison et de ramassage simples et rapides, garantissant que les livres arrivent à votre porte sans aucun problème. Une fois la période de location terminée, vous pouvez prendre rendez-vous pour recevoir le livre via la plateforme elle-même.\r\nNotes et avis des utilisateurs :\r\n\r\nLe site permet aux utilisateurs d\'évaluer et de rédiger des critiques de livres, ce qui aide les autres lecteurs à prendre des décisions éclairées concernant le choix des livres. Ces notes et avis améliorent l’interaction au sein de la communauté des lecteurs et contribuent à améliorer l’expérience utilisateur.\r\nProgrammes de fidélité et offres spéciales :\r\n\r\nMon Livre récompense ses clients réguliers avec des programmes de fidélité et des offres spéciales. Vous pouvez gagner des points à chaque location et les échanger contre des réductions ou des récompenses exclusives. De plus, le site propose des promotions saisonnières et des réductions sur une sélection de livres.\r\nSupport technique et lecture de conseil :\r\n\r\nLe site offre un excellent support technique pour aider les utilisateurs s\'ils rencontrent des problèmes techniques. Il propose également des consultations de lecture personnalisées aux utilisateurs qui ont besoin de recommandations sur des livres correspondant à leurs intérêts et à leurs besoins.\r\nMon Foie vision :\r\nMon Livre aspire à créer une communauté active de lecteurs qui échangent connaissances et culture à travers l\'emprunt de livres. Le site Web vise à promouvoir l’amour de la lecture et à offrir une alternative économique et durable à l’achat de livres. A travers ses services diversifiés et innovants, Mon Livre se veut le compagnon idéal de chaque lecteur, quel que soit son âge ou ses intérêts.\r\n\r\nEn choisissant Mon Livre, vous rejoignez un mouvement culturel qui favorise l\'échange de connaissances et contribue à bâtir une communauté de lecteurs informés et cultivés. Découvrez l\'univers du livre avec Mon Livre et vivez une expérience de lecture inoubliable.', 'service', 1, 'https://www.youtube.com/watch?v=PNTQlDVcMtk', 0, NULL, NULL, 5, 1, '0', 2, 2, '2024-07-22', '2024-07-23', '2024', '2024-07-16 16:54:24', '2024-11-15 09:37:22', NULL),
	(3, 7, 2, NULL, NULL, 'مشروع منصة2', 'مشروع منصة2مشروع منصة2مشروع منصة2مشروع منصة2مشروع منصة2مشروع منصة2', 'service', 1, 'https://incubateur.hoskadev.com/public/project/create', 0, NULL, NULL, 2, 2, '0', 2, 2, '2024-11-13', '2024-12-13', '2024', '2024-07-22 11:05:37', '2024-11-14 05:15:44', NULL),
	(4, 7, 1, NULL, NULL, 'للللل', 'لللل', 'industrial', 3, 'للل', 0, NULL, NULL, 0, 0, '0', 2, 2, '2024-11-08', '2024-12-08', '2024', '2024-07-22 14:46:22', '2024-11-15 09:37:51', NULL),
	(5, 7, 3, NULL, NULL, 'براءة اختراع', 'براءة اختراع براءة اختراعبراءة اختراعبراءة اختراعبراءة اختراعبراءة اختراعبراءة اختراعبراءة اختراعبراءة اختراعبراءة اختراع', 'industrial', 2, 'incubateur.hoskadev.com/public/project/create', 1, NULL, NULL, 2, 1, '0', 2, 2, '2024-11-13', '2024-12-13', '2024', '2024-07-24 06:22:07', '2024-11-13 06:31:54', NULL),
	(6, 7, 1, NULL, NULL, 'DGFSD', 'l test', 'industrial', 1, 'https://incubateur.hoskadev.com/', 0, NULL, NULL, 0, 2, '0', 0, 2, '2024-11-13', '2024-12-13', '2024', '2024-10-16 08:33:08', '2024-11-13 14:40:50', NULL),
	(7, 7, NULL, NULL, NULL, 'elhareth csdcs', 'sds', NULL, NULL, 'https://www.youtube.com/?app=desktop&hl=ar', 0, NULL, NULL, 0, 0, '0', 1, 1, '2024-11-08', NULL, '2024', '2024-10-18 18:28:02', '2024-11-15 09:37:47', NULL),
	(8, 7, 1, '20231002', '$2y$10$ilABk9mmhjeTvGSWr4PAfegLwYQVEvpHA7iMVvtHsBU8A5NpHWfVG', 'elhareth csdcs', 'https://www.youtube.com/?app=desktop&hl=ar', 'commercial', 1, 'https://www.youtube.com/?app=desktop&hl=ar', 3, NULL, NULL, 3, 2, '0', 2, 2, '2024-11-13', '2024-12-13', '2024', '2024-10-18 18:30:00', '2024-11-15 09:49:45', NULL),
	(9, 7, 1, '2024', '$2y$10$evRyjxJAcbMvr3ptTFf6c.YyV5h2.vyk7r9JJy7oUhEIPsLTfo3MK', 'elhareth csdcs', 'wewe', NULL, 1, NULL, 0, NULL, NULL, 0, 1, '0', 0, 2, '2024-11-13', '2024-12-13', '2024', '2024-11-03 21:43:38', '2024-11-15 09:48:03', NULL),
	(10, 7, 1, '2024', '2024', 'elhareth csdcs', 'gg', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, '0', 1, 1, '2024-11-13', '2024-12-13', '2024', '2024-11-06 09:53:54', '2024-11-13 06:31:54', NULL),
	(11, 7, NULL, '2024', '2024', 'خلفاوي الحارث', 'sdsds', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, '0', 1, 1, '2024-11-13', '2024-12-13', '2024', '2024-11-09 18:20:51', '2024-11-13 06:31:54', NULL),
	(12, 7, NULL, '20241', '2024', 'خلفاوي الحارث', '0795909128', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, '0', 1, 1, '2024-11-13', '2024-12-13', '2024', '2024-11-09 19:07:46', '2024-11-13 06:31:54', NULL),
	(13, 7, NULL, '20241', '2024', 'خلفاوي الحارث', 'kkkk', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, '0', 1, 1, '2024-11-13', '2024-12-13', '2024', '2024-11-09 19:11:11', '2024-11-13 06:31:54', NULL),
	(14, 7, NULL, '20241010', '20241010', 'خلفاوي الحارث', 'mmm', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, '0', 1, 1, '2024-11-13', '2024-12-13', '2024', '2024-11-09 19:18:13', '2024-11-13 06:31:54', NULL),
	(15, 7, NULL, '20241015', '$10$evRyjxJAcbMvr3ptTFf6c.YyV5h2.vyk7r9JJy7oUhEIPsLTfo3MK', 'خلفاوي الحارث', 'nnn', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, '0', 1, 1, '2024-11-13', '2024-12-13', '2024', '2024-11-09 19:22:06', '2024-11-13 06:31:54', NULL),
	(16, 7, NULL, '20241016', '20241016', 'خلفاوي الحارث', 'sdsdsdsd', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, '0', 2, 1, '2024-11-13', '2024-12-13', '2024', '2024-11-11 08:27:41', '2024-11-14 19:51:07', NULL),
	(17, 7, NULL, '20241017', '$2y$10$UuzW0lQBPs.IUlA9pr0Pe.zgkpR0OGIqAtR3l0wwTjjh.eCU6CvFe', 'خلفاوي الحارث', 'jhjjhjh', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, '0', 0, 2, '2024-11-13', '2024-12-13', '2024', '2024-11-11 08:30:03', '2024-11-14 19:51:19', NULL),
	(18, 7, NULL, '20241001', '$2y$10$3RMky9Q.ib93vAsvHV.5KOVc0AFgaDBiBC6A8nlN.Bq8V/DIVcI42', 'elhareth csdcs', 'yfy', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, '0', 1, 1, NULL, NULL, '2024', '2024-11-15 06:00:42', '2024-11-15 06:00:42', NULL),
	(23, 7, NULL, '20241002', '$2y$10$ilABk9mmhjeTvGSWr4PAfegLwYQVEvpHA7iMVvtHsBU8A5NpHWfVG', 'yfy', 'yfy', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, '0', 1, 1, NULL, NULL, '2024', '2024-11-15 06:08:25', '2024-11-15 06:08:25', NULL);

CREATE TABLE IF NOT EXISTS `project_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_project` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_project` (`id_project`),
  CONSTRAINT `images_project_id` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `id_faculty` bigint unsigned NOT NULL,
  `group_id` int DEFAULT NULL,
  `firstname_fr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname_fr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int NOT NULL,
  `birthday` date NOT NULL,
  `state_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `residence` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `academicLevel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moyenFinal` decimal(8,2) DEFAULT NULL,
  `project_stage` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_registration_number_unique` (`registration_number`),
  UNIQUE KEY `students_phone_unique` (`phone`),
  UNIQUE KEY `students_email_unique` (`email`),
  KEY `students_created_by_foreign` (`created_by`),
  KEY `id_faculty` (`id_faculty`),
  CONSTRAINT `students_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `students_faculty_id_foreign` FOREIGN KEY (`id_faculty`) REFERENCES `faculties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `students` (`id`, `registration_number`, `created_by`, `id_faculty`, `group_id`, `firstname_fr`, `firstname_ar`, `lastname_fr`, `lastname_ar`, `username`, `status`, `photo`, `gender`, `birthday`, `state_of_birth`, `place_of_birth`, `residence`, `group`, `batch`, `academicLevel`, `specialty`, `department`, `start_date`, `end_date`, `phone`, `email`, `password`, `moyenFinal`, `project_stage`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(52, '111555', NULL, 1, NULL, 'ss', 'ss', 'ss', 'ss', NULL, 1, NULL, 1, '2010-10-10', 'الوادي', 'الوادي', 'الوادي', NULL, '2024', 'ليسانس', 'ااا', 'GL', NULL, NULL, '66666666', 'ee@gmail.com', '$2y$10$Ec84oi4BvMLyhyzNrXEY7eDIwjfhOARLoXFnVl0MjxP./4NOoprNu', NULL, 1, '2024-11-15 08:49:41', '2024-11-15 08:49:41', NULL);

CREATE TABLE IF NOT EXISTS `student_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `student_id` (`student_id`) USING BTREE,
  CONSTRAINT `project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `student_groups` (`id`, `student_id`, `project_id`, `created_at`, `updated_at`) VALUES
	(31, 52, 8, '2024-11-15 09:59:39', '2024-11-15 09:59:38');

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coef` smallint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subjects_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `subjects` (`id`, `name`, `coef`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'المواضبة على الحضور', 2, '2024-05-06 15:55:48', '2024-05-06 15:55:48', NULL),
	(2, 'كمية المشاركة', 1, '2024-05-06 15:55:48', '2024-05-06 15:55:48', NULL),
	(3, 'جودة المشاركة', 2, '2024-05-06 15:55:48', '2024-05-06 15:55:48', NULL),
	(4, 'روح المبادرة', 1, '2024-05-06 15:55:48', '2024-05-06 15:55:48', NULL),
	(5, 'الحضور الذهني', 2, '2024-05-06 15:55:48', '2024-05-06 15:55:48', NULL),
	(6, 'القيم الأخلاقية', 2, '2024-05-06 15:55:48', '2024-05-06 15:55:48', NULL),
	(7, 'الهندام', 1, '2024-05-06 15:55:48', '2024-05-06 15:55:48', NULL),
	(8, 'العلاقة الإنسانية و التفاعل مع الفريق', 1, '2024-05-06 15:55:48', '2024-05-06 15:55:48', NULL),
	(9, 'اعمال المعارف التطبيقية و قدرة العمل', 6, '2024-05-06 15:55:48', '2024-05-06 15:55:48', NULL),
	(10, 'اختبار نهاية التربص', 2, '2024-05-06 15:55:48', '2024-05-06 15:55:48', NULL);



CREATE TABLE IF NOT EXISTS `administrative_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  `registration_certificate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identification_card` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `key__project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `key_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `administrative_files` (`id`, `student_id`, `project_id`, `registration_certificate`, `identification_card`, `photo`, `status`, `created_at`, `updated_at`) VALUES
	(9, 52, 8, '1731667485_registration_certificate_0.pdf', '1731667485_identification_card_0.pdf', '1731667485_photo_0.jpg', '1', '2024-11-15 09:44:46', '2024-11-15 10:00:49');


CREATE TABLE IF NOT EXISTS `attendences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `day` int NOT NULL,
  `year` int NOT NULL,
  `month` int NOT NULL,
  `week` int NOT NULL,
  `number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendences_student_id_foreign` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `certificates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `certificates_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `certificates` (`id`, `project_id`, `file_name`, `created_at`, `updated_at`) VALUES
	(7, 8, 'Créer un BMC', '2024-11-15 06:20:54', '2024-11-15 06:20:54'),
	(8, 8, 'Étape de préparation du prototype', '2024-11-15 06:35:40', '2024-11-15 06:35:40'),
	(9, 8, 'Étape de préparation du prototype', '2024-11-15 06:51:41', '2024-11-15 06:51:41');

CREATE TABLE IF NOT EXISTS `departements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_faculty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `departements` (`id`, `name_ar`, `name_fr`, `id_faculty`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'الري و الهندسة المدنية', 'Hydraulique et Génie Civil', 1, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(2, 'الهندسة الكهربائية', 'Génie Électrique', 1, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(3, 'هندسة الطرائق و البتروكيمياء', 'Génie des Procédés et Pétrochimie', 1, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(4, 'هندسة ميكانيكية', 'Génie Mécanique', 1, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(5, 'قسم البيولوجيا', 'Département de Biologie', 2, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(6, 'قسم الفلاحة', 'Département d\'Agriculture', 2, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(7, 'الترجمة', 'Traduction', 3, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(8, 'اللغة إنجليزية', 'Langue Anglaise', 3, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(9, 'اللغة الفرنسية', 'Langue Française', 3, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(10, 'اللغة و الأدب العربي', 'Langue et Littérature Arabe', 3, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(11, 'الإعلام و الاتصال', 'Information et Communication', 4, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(12, 'التاريخ', 'Histoire', 4, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(13, 'علم النفس', 'Psychologie', 4, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(14, 'علم النفس و علوم التربية', 'Psychologie et Sciences de l\'Éducation', 4, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(15, 'علوم إجتماعية', 'Sciences Sociales', 4, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(16, 'علوم إنسانية', 'Sciences Humaines', 4, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(17, 'العلوم الاقتصادية', 'Sciences Économiques', 5, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(18, 'العلوم التجارية', 'Sciences Commerciales', 5, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(19, 'العلوم المالية و المحاسبية', 'Sciences Financières et Comptables', 5, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(20, 'علوم التسيير', 'Sciences de Gestion', 5, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(21, 'العلوم السياسية', 'Sciences Politiques', 6, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(22, 'حقوق', 'Droit', 6, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(23, 'إعلام آلي', 'Informatique', 7, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(24, 'رياضيات', 'Mathématiques', 7, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(25, 'علوم المادة', 'Sciences de la Matière', 7, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(26, 'فيزياء', 'Physique', 7, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(27, 'كيمياء', 'Chimie', 7, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(28, 'قسم أصول الدين', 'Département des Fondements de la Religion', 8, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(29, 'قسم الحضارة الإسلامية', 'Département de la Civilisation Islamique', 8, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL),
	(30, 'قسم الشريعة', 'Département de la Charia', 8, '2024-07-02 08:39:35', '2024-07-02 08:39:35', NULL);


CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `rank` enum('1','2','3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golden_passport` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluations_student_id_foreign` (`student_id`),
  KEY `evaluations_created_by_foreign` (`created_by`),
  CONSTRAINT `evaluations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `evaluations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `notes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_student_id_foreign` (`student_id`),
  KEY `notes_created_by_foreign` (`created_by`),
  CONSTRAINT `notes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `notes_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





CREATE TABLE IF NOT EXISTS `supervising_teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `faculty_id` bigint unsigned NOT NULL,
  `departement_id` bigint unsigned NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname_fr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname_fr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speciality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `supervising_teachers_phone_unique` (`phone`),
  UNIQUE KEY `supervising_teachers_email_unique` (`email`),
  KEY `departement_id` (`departement_id`),
  KEY `faculty_id` (`faculty_id`),
  CONSTRAINT `departement_id` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `faculty_id` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `supervising_teachers` (`id`, `faculty_id`, `departement_id`, `phone`, `email`, `firstname_fr`, `firstname_ar`, `lastname_fr`, `lastname_ar`, `gender`, `photo`, `speciality`, `grade`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, '0554525521', 'Benazouzmourtada@yahou.fr', 'Mourtada', 'مرتضى', 'Benazouz', 'بن عزوز', 1, NULL, 'IA', 'Class A', 1, '2024-07-16 15:44:10', '2024-07-16 15:44:10', NULL),
	(2, 1, 1, '0664890184', 'asilammar48@gmail.com', 'ammr', 'عمار', 'djaidja', 'جعيجع', 1, NULL, 'مالية', 'محاضر ب', 1, '2024-07-22 10:37:03', '2024-07-22 10:37:03', NULL),
	(3, 1, 1, '0668022334', 'drfouadferhat@gmail.com', 'fff', 'للللل', 'fff', 'بببببب', 1, NULL, 'fff', ',cb', 1, '2024-07-22 14:49:02', '2024-11-06 18:51:42', '2024-11-06 18:51:42'),
	(4, 2, 10, '0795909828', 'elhareth079@gmail.com', 'خلفاوي', 'خلفاوي', 'الحارث', 'الحارث', 1, NULL, 'hhh', '23', 1, '2024-11-08 15:32:57', '2024-11-08 15:33:07', '2024-11-08 15:33:07');

CREATE TABLE IF NOT EXISTS `supervising_teacher_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supervising_teacher_id` bigint unsigned NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  `role` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `project_id` (`project_id`) USING BTREE,
  KEY `supervising_teacher_id` (`supervising_teacher_id`) USING BTREE,
  CONSTRAINT `key_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `supervising_teacher_id` FOREIGN KEY (`supervising_teacher_id`) REFERENCES `supervising_teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `supervising_teacher_groups` (`id`, `supervising_teacher_id`, `project_id`, `role`, `created_at`, `updated_at`) VALUES
	(9, 1, 5, '1', '2024-11-09 18:59:19', '2024-11-09 18:59:19'),
	(10, 1, 12, '2', '2024-11-09 19:07:47', '2024-11-09 19:07:47'),
	(11, 1, 13, '1', '2024-11-09 19:11:11', '2024-11-09 19:11:11'),
	(12, 1, 14, '2', '2024-11-09 19:18:13', '2024-11-09 19:18:13'),
	(13, 1, 15, '2', '2024-11-09 19:22:06', '2024-11-09 19:22:06'),
	(14, 1, 16, NULL, '2024-11-11 08:27:41', '2024-11-11 08:27:41'),
	(15, 1, 17, NULL, '2024-11-11 08:30:04', '2024-11-11 08:30:04'),
	(16, 1, 18, '1', '2024-11-15 06:00:42', '2024-11-15 06:00:42'),
	(17, 2, 18, '3', '2024-11-15 06:00:42', '2024-11-15 06:00:42'),
	(22, 1, 23, '3', '2024-11-15 06:08:25', '2024-11-15 06:08:25');

CREATE TABLE IF NOT EXISTS `supervising_teacher_projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_student` int NOT NULL,
  `faculty_id` int NOT NULL,
  `id_project` int DEFAULT NULL,
  `id_supervisor` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `supervising_teacher_projects` (`id`, `id_student`, `faculty_id`, `id_project`, `id_supervisor`, `created_at`, `updated_at`) VALUES
	(1, 31, 1, 8, 1, '2024-07-16 15:59:08', '2024-10-18 18:30:00'),
	(2, 32, 1, 2, 2, '2024-07-22 10:37:03', '2024-07-22 10:37:03'),
	(3, 34, 1, 4, 3, '2024-07-22 14:49:02', '2024-07-22 14:49:02');

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `commission_id` bigint unsigned NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname_fr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname_fr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` int NOT NULL,
  `grade` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teachers_phone_unique` (`phone`),
  UNIQUE KEY `teachers_email_unique` (`email`),
  KEY `id_commission` (`commission_id`) USING BTREE,
  CONSTRAINT `id_commission` FOREIGN KEY (`commission_id`) REFERENCES `commissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `teachers` (`id`, `commission_id`, `phone`, `email`, `password`, `firstname_fr`, `firstname_ar`, `lastname_fr`, `lastname_ar`, `birthday`, `gender`, `grade`, `address`, `status`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, '0656565656', 'adm5in@gmail.com', '$2y$10$XleBZfNLFsosI32FR6T.AeThKQpDlwwBLNkAFo5v1JjrmsA3MMEWy', 'vomm', 'لجنة', 'vvvv', 'تجربة', '1992-12-12', 1, 'م ا', 'كلية التكنولوجيا', 1, NULL, '2024-07-22 11:11:50', '2024-11-13 13:58:03', NULL),
	(2, 1, '0795909128', 'teacher@gmail.com', '$2y$10$Rbf82Gs5BqNlcsrgfIMTe.C77iT.98LrRTbMCa0Qi2CuH.1UE9epC', 'elhareth', 'elhareth', 'csdcs', 'csdcs', '2024-10-17', 1, NULL, 'BT 4 N 3', 1, NULL, '2024-10-17 09:27:24', '2024-11-07 14:32:38', NULL),
	(3, 1, '0795909134', 'elhareth0609@gmail.com', '$2y$10$7sRb7jRCM/Rl0broEryCeexrbVyFQhtVnk9O0Xji7MSD5IR7UmU0i', 'خلفاوي', 'خلفاوي', 'الحارث', 'الحارث', '2024-11-07', 1, '23', 'Eloued', 1, NULL, '2024-11-07 15:00:00', '2024-11-07 15:00:19', NULL),
	(4, 2, '0795949128', 'elhareth0609ds@gmail.com', '$2y$10$9c/oJDU3CBd5K5T5oT9w7ujJKXYYwspn4xbn9AGlULkQTQnq5nxc.', 'خلفاوي', 'خلفاوي', 'الحارث', 'الحارث', '2024-11-07', 1, '23', 'Eloued', 1, NULL, '2024-11-07 15:11:27', '2024-11-07 15:15:02', '2024-11-07 15:15:02');

CREATE TABLE IF NOT EXISTS `tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `subject_id` bigint unsigned NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tests_student_id_foreign` (`student_id`),
  KEY `tests_subject_id_foreign` (`subject_id`),
  CONSTRAINT `tests_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tests_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
