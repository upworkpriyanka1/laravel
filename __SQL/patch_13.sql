alter TABLE `clients` 
  change `client_active_status` `client_active_status` ENUM('P','A','I', 'N') NOT NULL DEFAULT 'P';
  

UPDATE `clients` SET `client_active_status` = 'P'  WHERE  `client_active_status` = 'N' or ( `client_active_status` is null ) or ( Trim(`client_active_status`) = '') ;
  
  
alter TABLE `clients` 
  change `client_active_status` `client_active_status` ENUM('P','A','I') NOT NULL DEFAULT 'P';
  
