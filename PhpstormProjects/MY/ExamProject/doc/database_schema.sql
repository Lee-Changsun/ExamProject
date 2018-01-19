create table user(
	userIdx int not null auto_increment,
	userId int not null unique,
	nickname char(30) not null,
	addDate  timestamp not null default current_timestamp,
	mod_date timestamp not null,
	primary key (userIdx)
);