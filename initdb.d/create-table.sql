set character set utf8mb4;

create table students (
  class_no varchar(50) primary key,
  full_name varchar(50) not null,
  email varchar(50) unique key not null,
  password LONGTEXT not null,
  from_highschool varchar(50) not null
);

insert into students (class_no, full_name, email, password, from_highschool) values ('2024010104', '田中新太郎', 'tanaka-taro@example.com', SHA2('ocsjoho', 256), '大阪情報国際大学付属高校');