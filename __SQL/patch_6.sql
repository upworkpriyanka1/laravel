CREATE TABLE `patients` (
	`pt_id`              INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`pt_patient_login`   VARCHAR(100) NOT NULL,
	`pt_first_name`      VARCHAR(50) NOT NULL,
	`pt_middle_name`     VARCHAR(50) NULL,
	`pt_last_name`       VARCHAR(50) NOT NULL,
	`pt_prefix`          VARCHAR(20) NULL,
	`pt_suffix`          VARCHAR(20) NULL,
	`pt_password`        VARCHAR(255) NOT NULL,
	`pt_salt`            VARCHAR(255) NULL,
	`pt_email`           VARCHAR(100) NOT NULL,
	`pt_patient_active_status` ENUM('N','A','I') NOT NULL DEFAULT 'N',
	`pt_address`         VARCHAR(100) NOT NULL,
	`pt_suite`           VARCHAR(20) NULL,
	`pt_state`           VARCHAR(50) NULL,
	`pt_zip`             VARCHAR(10) NULL,
        `pt_gender`          enum('M','F') NOT NULL, --  M - Male,  F - Female
        `pt_birth_date`      DATE NULL,
	`pt_ss_number`       VARCHAR(20) NULL,

  `created_at`         datetime NOT NULL default CURRENT_TIMESTAMP,
  `updated_at`         datetime NULL ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY          (`pt_id`),
	UNIQUE INDEX         `ind_patients_pt_email` (`pt_email`),
	UNIQUE INDEX         `ind_patients_pt_patient_login` (`pt_patient_login`),
	UNIQUE INDEX         `ind_patients_pt_ss_number` (`pt_ss_number`),
	INDEX                `ind_patients_pt_patient_active_status_pt_gender` (`pt_patient_active_status`, `pt_gender`),
  INDEX                `ind_patients_created_at` (`created_at`)
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;

INSERT INTO `patients` ( `pt_id`,	`pt_patient_login`,	`pt_first_name`, `pt_middle_name`, `pt_last_name`, `pt_prefix`,	`pt_suffix`,
	`pt_password`, `pt_salt`,	`pt_email`,	`pt_patient_active_status`,	`pt_address`,	`pt_suite`,	`pt_state`, `pt_zip`,
  `pt_gender`, `pt_birth_date`,	`pt_ss_number` )
VALUES (  '1', 'JohnSmith',	'John', '', 'Smith', 'dr', '',
  '', '', 'JohnSmith@mailer.com', 'A', 'street # 2', 'app 26', 'MN', '90057',
  'M', '1982-12-15',	'123-45-6789'  );

INSERT INTO `patients` ( `pt_id`,	`pt_patient_login`,	`pt_first_name`, `pt_middle_name`, `pt_last_name`, `pt_prefix`,	`pt_suffix`,
	`pt_password`, `pt_salt`,	`pt_email`,	`pt_patient_active_status`,	`pt_address`,	`pt_suite`,	`pt_state`, `pt_zip`,
  `pt_gender`, `pt_birth_date`,	`pt_ss_number` )
VALUES (  '2', 'EdmundAdams',	'Edmund', 'Paul', 'Adams', 'prof', '',
  '', '', 'EdmundAdams@mail.com', 'N', 'street # 31', 'app 14', 'NY', '10002',
  'M', '1980-11-14',	'183-41-6384'  );

INSERT INTO `patients` ( `pt_id`,	`pt_patient_login`,	`pt_first_name`, `pt_middle_name`, `pt_last_name`, `pt_prefix`,	`pt_suffix`,
	`pt_password`, `pt_salt`,	`pt_email`,	`pt_patient_active_status`,	`pt_address`,	`pt_suite`,	`pt_state`, `pt_zip`,
  `pt_gender`, `pt_birth_date`,	`pt_ss_number` )
VALUES (  '3', 'MarkConroy',	'Mark', '', 'Conroy', '', 'esquire',
  '', '', 'MarkConroy@mailer.com', 'A', 'street # 2', 'app 26', 'NY', '10002',
  'M', '1976-09-11',	'82-95-6183'  );

INSERT INTO `patients` ( `pt_id`,	`pt_patient_login`,	`pt_first_name`, `pt_middle_name`, `pt_last_name`, `pt_prefix`,	`pt_suffix`,
	`pt_password`, `pt_salt`,	`pt_email`,	`pt_patient_active_status`,	`pt_address`,	`pt_suite`,	`pt_state`, `pt_zip`,
  `pt_gender`, `pt_birth_date`,	`pt_ss_number` )
VALUES (  '4', 'SarahBalder',	'Sarah', 'Olin', 'Balder', '​BSA', '',
  '', '', 'sarah_balder@mailsite.com', 'I', 'street # 32', 'app 134', 'CA', '90002',
  'F', '1975-11-25',	'964-16-9642'  );

INSERT INTO `patients` ( `pt_id`,	`pt_patient_login`,	`pt_first_name`, `pt_middle_name`, `pt_last_name`, `pt_prefix`,	`pt_suffix`,
	`pt_password`, `pt_salt`,	`pt_email`,	`pt_patient_active_status`,	`pt_address`,	`pt_suite`,	`pt_state`, `pt_zip`,
  `pt_gender`, `pt_birth_date`,	`pt_ss_number` )
VALUES (  '5', 'JenniferCiarens',	'Jennifer', '', 'Ciarens', 'BSc', '',
  '', '', 'JenniferCiarens@site.com', 'N', 'street # 75', 'app 236',  'CA', '90003',
  'F', '1988-02-25',	'113-04-6186'  );





CREATE TABLE `patient_bereavements` (
	`pb_id`                        INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`pb_patient_id`                INT(11) UNSIGNED NOT NULL,
	`pb_patient_able_discuss`      enum('0','1','2','3','4','5') NOT NULL, -- 0: Most Open - 5: Strong Denial
	`pb_caregiver_able_discuss`    enum('0','1','2','3','4','5') NOT NULL, -- 0: Most Open - 5: Strong Denial
	`pb_able_discuss_comments`     varchar(255) NOT NULL,
  `created_at`                   datetime NOT NULL default CURRENT_TIMESTAMP,
  `updated_at`                   datetime NULL ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY                    (`pb_id`),
  INDEX                         `ind_patient_bereavements_created_at` (`created_at`)
);
ALTER TABLE `patient_bereavements`
  ADD CONSTRAINT         `fk_patient_bereavements_patients_pb_patient_id` FOREIGN KEY (`pb_patient_id`) REFERENCES `patients` (`pt_id`) ON UPDATE NO ACTION ON DELETE NO ACTION;


INSERT INTO `patient_bereavements` ( `pb_id`,	`pb_patient_id`, `pb_patient_able_discuss` , `pb_caregiver_able_discuss`, `pb_able_discuss_comments` )
  VALUES (1, 1, '2', '3', 'discuss comments text Lorem  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore...');

INSERT INTO `patient_bereavements` ( `pb_id`,	`pb_patient_id`, `pb_patient_able_discuss` , `pb_caregiver_able_discuss`, `pb_able_discuss_comments` )
  VALUES (2, 2, '0', '4', 'discuss comments text Lorem  ipsum dolor sit amet, consectetur adipiscing elit, sed 2222 ...');

INSERT INTO `patient_bereavements` ( `pb_id`,	`pb_patient_id`, `pb_patient_able_discuss` , `pb_caregiver_able_discuss`, `pb_able_discuss_comments` )
  VALUES (3, 3, '5', '1', 'discuss comments text Lorem  ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 33333333...');

CREATE TABLE `patient_bereavements_grieving_process` (
	`pg_id`                        INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`pg_patient_bereavements_id`   INT(11) UNSIGNED NOT NULL,
  `pg_grieving_process`          varchar(1) NOT NULL,
	PRIMARY KEY                    (`pg_id`)
);
ALTER TABLE `patient_bereavements_grieving_process`
  ADD CONSTRAINT         `fk_patient_bgp_pg_patient_bereavements_id` FOREIGN KEY (`pg_patient_bereavements_id`) REFERENCES `patient_bereavements` (`pb_id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

INSERT INTO `patient_bereavements_grieving_process` (	`pg_id`, `pg_patient_bereavements_id`, `pg_grieving_process` )   VALUES
 (1, 1, 'd'),
(2, 1, 'g'),
(3, 1, 'u');

INSERT INTO `patient_bereavements_grieving_process` (	`pg_id`, `pg_patient_bereavements_id`, `pg_grieving_process` )   VALUES
(4, 2, 'c'),
(5, 2, 'a'),
(6, 2, 'u');

INSERT INTO `patient_bereavements_grieving_process` (	`pg_id`, `pg_patient_bereavements_id`, `pg_grieving_process` )   VALUES
(7, 3, 'm'),
(8, 3, 'g');



CREATE TABLE `patient_contacts` (
	`pc_id`                 INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`pc_patient_id`         INT(11) UNSIGNED NOT NULL,
	`pc_first_name`         VARCHAR(50) NOT NULL,
	`pc_last_name`          VARCHAR(50) NOT NULL,
	`pc_relationship`       VARCHAR(20) NOT NULL,

  `pc_power_of_attorney`  enum('G', 'S', 'H', 'L') NULL, -- 'G' - general power of attorney, 'S' - special power of attorney, 'H' - health care power of attorney  -- 'L' - Lives with patient

	`pc_phone_1`            VARCHAR(50) NULL,
	`pc_phone_1_type`       VARCHAR(20) NULL,
	`pc_phone_2`            VARCHAR(50) NULL,
	`pc_phone_2_type`       VARCHAR(20) NULL,
	`pc_email`              VARCHAR(100) NOT NULL,
	`pc_address`            VARCHAR(100) NOT NULL,
	`pc_city`               VARCHAR(50) NULL,
	`pc_state`              VARCHAR(50) NULL,
	`pc_zip`                VARCHAR(10) NULL,

  `created_at`         datetime NOT NULL default CURRENT_TIMESTAMP,
  `updated_at`         datetime NULL ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY          (`pc_id`),
	UNIQUE INDEX         `ind_patient_contacts_pc_email` (`pc_email`),
  INDEX                `ind_patient_contacts_created_at` (`created_at`)
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;

ALTER TABLE `patient_contacts`
  ADD CONSTRAINT         `fk_patient_contacts_patients_pc_patient_id` FOREIGN KEY (`pc_patient_id`) REFERENCES `patients` (`pt_id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

INSERT into `patient_contacts` (`pc_id` ,	`pc_patient_id`, `pc_first_name`,	`pc_last_name`,	`pc_relationship`, `pc_power_of_attorney`, `pc_phone_1`,
	`pc_phone_1_type`, `pc_phone_2`, `pc_phone_2_type`,	`pc_email`,	`pc_address`,	`pc_city`, `pc_state`, `pc_zip` )
	VALUES ( '1' ,	'1', 'Paul',	'Donovan',	'brother', 'G', '345-5435-4535',
	'mobile', '', '',	'PaulDonovan@seller.com', 'street # 23, apt 143', 'Afton', 'MN', '55001' );

INSERT into `patient_contacts` (`pc_id` ,	`pc_patient_id`, `pc_first_name`,	`pc_last_name`,	`pc_relationship`, `pc_power_of_attorney`, `pc_phone_1`,
	`pc_phone_1_type`, `pc_phone_2`, `pc_phone_2_type`,	`pc_email`,	`pc_address`,	`pc_city`, `pc_state`, `pc_zip` )
	VALUES ( '2' ,	'1', 'Diana',	'Donovan',	'sister', 'L', '315-0936-4935',
	'office', '', '',		'DianaDonovan@seller.com','street # 55, apt 25', 'Afton', 'MN', '55001' );


INSERT into `patient_contacts` (`pc_id` ,	`pc_patient_id`, `pc_first_name`,	`pc_last_name`,	`pc_relationship`, `pc_power_of_attorney`, `pc_phone_1`,
	`pc_phone_1_type`, `pc_phone_2`, `pc_phone_2_type`,	`pc_email`,	`pc_address`,	`pc_city`, `pc_state`, `pc_zip` )
	VALUES ( '3' ,	'3', 'Brad',	'Conroy',	'son', 'L', '952-1385-9632',
	'mobile', '9872-8765-3495', 'home',	'BradConroy@seller.com', 'street # 31, apt 5a', 'Afton', 'MN', '55001' );

INSERT into `patient_contacts` (`pc_id` ,	`pc_patient_id`, `pc_first_name`,	`pc_last_name`,	`pc_relationship`, `pc_power_of_attorney`, `pc_phone_1`,
	`pc_phone_1_type`, `pc_phone_2`, `pc_phone_2_type`,	`pc_email`,	`pc_address`,	`pc_city`, `pc_state`, `pc_zip` )
	VALUES ( '4' ,	'3', 'Jenny',	'Blue',	'', 'S', '542-8613-9371',
	'mobile', '341-9173-863', 'office',		'JennyBlue@goodlayer.com','street # 12, apt 98b', 'Bayport', 'MN', '55003' );

INSERT into `patient_contacts` (`pc_id` ,	`pc_patient_id`, `pc_first_name`,	`pc_last_name`,	`pc_relationship`, `pc_power_of_attorney`, `pc_phone_1`,
	`pc_phone_1_type`, `pc_phone_2`, `pc_phone_2_type`,	`pc_email`,	`pc_address`,	`pc_city`, `pc_state`, `pc_zip` )
	VALUES ( '5' ,	'5', 'Fil',	'Mood',	'', 'L', '591-8313-7321',
	'mobile', '5924-9474-122', 'home',		'FilMood@site.com','street # 3', 'Bayport', 'MN', '55003' );

