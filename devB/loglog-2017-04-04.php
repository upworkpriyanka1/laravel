<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-04-04 08:39:31 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:39:31 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:47:34 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:47:34 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:48:28 --> Could not find the language line ""
ERROR - 2017-04-04 08:48:28 --> Could not find the language line ""
ERROR - 2017-04-04 08:48:28 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:48:28 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:55:21 --> Could not find the language line ""
ERROR - 2017-04-04 08:55:21 --> Could not find the language line ""
ERROR - 2017-04-04 08:55:21 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:55:21 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:56:08 --> Could not find the language line ""
ERROR - 2017-04-04 08:56:08 --> Could not find the language line ""
ERROR - 2017-04-04 08:56:08 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:56:08 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:58:20 --> Could not find the language line ""
ERROR - 2017-04-04 08:58:20 --> Could not find the language line ""
ERROR - 2017-04-04 08:58:20 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:58:20 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:58:30 --> Could not find the language line ""
ERROR - 2017-04-04 08:58:30 --> Could not find the language line ""
ERROR - 2017-04-04 08:58:30 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:58:30 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:59:11 --> Could not find the language line ""
ERROR - 2017-04-04 08:59:11 --> Could not find the language line ""
ERROR - 2017-04-04 08:59:11 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 08:59:11 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:02:50 --> Query error: Table 'xntralne_0.jobs' doesn't exist - Invalid query: SELECT *
FROM `jobs`
WHERE `id` != '1'
ERROR - 2017-04-04 09:02:51 --> Query error: Table 'xntralne_0.users_jobs' doesn't exist - Invalid query: SELECT *, users.id AS UserID
FROM `users`
JOIN `users_groups` ON `users_groups`.`user_id` = `users`.`id`
JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
JOIN `users_jobs` ON `users_jobs`.`user_id` = `users`.`id`
JOIN `jobs` ON `jobs`.`id` = `users_jobs`.`job_id`
JOIN `users_clients` ON `users_clients`.`uc_user_id` = `users`.`id`
JOIN `clients` ON `clients`.`cid` = `users_clients`.`uc_client_id`
WHERE `users`.`id` != '1'
AND `users`.`is_patient` = '0'
AND `clients`.`cid` IS NULL
AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'
ERROR - 2017-04-04 09:03:56 --> Query error: Table 'xntralne_0.jobs' doesn't exist - Invalid query: SELECT *
FROM `jobs`
WHERE `id` != '1'
ERROR - 2017-04-04 09:05:04 --> Query error: Table 'xntralne_0.jobs' doesn't exist - Invalid query: SELECT *
FROM `jobs`
WHERE `id` != '1'
ERROR - 2017-04-04 09:05:07 --> Query error: Table 'xntralne_0.jobs' doesn't exist - Invalid query: SELECT *
FROM `jobs`
WHERE `id` != '1'
ERROR - 2017-04-04 09:11:09 --> Query error: Table 'xntralne_0.jobs' doesn't exist - Invalid query: SELECT *
FROM `jobs`
WHERE `id` != '1'
ERROR - 2017-04-04 09:11:11 --> Query error: Table 'xntralne_0.jobs' doesn't exist - Invalid query: SELECT *
FROM `jobs`
WHERE `id` != '1'
ERROR - 2017-04-04 09:11:13 --> Query error: Table 'xntralne_0.jobs' doesn't exist - Invalid query: SELECT *
FROM `jobs`
WHERE `id` != '1'
ERROR - 2017-04-04 09:11:36 --> Query error: Table 'xntralne_0.jobs' doesn't exist - Invalid query: SELECT *
FROM `jobs`
WHERE `id` != '1'
ERROR - 2017-04-04 09:12:05 --> Query error: Table 'xntralne_0.jobs' doesn't exist - Invalid query: SELECT *
FROM `jobs`
WHERE `id` != '1'
ERROR - 2017-04-04 09:12:06 --> Query error: Table 'xntralne_0.jobs' doesn't exist - Invalid query: SELECT *
FROM `jobs`
WHERE `id` != '1'
ERROR - 2017-04-04 09:13:54 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:13:54 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:17:07 --> Query error: Table 'xntralne_0.users_jobs' doesn't exist - Invalid query: SELECT *, users.id AS UserID
FROM `users`
JOIN `users_groups` ON `users_groups`.`user_id` = `users`.`id`
JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
JOIN `users_jobs` ON `users_jobs`.`user_id` = `users`.`id`
JOIN `jobs` ON `jobs`.`id` = `users_jobs`.`job_id`
JOIN `users_clients` ON `users_clients`.`uc_user_id` = `users`.`id`
JOIN `clients` ON `clients`.`cid` = `users_clients`.`uc_client_id`
WHERE `users`.`id` != '1'
AND `users`.`is_patient` = '0'
AND `clients`.`cid` IS NULL
AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'
ERROR - 2017-04-04 09:17:55 --> Query error: Table 'xntralne_0.users_jobs' doesn't exist - Invalid query: SELECT *, users.id AS UserID
FROM `users`
JOIN `users_groups` ON `users_groups`.`user_id` = `users`.`id`
JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
JOIN `users_jobs` ON `users_jobs`.`user_id` = `users`.`id`
JOIN `users_clients` ON `users_clients`.`uc_user_id` = `users`.`id`
JOIN `clients` ON `clients`.`cid` = `users_clients`.`uc_client_id`
WHERE `users`.`id` != '1'
AND `users`.`is_patient` = '0'
AND `clients`.`cid` IS NULL
AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'
ERROR - 2017-04-04 09:18:18 --> Query error: Unknown column 'users.is_patient' in 'where clause' - Invalid query: SELECT *, users.id AS UserID
FROM `users`
JOIN `users_groups` ON `users_groups`.`user_id` = `users`.`id`
JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
JOIN `users_clients` ON `users_clients`.`uc_user_id` = `users`.`id`
JOIN `clients` ON `clients`.`cid` = `users_clients`.`uc_client_id`
WHERE `users`.`id` != '1'
AND `users`.`is_patient` = '0'
AND `clients`.`cid` IS NULL
AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'
ERROR - 2017-04-04 09:19:14 --> Query error: Unknown column 'users.is_patient' in 'where clause' - Invalid query: SELECT *, users.id AS UserID
FROM `users`
JOIN `users_groups` ON `users_groups`.`user_id` = `users`.`id`
JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
JOIN `users_clients` ON `users_clients`.`uc_user_id` = `users`.`id`
JOIN `clients` ON `clients`.`cid` = `users_clients`.`uc_client_id`
WHERE `users`.`id` != '1'
AND `users`.`is_patient` = '0'
AND `clients`.`cid` IS NULL
AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'
ERROR - 2017-04-04 09:19:15 --> Query error: Unknown column 'users.is_patient' in 'where clause' - Invalid query: SELECT *, users.id AS UserID
FROM `users`
JOIN `users_groups` ON `users_groups`.`user_id` = `users`.`id`
JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
JOIN `users_clients` ON `users_clients`.`uc_user_id` = `users`.`id`
JOIN `clients` ON `clients`.`cid` = `users_clients`.`uc_client_id`
WHERE `users`.`id` != '1'
AND `users`.`is_patient` = '0'
AND `clients`.`cid` IS NULL
AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'
ERROR - 2017-04-04 09:19:27 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:19:27 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:19:37 --> Query error: Unknown column 'users.is_patient' in 'where clause' - Invalid query: SELECT *, users.id AS UserID
FROM `users`
JOIN `users_groups` ON `users_groups`.`user_id` = `users`.`id`
JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
JOIN `users_clients` ON `users_clients`.`uc_user_id` = `users`.`id`
JOIN `clients` ON `clients`.`cid` = `users_clients`.`uc_client_id`
WHERE `users`.`id` != '1'
AND `users`.`is_patient` = '0'
AND `clients`.`cid` IS NULL
AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'
ERROR - 2017-04-04 09:19:46 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:19:46 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:21:03 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:21:03 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:23:07 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:23:07 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:23:12 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:23:12 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:25:42 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:25:42 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:25:45 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:25:45 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:26:25 --> Query error: Table 'xntralne_0.users_jobs' doesn't exist - Invalid query: INSERT INTO `users_jobs` (`user_id`, `job_id`) VALUES (44, NULL)
ERROR - 2017-04-04 09:31:56 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:31:56 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:31:58 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:31:58 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:32:02 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:32:02 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:32:29 --> Query error: Table 'xntralne_0.users_jobs' doesn't exist - Invalid query: INSERT INTO `users_jobs` (`user_id`, `job_id`) VALUES (45, NULL)
ERROR - 2017-04-04 09:32:33 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:32:33 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:38:12 --> Query error: Table 'xntralne_0.users_jobs' doesn't exist - Invalid query: INSERT INTO `users_jobs` (`user_id`, `job_id`) VALUES (46, NULL)
ERROR - 2017-04-04 09:38:29 --> Query error: Table 'xntralne_0.users_jobs' doesn't exist - Invalid query: INSERT INTO `users_jobs` (`user_id`, `job_id`) VALUES (47, NULL)
ERROR - 2017-04-04 09:39:41 --> Query error: Table 'xntralne_0.users_jobs' doesn't exist - Invalid query: INSERT INTO `users_jobs` (`user_id`, `job_id`) VALUES (48, NULL)
ERROR - 2017-04-04 09:45:55 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:45:55 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:45:57 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:45:57 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:47:18 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:47:18 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:47:21 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:47:21 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:47:22 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:47:22 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:47:24 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:47:24 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:47:27 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 09:47:27 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 10:34:15 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 10:34:15 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 10:34:34 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 10:34:34 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:19:56 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:19:56 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:20:29 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:20:29 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:20:32 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:20:32 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:24:25 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:24:25 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:24:28 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:24:28 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:25:28 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:25:28 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:31:13 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:31:13 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:31:16 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:31:16 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:31:18 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:31:18 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:34:14 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:34:14 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:36:21 --> Severity: Error --> Call to a member function user() on a non-object C:\xampp\htdocs\zntral_site_new\application\modules\super\controllers\Super.php 25
ERROR - 2017-04-04 11:36:34 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:36:34 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:36:38 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:36:38 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:36:40 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:36:40 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:37:06 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:37:06 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:37:09 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:37:09 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:38:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'' at line 9 - Invalid query: SELECT *, users.id AS UserID
FROM `users`
JOIN `users_groups` ON `users_groups`.`user_id` = `users`.`id`
JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
JOIN `users_clients` ON `users_clients`.`uc_user_id` = `users`.`id`
JOIN `clients` ON `clients`.`cid` = `users_clients`.`uc_client_id`
WHERE `users`.`id` != '1'
AND `clients`.`cid` =
AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'
ERROR - 2017-04-04 11:39:18 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'' at line 9 - Invalid query: SELECT *, users.id AS UserID
FROM `users`
JOIN `users_groups` ON `users_groups`.`user_id` = `users`.`id`
JOIN `groups` ON `groups`.`id` = `users_groups`.`group_id`
JOIN `users_clients` ON `users_clients`.`uc_user_id` = `users`.`id`
JOIN `clients` ON `clients`.`cid` = `users_clients`.`uc_client_id`
WHERE `users`.`id` != '1'
AND `clients`.`cid` =
AND `users_groups`.`id` != '1'
AND `groups`.`id` != '1'
ERROR - 2017-04-04 11:39:59 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:39:59 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:40:03 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 11:40:03 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:41:52 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:41:52 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:41:55 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:41:55 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:42:32 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:42:33 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:42:35 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:42:35 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:49:04 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:49:04 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 12:50:08 --> Could not find the language line "phone_type"
ERROR - 2017-04-04 13:14:44 --> Could not find the language line "phone_type"
ERROR - 2017-04-04 13:15:01 --> Could not find the language line "phone_type"
ERROR - 2017-04-04 13:16:20 --> Could not find the language line "phone_type"
ERROR - 2017-04-04 13:16:20 --> Could not find the language line "phone_type"
ERROR - 2017-04-04 13:16:22 --> Query error: Unknown column 'username' in 'order clause' - Invalid query: SELECT `clients_vendors`.*, `vendors`.`vn_name`, `vendors`.`vn_id`, `vendors`.`vn_email`, `vendors`.`vn_website`
FROM `clients_vendors`
RIGHT JOIN `vendors` ON `vendors`.`vn_id` = `clients_vendors`.`cv_vendor_id` AND `clients_vendors`.`cv_active_status` = 'undefined' 
ORDER BY `username` DESC
 LIMIT 10
ERROR - 2017-04-04 13:16:29 --> Could not find the language line "phone_type"
ERROR - 2017-04-04 13:17:12 --> Could not find the language line "phone_type"
ERROR - 2017-04-04 13:18:46 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:18:46 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:18:47 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:18:47 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:18:58 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:18:58 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:18:59 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:18:59 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:21:14 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:21:14 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:21:14 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:21:15 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:22:10 --> Could not find the language line "services"
ERROR - 2017-04-04 13:22:21 --> Could not find the language line "services"
ERROR - 2017-04-04 13:22:34 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:22:34 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:22:34 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:22:34 --> 404 Page Not Found: /index
ERROR - 2017-04-04 13:22:42 --> Could not find the language line "cms_items"
ERROR - 2017-04-04 13:23:29 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:23:29 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:23:32 --> Severity: Error --> Call to undefined method Common_mdl::get_client() C:\xampp\htdocs\zntral_site_new\application\modules\super\controllers\Super.php 235
ERROR - 2017-04-04 13:23:46 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:23:46 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:23:50 --> Severity: Error --> Call to undefined method Common_mdl::get_client() C:\xampp\htdocs\zntral_site_new\application\modules\super\controllers\Super.php 235
ERROR - 2017-04-04 13:24:31 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:24:31 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:24:33 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:24:33 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:24:37 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:24:37 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:32:59 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:32:59 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:33:02 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:33:02 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:33:23 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:33:23 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:33:24 --> Query error: Table 'xntralne_0.contacts' doesn't exist - Invalid query: SELECT *
FROM `contacts`
JOIN `contact_types` ON `contact_types`.`con_type_id` = `contacts`.`contact_type_id`
WHERE `contacts`.`contact_client_id` IS NULL
ERROR - 2017-04-04 13:33:52 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:33:52 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:33:55 --> Query error: Table 'xntralne_0.contacts' doesn't exist - Invalid query: SELECT *
FROM `contacts`
JOIN `contact_types` ON `contact_types`.`con_type_id` = `contacts`.`contact_type_id`
WHERE `contacts`.`contact_client_id` IS NULL
ERROR - 2017-04-04 13:33:57 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:33:57 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:40:51 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 13:40:51 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 15:33:01 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 15:33:01 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 15:33:06 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 15:33:06 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 15:35:13 --> Could not find the language line "color_scheme"
ERROR - 2017-04-04 15:35:13 --> Could not find the language line "color_scheme"
