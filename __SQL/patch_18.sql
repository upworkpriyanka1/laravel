

 select `email`, count(*) as c from `users` 
  group by `email` having c> 1;

 
alter TABLE `users` 
  add UNIQUE INDEX `ind_users_email` (`email`);
  
