select  count(*) from `clients` group by `client_email`;

ALTER TABLE `clients` 
	add unique index `ind_clients_client_email` (`client_email`);
	
	
	
ALTER TABLE `users_clients` 
  add column `uc_group_id` MEDIUMINT(8) UNSIGNED NOT NULL after `uc_client_id`;
  

UPDATE `users_clients` SET `uc_group_id` = 11;  
  
ALTER TABLE `users_clients`
  ADD CONSTRAINT `fk_users_clients_uc_group_id` FOREIGN KEY (`uc_group_id`) REFERENCES `groups` (`id`);
  

	`uc_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`uc_user_id` INT(11) UNSIGNED NOT NULL,
	`uc_client_id` MEDIUMINT(8) UNSIGNED NULL DEFAULT NULL,
	`uc_active_status` ENUM('E','O','N') NOT NULL DEFAULT 'N',
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`uc_id`),
	UNIQUE INDEX `uc_users_companies` (`uc_user_id`, `uc_client_id`),
	INDEX `fk_users_companies_users1_idx` (`uc_user_id`),
	INDEX `fk_users_companies_companies1_idx` (`uc_client_id`),
	INDEX `user_id` (`uc_user_id`),
	INDEX `company_id` (`uc_client_id`),
	INDEX `ind_users_clients_uc_client_id_uc_active_status` (`uc_client_id`, `uc_active_status`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=56
;
