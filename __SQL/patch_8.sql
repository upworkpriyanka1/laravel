alter TABLE `users` 
  change `user_active_status` `user_active_status`  ENUM( 'N', 'W', 'A', 'I' ) NOT NULL DEFAULT 'N';
  
  
CREATE TABLE `upload_bg` (
  `Id` INT(10) NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(100) NULL,
  timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)  
)
COLLATE='utf8_general_ci' ENGINE=InnoDB ;  


INSERT INTO `users_clients` (`uc_id`, `uc_user_id`, `uc_client_id`, `uc_active_status`, `updated_at`, `created_at`) VALUES
(22, 1, 9, 'E', NULL, '2017-01-06 08:08:21'),
(23, 1, 8, 'E', NULL, '2017-01-06 08:08:31');

INSERT INTO `users_clients` (`uc_id`, `uc_user_id`, `uc_client_id`, `uc_active_status`, `updated_at`, `created_at`) VALUES
(24, 3, 9, 'E', NULL, '2017-01-06 08:08:21'),
(25, 3, 8, 'E', NULL, '2017-01-06 08:08:31');

