#
# Apply __SQL/patch_16.sql after making sure that there are no duplicate emails.

### BBITS QUERIES START ###

ALTER TABLE `users_clients` ADD `username` VARCHAR(100) NOT NULL AFTER `uc_active_status`, ADD `password` VARCHAR(255) NOT NULL AFTER `username`, ADD `salt` VARCHAR(255) NOT NULL AFTER `password`, ADD `activation_code` VARCHAR(40) NOT NULL AFTER `salt`;

ALTER TABLE `users_clients` ADD `updated_at` DATETIME NULL AFTER `created_at`;

ALTER TABLE `users_clients` CHANGE `uc_active_status` `uc_active_status` ENUM('N', 'P', 'A', 'I', 'L', 'E') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'P';

DELETE FROM `users_clients` WHERE `uc_user_id` = 1;

INSERT INTO `users_clients` (`uc_user_id`, `uc_client_id`, `uc_group_id`, `uc_active_status`, `username`, `password`, `salt`, `activation_code`, `created_at`,`updated_at`) VALUES ('1', '1', '1', 'A', 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO `cms_items` (`ci_id`, `ci_title`, `ci_alias`, `ci_page_type`, `ci_short_descr`, `ci_content`, `ci_content_hints`, `ci_author_id`, `ci_published`, `ci_created_at`, `ci_updated_at`) VALUES (NULL, 'Existing User Activation', 'existing_account_activated', 'E', '', '<h2>Account Activation at [site_name] site</h2>Dear [username], your account was activated at <b><a href="[site_url]">[site_name]</a></b> site, with email [ email].
Now you can login at <a href="[site_url]">[site_name] </a> site.

[support_signature] ', '<b>[site_name]</b> - name of site (from Settings),<br> <b>[site_url]</b> - url of main page of site,<br> <b>[first_name]</b> - first_name of user with activated account, <br> <b>[last_name]</b> - last_name of user with activated account, <br><b>[username]</b> - username(login) of user with activated account,<br><b>[email]</b> - email of user with activated account,<br> <b>[support_signature]</b> - Support signature text(from Settings)', '1', 'Y', '2017-01-18 03:53:17', '2017-01-18 03:53:17');