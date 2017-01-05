

alter TABLE `clients` 
  add column `client_img`  VARCHAR(100) NULL after `client_name`;
  
  
alter TABLE `users` 
  add column `created_at`  datetime NOT NULL  DEFAULT CURRENT_TIMESTAMP;

alter TABLE `users` 
  add column `updated_at`  datetime NULL ON UPDATE CURRENT_TIMESTAMP;

alter TABLE `users`
  add INDEX `ind_users_created_at` (`created_at`);

alter TABLE `users` drop column  `is_patient`;

alter TABLE `clients` 
  change column `created_at` `created_at`  datetime NOT NULL  DEFAULT CURRENT_TIMESTAMP;

alter TABLE `clients` 
  change column `updated_at` `updated_at`  datetime   DEFAULT CURRENT_TIMESTAMP;
