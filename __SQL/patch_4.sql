ALTER TABLE `clients`
  ADD CONSTRAINT         `fk_clients_clients_types_id` FOREIGN KEY (`clients_types_id`) REFERENCES `clients_types` (`type_id`) ON UPDATE NO ACTION ON DELETE NO ACTION;



CREATE TABLE `vendor_types` (
  `vt_id`                  MEDIUMINT(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `vt_name`                VARCHAR(100) NOT NULL,
  `vt_description`         TEXT NULL,
  `created_at`             datetime NOT NULL default CURRENT_TIMESTAMP,
  UNIQUE KEY `ind_vt_name` (`vt_name`),
  KEY `ind_vendor_types_created_at`     (`created_at`)
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;

INSERT INTO `vendor_types` ( `vt_name`, `vt_description` ) VALUES( 'Possible Supplies', 'Possible Supplies description text...' );
INSERT INTO `vendor_types` ( `vt_name`, `vt_description` ) VALUES( 'Medications', 'Medications description text...' );
INSERT INTO `vendor_types` ( `vt_name`, `vt_description` ) VALUES( 'Equipments', 'Equipments description text...' );
INSERT INTO `vendor_types` ( `vt_name`, `vt_description` ) VALUES( 'Staff visit', 'Staff visit description text...' );


 
CREATE TABLE `vendors` (
  `vn_id`                  MEDIUMINT(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `vn_name`                VARCHAR(100) NOT NULL,
  `vn_email`               varchar(50) NOT NULL,
  `vn_website`             varchar(100) NOT NULL,
  `vn_description`         TEXT NULL,
  `created_at`             datetime NOT NULL default CURRENT_TIMESTAMP,
  `updated_at`             datetime NULL ON UPDATE CURRENT_TIMESTAMP,

  UNIQUE KEY `ind_vendors_vn_name` (`vn_name`),
  UNIQUE KEY `ind_vendors_vn_email` (`vn_email`),
  KEY `ind_vendors_created_at`     (`created_at`)
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;
 
INSERT INTO `vendors` ( `vn_id`, `vn_name`, `vn_email`, `vn_website`, `vn_description` ) 
  VALUES( 1, 'vendor_1', 'vendor_1@site.com', 'http://vendor_1.com', 'vendor_1 description text...' );
INSERT INTO `vendors` ( `vn_id`, `vn_name`, `vn_email`, `vn_website`, `vn_description` ) 
  VALUES( 2, 'vendor_2', 'vendor_2@site.com', 'http://vendor_2.com', 'vendor_2 description text...' );
INSERT INTO `vendors` ( `vn_id`, `vn_name`, `vn_email`, `vn_website`, `vn_description` ) 
  VALUES( 3, 'vendor_3', 'vendor_3@site.com', 'http://vendor_3.com', 'vendor_3 description text...' );
INSERT INTO `vendors` ( `vn_id`, `vn_name`, `vn_email`, `vn_website`, `vn_description` ) 
  VALUES( 4, 'vendor_4', 'vendor_4@site.com', 'http://vendor_4.com', 'vendor_4 description text...' );
INSERT INTO `vendors` ( `vn_id`, `vn_name`, `vn_email`, `vn_website`, `vn_description` ) 
  VALUES( 5, 'vendor_5', 'vendor_5@site.com', 'http://vendor_5.com', 'vendor_5 description text...' );
  
  
CREATE TABLE `vendors_have_types` (
  `vh_id`                  MEDIUMINT(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `vh_vendor_id`              MEDIUMINT(8) NOT NULL,
  `vh_vendor_type_id`         MEDIUMINT(8) NOT NULL,
  `created_at`             datetime NOT NULL default CURRENT_TIMESTAMP,
  UNIQUE KEY `ind_vendors_have_types_vh_vendor_id_vh_vendor_type_id` (`vh_vendor_id`, `vh_vendor_type_id`),
  KEY `ind_vendors_have_types_created_at`     (`created_at`)
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;
  
ALTER TABLE `vendors_have_types`
  ADD CONSTRAINT         `fk_vendors_have_types_vh_vendor_id` FOREIGN KEY (`vh_vendor_id`) REFERENCES `vendors` (`vn_id`) ON UPDATE NO ACTION ON DELETE NO ACTION;
  
ALTER TABLE `vendors_have_types`
  ADD CONSTRAINT         `fk_vendors_have_types_vh_vendor_type_id` FOREIGN KEY (`vh_vendor_type_id`) REFERENCES `vendor_types` (`vt_id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

Insert into `vendors_have_types` ( `vh_vendor_id`, `vh_vendor_type_id` ) VALUES (1,2);
Insert into `vendors_have_types` ( `vh_vendor_id`, `vh_vendor_type_id` ) VALUES (1,3);
Insert into `vendors_have_types` ( `vh_vendor_id`, `vh_vendor_type_id` ) VALUES (2,2);
Insert into `vendors_have_types` ( `vh_vendor_id`, `vh_vendor_type_id` ) VALUES (2,4);
Insert into `vendors_have_types` ( `vh_vendor_id`, `vh_vendor_type_id` ) VALUES (3,1);


CREATE TABLE `vendor_contacts` (
  `vc_id`                     MEDIUMINT(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `vc_vendor_id`              MEDIUMINT(8) NOT NULL,
  `vc_person_name`            VARCHAR(50) NOT NULL,
  `vc_person_description`     VARCHAR(255) NOT NULL,
  `vc_phone`                  VARCHAR(50) NOT NULL,
  `vc_phone_description`      VARCHAR(255) NOT NULL,
  `vc_person_email`           VARCHAR(50) NOT NULL,
  `created_at`                datetime NOT NULL default CURRENT_TIMESTAMP,
  `updated_at`                DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY                  `ind_vendors_have_types_vc_vendor_id_vc_person_name` (`vc_vendor_id`, `vc_person_name`),
  KEY                         `ind_vendor_contacts_created_at`     (`created_at`)
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;
  
ALTER TABLE `vendor_contacts`
  ADD CONSTRAINT         `fk_vendor_contacts_vc_vendor_id` FOREIGN KEY (`vc_vendor_id`) REFERENCES `vendors` (`vn_id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

Insert into `vendor_contacts` ( `vc_id`, `vc_vendor_id`, `vc_person_name`, `vc_person_description`, `vc_phone`, `vc_phone_description`, `vc_person_email` ) 
  VALUES ( 1, 1, 'Person Name # 1', 'Person Description # 1', 'Phone # 1', 'Phone Description # 1...', 'person_email_1@server.com' );
  

Insert into `vendor_contacts` ( `vc_id`, `vc_vendor_id`, `vc_person_name`, `vc_person_description`, `vc_phone`, `vc_phone_description`, `vc_person_email` ) 
  VALUES ( 2, 1, 'Person Name # 2', 'Person Description # 2', 'Phone # 2', 'Phone Description # 2...', 'person_email_2@server.com' );
  

Insert into `vendor_contacts` ( `vc_id`, `vc_vendor_id`, `vc_person_name`, `vc_person_description`, `vc_phone`, `vc_phone_description`, `vc_person_email` ) 
  VALUES ( 3, 2, 'Person Name # 3', 'Person Description # 3', 'Phone # 3', 'Phone Description # 3...', 'person_email_3@server.com' );
  

Insert into `vendor_contacts` ( `vc_id`, `vc_vendor_id`, `vc_person_name`, `vc_person_description`, `vc_phone`, `vc_phone_description`, `vc_person_email` ) 
  VALUES ( 4, 2, 'Person Name # 4', 'Person Description # 4', 'Phone # 4', 'Phone Description # 4...', 'person_email_4@server.com' );
  

Insert into `vendor_contacts` ( `vc_id`, `vc_vendor_id`, `vc_person_name`, `vc_person_description`, `vc_phone`, `vc_phone_description`, `vc_person_email` ) 
  VALUES ( 5, 1, 'Person Name # 5', 'Person Description # 5', 'Phone # 5', 'Phone Description # 5...', 'person_email_5@server.com' );
  
