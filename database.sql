
CREATE DATABASE IF NOT EXISTS boystyle DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
SHOW VARIABLES LIKE 'character%';
/* set character_set_client=utf8;
set character_set_connection=utf8;
set character_set_database=utf8;
set character_set_results=utf8;
set character_set_server=utf8;
SHOW VARIABLES LIKE 'character%'; */

use boystyle;
/*
drop TABLE IF EXISTS BS_ProURL;
drop TABLE IF EXISTS BS_ProInfo;
*/

create TABLE IF NOT EXISTS BS_ProInfo(
	pro_id bigint,
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
	disabled bit default 0,
	primary key(pro_id)
)default charset=utf8;

use boystyle;
select * from BS_ProInfo;

/* DESC BS_ProInfo; */


create TABLE IF NOT EXISTS BS_Category(
	cat_id int,
	category varchar(100),
	sub_cat varchar(100),
	cat_desc varchar(300),
	primary key(cat_id)
)default charset=utf8;

replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(101,'潮装','T恤','男神 - T恤');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(102,'潮装','裤子','男神 - 裤子');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(103,'潮装','衬衣','男神 - 衬衣');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(104,'鞋子','运动鞋','男神 - 运动鞋');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(105,'鞋子','皮鞋','男神 - 皮鞋');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(106,'鞋子','板鞋','男神 - 板鞋');

replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(201,'送女友','连衣裙春夏','女神 - 连衣裙春夏');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(202,'送女友','短裙','女神 - 短裙');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(203,'送女友','饰品','女神 - 饰品');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(204,'送女友','单鞋','女神 - 单鞋');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(205,'送女友','凉鞋','女神 - 凉鞋');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(206,'送女友','高跟鞋','女神 - 高跟鞋');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(207,'送女友','丝袜','女神 - 丝袜');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(208,'送女友','文胸','女神 - 文胸');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(209,'送女友','内裤','女神 - 内裤');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(210,'送女友','包包','女神 - 包包');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(211,'送女友','护肤','女神 - 护肤');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(212,'送女友','化妆品','女神 - 化妆品');

replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(301,'小屁孩','小衣服','小屁孩 - 小衣服');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(302,'小屁孩','小裤子','小屁孩 - 小裤子');

replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(401,'品质生活','其他','品质生活 - 其他');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(402,'品质生活','电子产品','品质生活 - 电子产品');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(501,'趣玩','趣玩','趣玩');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(601,'美食','美食','美食');

select * from BS_Category;








