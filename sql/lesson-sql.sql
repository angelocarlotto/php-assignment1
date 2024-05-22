create database worklogdb;

use worklogdb;

CREATE TABLE task_status (
  task_status_id int not null ,
  description varchar(20) NOT NULL,
  primary key (task_status_id)
);


CREATE TABLE employees (
  employee_id int not null auto_increment,
  full_name varchar(50) NOT NULL,
  primary key (employee_id)
);



CREATE TABLE tasks (
  task_id int not null auto_increment,
  title varchar(50) not null,
  employee_id_creation int not null ,
  employee_id_assigned  int not  null ,
  creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  start_date DATETIME NOT NULL,
  end_date DATETIME NOT NULL,
  task_status_id int not null default 0,
  description  varchar(1000) NOT NULL,
  solution varchar(1000) ,
  primary key (task_id),
  FOREIGN KEY (employee_id_creation)
      REFERENCES employees(employee_id),
      FOREIGN KEY (employee_id_assigned)
      REFERENCES employees(employee_id),
      FOREIGN KEY (task_status_id)
      REFERENCES task_status(task_status_id)
);




INSERT into task_status(task_status_id,description) VALUES 
 (0,'Not Initiated'),
 (1,'Doing'),
 (2,'Done');

INSERT into employees(full_name) values
 ('employee 1'),
 ('employee 2'),
 ('employee 3'),
 ('employee 4'),
 ('employee 5');


INSERT into tasks(title,employee_id_creation,employee_id_assigned,start_date, end_date,task_status_id, description) values
('create dashboard',1,1,'2014-05-31 23:59:59','2014-06-30 23:59:59',0,'this is a description of what have to be done');