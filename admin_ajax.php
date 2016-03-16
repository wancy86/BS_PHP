<?php
require_once 'lib/mysql.func.php';

$action = $_GET['action'];
$uid = $_GET['uid'];

switch ($action) {
case 'search':
	//先插入数据
	$query = "replace into BS_UserOrder(order_id,uid) values($order_id,$uid)";
	$result = mysqli_query(connect(), $query);

	//查询单条记录返回
	$query = " select A.order_id, A.uid,";
	$query .= " IFNULL(B.pro_id,'') as pro_id,";
	$query .= " IFNULL(B.title,'') as title,";
	$query .= " IFNULL(B.seller_ww,'') as seller_ww,";
	$query .= " IFNULL(B.shop_name,'') as shop_name,";
	$query .= " IFNULL(B.pro_number,'') as pro_number,";
	$query .= " IFNULL(B.price,'') as price,";
	$query .= " IFNULL(B.order_status,'') as order_status,";
	$query .= " IFNULL(B.totalcomm_percent,'') as totalcomm_percent,";
	$query .= " IFNULL(B.share_percent,'') as share_percent,";
	$query .= " IFNULL(B.paid_amount,'') as paid_amount,";
	$query .= " IFNULL(B.earn_preview,'') as earn_preview,";
	$query .= " IFNULL(B.price_real,'') as price_real,";
	$query .= " IFNULL(B.earn_inplan,'0')*0.5 as earn_inplan,";
	$query .= " IFNULL(B.paid_date,'') as paid_date,";
	$query .= " IFNULL(B.comm_percent,'0')*0.5 as comm_percent,";
	$query .= " IFNULL(B.commission,'') as commission,";
	$query .= " IFNULL(B.butie_percent,'') as butie_percent,";
	$query .= " IFNULL(B.butie_amount,'') as butie_amount,";
	$query .= " IFNULL(B.butie_type,'') as butie_type,";
	$query .= " IFNULL(B.platform,'') as platform,";
	$query .= " IFNULL(B.thrid_server,'') as thrid_server,";
	$query .= " IFNULL(B.category,'') as category,";
	$query .= " IFNULL(B.ad_holder,'') as ad_holder,";
	$query .= " IFNULL(B.entry_date,'') as entry_date";
	$query .= " from BS_UserOrder as A ";
	$query .= " left join BS_Order as B on A.order_id=B.order_id";
	$query .= " where A.uid=$uid and A.order_id='$order_id'";
	$result = mysqli_query(connect(), $query);

	// echo "$query";

	echo json_encode(mysqli_fetch_assoc($result));
	break;
case 'del':
	$query = "delete from BS_UserOrder where uid=$uid and order_id=$order_id";
	$result = mysqli_query(connect(), $query);
	if ($result) {
		echo "删除成功";
	} else {
		echo "删除失败";
	}
	break;
}
?>