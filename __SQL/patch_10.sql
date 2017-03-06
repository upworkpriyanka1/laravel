
alter TABLE `clients` 
  add column `client_phone_2` VARCHAR(50) NULL after `client_phone`;
  

alter TABLE `clients` 
  add column `client_phone_3` VARCHAR(50) NULL after `client_phone_2`;
  
alter TABLE `clients` 
  add column `client_phone_4` VARCHAR(50) NULL after `client_phone_3`;
  
alter TABLE `clients` 
  add column `client_phone_type` VARCHAR(20) NULL after `client_phone_4`;

  

