ALTER TABLE `clients` 
  drop column `client_phone`;
  
ALTER TABLE `clients` 
  drop column `client_phone_2`;
  
ALTER TABLE `clients` 
  drop column `client_phone_3`;
  
ALTER TABLE `clients` 
  drop column `client_phone_4`;

ALTER TABLE `clients` 
  drop column `client_phone_type`;
  
CREATE TABLE `clients_phones` (
    `cp_id`                 MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,   
    `cp_clients_id`         MEDIUMINT(8) UNSIGNED NOT NULL,
    `cp_client_phone_2`     VARCHAR(50) NULL DEFAULT NULL,
    `cp_client_phone_type`  VARCHAR(20) NULL DEFAULT NULL,    
    `created_at`            DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`cp_id`),
    CONSTRAINT `fk_clients_phones_cp_clients_id` FOREIGN KEY (`cp_clients_id`) REFERENCES `clients` (`cid`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;



alter TABLE `clients` 
  add column `client_phone` varchar(50) NOT NULL after `client_zip`;
  
alter TABLE `clients` 
  add column `client_phone_2` varchar(50) DEFAULT NULL after `client_phone`;
  
  
alter TABLE `clients` 
  add column `client_phone_3` varchar(50) DEFAULT NULL after `client_phone_2`;
  
alter TABLE `clients` 
  add column `client_phone_4` varchar(50) DEFAULT NULL after `client_phone_3`;
  
alter TABLE `clients` 
  add column `client_phone_type` varchar(20) DEFAULT NULL after `client_phone_4`;
  
  
  `client_fax` varchar(50) NOT NULL,
  `client_email` varchar(50) DEFAULT NULL,
  `client_website` varchar(100) DEFAULT NULL,
  `color_scheme` smallint(2) DEFAULT NULL,
  `client_notes` text NOT NULL,
  `client_active_status` enum('P','A','I') NOT NULL DEFAULT 'P',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



	`client_phone_2` VARCHAR(50) NULL DEFAULT NULL,
	`client_phone_3` VARCHAR(50) NULL DEFAULT NULL,
	`client_phone_4` VARCHAR(50) NULL DEFAULT NULL,
	`client_phone_type` VARCHAR(20) NULL DEFAULT NULL,
	`client_fax` VARCHAR(50) NOT NULL,
	`client_email` VARCHAR(50) NULL DEFAULT NULL,
	`client_website` VARCHAR(100) NULL DEFAULT NULL,
	`color_scheme` VARCHAR(20) NULL DEFAULT NULL,
	`client_notes` TEXT NOT NULL,
	`client_active_status` ENUM('P','A','I') NOT NULL DEFAULT 'P',
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`cid`),
	INDEX `ind_clients_active_status_client_name` (`client_name`),
	INDEX `ind_clients_client_active_status_client_name` (`client_active_status`, `client_name`),
	INDEX `fk_clients_clients_types_id` (`clients_types_id`),
	CONSTRAINT `fk_clients_clients_types_id` FOREIGN KEY (`clients_types_id`) REFERENCES `clients_types` (`type_id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=17072
;
