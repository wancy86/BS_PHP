use boystyle;

create TABLE IF NOT EXISTS BS_ProURL(
	id int AUTO_INCREMENT PRIMARY,
	url varchar(500) CHARACTER SET UTF8,
	title varchar(200)CHARACTER SET UTF8,
	img_url varchar(300)CHARACTER SET UTF8,
	img_list varchar(500)CHARACTER SET UTF8,
	show_order int default 0,
	category varchar(50) CHARACTER SET UTF8,
	entrydate date default now()
);