ALTER TABLE `clients`
  change `client_owner` `client_owner` VARCHAR(100) NULL;
  
ALTER TABLE `clients`
  change `client_email` `client_email` VARCHAR(50) NULL;
  
ALTER TABLE `clients`
  change `client_website` `client_website` VARCHAR(100) NULL;

UPDATE `clients` SET `color_scheme` = '1';
ALTER TABLE `clients`
  change `color_scheme` `color_scheme` smallint(2) NULL;
