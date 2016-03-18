﻿
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
	cat_id int,
	entrydate timestamp  default CURRENT_TIMESTAMP,
	disabled bit default 0,
	primary key(pro_id)
)default charset=utf8;
/*
use boystyle;
select * from BS_ProInfo;
*/
/* DESC BS_ProInfo; */


update BS_Proinfo
set commission=truncate(round(price*comm_percent/100.0,2),2);



create TABLE IF NOT EXISTS BS_Category(
	cat_id int,
	category varchar(100),
	sub_cat varchar(100),
	cat_desc varchar(300),
	primary key(cat_id)
)default charset=utf8;

delete from BS_Category;
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(101,'潮装','T恤','男神 - T恤');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(102,'潮装','裤子','男神 - 裤子');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(103,'潮装','衬衣','男神 - 衬衣');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(104,'男鞋','运动鞋','男神 - 运动鞋');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(105,'男鞋','皮鞋','男神 - 皮鞋');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(106,'男鞋','板鞋','男神 - 板鞋');

replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(201,'靓装','连衣裙春夏','女神 - 连衣裙春夏');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(202,'靓装','短裙','女神 - 短裙');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(203,'精美配饰','饰品','女神 - 饰品');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(204,'女鞋','单鞋','女神 - 单鞋');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(205,'女鞋','凉鞋','女神 - 凉鞋');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(206,'女鞋','高跟鞋','女神 - 高跟鞋');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(207,'精美配饰','丝袜','女神 - 丝袜');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(208,'精美配饰','文胸','女神 - 文胸');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(209,'精美配饰','内裤','女神 - 内裤');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(210,'精美配饰','包包','女神 - 包包');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(211,'美容护肤','护肤','女神 - 护肤');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(212,'美容护肤','化妆品','女神 - 化妆品');

replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(301,'童装','小衣服','儿童 - 小衣服');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(302,'童装','小裤子','儿童 - 小裤子');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(303,'玩具','玩具','儿童 - 玩具');

replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(401,'品质生活','品质生活','品质生活 - 其他');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(402,'电子产品','鼠键','品质生活 - 鼠键');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(403,'电子产品','手机','品质生活 - 手机');

replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(501,'创意趣玩','创意趣玩','创意趣玩');
replace into BS_Category(cat_id,category,sub_cat,cat_desc) values(601,'美食','美食','美食');

/*
select * from BS_Category;

select 
pro_id, title, img_url, detail_url, shop_name, price, month_sold, comm_percent, seller_ww, short_tbk_url, tbk_url
from BS_ProInfo as A
join BS_Category as B on A.cat_id=B.cat_id
where A.disabled=0
and B.category='送女友' 
order by A.pro_id
limit 0,15
*/


/*
*Table for user info
*/
create table if not exists BS_User(
	uid int auto_increment,
	account varchar(100),
	email varchar(200),
	phone varchar(20),
	pwd varchar(200),/*MD5*/
	invite_code varchar(20),
	invite_by int,
	reg_date datetime,
	primary key(uid)
)default charset=utf8;

insert into BS_User(account,email,phone,pwd)
select 'admin','wancy86@sina.com','13028865077','E10ADC3949BA59ABBE56E057F20F883E'
from dual where not exists(
	select * from BS_User where uid=1
);
/*
select * from BS_User;
*/
/*
*
*Create Table for JSON files
*
*/

/*
drop table BS_JSON;
*/
create table if not exists BS_JSON(
	fid int default 0,
	category varchar(100),
	load_order int,
	data_rows int,
	file_name varchar(300),
	entry_date datetime,
	primary key(file_name)
)default charset=utf8;
/*
select * from BS_JSON;
*/
/*
delete from BS_JSON;
*/


/*
*订单表，记录成交的订单数据，来自淘宝客中心的数据
*/
/*
drop table BS_Order;
*/
create table if not exists BS_Order(
	order_id bigint,/*订单编号*/
	pro_id bigint,/*商品ID*/
	title varchar(1000),/*商品详情*/
	seller_ww VARCHAR(200),	/*卖家旺旺*/
	shop_name VARCHAR(200),/*店铺名称*/
	pro_number int,/*商品数量*/
	price float,/*商品单价*/
	order_status varchar(200),/*订单状态*/
	totalcomm_percent FLOAT,/*收入比例*/
	share_percent varchar(100),/*分成比例*/
	paid_amount float,/*付款金额*/
	earn_preview float,/*效果预估*/
	price_real float,/*计算金额*/
	earn_inplan float,/*预估收入*/
	paid_date datetime,/*计算时间*/
	comm_percent FLOAT,/*佣金比例*/
	commission float,/*佣金*/
	butie_percent float,/*补贴比例*/
	butie_amount float,/*补贴金额*/
	butie_type varchar(200),/*补贴类型*/
	platform varchar(100),/*成交平台，PC*/
	thrid_server varchar(200),/*第三方服务*/
	category varchar(200),/*类目名称*/
	ad_holder bigint,/*来源媒体ID*/
	entry_date datetime,/*录入时间*/
	primary key(order_id)
)default charset=utf8;
/*
select * from BS_Order;
*/
/*
delete from BS_Order;
*/
/*
order_id ,pro_id ,title ,seller_ww ,shop_name ,pro_number ,price ,order_status ,totalcomm_percent ,share_percent ,paid_amount ,earn_preview ,price_real
,earn_inplan ,paid_date ,comm_percent ,commission ,butie_percent ,butie_amount ,butie_type ,platform ,thrid_server ,category ,ad_holder ,entry_date
*/


/*
*用户订单查询，添加修改
*/
create table if not exists BS_UserOrder(	
	order_id bigint,/*订单编号*/
	uid int,
	primary key(order_id)
)default charset=utf8;
/*
select A.order_id, 
from BS_UserOrder as A 
left join BS_Order as B on A.order_id=B.order_id
where A.uid=$uid
*/

replace into BS_UserOrder(order_id,uid)  values(1627901148814774,1),(1625509289254774,1);

select A.order_id, 
IFNULL(B.pro_id,'') as pro_id,
IFNULL(B.title,'') as title,
IFNULL(B.seller_ww,'') as seller_ww,
IFNULL(B.shop_name,'') as shop_name,
IFNULL(B.pro_number,'') as pro_number,
IFNULL(B.price,'') as price,
IFNULL(B.order_status,'') as order_status,
IFNULL(B.totalcomm_percent,'') as totalcomm_percent,
IFNULL(B.share_percent,'') as share_percent,
IFNULL(B.paid_amount,'') as paid_amount,
IFNULL(B.earn_preview,'') as earn_preview,
IFNULL(B.price_real,'') as price_real,
IFNULL(B.earn_inplan,'') as earn_inplan,
IFNULL(B.paid_date,'') as paid_date,
IFNULL(B.comm_percent,'') as comm_percent,
IFNULL(B.commission,'') as commission,
IFNULL(B.butie_percent,'') as butie_percent,
IFNULL(B.butie_amount,'') as butie_amount,
IFNULL(B.butie_type,'') as butie_type,
IFNULL(B.platform,'') as platform,
IFNULL(B.thrid_server,'') as thrid_server,
IFNULL(B.category,'') as category,
IFNULL(B.ad_holder,'') as ad_holder,
IFNULL(B.entry_date,'') as entry_date
from BS_UserOrder as A 
left join BS_Order as B on A.order_id=B.order_id



/*
*用户收藏夹
*使用insert
*/
create table if not exists BS_Favorite(	
	fid int auto_increment,
	uid int,
	pro_id bigint,
	memo varchar(200),
	entrydate date,
	primary key(fid)
)default charset=utf8;

/*

replace into BS_Favorite(uid,pro_id,entrydate)
values($uid,$pro_id,getdate())

delete from BS_Favorite	where uid=$uid and pro_id=$pro_id

*/


