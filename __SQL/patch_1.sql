

alter TABLE `clients` 
  add  column `clients_types_id`  MEDIUMINT(8) NOT NULL after `client_name`;

UPDATE `clients` SET `clients_types_id`= 4;


alter TABLE `clients`
  change color_scheme color_scheme VARCHAR(20) NULL;


alter TABLE `clients` 
  add column `created_at` datetime NOT NULL;
  
alter TABLE `clients` 
  add column `updated_at` datetime NULL;
  
UPDATE clients SET `created_at` = '2016-11-23 13:26:38', `updated_at`  = '2016-11-23 13:26:38';
