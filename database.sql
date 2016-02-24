
CREATE DATABASE IF NOT EXISTS boystyle CHARACTER SET utf8;
use boystyle;

drop TABLE IF EXISTS BS_ProURL;

create TABLE IF NOT EXISTS BS_ProInfo(
	id int AUTO_INCREMENT,
	url varchar(500),
	price float,
	commission float,
	earn float,
	back_BB float,
	title varchar(200),
	img_url varchar(300),
	img_list varchar(500),
	show_order int default 0,
	category varchar(50),
	entrydate timestamp  default CURRENT_TIMESTAMP,
	primary key(id)
)default charset=utf8;

select * from BS_ProInfo;


