
CREATE TABLE `services` (
  `sv_id`                  MEDIUMINT(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `sv_title`               VARCHAR(100) NOT NULL,
  `sv_active_status`       enum('A','I') NOT NULL default 'I',
  
  `sv_vendor_type_id`      MEDIUMINT(8) NOT NULL,
  `sv_description`         TEXT NULL,
  `created_at`             datetime NOT NULL default CURRENT_TIMESTAMP,
  `updated_at`             datetime NULL ON UPDATE CURRENT_TIMESTAMP,

  UNIQUE KEY `ind_services_sv_title`         (`sv_title`),
  KEY `ind_services_sv_active_status`      (`sv_active_status`),
  KEY `ind_services_created_at`              (`created_at`)
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;

ALTER TABLE `services`
  ADD CONSTRAINT         `fk_services_vendor_types_sv_vendor_type_id` FOREIGN KEY (`sv_vendor_type_id`) REFERENCES `vendor_types` (`vt_id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

INSERT INTO `services` ( `sv_id`, `sv_title`, `sv_active_status`, `sv_vendor_type_id`, `sv_description` ) 
  VALUES( 1, 'Hospice at Home', 'A', 2, 'Hospice at Home description text' );

INSERT INTO `services` ( `sv_id`, `sv_title`, `sv_active_status`, `sv_vendor_type_id`, `sv_description` ) 
  VALUES( 2, 'Palliative Care', 'A', 2, 'Palliative Care description text' );

INSERT INTO `services` ( `sv_id`, `sv_title`, `sv_active_status`, `sv_vendor_type_id`, `sv_description` ) 
  VALUES( 3, 'Care for Veterans', 'A', 4, 'Care for Veterans description text' );

INSERT INTO `services` ( `sv_id`, `sv_title`, `sv_active_status`, `sv_vendor_type_id`, `sv_description` ) 
  VALUES( 4, 'Music Therapy', 'I', 1, 'Music Therapy description text' );
  
INSERT INTO `services` ( `sv_id`, `sv_title`, `sv_active_status`, `sv_vendor_type_id`, `sv_description` ) 
  VALUES( 5, 'Care for People of All Backgrounds', 'A', 3, 'Care for People of All Backgrounds description text' );
  
    

CREATE TABLE `service_images` (
  `si_id`                  MEDIUMINT(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `si_service_id`          MEDIUMINT(8) NOT NULL REFERENCES services (cv_id),
  `si_image`               VARCHAR(100) NOT NULL,
  `si_is_main`             enum('Y','N') NOT NULL default 'N',
  `created_at`             datetime NOT NULL default CURRENT_TIMESTAMP,
  UNIQUE KEY `ind_service_images_si_service_id_si_image`         ( `si_service_id`, `si_image` ),
  KEY `ind_service_images_si_service_id_si_is_main`              ( `si_service_id`, `si_is_main` ),
  KEY `ind_service_images_created_at`                            ( `created_at` )
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;

  
================
SET FOREIGN_KEY_CHECKS = 0;

alter TABLE `vendor_contacts`
	change `vc_vendor_id` `vc_vendor_id` MEDIUMINT(8) UNSIGNED NOT NULL;
alter TABLE `vendors`
	change `vn_id` `vn_id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT;

SET FOREIGN_KEY_CHECKS = 1;

=============
alter TABLE `users_clients`
	ADD key `ind_users_clients_uc_client_id_uc_active_status` (`uc_client_id`, `uc_active_status`);


CREATE TABLE `clients_vendors` (
	`cv_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`cv_client_id` MEDIUMINT(8) UNSIGNED NOT NULL,
	`cv_vendor_id` MEDIUMINT(8) NULL DEFAULT NULL,
	`cv_active_status` ENUM('P','N') NOT NULL DEFAULT 'N', -- P-Provides; N-Does Not Provides
	`updated_at` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`cv_id`),
	UNIQUE INDEX `cv_clients_vendors` ( `cv_client_id`, `cv_vendor_id` ),
	KEY `ind_cv_clients_cv_active_status` ( `cv_client_id`, `cv_active_status` )

)
COLLATE='utf8_general_ci'ENGINE=InnoDB;

ALTER TABLE `clients_vendors`
  ADD CONSTRAINT `fk_clients_vendors_cv_client_id` FOREIGN KEY (`cv_client_id`) REFERENCES `clients` (`cid`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `clients_vendors`
  ADD CONSTRAINT `fk_clients_vendors_cv_vendor_id` FOREIGN KEY (`cv_vendor_id`) REFERENCES `vendors` (`vn_id`) ON UPDATE NO ACTION ON DELETE NO ACTION;
  

s Clients can provide some services I would make in Client editor vendors listing with setting status "Provides"/"Does Not Provides". Very similar to "Related users".

    When accessing a client's details page, there should be a section called "Vendors". If the client is working with the vendor, the vendor will be listed. If the client has no vendors associated with the client, this section will be empty.

But do we need similar "Clients Providers" in vendor editor? That could be usefull for admin in vendor editor to see/change who of clients provides this service.



