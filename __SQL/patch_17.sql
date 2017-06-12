ALTER TABLE `users_groups` 
  ADD COLUMN 	`status` ENUM('A','I', 'P') NOT NULL DEFAULT 'P';
  
  
ALTER TABLE `users_groups` 
  ADD INDEX `fk_users_groups_group_id_status_idx` (`group_id`, `status`);
  
	

UPDATE `users` SET `user_active_status` = 'I' where `user_active_status` not in ('N','P','A','I','L');


ALTER TABLE `users`
  change COLUMN  `user_active_status`  `user_status` ENUM('N','P','A','I','L') NOT NULL DEFAULT 'I';
 
  
  
  
alter TABLE `patients` 
  change COLUMN  `pt_patient_active_status` `patient_status`  enum('N','A','I') NOT NULL DEFAULT 'N';
  
UPDATE `users_clients`SET `uc_active_status`= 'E' WHERE `uc_active_status` NOT IN ('E','O');  
  
ALTER TABLE `users_clients` 
  change COLUMN `uc_active_status` `uc_active_status` enum('E','O') NOT NULL DEFAULT 'E';
  
 
 
 
  
  
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  
  
  `pt_address` varchar(100) NOT NULL,
  `pt_suite` varchar(20) DEFAULT NULL,
  `pt_state` varchar(50) DEFAULT NULL,
  `pt_zip` varchar(10) DEFAULT NULL,
  `pt_gender` enum('M','F') NOT NULL,
  `pt_birth_date` date DEFAULT NULL,
  `pt_ss_number` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
  
  Define N W A I and L
  
First, in user_active_status (needs to change to 'user_status')


`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) UNSIGNED NOT NULL,
	`group_id` MEDIUMINT(8) UNSIGNED NOT NULL,



CREATE TABLE `users_groups` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) UNSIGNED NOT NULL,
	`group_id` MEDIUMINT(8) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `uc_users_groups` (`user_id`, `group_id`),
	INDEX `fk_users_groups_users1_idx` (`user_id`),
	INDEX `fk_users_groups_groups1_idx` (`group_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=97
;