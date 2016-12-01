alter TABLE `users`
  drop INDEX `is_active` ;

alter TABLE `users`
  drop column `active` ;
  
  
user_active_status

alter TABLE `users`
  change is_active user_active_status enum('N','A','I') NOT NULL default 'N' ;

  
alter TABLE `users` 
  ADD INDEX `ind_users_user_active_status_username` (`user_active_status`, `username`);
  

alter TABLE `users_clients`  
  drop INDEX `is_active`;
  
alter TABLE `users_clients`  
  drop INDEX `change_status`;

alter TABLE `users_clients`  
  change uc_is_active uc_active_status enum('E','O','N') NOT NULL default 'N' ; -- E-Employee, O-Only Out Of Staff, N- Not Related
  
  

  
alter TABLE `users_clients` 
  add column `created_at` datetime NOT NULL  DEFAULT CURRENT_TIMESTAMP;
  
alter TABLE `users_clients` 
  add column `updated_at` datetime NULL;

  
  
alter TABLE `activity_logs` 
  change `super_id` `super_id` INT(11) NULL;

  
  
  
  CREATE TABLE `users_clients` (
	`uc_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`uc_user_id` INT(11) UNSIGNED NOT NULL,
	`uc_client_id` MEDIUMINT(8) UNSIGNED NULL DEFAULT NULL,
	`uc_is_active` TINYINT(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`uc_id`),
	UNIQUE INDEX `uc_users_companies` (`uc_user_id`, `uc_client_id`),
	INDEX `fk_users_companies_users1_idx` (`uc_user_id`),
	INDEX `fk_users_companies_companies1_idx` (`uc_client_id`),
	INDEX `is_active` (`uc_is_active`),
	INDEX `user_id` (`uc_user_id`),
	INDEX `company_id` (`uc_client_id`),
	INDEX `change_status` (`uc_is_active`, `uc_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=11
;
