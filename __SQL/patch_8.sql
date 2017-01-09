alter TABLE `users` 
  change `user_active_status` `user_active_status`  ENUM( 'N', 'W', 'A', 'I' ) NOT NULL DEFAULT 'N';
  
  
CREATE TABLE `upload_bg` (
  `Id` INT(10) NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(100) NULL,
  timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)  
)
COLLATE='utf8_general_ci' ENGINE=InnoDB ;  


