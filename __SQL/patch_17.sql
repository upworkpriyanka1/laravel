ALTER TABLE `users_groups` 
  ADD COLUMN 	`status` ENUM('A','I', 'P') NOT NULL DEFAULT 'P';
  
  
  INSERT INTO `users_groups` ( `user_id`, `group_id`, `status`) VALUES
( 1, 5, 'A'),
( 1, 11, 'A');

  
UPDATE `users_groups` SET  `status`=  'A' WHERE `user_id` = 1;

  
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
  
 
 