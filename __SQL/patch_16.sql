
ALTER TABLE `clients` 
	add unique index `ind_clients_client_email` (`client_email`);
	
	
	
ALTER TABLE `users_clients` 
  add column `uc_group_id` MEDIUMINT(8) UNSIGNED NOT NULL after `uc_client_id`;
  

UPDATE `users_clients` SET `uc_group_id` = 11;  
  
ALTER TABLE `users_clients`
  ADD CONSTRAINT `fk_users_clients_uc_group_id` FOREIGN KEY (`uc_group_id`) REFERENCES `groups` (`id`);
  

  
ALTER TABLE `users_clients`
  DROP KEY `uc_users_companies`;

ALTER TABLE `users_clients`
  ADD UNIQUE KEY `users_clients_` (`uc_user_id`,`uc_client_id`,`uc_group_id`);


  
INSERT INTO `users_clients` ( `uc_user_id`, `uc_client_id`, `uc_group_id`, `uc_active_status`, `created_at`, `updated_at`) VALUES
(66, 2, 9, 'E', '2016-12-01 09:10:09', NULL);
  