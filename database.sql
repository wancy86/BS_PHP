use boystyle;

/*drop TABLE BS_ProURL;*/

create TABLE IF NOT EXISTS BS_ProURL(
	id int AUTO_INCREMENT,
	url varchar(500),
	title varchar(200),
	img_url varchar(300),
	img_list varchar(500),
	show_order int default 0,
	category varchar(50),
	entrydate timestamp  default CURRENT_TIMESTAMP,
	primary key(id)
)default charset=utf8;

select * from BS_ProURL;