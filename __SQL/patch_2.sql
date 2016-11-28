alter TABLE `clients`
  change client_is_active client_active_status enum('N','A','I') NOT NULL default 'N' ;

alter TABLE `clients`
  drop INDEX `is_active` ;
  
alter TABLE `clients` 
  ADD INDEX `ind_clients_client_active_status_client_name` (`client_active_status`, `client_name`);
  
