DROP TABLE IF EXISTS `cms_items` ;
CREATE TABLE `cms_items` (
	`ci_id`             INT(11) NOT NULL AUTO_INCREMENT,
	`ci_title`          VARCHAR(100) NOT NULL,
	`ci_alias`          VARCHAR(50) NOT NULL,
	`ci_page_type`      ENUM('E','P','B') NOT NULL,
	`ci_short_descr`    VARCHAR(255) NULL DEFAULT NULL,
	`ci_content`        TEXT NOT NULL,
  `ci_content_hints`  TEXT NULL,
	`ci_author_id`      INT(11) UNSIGNED NOT NULL,
	`ci_published`      ENUM('Y','N') NOT NULL DEFAULT 'N',
	`ci_created_at`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`ci_updated_at`     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ci_id`),
	UNIQUE INDEX `ind_cms_items_ci_alias` (`ci_alias`),
	INDEX `ind_cms_items` (`ci_page_type`, `ci_published`, `ci_author_id`)
);

ALTER TABLE `cms_items`
  ADD CONSTRAINT         `fk_cms_items_users_ci_author_id` FOREIGN KEY (`ci_author_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

  

INSERT INTO `cms_items` (`ci_id`, `ci_title`, `ci_alias`, `ci_page_type`, `ci_short_descr`, `ci_content`,  `ci_content_hints`, `ci_author_id`, `ci_published` ) VALUES
(1, 'User Register', 'user_register', 'E', '', '<h2>Registration at [site_name] site</h2>Dear [username], you are registered at <b><a href="[site_url]">[site_name]</a></b> site, with email [ email].  You need to activate your account at <a href="[activation_page_url]">Activation page [activation_page_url] </a> and you will receive your password.

[support_signature] ', '', 1, 'Y' );
UPDATE `cms_items`  SET `ci_content_hints`= '<b>[site_name]</b> - name of site (from Settings),<br> <b>[site_url]</b> - url of main page of site,<br> <b>[activation_page_url]</b> - activation page url,
 <br> <b>[first_name]</b> - first_name of user who is registered, <br> <b>[last_name]</b> - last_name of user who is registered, <br><b>[username]</b> - username(login) of user who is registered,<br><b>[email]</b> - email of user who is registered,<br> <b>[support_signature]</b> - Support signature text(from Settings)' WHERE `ci_alias`= 'user_register';





INSERT INTO `cms_items` (`ci_id`, `ci_title`, `ci_alias`, `ci_page_type`, `ci_short_descr`, `ci_content`,  `ci_content_hints`, `ci_author_id`, `ci_published` ) VALUES
(2, 'Account Activated', 'account_activated', 'E', '', '<h2>Account Activation at [site_name] site</h2>Dear [username], your account was activated at <b><a href="[site_url]">[site_name]</a></b> site, with email [ email] and password [ password ]
Now you can login at <a href="[site_url]">[site_name] </a> site.

[support_signature] ', '', 1, 'Y' );
UPDATE `cms_items`  SET `ci_content_hints`= '<b>[site_name]</b> - name of site (from Settings),<br> <b>[site_url]</b> - url of main page of site,<br> <b>[password]</b> - password of login,
 <br> <b>[first_name]</b> - first_name of user with activated account, <br> <b>[last_name]</b> - last_name of user with activated account, <br><b>[username]</b> - username(login) of user with activated account,<br><b>[email]</b> - email of user with activated account,<br> <b>[support_signature]</b> - Support signature text(from Settings)' WHERE `ci_alias`= 'account_activated';




INSERT INTO `cms_items` (`ci_id`, `ci_title`, `ci_alias`, `ci_page_type`, `ci_short_descr`, `ci_content`,  `ci_content_hints`, `ci_author_id`, `ci_published` ) VALUES
(3, 'New Password Generated', 'new_password_generated', 'E', '', '<h2>New Password Generation at [site_name] site</h2>Dear [username], new password was generated for your account at <b><a href="[site_url]">[site_name]</a></b> site. Use email [ email] and password [ password ]
 Now you can login at <a href="[site_url]">[site_name] </a> site.

[support_signature] ', '', 1, 'Y' );
UPDATE `cms_items`  SET `ci_content_hints`= '<b>[site_name]</b> - name of site (from Settings),<br> <b>[site_url]</b> - url of main page of site,<br> <b>[password]</b> - generated password of login,
 <br> <b>[first_name]</b> - first_name of user with new generated password, <br> <b>[last_name]</b> - last_name of user with new generated password, <br><b>[username]</b> - username(login) of user with new generated password,<br><b>[email]</b> - email of user with new generated password,<br> <b>[support_signature]</b> - Support signature text(from Settings)' WHERE `ci_alias`= 'new_password_generated';


