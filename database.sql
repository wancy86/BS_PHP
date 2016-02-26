
CREATE DATABASE IF NOT EXISTS boystyle CHARACTER SET utf8;
use boystyle;
/*
drop TABLE IF EXISTS BS_ProURL;
drop TABLE IF EXISTS BS_ProInfo;
*/
drop TABLE IF EXISTS BS_ProInfo;
create TABLE IF NOT EXISTS BS_ProInfo(
	pro_id DOUBLE,
	title varchar(1000),
	img_url varchar(300),
	detail_url varchar(500),
	shop_name VARCHAR(200),
	price float,
	month_sold INT,
	comm_percent FLOAT,
	seller_ww VARCHAR(200),	
	back_BB float,
	short_tbk_url VARCHAR(500),
	tbk_url VARCHAR(1000),
	
	commission float,
	earn float,
	img_list varchar(500),
	show_order int default 0,
	category varchar(100),
	entrydate timestamp  default CURRENT_TIMESTAMP,
	primary key(pro_id)
)default charset=utf8;

select * from BS_ProInfo;

/* DESC BS_ProInfo; */

