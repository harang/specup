 create table greet (
 num int unsigned not null auto_increment,
 id varchar(15),
 nick varchar(10),
 subject varchar(255) not null,
 content text,
 regist_day varchar(20),
 hit int unsigned,
 file_name varchar(255),
 primary key(num)
 );