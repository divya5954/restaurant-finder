CREATE TABLE `restro`.`restaurant` ( `r_id` INT(3) NOT NULL AUTO_INCREMENT , `r_name` VARCHAR(15) NOT NULL , `r_type` VARCHAR(10) NOT NULL , `r_add` VARCHAR(20) NOT NULL , `r_cuisine` VARCHAR(15) NOT NULL , `r_rat_avg` FLOAT NOT NULL , `r_rat_sum` INT NOT NULL , `r_rat_no` INT NOT NULL , `r_contact` INT NOT NULL , `r_time` TIME NOT NULL , `r_pic` VARCHAR(255) NOT NULL , PRIMARY KEY (`r_id`)) ENGINE = InnoDB; 

CREATE TABLE `restro`.`user` ( `u_id` INT NOT NULL AUTO_INCREMENT , `u_name` VARCHAR(10) NOT NULL , `u_pass` VARCHAR(15) NOT NULL , `u_email` VARCHAR(25) NOT NULL , PRIMARY KEY (`u_id`), UNIQUE (`u_email`)) ENGINE = InnoDB;

CREATE TABLE `restro`.`review` ( `rest_id` INT NOT NULL , `rev_id` INT NOT NULL AUTO_INCREMENT , `review` TEXT NOT NULL , PRIMARY KEY (`rev_id`)) ENGINE = InnoDB;

CREATE TABLE `restro`.`admin` ( `a_rev` TEXT NOT NULL , `ar_id` INT(1) NOT NULL AUTO_INCREMENT , `app` INT(1) NOT NULL DEFAULT '0' , `a_restid` INT NOT NULL , PRIMARY KEY (`ar_id`)) ENGINE = InnoDB;

CREATE TABLE `restro`.`suggestion` ( `s_id` INT NOT NULL AUTO_INCREMENT , `u_id` INT NOT NULL , `suggestion` TEXT NOT NULL , PRIMARY KEY (`s_id`)) ENGINE = InnoDB;

ALTER TABLE review ADD FOREIGN KEY (REST_ID) REFERENCES restaurant (R_ID)

ALTER TABLE suggestion ADD FOREIGN KEY (U_ID) REFERENCES user (U_ID)

ALTER TABLE admin ADD FOREIGN KEY (A_RESTID) REFERENCES restaurant (R_ID)

ALTER TABLE `review` ADD `u_id` INT NOT NULL AFTER `rev_id`;

ALTER TABLE review ADD FOREIGN KEY (U_ID) REFERENCES user (U_ID)

ALTER TABLE admin ADD FOREIGN KEY (U_ID) REFERENCES user (U_ID)